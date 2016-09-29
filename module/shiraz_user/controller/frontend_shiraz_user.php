<?php

/**
 * frontend-shiraz_user.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > shiraz_user
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/club/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /shiraz_user/profile");
	}
	else
	{
		if(isset($_POST['login']))
		{
			if($_POST['capcha']
					&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']))
			{
				$_SESSION['result']="کد تصویری را وارد نکرده‌اید و یا اشتباه وارد کرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['username']=="")
			{
				$_SESSION['result']="نام کاربری را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['password']=="")
			{
				$_SESSION['result']="کلمه عبور را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else
			{
				$chk_user=Shiraz_user::get(array("username" => $_POST['username']));
				if(isset($chk_user))
				{
					if($chk_user->status=="active")
					{
						//user ok. checking password...
						require_once(__COREROOT__."/libs/utility/hashing.php");
						if($chk_user->password
								==hashit($_POST['password'], $chk_user->password_salt))
						{
							//password ok. setting sessions...
							$_SESSION["glogin_username"]=$chk_user->username;
							$_SESSION["glogin_email"]=$chk_user->email;
							$_SESSION["glogin_user_level"]=$chk_user->level;
                            $_SESSION["glogin_user_id"]=$chk_user->id;
                            $_SESSION["glogin_user_plus"]=$chk_user->plus_count;
							$_SESSION['result']="خوش‌آمدید";
							$_SESSION['alert']="success";

							if(isset($_POST['redirect']))
							{
								header("location: ".$_POST['redirect']);
							}
							else
							{
								header("location: /shiraz_user/profile");
							}
							return;
						}
						else
						{

							$_SESSION['result']="کلمه عبور نادرست است";
							$_SESSION['alert']="error";
						}
					}
					else
					{
						$_SESSION['result']="حساب شما غیرفعال شده است";
						$_SESSION['alert']="error";
					}
				}
				else
				{
					$_SESSION['result']="نام کاربری نادرست است";
					$_SESSION['alert']="error";
				}
			}
			header("location: /shiraz_user");
		}
	}
}

function forgot()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /shiraz_user/profile");
	}
	else
	{
		if(isset($_GET['forgot'])&&$_GET['forgot']=="true")
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			if(!email_validation($_POST['email']))
			{
				$_SESSION['result']="آدرس ایمیل معتبر نیست";
				$_SESSION['alert']="alarm";
			}
			else
			{
				$chk_user=Shiraz_user::get(array("email" => $_POST['email']));
				if(isset($chk_user))
				{
					if($chk_user->status=="active")
					{
						require_once(__COREROOT__."/libs/utility/hashing.php");
						//email ok. sending reset pass email...
						$t_c=rndstring(100);
						$arr_update=array(
								"id" => $chk_user->id,
								"temp_code" => $t_c
						);
						Shiraz_user::update($arr_update);

						$email_text="
						برای رسیدن به کلمه عبور جدید ، <a href=\"http://$_SERVER[HTTP_HOST]/shiraz_user/forgot?email=$chk_user->email&t_c=$t_c\" >اینجا</a> را کلیک کنید و یا لینک زیر را دنبال کنید : <br/>
						http://$_SERVER[HTTP_HOST]/shiraz_user/forgot?email=$chk_user->email&t_c=$t_c
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
						}
						else
						{
							$_SESSION['result']="مشکلی در ارسال ایمیل به وجود آمد، دوباره تلاش کنید";
							$_SESSION['alert']="error";
						}
					}
					else
					{
						$_SESSION['result']="حساب شما غیرفعال شده است";
						$_SESSION['alert']="error";
					}
				}
				else
				{
					$_SESSION['result']="آدرس ایمیل نادرست است";
					$_SESSION['alert']="error";
				}
			}
			header("location: /shiraz_user/forgot");
		}

		if(isset($_GET['email'])&&isset($_GET['t_c']))
		{
			$arr_get=array(
					"email" => $_GET['email'],
					"temp_code" => $_GET['t_c']
			);
			$chk_user=Shiraz_user::get($arr_get);
			if(isset($chk_user))
			{
				require_once(__COREROOT__."/libs/utility/hashing.php");
				$n_p=rndstring(8);
				$password_salt=saltit($chk_user->username);
				$password=hashit($n_p, $password_salt);

				$arr_update=array(
						"id" => $chk_user->id,
						"temp_code" => "NULL",
						"password" => $password,
						"password_salt" => $password_salt
				);
				Shiraz_user::update($arr_update);

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
				}
				else
				{
					$_SESSION['result']="مشکلی در ارسال ایمیل به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
				}
			}
			else
			{
				$_SESSION['result']="درحواست شما معتبر نیست،‌ دوباره تلاش کنید";
				$_SESSION['alert']="error";
			}
			header("location: /shiraz_user");
		}
	}
}

function profile()
{
	if(isset($_SESSION["glogin_username"]))
	{
		if(isset($_GET['edit_params'])&&$_GET['edit_params']=="true")
		{
			

			require_once(__COREROOT__."/libs/utility/validating.php");
			if($_POST['email']!=$_SESSION["glogin_email"])
			{
				if(!email_validation($_POST['email']))
				{
					$_SESSION['result']="آدرس ایمیل معتبر نیست";
					$_SESSION['alert']="alarm";
					header("location: /shiraz_user/profile");
					return;
				}
				else if(Shiraz_user::get_count(array("email" => $_POST['email']))>0)
				{
					$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
					header("location: /shiraz_user/profile");
					return;
				}
			}
			if($_POST['cell']=="" || !cell_validation($_POST['cell']))
			{
					$_SESSION['result']="شماره همراه معتبر نیست";
					$_SESSION['alert']="alarm";
					header("location: /shiraz_user/profile");
					return;
			}
			if($_POST['birthdate']!="")
				$birthdate=shamsi_to_miladi($_POST['birthdate']);
			else
				$birthdate="NULL";
			
			$arr_update=array(
						"id" => $_SESSION["glogin_user_id"],
						"email" => $_POST['email'],
						"gender" => $_POST['gender'],
						"cell" => $_POST['cell'],
						"name" => $_POST['name'],
						"birthdate" => $birthdate,
						"address" => $_POST['address'],
						"avatar" => $_POST['avatar']
				);
			Shiraz_user::update($arr_update);
			$_SESSION['result']="تغییرات با موفقیت انجام شد";
			$_SESSION['alert']="success";
			header("location: /shiraz_user/profile");
		}
		$GLOBALS['GCMS']->assign('user', Shiraz_user::get(array("id" => $_SESSION["glogin_user_id"])));
	}
	else
		header("location: /shiraz_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function chngpass()
{
	if(isset($_SESSION["glogin_username"]))
	{
		if(isset($_POST['chngpass']))
		{
			if($_POST['capcha']
					&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']))
			{
				$_SESSION['result']="کد تصویری را وارد نکرده‌اید و یا اشتباه وارد کرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['password']=="")
			{
				$_SESSION['result']="کلمه عبور را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['password']!=$_POST['re_password'])
			{
				$_SESSION['result']="تکرار کلمه عبور مانند کلمه عبور نیست";
				$_SESSION['alert']="alarm";
			}
			else
			{
				require_once(__COREROOT__."/libs/utility/hashing.php");
				$password_salt=saltit($_SESSION["glogin_username"]);
				$password=hashit($_POST['password'], $password_salt);
				//updating db...
				$arr_update=array(
						"id" => $_SESSION["glogin_user_id"],
						"password" => $password,
						"password_salt" => $password_salt,
				);
				if(Shiraz_user::update($arr_update))
				{
					$_SESSION['result']="کلمه عبور تغییر کرد";
					$_SESSION['alert']="success";
					header("location: /shiraz_user/profile");
					return;
				}
				else
				{
					$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
				}
			}
			header("location: /shiraz_user/chngpass");
		}
	}
	else
		header("location: /shiraz_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function logout()
{
	if(isset($_SESSION["glogin_username"]))
	{
		unset($_SESSION["glogin_username"]);
		unset($_SESSION["glogin_email"]);
		unset($_SESSION["glogin_user_level"]);
		unset($_SESSION["glogin_user_id"]);
	}
	header("location: /shiraz_user");
}

function register()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /shiraz_user/profile");
	}
	else
	{
		if(isset($_POST['register']))
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			if($_POST['username']=="")
			{
				$_SESSION['result']="نام کاربری را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['password']=="")
			{
				$_SESSION['result']="کلمه عبور را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['cell']=="" || !cell_validation($_POST['cell']))
			{
				$_SESSION['result']="تلفن همراه معتبر نیست";
				$_SESSION['alert']="alarm";
			}
			else if(!email_validation($_POST['email']))
			{
				$_SESSION['result']="آدرس ایمیل معتبر نیست";
				$_SESSION['alert']="alarm";
			}
			else
			{
				//checking duplicate username & email...
				$chk_username=Shiraz_user::get(array("username" => $_POST['username']));
				$chk_email=Shiraz_user::get(array("email" => $_POST['email']));
				if(isset($chk_username))
				{
					$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
					$_SESSION['alert']="alarm";
				}
				else if(isset($chk_email))
				{
					$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
				}
				else
				{
					require_once(__COREROOT__."/libs/utility/hashing.php");
					//adding user to db
					$password_salt=saltit($_POST['email']);
					$password=hashit($_POST['password'], $password_salt);
					$arr_insert=array(	
						"username" => $_POST['username'],
						"email" => $_POST['email'],
						"temp_code" => "NULL",
						"password" => $password,
						"password_salt" => $password_salt,
						"gender" => $_POST['gender'],
						"level" => "member",
						"status" => "active",
						"cell" => $_POST['cell'],
						"name" => $_POST['name'],
						"birthdate" => "NULL",
						"address" => "NULL",
						"avatar" => "NULL",
						"plus_count" => "0",
						"created_date" => date("Y-m-d H:i:s")
					);
					if(Shiraz_user::insert($arr_insert))
					{
						$id_user=mysql_insert_id();
						//sending email...
						$text_form="
								کاربر گرامی ".$_POST['username']
								." <br />
										شما    در وب سایت ".$_SERVER['HTTP_HOST']
										." عضو شدید <br />
												شما می توانید از طریق اطلاعات  زیر وارد پروفایل کاربری خود شوید . <br />
												آدرس ورود به کنترل پنل : ".$_SERVER['HTTP_HOST']
												."/shiraz_user <br />
														نام کاربری : ".$_POST['username']."<br />
																ایمیل : ".$_POST['email']."<br />
																		کلمه عبور : ".$_POST['password']
																		."<br />

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
						
						//sms
						sms_register($_POST['username'],$_POST['cell']);
						
						//setting sessions...
						$_SESSION["glogin_username"]=$_POST['username'];
						$_SESSION["glogin_email"]=$_POST['email'];
						$_SESSION["glogin_user_level"]="user";
						$_SESSION["glogin_user_id"]=$id_user;
						
						$_SESSION['result']="ثبت‌نام با موفقیت انجام شد";
						$_SESSION['alert']="success";
						header("location: /shiraz_user/profile");
						return;
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
					}
				}
			}
			header("location: /register");
		}
	}
}

