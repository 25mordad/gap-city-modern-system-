<?php

/**
 * backend-user.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > user
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/utility/hashing.php");
$utilityfile = __COREROOT__."/module/user/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//setting $_GET if not set
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/user/?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=10;
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
	//setting search
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$users=User::get($arr_get, true, $order, $limit);
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
	$GLOBALS['GCMS']->assign('paging', ceil(User::get_count($arr_get)/$max_results));
}

function new_user()
{
	if(isset($_POST['username']))
	{
		//checking duplicate username & email...
		$chk_username=User::get(array("username" => $_POST['username']));
		$chk_email=User::get(array("email" => $_POST['email']));
		if(isset($chk_username))
		{
			$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
			$_SESSION['alert']="alarm";
			header("location: /gadmin/user/new");
		}
		else if(isset($chk_email))
		{
			$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
			$_SESSION['alert']="alarm";
			header("location: /gadmin/user/new");
		}
		else
		{
			//adding user to db
			$password_salt=saltit($_POST['username']);
			$password=hashit($_POST['password'], $password_salt);
			$arr_insert=array(
					"username" => $_POST['username'],
					"email" => $_POST['email'],
					"temp_code" => "NULL",
					"password" => $password,
					"password_salt" => $password_salt,
					"password_attempts_failed" => 0,
					"status" => $_POST['status'],
					"user_level" => $_POST['user_level'],
					"added_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s")
			);
			User::insert($arr_insert);
			$id_user=mysql_insert_id();
			foreach($GLOBALS['GCMS_USER_PARAM'] as $key => $val)
			{
				MetaUser::insert(
				array("id_user" => $id_user, "name" => "param_".$key, "value" => ""));
			}

			//sending email...
			if($_POST['status']=="active")
			{
				$text_form="
                کاربر گرامی ".$_POST['username']
                ." <br />
                شما توسط مدیر سایت در وب سایت ".$_SERVER['HTTP_HOST']
                ." عضو شدید <br />
                 <br />
                آدرس ورود به کنترل پنل : ".$_SERVER['HTTP_HOST']
                ."/user <br />
                نام کاربری : ".$_POST['username']."<br />
                ایمیل : ".$_POST['email']."<br />
                کلمه عبور : ".$_POST['password']
                ."<br />
                لطفا بعد از ورود به کنترل پنل ، کلمه عبور را تغییر دهید. <br />
                با تشکر
                ";
				if (false)
				{
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
				}else{
					$name="noreply-gatriya";
					$from="noreply@gatriya.com";
					$mail= new PHPMailer();
					$mail->IsSMTP();
					$mail->SMTPAuth=true;
					$mail->Host       = "mail.gatriya.com";
					$mail->Username= "noreply@gatriya.com";
					$mail->Password= "+,FDJ?#Gm*qE";
					$mail->AddAddress($_POST['email'], $_POST['email']);
					$mail->SetFrom($from, $name);
					$mail->AddReplyTo($from, $name);
					$mail->Subject    = "به وب سایت ".$_SERVER['HTTP_HOST']." خوش آمدید.";
					$mail->IsHTML(true);
					$body = '<html><body>';
					$body .= '<p style="direction:rtl;font-family:tahoma;">'.$text_form.'</p>';
					$body .= '<p style="direction:rtl;font-family:tahoma;">:: این ایمیل به صورت خودکار برای شما ارسال شده است ::</p>';
					$body .= "</body></html>";
					$mail->MsgHTML($body);
					$mail->AltBody= $text_form;
					$mail->Send();
						
				}

			}

			$_SESSION['result']="عضو جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/user/edit/".$id_user);
		}
	}
}

function edit($id)
{
	$user=User::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		$user_params=user_params($id);
		if(isset($_POST['submitForm']))
		{
			if(isset($_POST['edit_params'])&&$_POST['edit_params']=="true")
			{
				foreach($user_params as $user_param)
				{
					$value=$_POST['meta_'.$user_param['id']];
					if($value=="")
						$value="NULL";
					$arr_update_meta=array(
							"id" => $user_param['id'],
							"value" => $value
					);
					MetaUser::update($arr_update_meta);
				}
			}
			else
			{
				//checking duplicate username & email...
				/* if($user->username!=$_POST['username'])
				 {
				$chk_username=User::get(array("username" => $_POST['username']));
				if(isset($chk_username))
				{
				$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
				$_SESSION['alert']="alarm";
				header("location: /gadmin/user/edit/".$id);
				return;
				}
				} */
				if($user->email!=$_POST['email'])
				{
					$chk_email=User::get(array("email" => $_POST['email']));
					if(isset($chk_email))
					{
						$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
						$_SESSION['alert']="alarm";
						header("location: /gadmin/user/edit/".$id);
						return;
					}
				}
				$arr_update=array(
						"id" => $id,
						/* "username" => $_POST['username'], */
						"email" => $_POST['email'],
						"status" => $_POST['status'],
						"user_level" => $_POST['user_level']
				);
				User::update($arr_update);
			}
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/user/edit/".$id);
		}
		$GLOBALS['GCMS']->assign('user', $user);
		$GLOBALS['GCMS']->assign('user_params', $user_params);
	}
	else
		header("location: /error404?error=user&reason=user_not_exist");
}

