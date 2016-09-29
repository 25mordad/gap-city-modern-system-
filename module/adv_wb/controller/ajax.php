<?php

/**
 * ajax.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Use: backend > AJAX Functions
 *
 * @author 25mordad <25mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

$controller=$_GET['controller'];
if(function_exists($controller))
{
	$controller();
}

function get_scores()
{
	$scores=WbScore::get(array("id_rel_class_lesson" => $_POST['id_rel_class_lesson']), true);
	$result='<div class="top"><span>لیست عناوین نمرات</span><div class="clear"></div></div>';
	if(count($scores)==0)
		$result.='<div class="row_0">هنوز نمره‌ای برای این درس اضافه نشده است.</div>';
	else
		foreach($scores as $score)
		{
			$arr_types=array(
						'far' => "فروردین",
						'ord' => "اردیبهشت",
						'kho' => "خرداد",
						'tir' => "تیر",
						'mor' => "مرداد",
						'sha' => "شهریور",
						'mhr' => "مهر",
						'abn' => "آبان",
						'azr' => "آذر",
						'dey' => "دی",
						'bah' => "بهمن",
						'sfn' => "اسفند",
						'normal' => "عادی",
						'midterm' => "میان‌ترم",
						'finterm' => "پایان‌ترم",
						'1midterm' => "نوبت اول مستمر 1",
						'1finterm' => "نوبت اول پایانی 1",
						'2midterm' => "نوبت دوم مستمر 2",
						'2finterm' => "نوبت دوم پایانی 2" ,
                        'clsact' => "فعالیت کلاسی" ,
                        'prgrs' => "پیشرفت" ,
                        'vocb' => "شفاهی" 
			);
			$result.='<div class="row_1"><span style="width: 200px;">'.$score->title
					.'</span><span style="width: 200px;">'.$arr_types[$score->type]
					.'</span><span style="width: 200px;"><a href="adv_wb/scores/'.$score->id.'">ثبت و ویرایش نمرات دانش‌آموزان</a></span><span style="width: 50px;" class="last">
			<a href="adv_wb/delscore/'.$score->id.'"
			title="نمره '.$score->title
					.' حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
			</span>
			<div class="clear"></div>
			</div>';
		}
	echo $result;
}

function get_users()
{
	$users=User::get(array("status" => "active", "user_level" => $_POST['level']), true,
			array("by" => "date_created", "sort" => "DESC"), NULL,
			"param_".key($GLOBALS['GCMS_USER_PARAM']));
	next($GLOBALS['GCMS_USER_PARAM']);
	$result='<option value="">انتخاب کنید</option>';
	foreach($users as $user)
	{
		$par2=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		$value=$user->username;
		if($user->value!=""||$par2->value!="")
			$value=$value." (".$user->value." ".$par2->value.")";
		$result=$result."<option ";
		if(isset($_POST['user_id'])&&$_POST['user_id']==$user->id)
			$result=$result."selected=\"selected\" ";
		$result=$result." value=\"".$user->id."\">".$value."</option>";
	}
	prev($GLOBALS['GCMS_USER_PARAM']);
	echo $result;
}
