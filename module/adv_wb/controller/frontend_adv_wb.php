<?php

/**
 * frontend_adv_wb.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > adv_wb
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
	if($_SESSION["glogin_user_level"]==13)
		$GLOBALS['GCMS']
				->assign('classes',
						WbRelClassTeacher::get(array("id_teacher" => $_SESSION["glogin_user_id"]),
								true, array("by" => "id", "sort" => "DESC"), "class"));
	if($_SESSION["glogin_user_level"]==12)
		$GLOBALS['GCMS']
				->assign('classes',
						WbRelClassStudent::get(array("id_student" => $_SESSION["glogin_user_id"]),
								true, array("by" => "id", "sort" => "DESC"), "class"));
	/*
	 * For old nokhbegan tpl
	 */
	$GLOBALS['GCMS']->assign('default_year',WbYear::get(array("default" => "true")));
	if (isset($_GET['class']))
		$GLOBALS['GCMS']->assign('list_rel_class_lesson',
					WbRelClassLesson::get(array("id_class" => $_GET['class']), true,
							array("by" => "id", "sort" => "DESC"), true));
	/*
	 * End
	 */

}

function workbook($id)
{
	$GLOBALS['GCMS']->assign('default_year', WbYear::get(array("default" => "true")));
	$GLOBALS['GCMS']
			->assign('lessons',
					WbRelClassLesson::get(array("id_class" => $id), true,
							array("by" => "id", "sort" => "DESC"), true));
	$GLOBALS['GCMS']->assign('class', WbClass::get(array("id" => $id)));
}