function chngpass($id)
{
	$user=User::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		if(isset($_POST['confirm_password']))
		{
			$password_salt=saltit($_POST['username']);
			$password=hashit($_POST['password'], $password_salt);
			//updating db...
			$arr_update=array(
					"id" => $id,
					"password" => $password,
					"password_salt" => $password_salt,
			);
			User::update($arr_update);
			//sending email...
			if($user->status=="active")
			{
				$email_text="
				<p style=\"direction:rtl;font-family:tahoma;\">
                کاربر گرامی ".$user->username."
                </p>
				<p style=\"direction:rtl;font-family:tahoma;\">
                کلمه عبور شما در سایت  ".$_SERVER['HTTP_HOST']."  تغییر کرد.
                </p>
				<p style=\"direction:rtl;font-family:tahoma;\">
				نام کاربری : ".$user->username."
				</p>
				<p style=\"direction:rtl;font-family:tahoma;\">
                کلمه عبور جدید شما : ".$_POST['password'] ."
                </p>
                <p style=\"direction:rtl;font-family:tahoma;\">
                ورود به بخش کاربری : <a href=\"http://$_SERVER[HTTP_HOST]/user\" >http://".$_SERVER['HTTP_HOST']."/user</a>
                </p>
                ";

				if (false)
				{
					$arr_email=array(
							"from" => "noreply@".$_SERVER['HTTP_HOST'],
							"to" => $user->email,
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
				}else{
					$name="noreply-gatriya";
					$from="noreply@gatriya.com";
					$mail= new PHPMailer();
					$mail->IsSMTP();
					$mail->SMTPAuth=true;
					$mail->Host       = "mail.gatriya.com";
					$mail->Username= "noreply@gatriya.com";
					$mail->Password= "+,FDJ?#Gm*qE";
					$mail->AddAddress($user->email, $user->email);
					$mail->SetFrom($from, $name);
					$mail->AddReplyTo($from, $name);
					$mail->Subject    = "New Password From ".$_SERVER['HTTP_HOST'];
					$mail->IsHTML(true);
					$body = '<html><body>';
					$body .= '<p style="direction:rtl;font-family:tahoma;">'.$email_text.'</p>';
					$body .= '<p style="direction:rtl;font-family:tahoma;">:: این ایمیل به صورت خودکار برای شما ارسال شده است ::</p>';
					$body .= "</body></html>";
					$mail->MsgHTML($body);
					$mail->AltBody= $email_text;
					$mail->Send();
				}

			}
			$_SESSION['result']="کلمه عبور تغییر کرد";
			$_SESSION['alert']="success";
			header("location: /gadmin/user/chngpass/".$id);
		}
		$GLOBALS['GCMS']->assign('user', $user);
		$GLOBALS['GCMS']->assign('user_params', user_params($id));
	}
	else
		header("location: /error404?error=user&reason=user_not_exist");
}

function del($id)
{
	$user=User::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		$arr_update=array(
				"id" => $id,
				"status" => "delete"
		);
		User::update($arr_update);

		$_SESSION['result']="عضو حذف شد";
		$_SESSION['alert']="success";

		//setting $_GET if not set
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/user/?paging=".$_GET['paging']."&search=".$_GET['search']);
	}
	else
		header("location: /error404?error=user&reason=user_not_exist");
}

function undel($id)
{
	$user=User::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		$arr_update=array(
				"id" => $id,
				"status" => "pending"
		);
		User::update($arr_update);

		$_SESSION['result']="عضو بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/user/edit/".$id);
	}
	else
		header("location: /error404?error=user&reason=user_not_exist");
}

function setting()
{
	if(isset($_POST['submitForm']))
	{
		foreach($GLOBALS['GCMS_USER_LEVEL'] as $key => $val)
		{
			Setting::update(array("id" => $key, "st_value" => $_POST[$key]));
		}
		foreach($GLOBALS['GCMS_USER_PARAM'] as $key => $val)
		{
			Setting::update(array("id" => $key, "st_value" => $_POST[$key]));
		}
		$_SESSION['result']="ویرایش انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/user/setting/");
	}
}

function edit_credit()
{
	if(isset($_POST['submit']))
	{
		$credit=MetaUser::get(array("id_user" => $_POST['id_user'], "name" => "credit"));
		if(!isset($credit))
			MetaUser::insert(
					array(
							"id_user" => $_POST['id_user'],
							"name" => "credit",
							"value" => $_POST['credit']
					));
		else
			MetaUser::update(array("id" => $credit->id, "value" => $_POST['credit']));
		$_SESSION['result']="ویرایش انجام شد";
		$_SESSION['alert']="success";

		//setting $_GET if not set
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/user/?paging=".$_GET['paging']."&search=".$_GET['search']);
	}
}

