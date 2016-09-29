<?php

/**
 * auth.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > auth
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/utility/hashing.php");

function login()
{
	if(isset($_SESSION["username"]))
	{
		header("location: /gadmin");
	}
	else
	{
		if(isset($_POST['user']))
		{
			$arr_get=array(
						"username" => $_POST['user']
			);
			$chk_user=Operator::get($arr_get);
			if(isset($chk_user))
			{
				if($chk_user->status=="true")
				{
					//user ok. checking password...
					if($chk_user->password==hashit($_POST['password'], $chk_user->password_salt))
					{
						//password ok. setting sessions...
						$_SESSION["userid"]=$chk_user->id;
						$_SESSION["username"]=$chk_user->username;
						$_SESSION["email"]=$chk_user->email;
						$_SESSION["name"]=$chk_user->name;
						$_SESSION["level"]=$chk_user->op_level;
						//reseting password_attempts_failed
						if($chk_user->password_attempts_failed>0)
						{
							$arr_update=array(
										"id" => $chk_user->id,
										"password_attempts_failed" => 0
							);
							Operator::update($arr_update);
						}
						//redirecting...
						$pending_count=Comment::get_count(array("cm_status" => "pending"));
						if($pending_count==0)
						{
							$_SESSION['result']="خوش‌آمدید";
							$_SESSION['alert']="success";
						}
						else
						{
							$_SESSION['result']="خوش‌آمدید. $pending_count نظر در انتظار تایید هستند.";
							$_SESSION['alert']="alarm";
						}
						if(isset($_POST['redirect']))
						{
							header("location: ".$_POST['redirect']);
						}
						else
						{
							header("location: /gadmin");
						}
					}
					else
					{
						//wrong pass. disabling user after 5 attempts...
						if($chk_user->password_attempts_failed==4)
						{
							$arr_update=array(
										"id" => $chk_user->id,
										"password_attempts_failed" => 5,
										"status" => "false"
							);
						}
						else
						{
							$arr_update=array(
										"id" => $chk_user->id,
										"password_attempts_failed" => $chk_user->password_attempts_failed+1
							);
						}
						Operator::update($arr_update);

						$_SESSION['result']="کلمه عبور نادرست است";
						$_SESSION['alert']="error";
						header("location: /login");
					}
				}
				else
				{
					$_SESSION['result']="حساب شما غیرفعال شده است";
					$_SESSION['alert']="error";
					header("location: /login");
				}
			}
			else
			{
				$_SESSION['result']="نام کاربری نادرست است";
				$_SESSION['alert']="error";
				header("location: /login");
			}

		}
	}
}

function logout()
{
	if(isset($_SESSION["username"]))
	{
		unset($_SESSION["userid"]);
		unset($_SESSION["username"]);
		unset($_SESSION["email"]);
		unset($_SESSION["name"]);
		unset($_SESSION["level"]);
	}
	header("location: /login");
}

function forgot()
{
	if(isset($_SESSION["username"]))
	{
		header("location: /gadmin");
	}
	else
	{
		if(isset($_POST["submit"]))
		{

			$arr_get=array(
						"username" => $_POST['user']
			);
			$chk_user=Operator::get($arr_get);

			if(isset($chk_user))
			{
				if($chk_user->status=="true")
				{
					//user ok. checking email...
					if($chk_user->email==$_POST['email'])
					{
						//email ok. sending reset pass email...
						$t_c=rndstring(100);
						$arr_update=array(
									"id" => $chk_user->id,
									"temp_code" => $t_c
						);
						Operator::update($arr_update);

						$email_text="
						        برای رسیدن به کلمه عبور جدید ، <a href=\"http://$_SERVER[HTTP_HOST]/forgot?email=$chk_user->email&t_c=$t_c\" >اینجا</a> را کلیک کنید و یا لینک زیر را دنبال کنید : <br/>
						        http://$_SERVER[HTTP_HOST]/forgot?email=$chk_user->email&t_c=$t_c
						        <br/>
						        ";
						$arr_email=array(
									"from" => "noreply@".$_SERVER['HTTP_HOST'],
									"to" => $chk_user->email,
									"subject" => "Change Password Link From ".$_SERVER['HTTP_HOST'],
									"text" => $email_text,
									"sign" => ":: این ایمیل به صورت خودکار برای شما ارسال شده است ::",
									"URL" => $_SERVER['HTTP_HOST'],
						);
						$sendmail=new Email();
						$sendmail->set("html", true);
						$sendmail->getParams($arr_email);
						$sendmail->parseBody();
						$sendmail->setHeaders();

						if($sendmail->send())
						{
							$_SESSION['result']="لینک تغییر کلمه عبور، به آدرس ایمیل شما ارسال شد ";
							$_SESSION['alert']="success";
							header("location: /login");
						}
						else
						{
							$_SESSION['result']="مشکلی در ارسال ایمیل به وجود آمد، دوباره تلاش کنید";
							$_SESSION['alert']="error";
							header("location: /forgot");
						}
					}
					else
					{
						$_SESSION['result']="آدرس ایمیل نادرست است";
						$_SESSION['alert']="error";
						header("location: /forgot");
					}
				}
				else
				{
					$_SESSION['result']="حساب شما غیرفعال شده است";
					$_SESSION['alert']="error";
					header("location: /forgot");
				}
			}
			else
			{
				$_SESSION['result']="نام کاربری نادرست است";
				$_SESSION['alert']="error";
				header("location: /forgot");
			}
		}

		if(isset($_GET['email'])&&isset($_GET['t_c']))
		{
			$arr_get=array(
						"email" => $_GET['email'],
						"temp_code" => $_GET['t_c']
			);
			$chk_user=Operator::get($arr_get);
			if(isset($chk_user))
			{
				$n_p=rndstring(8);
				$password_salt=saltit($chk_user->username);
				$password=hashit($n_p, $password_salt);

				$arr_update=array(
							"id" => $chk_user->id,
							"temp_code" => "NULL",
							"password" => $password,
							"password_salt" => $password_salt
				);
				Operator::update($arr_update);

				$email_text="
                کلمه عبور جدید شما : $n_p
                ";
				$arr_email=array(
							"from" => "noreply@".$_SERVER['HTTP_HOST'],
							"to" => $chk_user->email,
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

				if($sendmail->send())
				{
					$_SESSION['result']="کلمه عبور جدید، به آدرس ایمیل شما ارسال شد ";
					$_SESSION['alert']="success";
					header("location: /login");
				}
				else
				{
					$_SESSION['result']="مشکلی در ارسال ایمیل به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
					header("location: /forgot");
				}
			}
			else
			{
				$_SESSION['result']="درحواست شما معتبر نیست،‌ دوباره تلاش کنید";
				$_SESSION['alert']="error";
				header("location: /forgot");
			}
		}
	}
}
