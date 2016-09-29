<?php

/**
 * frontend-sarfejo_user.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > sarfejo_user
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
	if(isset($_SESSION["glogin_user_id"]))
	{
		header("location: /sarfejo_user/profile");
	}
	else
	{
		if(isset($_POST['login']))
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			if(!email_validation($_POST['email']))
			{
				$_SESSION['result']="آدرس ایمیل معتبر نیست";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['password']=="")
			{
				$_SESSION['result']="کلمه عبور را وارد نکرده‌اید";
				$_SESSION['alert']="warning";
			}
			else
			{
				$chk_user=Sarfejo_user::get(array("email" => $_POST['email']));
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
							$_SESSION["glogin_email"]=$chk_user->email;
							$_SESSION["glogin_user_level"]=$chk_user->level;
							$_SESSION["glogin_user_id"]=$chk_user->id;
                            $_SESSION["glogin_user_name"]=$chk_user->name;
                            $_SESSION["glogin_user_avatar"]=$chk_user->avatar;
							$_SESSION['result']="خوش‌آمدید";
							$_SESSION['alert']="success";

							if(isset($_POST['redirect']))
							{
								header("location: ".$_POST['redirect']);
							}
							else
							{
								header("location: /sarfejo_user/profile");
							}
							return;
						}
						else
						{

							$_SESSION['result']="کلمه عبور نادرست است";
							$_SESSION['alert']="warning";
						}
					}
					else
					{
						$_SESSION['result']="حساب شما غیرفعال شده است";
						$_SESSION['alert']="warning";
					}
				}
				else
				{
					$_SESSION['result']="ایمیل نادرست است";
					$_SESSION['alert']="warning";
				}
			}
			header("location: /sarfejo_user");
		}
	}
}

function forgot()
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		header("location: /sarfejo_user/profile");
	}
	else
	{
		if(isset($_GET['forgot'])&&$_GET['forgot']=="true")
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			if(!email_validation($_POST['email']))
			{
				$_SESSION['result']="آدرس ایمیل معتبر نیست";
				$_SESSION['alert']="warning";
			}
			else
			{
				$chk_user=Sarfejo_user::get(array("email" => $_POST['email']));
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
						Sarfejo_user::update($arr_update);

						$email_text="
						برای رسیدن به کلمه عبور جدید ، <a href=\"http://$_SERVER[HTTP_HOST]/sarfejo_user/forgot?email=$chk_user->email&t_c=$t_c\" >اینجا</a> را کلیک کنید و یا لینک زیر را دنبال کنید : <br/>
						http://$_SERVER[HTTP_HOST]/sarfejo_user/forgot?email=$chk_user->email&t_c=$t_c
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
							$_SESSION['alert']="danger";
						}
					}
					else
					{
						$_SESSION['result']="حساب شما غیرفعال شده است";
						$_SESSION['alert']="danger";
					}
				}
				else
				{
					$_SESSION['result']="آدرس ایمیل نادرست است";
					$_SESSION['alert']="danger";
				}
			}
			header("location: /sarfejo_user/forgot");
		}

		if(isset($_GET['email'])&&isset($_GET['t_c']))
		{
			$arr_get=array(
					"email" => $_GET['email'],
					"temp_code" => $_GET['t_c']
			);
			$chk_user=Sarfejo_user::get($arr_get);
			if(isset($chk_user))
			{
				require_once(__COREROOT__."/libs/utility/hashing.php");
				$n_p=rndstring(8);
				$password_salt=saltit($chk_user->email);
				$password=hashit($n_p, $password_salt);

				$arr_update=array(
						"id" => $chk_user->id,
						"temp_code" => "NULL",
						"password" => $password,
						"password_salt" => $password_salt
				);
				Sarfejo_user::update($arr_update);

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
					$_SESSION['alert']="danger";
				}
			}
			else
			{
				$_SESSION['result']="درحواست شما معتبر نیست،‌ دوباره تلاش کنید";
				$_SESSION['alert']="danger";
			}
			header("location: /sarfejo_user");
		}
	}
}

function profile()
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		if(isset($_GET['edit_params'])&&$_GET['edit_params']=="true")
		{
			if($_POST['birthdate']!="")
				$birthdate=shamsi_to_miladi($_POST['birthdate']);
			else
				$birthdate="NULL";
			
			$arr_update=array(
						"id" => $_SESSION["glogin_user_id"],					
						"gender" => $_POST['gender'],
						"cell" => $_POST['cell'],
						"name" => $_POST['name'],
						"birthdate" => $birthdate,
						"state" => $_POST['state'],
						"city" => $_POST['city'],
						"co_name" => $_POST['co_name'],
						"degree" => $_POST['degree'],
						"address" => $_POST['address'],
						"avatar" => $_POST['avatar']
				);
			Sarfejo_user::update($arr_update);
            $_SESSION["glogin_user_name"]=$_POST['name'];
            $_SESSION["glogin_user_avatar"]=$_POST['avatar'];
			$_SESSION['result']="تغییرات با موفقیت انجام شد";
			$_SESSION['alert']="success";
			header("location: /sarfejo_user/profile");
		}
		$GLOBALS['GCMS']->assign('user', Sarfejo_user::get(array("id" => $_SESSION["glogin_user_id"])));
	}
	else
		header("location: /sarfejo_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function chngpass()
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		if(isset($_POST['chngpass']))
		{
			if($_POST['capcha']
					&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']))
			{
				$_SESSION['result']="کد تصویری را وارد نکرده‌اید و یا اشتباه وارد کرده‌اید";
				$_SESSION['alert']="warning";
			}
			else if($_POST['password']=="")
			{
				$_SESSION['result']="کلمه عبور را وارد نکرده‌اید";
				$_SESSION['alert']="warning";
			}
			else if($_POST['password']!=$_POST['re_password'])
			{
				$_SESSION['result']="تکرار کلمه عبور مانند کلمه عبور نیست";
				$_SESSION['alert']="warning";
			}
			else
			{
				require_once(__COREROOT__."/libs/utility/hashing.php");
				$password_salt=saltit($_SESSION["glogin_email"]);
				$password=hashit($_POST['password'], $password_salt);
				//updating db...
				$arr_update=array(
						"id" => $_SESSION["glogin_user_id"],
						"password" => $password,
						"password_salt" => $password_salt,
				);
				if(Sarfejo_user::update($arr_update))
				{
					$_SESSION['result']="کلمه عبور تغییر کرد";
					$_SESSION['alert']="success";
					header("location: /sarfejo_user/profile");
					return;
				}
				else
				{
					$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="danger";
				}
			}
			header("location: /sarfejo_user/chngpass");
		}
	}
	else
		header("location: /sarfejo_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function logout()
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		unset($_SESSION["glogin_email"]);
		unset($_SESSION["glogin_user_level"]);
		unset($_SESSION["glogin_user_id"]);
	}
	header("location: /sarfejo_user");
}

function register()
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		header("location: /sarfejo_user/profile");
	}
	else
	{
		if(isset($_POST['register']))
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			if($_POST['password']=="")
			{
				$_SESSION['result']="کلمه عبور را وارد نکرده‌اید";
				$_SESSION['alert']="warning";
			}
			else if(!email_validation($_POST['email']))
			{
				$_SESSION['result']="آدرس ایمیل معتبر نیست";
				$_SESSION['alert']="warning";
			}
			else
			{
				//checking duplicate email...
				$chk_email=Sarfejo_user::get(array("email" => $_POST['email']));
				if(isset($chk_email))
				{
					$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
					$_SESSION['alert']="warning";
				}
				else
				{
					require_once(__COREROOT__."/libs/utility/hashing.php");
					//adding user to db
					$password_salt=saltit($_POST['email']);
					$password=hashit($_POST['password'], $password_salt);
					if($_POST['birthdate']!="")
						$birthdate=shamsi_to_miladi($_POST['birthdate']);
					else
						$birthdate="NULL";
					
					$arr_insert=array(	
						"email" => $_POST['email'],
						"temp_code" => "NULL",
						"password" => $password,
						"password_salt" => $password_salt,
						"gender" => $_POST['gender'],
						"level" => $_POST['level'],
						"status" => "active",
						"cell" => $_POST['cell'],
						"name" => $_POST['name'],
						"birthdate" => $birthdate,
						"state" => $_POST['state'],
						"city" => $_POST['city'],
						"co_name" => $_POST['co_name'],
						"degree" => "NULL",
						"credit" => "0",
						"address" => "NULL",							
						"avatar" => "NULL",
						"created_date" => date("Y-m-d H:i:s")
					);
					if(Sarfejo_user::insert($arr_insert))
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
												."/sarfejo_user <br />
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
						
						//setting sessions...
						$_SESSION["glogin_email"]=$_POST['email'];
						$_SESSION["glogin_user_level"]=$_POST['level'];
						$_SESSION["glogin_user_id"]=$id_user;
                        $_SESSION["glogin_user_name"]=$_POST['name'];
						$_SESSION['result']="ثبت‌نام با موفقیت انجام شد";
						$_SESSION['alert']="success";
						header("location: /sarfejo_user/profile");
						return;
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="danger";
					}
				}
			}
			header("location: /register");
		}
	}
}

