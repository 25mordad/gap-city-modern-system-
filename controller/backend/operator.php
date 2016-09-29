<?php

/**
 * operator.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > operator
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/utility/hashing.php");

function index()
{
	$GLOBALS['GCMS']->assign('operators', Operator::get(NULL, true));
}

function new_operator()
{
	if(isset($_POST['email']))
	{
		//checking duplicate username & email...
		$chk_username=Operator::get(array("username" => $_POST['username']));
		$chk_email=Operator::get(array("email" => $_POST['email']));
		if(isset($chk_username))
		{
			$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
			$_SESSION['alert']="warning";
			header("location: /gadmin/operator/new");
		}
		else if(isset($chk_email))
		{
			$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
			$_SESSION['alert']="warning";
			header("location: /gadmin/operator/new");
		}
		else
		{
			//adding operator to db
			$password_salt=saltit($_POST['username']);
			$password=hashit($_POST['password'], $password_salt);
			$arr_insert=array(
						"username" => $_POST['username'],
						"email" => $_POST['email'],
						"temp_code" => "NULL",
						"password" => $password,
						"password_salt" => $password_salt,
						"password_attempts_failed" => 0,
						"name" => $_POST['name'],
						"status" => $_POST['status'],
						"op_level" => $_POST['level'],
						"add_id" => $_SESSION["userid"],
						"date_created" => date("Y-m-d H:i:s")
			);
			Operator::insert($arr_insert);

			//sending email...
			if($_POST['status']=="true")
			{
				$text_form="
                کاربر گرامی ".$_POST['username']." <br />
                شما توسط مدیر سایت در وب سایت ".$_SERVER['HTTP_HOST']
						." عضو شدید <br />
                 <br />
                آدرس ورود به کنترل پنل : ".$_SERVER['HTTP_HOST']."/login <br />
                نام کاربری : ".$_POST['username']."<br />
                ایمیل : ".$_POST['email']."<br />
                کلمه عبور : ".$_POST['password']
						."<br />
                لطفا بعد از ورود به کنترل پنل ، کلمه عبور را تغییر دهید. <br />
                با تشکر
                ";
				$arr_email=array(
							"from" => $GLOBALS['GCMS_SETTING']['general']['email'],
							"to" => $_POST['email'],
							"subject" => "به وب سایت ".$_SERVER['HTTP_HOST']." خوش آمدید.",
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
			}

			$_SESSION['result']="کاربر جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/operator/edit/".mysql_insert_id());
		}
	}
}

function edit($id)
{
	$operator=Operator::get(array("id" => $id));
	//superadmin does not exist for others
	if($operator->op_level=="10"&&$_SESSION["level"]!="10")
		header("location: /error404?error=operator&reason=user_not_exist");

	if(isset($_POST["email"]))
	{
		//checking duplicate username & email...
		if($operator->username!=$_POST['username'])
		{
			$chk_username=Operator::get(array("username" => $_POST['username']));
			if(isset($chk_username))
			{
				$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
				$_SESSION['alert']="warning";
				header("location: /gadmin/operator/edit/".$id);
				return;
			}
		}
		if($operator->email!=$_POST['email'])
		{
			$chk_email=Operator::get(array("email" => $_POST['email']));
			if(isset($chk_email))
			{
				$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
				$_SESSION['alert']="warning";
				header("location: /gadmin/operator/edit/".$id);
				return;
			}
		}
		//updating db...
		$arr_update=array(
					"id" => $id,
					"username" => $_POST['username'],
					"email" => $_POST['email'],
					"name" => $_POST['name'],
					"status" => $_POST['status'],
					"op_level" => $_POST['level']
		);
		Operator::update($arr_update);
		$_SESSION['result']="ویرایش انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/operator/edit/".$id);
	}
	$GLOBALS['GCMS']->assign('operator', $operator);
}

function pass($id)
{
	$operator=Operator::get(array("id" => $id));
	//superadmin does not exist for others
	if($operator->op_level=="10"&&$_SESSION["level"]!="10")
		header("location: /error404?error=operator&reason=user_not_exist");

	if(isset($_POST["password"]))
	{
		$password_salt=saltit($_POST['username']);
		$password=hashit($_POST['password'], $password_salt);
		//updating db...
		$arr_update=array(
					"id" => $id,
					"password" => $password,
					"password_salt" => $password_salt,
		);
		Operator::update($arr_update);

		//sending email...
		if($operator->status=="true")
		{
			$email_text="
                کاربر گرامی ".$operator->username." <br />
                کلمه عبور شما در سایت  ".$_SERVER['HTTP_HOST']
					."  تغییر کرد.<br />
                کلمه عبور جدید شما : ".$_POST['password'];
			$arr_email=array(
						"from" => "noreply@".$_SERVER['HTTP_HOST'],
						"to" => $operator->email,
						"subject" => "New Password From ".$_SERVER['HTTP_HOST'],
						"text" => $email_text,
						"sign" => ":: این ایمیل به صورت خودکار برای شما ارسال شده است ::",
						"URL" => $_SERVER['HTTP_HOST'],
			);
			$sendmail=new Email();
			$sendmail->set("html", true);
			$sendmail->getParams($arr_email);
			$sendmail->parseBody();
			$sendmail->setHeaders();
			$sendmail->send();
		}

		$_SESSION['result']="کلمه عبور ویرایش شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/operator/pass/".$id);
	}
	$GLOBALS['GCMS']->assign('operator', $operator);
}