function liststudent($id)
{
	$students=WbRelClassStudent::get(array("id_class" => $id), true,
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
	$GLOBALS['GCMS']->assign('students', $students);
	$GLOBALS['GCMS']->assign('class', WbClass::get(array("id" => $id)));
}

function listclass()
{
	//setting $_GET if not set
	if(!isset($_GET['paging']))
	{
		header("location: /adv_wb/listclass/?paging=1");
		return;
	}
	$default_year=WbYear::get(array("default" => "true"));
	$past_classes=WbRelClassStudent::get(array("id_student" => $_SESSION["glogin_user_id"]), true,
			NULL, "class");
	$has_class="false";
	if($past_classes)
		foreach($past_classes as $past_class)
		{
			if($past_class->id_year==$default_year->id)
				$has_class="true";
		}
	$GLOBALS['GCMS']->assign('has_class', $has_class);
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
	//assigning variables
	$classes=WbClass::get($arr_get, true, $order, $limit, $default_year->id);
	foreach($classes as $class)
	{
		$class->used_capacity=WbRelClassStudent::get_count(array("id_class" => $class->id));
	}
	$GLOBALS['GCMS']->assign('classes', $classes);
	$GLOBALS['GCMS']
			->assign('paging', ceil(WbClass::get_count($arr_get, $default_year->id)/$max_results));
}

function register($id)
{
	$class=WbClass::get(array("id" => $id));
	if(isset($id)&&isset($class))
	{
		if($class->tuition=="")
		{
			$_SESSION['result']="شهریه کلاس نامشخص است";
			$_SESSION['alert']="error";
			header("location: /adv_wb/listclass/?paging=1");
		}
		else if($class->capacity==WbRelClassStudent::get_count(array("id_class" => $id)))
		{
			$_SESSION['result']="ظرفیت کلاس تکمیل است";
			$_SESSION['alert']="error";
			header("location: /adv_wb/listclass/?paging=1");
		}
		else
		{

			$lessons=WbRelClassLesson::get(array("id_class" => $id), true, NULL, true);
			if($lessons)
				foreach($lessons as $lesson)
					if($lesson->id_parent!=0)
					{
						$passed=false;
						$to_pass=WbLesson::get(array("id" => $lesson->id_parent));
						$chk_passed=WbRelClassStudent::get(
								array("id_student" => $_SESSION["glogin_user_id"]), true, NULL,
								$lesson->id_parent);
						if($chk_passed)
							foreach($chk_passed as $item)
								if($item->type=="normal"
										&&$item->number>=$to_pass->accept_score)
								{
									$passed=true;
									break;
								}
						if(!$passed)
						{
							$_SESSION['result']="درس پیش‌نیاز گذرانده نشده است";
							$_SESSION['alert']="error";
							header("location: /adv_wb/listclass/?paging=1");
							return;
						}
					}

			$discount=MetaUser::get(
					array("id_user" => $_SESSION["glogin_user_id"], "name" => "tuition_discount"));
			if(isset($discount))
				$tuition_discount=$discount->value;
			else
				$tuition_discount=0;
			if($class->tuition>($_SESSION["glogin_user_credit"]+$tuition_discount))
			{
				$_SESSION['result']="اعتبار شما کافی نیست";
				$_SESSION['alert']="error";
				header("location: /adv_wb/listclass/?paging=1");
			}
			else
			{
				$default_year=WbYear::get(array("default" => "true"));
				$past_classes=WbRelClassStudent::get(
						array("id_student" => $_SESSION["glogin_user_id"]), true, NULL, "class");
				$has_class="false";
				if($past_classes)
					foreach($past_classes as $past_class)
					{
						if($past_class->id_year==$default_year->id)
							$has_class="true";
					}
				$GLOBALS['GCMS']->assign('has_class', $has_class);
				$GLOBALS['GCMS']->assign('class', $class);
				$GLOBALS['GCMS']->assign('tuition_discount', $tuition_discount);
			}

		}
	}
	else
		header("location: /error404?error=adv_wb&reason=class_not_exist");
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
				if(WbRelClassStudent::insert($arr))
				{
					$row_c=MetaUser::get(
							array("id_user" => $_POST['id_student'], "name" => "credit"));
					if(!isset($row_c->id))
					{
						$arr_new_meta=array(
									"id_user" => $_POST['id_student'],
									"name" => "credit",
									"value" => 0
						);
						MetaUser::insert($arr_new_meta);
						$row_c=MetaUser::get(
								array("id_user" => $_POST['id_student'], "name" => "credit"));
					}
					$new_credit=$row_c->value-$class->tuition+$_POST['tuition_discount'];
					$arr_update_meta=array(
								"id" => $row_c->id,
								"value" => $new_credit
					);
					MetaUser::update($arr_update_meta);
					$_SESSION["glogin_user_credit"]=$new_credit;
					if($_POST['tuition_discount']!=0)
					{
						$discount=MetaUser::get(
								array(
											"id_user" => $_POST['id_student'],
											"name" => "tuition_discount"
								));
						MetaUser::del($discount->id);
					}
					//
					$text_form="
					ثبت‌نام در سیستم ثبت شد
                            ";
					$arr_email=array(
								"from" => "info@rses.ir",
								"to" => $GLOBALS['GCMS_SETTING']['general']['email'],
								"subject" => "Register From ".$_SERVER['HTTP_HOST'],
								"text" => $text_form,
								"sign" => "::ارسال شده توسط سیستم::",
								"URL" => "آدرس سایت :: ".$_SERVER['HTTP_HOST'],
					);
					$sendmail=new Email();
					$sendmail->set("html", true);
					$sendmail->getParams($arr_email);
					$sendmail->parseBody();
					$sendmail->setHeaders();
					$sendmail->send();
					$_SESSION['result']="ثبت‌نام در کلاس با موفقیت انجام شد";
					$_SESSION['alert']="success";
					header("location: /adv_wb");
					return;
				}
				else
				{
					$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
				}
			}
		}
		else
		{
			$_SESSION['result']="دانش‌آموز به دلیل تکراری بودن اضافه نشد";
			$_SESSION['alert']="error";
		}
		header("location: /adv_wb/listclass/?paging=1");
	}
}
