<?php

/**
 * backend_adv_wb.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > adv_wb
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/adv_wb/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//setting $_GET if not set
	if(!isset($_GET['branch']))
		$_GET['branch']="all";
	if(!isset($_GET['grade']))
		$_GET['grade']="all";
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /gadmin/adv_wb/?paging=1&search=".$_GET['search']."&branch="
						.$_GET['branch']."&grade=".$_GET['grade']);
	//preparing to query
	$max_results=20;
	$arr_get=array();
	$order=array(
				"by" => "id",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//setting filters
	if($_GET['branch']!="all")
		$arr_get['id_branch']=$_GET['branch'];
	if($_GET['grade']!="all")
		$arr_get['id_grade']=$_GET['grade'];
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$default_year=WbYear::get(array("default" => "true"));
	$classes=WbClass::get($arr_get, true, $order, $limit, $default_year->id);
	foreach($classes as $class)
	{
		$class->used_capacity=WbRelClassStudent::get_count(array("id_class" => $class->id));
	}
	require_once(__COREROOT__."/libs/utility/selecting.php");
	$GLOBALS['GCMS']->assign('branches', select_branch());
	$GLOBALS['GCMS']->assign('grades', select_grade());
	$GLOBALS['GCMS']->assign('classes', $classes);
	$GLOBALS['GCMS']
			->assign('paging', ceil(WbClass::get_count($arr_get, $default_year->id)/$max_results));
}

function newclass()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
					"id_grade" => $_POST['id_grade'],
					"name" => $_POST['name'],
					"capacity" => $_POST['capacity'],
					"text" => $_POST['text'],
					"id_branch" => $_POST['id_branch'],
					"ages" => $_POST['ages'],
					"sex" => $_POST['sex'],
					"tuition" => $_POST['tuition']
		);
		WbClass::insert($arr_insert);
		$_SESSION['result']="کلاس جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/adv_wb/editclass/".mysql_insert_id());
	}
	require_once(__COREROOT__."/libs/utility/selecting.php");
	$GLOBALS['GCMS']->assign('branches', select_branch());
	$GLOBALS['GCMS']->assign('grades', select_grade());
	$GLOBALS['GCMS']->assign('select_capacity', select_number(1, 80));
}

function editclass($id)
{
	$class=WbClass::get(array("id" => $id));
	if(isset($id)&&isset($class))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
						"id" => $id,
						"id_grade" => $_POST['id_grade'],
						"name" => $_POST['name'],
						"capacity" => $_POST['capacity'],
						"text" => $_POST['text'],
						"id_branch" => $_POST['id_branch'],
						"ages" => $_POST['ages'],
						"sex" => $_POST['sex'],
						"tuition" => $_POST['tuition']
			);
			WbClass::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/adv_wb/editclass/".$id);
		}
		require_once(__COREROOT__."/libs/utility/selecting.php");
		$GLOBALS['GCMS']->assign('branches', select_branch());
		$GLOBALS['GCMS']->assign('grades', select_grade());
		$GLOBALS['GCMS']->assign('select_capacity', select_number(1, 80));
		$GLOBALS['GCMS']->assign('class', $class);
	}
	else
		header("location: /error404?error=adv_wb&reason=class_not_exist");
}

function infoclass($id)
{
	$class=WbClass::get(array("id" => $id));
	if(isset($id)&&isset($class))
	{
		$lessons=WbRelClassLesson::get(array("id_class" => $class->id), true,
				array("by" => "id", "sort" => "DESC"), true);
		$teachers=WbRelClassTeacher::get(array("id_class" => $class->id), true,
				array("by" => "id", "sort" => "DESC"), "user");
		foreach($teachers as $teacher)
		{
			$par1=MetaUser::get(
					array(
								"id_user" => $teacher->id_teacher,
								"name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])
					));
			next($GLOBALS['GCMS_USER_PARAM']);
			$par2=MetaUser::get(
					array(
								"id_user" => $teacher->id_teacher,
								"name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])
					));
			prev($GLOBALS['GCMS_USER_PARAM']);
			$teacher->params="";
			if(isset($par1))
				$teacher->params=$teacher->params.$par1->value;
			if(isset($par2))
				$teacher->params=$teacher->params." ".$par2->value;
		}
		$students=WbRelClassStudent::get(array("id_class" => $class->id), true,
				array("by" => "id", "sort" => "DESC"), "user");
		foreach($students as $student)
		{
			$par1=MetaUser::get(
					array(
								"id_user" => $student->id_student,
								"name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])
					));
			next($GLOBALS['GCMS_USER_PARAM']);
			$par2=MetaUser::get(
					array(
								"id_user" => $student->id_student,
								"name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])
					));
			prev($GLOBALS['GCMS_USER_PARAM']);
			$student->params="";
			if(isset($par1))
				$student->params=$student->params.$par1->value;
			if(isset($par2))
				$student->params=$student->params." ".$par2->value;
		}
		$GLOBALS['GCMS']->assign('lessons', $lessons);
		$GLOBALS['GCMS']->assign('teachers', $teachers);
		$GLOBALS['GCMS']->assign('students', $students);
		$GLOBALS['GCMS']->assign('branch', WbBranch::get(array("id" => $class->id_branch)));
		$GLOBALS['GCMS']->assign('grade', WbGrade::get(array("id" => $class->id_grade)));
		require_once(__COREROOT__."/libs/utility/selecting.php");
		$GLOBALS['GCMS']->assign('select_lesson', select_lesson());
		$GLOBALS['GCMS']->assign('class', $class);
	}
	else
		header("location: /error404?error=adv_wb&reason=class_not_exist");
}

function scoreclass($id)
{
	$class=WbClass::get(array("id" => $id));
	if(isset($id)&&isset($class))
	{
		$lessons=WbRelClassLesson::get(array("id_class" => $class->id), true,
				array("by" => "id", "sort" => "DESC"), true);
		foreach($lessons as $lesson)
		{
			$select_lesson[$lesson->id]=$lesson->name;
		}
		$GLOBALS['GCMS']->assign('branch', WbBranch::get(array("id" => $class->id_branch)));
		$GLOBALS['GCMS']->assign('grade', WbGrade::get(array("id" => $class->id_grade)));
		$GLOBALS['GCMS']->assign('select_lesson', $select_lesson);
		$GLOBALS['GCMS']->assign('class', $class);
	}
	else
		header("location: /error404?error=adv_wb&reason=class_not_exist");
}

function delclass($id)
{
	$class=WbClass::get(array("id" => $id));
	if(isset($id)&&isset($class))
	{
		if(WbRelClassLesson::get_count(array("id_class" => $id))==0
				&&WbRelClassTeacher::get_count(array("id_class" => $id))==0
				&&WbRelClassStudent::get_count(array("id_class" => $id))==0)
		{
			WbClass::del($id);
			$_SESSION['result']="کلاس حذف شد";
			$_SESSION['alert']="success";
			if(!isset($_GET['paging']))
				$_GET['paging']="1";
			header("location: /gadmin/adv_wb/?paging=".$_GET['paging']);
		}
		else
		{
			$_SESSION['result']="کلاس به دلیل درس‌ها یا معلمان یا دانش‌آموزان موجود در آن حذف نشد";
			$_SESSION['alert']="error";
			header("location: /gadmin/adv_wb/infoclass/".$id);
		}
	}
	else
		header("location: /error404?error=adv_wb&reason=class_not_exist");
}

function branches()
{
	if(isset($_GET['edit']))
	{
		$branch=WbBranch::get(array("id" => $_GET['edit']));
		if(isset($branch))
			$GLOBALS['GCMS']->assign('branch', $branch);
	}
	$GLOBALS['GCMS']->assign('branches', WbBranch::get(NULL, true));
}

function newbranch()
{
	if(isset($_POST['submit']))
	{
		WbBranch::insert(array("name" => $_POST['name']));
		$_SESSION['result']="شعبه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/adv_wb/branches");
	}
}

function editbranch($id)
{
	$branch=WbBranch::get(array("id" => $id));
	if(isset($id)&&isset($branch))
	{
		if(isset($_POST['submit']))
		{
			WbBranch::update(array("id" => $id, "name" => $_POST['name']));
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/adv_wb/branches");
		}
	}
	else
		header("location: /error404?error=adv_wb&reason=branch_not_exist");
}

function delbranch($id)
{
	$branch=WbBranch::get(array("id" => $id));
	if(isset($id)&&isset($branch))
	{
		if(WbClass::get_count(array("id_branch" => $id))==0)
		{
			WbBranch::del($id);
			$_SESSION['result']="شعبه حذف شد";
			$_SESSION['alert']="success";
		}
		else
		{
			$_SESSION['result']="شعبه به دلیل کلاس‌های موجود در آن حذف نشد";
			$_SESSION['alert']="error";
		}
		header("location: /gadmin/adv_wb/branches");
	}
	else
		header("location: /error404?error=adv_wb&reason=branch_not_exist");
}

function grades()
{
	if(isset($_GET['edit']))
	{
		$grade=WbGrade::get(array("id" => $_GET['edit']));
		if(isset($grade))
			$GLOBALS['GCMS']->assign('grade', $grade);
	}
	if(!isset($_GET['paging']))
		header("location: /gadmin/adv_wb/grades/?paging=1");
	//preparing to query
	$max_results=15;
	$arr_get=array();
	$order=array(
				"by" => "id",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	$default_year=WbYear::get(array("default" => "true"));
	$GLOBALS['GCMS']
			->assign('grades',
					WbGrade::get(array("id_year" => $default_year->id), true, $order, $limit));
	$GLOBALS['GCMS']
			->assign('paging',
					ceil(WbGrade::get_count(array("id_year" => $default_year->id))/$max_results));
	$GLOBALS['GCMS']->assign('default_year', $default_year);
}

function newgrade()
{
	if(isset($_POST['submit']))
	{
		$default_year=WbYear::get(array("default" => "true"));
		WbGrade::insert(array("name" => $_POST['name'], "id_year" => $default_year->id));
		$_SESSION['result']="پایه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/adv_wb/grades/?paging=1");
	}
}

function editgrade($id)
{
	$grade=WbGrade::get(array("id" => $id));
	if(isset($id)&&isset($grade))
	{
		if(isset($_POST['submit']))
		{
			WbGrade::update(array("id" => $id, "name" => $_POST['name']));
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			if(!isset($_GET['paging']))
				$_GET['paging']="1";
			header("location: /gadmin/adv_wb/grades/?paging=".$_GET['paging']);
		}
	}
	else
		header("location: /error404?error=adv_wb&reason=grade_not_exist");
}

function delgrade($id)
{
	$grade=WbGrade::get(array("id" => $id));
	if(isset($id)&&isset($grade))
	{
		if(WbClass::get_count(array("id_grade" => $id))==0)
		{
			WbGrade::del($id);
			$_SESSION['result']="پایه حذف شد";
			$_SESSION['alert']="success";
		}
		else
		{
			$_SESSION['result']="پایه به دلیل کلاس‌های موجود در آن حذف نشد";
			$_SESSION['alert']="error";
		}
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/adv_wb/grades/?paging=".$_GET['paging']);
	}
	else
		header("location: /error404?error=adv_wb&reason=grade_not_exist");
}

function lessons()
{
	if(!isset($_GET['paging']))
	{
		header("location: /gadmin/adv_wb/lessons/?paging=1");
		return;
	}
	require_once(__COREROOT__."/libs/utility/selecting.php");
	if(isset($_GET['edit']))
	{
		$lesson=WbLesson::get(array("id" => $_GET['edit']));
		if(isset($lesson))
		{
			$GLOBALS['GCMS']->assign('lesson', $lesson);
			$GLOBALS['GCMS']->assign('select_lesson', select_lesson($lesson->id));
		}
		else
			$GLOBALS['GCMS']->assign('select_lesson', select_lesson());
	}
	else
		$GLOBALS['GCMS']->assign('select_lesson', select_lesson());
	//preparing to query
	$max_results=20;
	$arr_get=array();
	$order=array(
				"by" => "id",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	$GLOBALS['GCMS']->assign('lessons', WbLesson::get(NULL, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(WbLesson::get_count(NULL)/$max_results));
}

function newlesson()
{
	if(isset($_POST['submit']))
	{
		if($_POST['rate']=="")
			$_POST['rate']="NULL";
		if($_POST['code']=="")
			$_POST['code']="NULL";
		if($_POST['accept_score']=="")
			$_POST['accept_score']="NULL";
		WbLesson::insert(
				array(
							"name" => $_POST['name'],
							"id_parent" => $_POST['id_parent'],
							"rate" => $_POST['rate'],
							"code" => $_POST['code'],
							"accept_score" => $_POST['accept_score']
				));
		$_SESSION['result']="درس جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/adv_wb/lessons/?paging=1");
	}
}

function editlesson($id)
{
	$lesson=WbLesson::get(array("id" => $id));
	if(isset($id)&&isset($lesson))
	{
		if(isset($_POST['submit']))
		{
			if($_POST['rate']=="")
				$_POST['rate']="NULL";
			if($_POST['code']=="")
				$_POST['code']="NULL";
			if($_POST['accept_score']=="")
				$_POST['accept_score']="NULL";
			WbLesson::update(
					array(
								"id" => $id,
								"name" => $_POST['name'],
								"id_parent" => $_POST['id_parent'],
								"rate" => $_POST['rate'],
								"code" => $_POST['code'],
								"accept_score" => $_POST['accept_score']
					));
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			if(!isset($_GET['paging']))
				$_GET['paging']="1";
			header("location: /gadmin/adv_wb/lessons/?paging=".$_GET['paging']);
		}
	}
	else
		header("location: /error404?error=adv_wb&reason=lesson_not_exist");
}

function dellesson($id)
{
	$lesson=WbLesson::get(array("id" => $id));
	if(isset($id)&&isset($lesson))
	{
		if(WbLesson::get_count(array("id_parent" => $id))>0)
		{
			$_SESSION['result']="درس به دلیل پیش‌نیاز بودن حذف نشد";
			$_SESSION['alert']="error";
		}
		else if(WbRelClassLesson::get_count(array("id_lesson" => $id))>0)
		{
			$_SESSION['result']="درس به دلیل کلاس‌های مرتبط با آن حذف نشد";
			$_SESSION['alert']="error";
		}
		else
		{
			WbLesson::del($id);
			$_SESSION['result']="درس حذف شد";
			$_SESSION['alert']="success";
		}
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/adv_wb/lessons/?paging=".$_GET['paging']);
	}
	else
		header("location: /error404?error=adv_wb&reason=lesson_not_exist");
}

function addlessontoclass()
{
	if(isset($_POST['submit']))
	{
		$arr=array(
					"id_class" => $_POST['id_class'],
					"id_lesson" => $_POST['id_lesson']
		);
		if(WbRelClassLesson::get_count($arr)==0)
		{
			WbRelClassLesson::insert($arr);
			$_SESSION['result']="درس به کلاس اضافه شد";
			$_SESSION['alert']="success";
		}
		else
		{
			$_SESSION['result']="درس به دلیل تکراری بودن اضافه نشد";
			$_SESSION['alert']="error";
		}
		header("location: /gadmin/adv_wb/infoclass/".$_POST['id_class']);
	}
}

function addteachertoclass()
{
	if(isset($_POST['submit']))
	{
		$arr=array(
					"id_class" => $_POST['id_class'],
					"id_teacher" => $_POST['id_teacher']
		);
		if(WbRelClassTeacher::get_count($arr)==0)
		{
			WbRelClassTeacher::insert($arr);
			$_SESSION['result']="معلم به کلاس اضافه شد";
			$_SESSION['alert']="success";
		}
		else
		{
			$_SESSION['result']="معلم به دلیل تکراری بودن اضافه نشد";
			$_SESSION['alert']="error";
		}
		header("location: /gadmin/adv_wb/infoclass/".$_POST['id_class']);
	}
}

function addstudenttoclass()
{
	if(isset($_POST['submit']))
	{
		$arr=array(
					"id_class" => $_POST['id_class'],
					"id_student" => $_POST['id_student']
		);
		if(WbRelClassStudent::get_count($arr)==0)
		{
			$class=WbClass::get(array("id" => $_POST['id_class']));
			if($class->capacity
					==WbRelClassStudent::get_count(array("id_class" => $_POST['id_class'])))
			{
				$_SESSION['result']="ظرفیت کلاس تکمیل است";
				$_SESSION['alert']="error";
			}
			else
			{
				WbRelClassStudent::insert($arr);
				$_SESSION['result']="دانش‌آموز به کلاس اضافه شد";
				$_SESSION['alert']="success";
			}
		}
		else
		{
			$_SESSION['result']="دانش‌آموز به دلیل تکراری بودن اضافه نشد";
			$_SESSION['alert']="error";
		}
		header("location: /gadmin/adv_wb/infoclass/".$_POST['id_class']);
	}
}

function addscore()
{
	if(isset($_POST['submit']))
	{
		$arr=array(
					"id_rel_class_lesson" => $_POST['id_rel_class_lesson_hidden'],
					"title" => $_POST['title'],
					"type" => $_POST['type']
		);
		WbScore::insert($arr);
		$_SESSION['result']="نمره به درس مربوط به کلاس اضافه شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/adv_wb/scoreclass/".$_POST['id_class']);
	}
}

function dellessonfromclass($id)
{
	$item=WbRelClassLesson::get(array("id" => $id));
	if(isset($id)&&isset($item))
	{
		WbRelClassLesson::del($id);
		$_SESSION['result']="درس از کلاس حذف شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/adv_wb/infoclass/".$item->id_class);
	}
	else
		header("location: /error404?error=adv_wb&reason=item_not_exist");
}

function delteacherfromclass($id)
{
	$item=WbRelClassTeacher::get(array("id" => $id));
	if(isset($id)&&isset($item))
	{
		WbRelClassTeacher::del($id);
		$_SESSION['result']="معلم از کلاس حذف شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/adv_wb/infoclass/".$item->id_class);
	}
	else
		header("location: /error404?error=adv_wb&reason=item_not_exist");
}

function delstudentfromclass($id)
{
	$item=WbRelClassStudent::get(array("id" => $id));
	if(isset($id)&&isset($item))
	{
		WbRelClassStudent::del($id);
		$_SESSION['result']="دانش‌آموز از کلاس حذف شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/adv_wb/infoclass/".$item->id_class);
	}
	else
		header("location: /error404?error=adv_wb&reason=item_not_exist");
}

function delscore($id)
{
	$item=WbScore::get(array("id" => $id));
	if(isset($id)&&isset($item))
	{
		if(WbScoreStudent::get_count(array("id_score" => $id))>0)
		{
			$_SESSION['result']="نمره به دلیل نمرات ثبت‌شده درون آن حذف نشد";
			$_SESSION['alert']="error";
		}
		else
		{
			WbScore::del($id);
			$_SESSION['result']="نمره حذف شد";
			$_SESSION['alert']="success";
		}
		$rel=WbRelClassLesson::get(array("id" => $item->id_rel_class_lesson));
		header("location: /gadmin/adv_wb/scoreclass/".$rel->id_class);
	}
	else
		header("location: /error404?error=adv_wb&reason=item_not_exist");
}

function discounts()
{
	if(!isset($_GET['paging']))
		header("location: /gadmin/adv_wb/discounts/?paging=1");
	if(isset($_GET['edit']))
	{
		$discount=MetaUser::get(array("id" => $_GET['edit']));
		if(isset($discount))
		{
			$user=User::get(array("id" => $discount->id_user));
			$discount->username=$user->username;
			$GLOBALS['GCMS']->assign('discount', $discount);
		}
	}
	//preparing to query
	$max_results=15;
	$arr_get=array(
				"status_not" => "delete"
	);
	$order=array(
				"by" => "date_created",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//assigning variables
	$users=User::get($arr_get, true, $order, $limit, "tuition_discount");
	foreach($users as $user)
	{
		$par1=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		next($GLOBALS['GCMS_USER_PARAM']);
		$par2=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		prev($GLOBALS['GCMS_USER_PARAM']);
		$user->params="";
		if(isset($par1))
			$user->params=$user->params.$par1->value;
		if(isset($par2))
			$user->params=$user->params." ".$par2->value;
		$credit=MetaUser::get(array("id_user" => $user->id, "name" => "credit"));
		if(isset($credit))
			$user->credit=$credit->value;
		else
			$user->credit=0;
	}
	$GLOBALS['GCMS']->assign('users', $users);
	$GLOBALS['GCMS']->assign('paging', ceil(User::get_count($arr_get, "tuition_discount")/$max_results));
}

function newdiscount()
{
	if(isset($_POST['submit']))
	{
		if(MetaUser::get_count(array("id_user" => $_POST['id_user'], "name" => "tuition_discount"))
				==0)
		{
			MetaUser::insert(
					array(
								"id_user" => $_POST['id_user'],
								"name" => "tuition_discount",
								"value" => $_POST['tuition_discount']
					));
			$_SESSION['result']="تخفیف جدید ایجاد شد";
			$_SESSION['alert']="success";
		}
		else
		{
			$_SESSION['result']="تخفیف برای این کاربر قبلا ایجاد شده است";
			$_SESSION['alert']="error";
		}
		header("location: /gadmin/adv_wb/discounts/?paging=1");
	}
}

function editdiscount($id)
{
	$discount=MetaUser::get(array("id" => $id));
	if(isset($id)&&isset($discount))
	{
		if(isset($_POST['submit']))
		{
			MetaUser::update(array("id" => $id, "value" => $_POST['tuition_discount']));
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			if(!isset($_GET['paging']))
				$_GET['paging']="1";
			header("location: /gadmin/adv_wb/discounts/?paging=".$_GET['paging']);
		}
	}
	else
		header("location: /error404?error=adv_wb&reason=discount_not_exist");
}

function deldiscount($id)
{
	$discount=MetaUser::get(array("id" => $id, "name" => "tuition_discount"));
	if(isset($id)&&isset($discount))
	{
		MetaUser::del($id);
		$_SESSION['result']="تخفیف حذف شد";
		$_SESSION['alert']="success";

		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/adv_wb/discounts/?paging=".$_GET['paging']);
	}
	else
		header("location: /error404?error=adv_wb&reason=discount_not_exist");
}

function scores($id)
{
	$score=WbScore::get(array("id" => $id));
	$rel=WbRelClassLesson::get(array("id" => $score->id_rel_class_lesson), false, NULL, true);
	$class=WbClass::get(array("id" => $rel->id_class));

	if(isset($id)&&isset($class))
	{
		$students=WbRelClassStudent::get(array("id_class" => $class->id), true,
				array("by" => "id", "sort" => "DESC"), "user");

		if(isset($_POST['submit']))
		{
			foreach($students as $student)
			{
				$student_score=WbScoreStudent::get(
						array("id_score" => $id, "id_student" => $student->id_student));
				if(isset($student_score))
				{
					$arr_update=array(
								"id" => $student_score->id,
								"number" => $_POST['number_'.$id.'_'.$student->id_student]
					);
					WbScoreStudent::update($arr_update);
				}
				else
				{
					$arr_insert=array(
								"id_score" => $id,
								"id_student" => $student->id_student,
								"number" => $_POST['number_'.$id.'_'.$student->id_student]
					);
					WbScoreStudent::insert($arr_insert);
				}
			}
			$_SESSION['result']="تغییرات ثبت شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/adv_wb/scores/".$id);
			return;
		}

		foreach($students as $student)
		{
			$par1=MetaUser::get(
					array(
								"id_user" => $student->id_student,
								"name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])
					));
			next($GLOBALS['GCMS_USER_PARAM']);
			$par2=MetaUser::get(
					array(
								"id_user" => $student->id_student,
								"name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])
					));
			prev($GLOBALS['GCMS_USER_PARAM']);
			$student->params="";
			if(isset($par2))
				$student->params=$student->params.$par2->value;
			if(isset($par1))
				$student->params=$student->params."، ".$par1->value;

			$student_score=WbScoreStudent::get(
					array("id_score" => $id, "id_student" => $student->id_student));
			if(isset($student_score))
				$student->score=$student_score->number;
			else
				$student->score=$rel->accept_score;
		}
		usort($students, function($item1, $item2){
			return strcmp($item1->params, $item2->params);
		});
		$GLOBALS['GCMS']->assign('students', $students);
		$GLOBALS['GCMS']->assign('class', $class);
		$GLOBALS['GCMS']->assign('lesson', $rel);
		$GLOBALS['GCMS']->assign('score', $score);
	}
	else
		header("location: /error404?error=adv_wb&reason=class_not_exist");
}

function workbooks($id)
{
	$GLOBALS['GCMS']->assign('default_year', WbYear::get(array("default" => "true")));
	$GLOBALS['GCMS']
			->assign('lessons',
					WbRelClassLesson::get(array("id_class" => $id), true,
							array("by" => "id", "sort" => "DESC"), true));
	$GLOBALS['GCMS']->assign('class', WbClass::get(array("id" => $id)));
}
