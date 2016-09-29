<?php

/**
 * frontend_club.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > club
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
		header("location: /club/dashboard");
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
				$chk_user=ItakUser::get(
						array("username" => $_POST['username'], "status_not" => "delete"));
				if(isset($chk_user))
				{
					if($chk_user->status!="disabled")
					{
						//user ok. checking password...
						require_once(__COREROOT__."/libs/utility/hashing.php");
						if($chk_user->password
								==hashit($_POST['password'], $chk_user->password_salt))
						{
							//password ok. setting sessions...
							$_SESSION["glogin_username"]=$chk_user->username;
							$_SESSION["glogin_name"]=$chk_user->name;
							$_SESSION["glogin_avatar"]=$chk_user->avatar;
							$_SESSION["glogin_email"]=$chk_user->email;
							$_SESSION["glogin_cell"]=$chk_user->cell;
							$_SESSION["glogin_user_level"]=$chk_user->user_level;
							$_SESSION["glogin_user_id"]=$chk_user->id;
							//reseting password_attempts_failed
							if($chk_user->password_attempts_failed>0)
							{
								$arr_update=array(
											"id" => $chk_user->id,
											"password_attempts_failed" => 0
								);
								ItakUser::update($arr_update);
							}
							$_SESSION['result']="خوش‌آمدید";
							$_SESSION['alert']="success";

							if(isset($_POST['redirect']))
							{
								header("location: ".$_POST['redirect']);
							}
							else
							{
								header("location: /club/dashboard");
							}
							return;
						}
						else
						{
							//wrong pass. disabling user after 5 attempts...
							if($chk_user->password_attempts_failed==4)
							{
								$arr_update=array(
											"id" => $chk_user->id,
											"password_attempts_failed" => 5,
											"status" => "disabled"
								);
							}
							else
							{
								$arr_update=array(
											"id" => $chk_user->id,
											"password_attempts_failed" => $chk_user
													->password_attempts_failed+1
								);
							}
							ItakUser::update($arr_update);

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
			header("location: /club");
		}
	}
}
function dashboard()
{
	
}
function forgot()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /club/dashboard");
	}
	else
	{
		if(isset($_GET['forgot'])&&$_GET['forgot']=="true")
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			if(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha'])
			{
				$_SESSION['result']="کد تصویری را وارد نکرده‌اید و یا اشتباه وارد کرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['username']=="")
			{
				$_SESSION['result']="نام کاربری را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if(!email_validation($_POST['email']))
			{
				$_SESSION['result']="آدرس ایمیل معتبر نیست";
				$_SESSION['alert']="alarm";
			}
			else
			{
				$chk_user=ItakUser::get(
						array(
									"username" => $_POST['username'],
									"status_not" => "delete",
									"email" => $_POST['email']
						));
				if(isset($chk_user))
				{
					if($chk_user->status!="disabled")
					{
						require_once(__COREROOT__."/libs/utility/hashing.php");
						//email ok. sending reset pass email...
						$t_c=rndstring(100);
						$arr_update=array(
									"id" => $chk_user->id,
									"password_temp_code" => $t_c
						);
						ItakUser::update($arr_update);

						$email_text="
							برای رسیدن به کلمه عبور جدید ، <a href=\"http://$_SERVER[HTTP_HOST]/club/forgot?username=$chk_user->username&email=$chk_user->email&t_c=$t_c\" >اینجا</a> را کلیک کنید و یا لینک زیر را دنبال کنید : <br/>
							http://$_SERVER[HTTP_HOST]/club/forgot?username=$chk_user->username&email=$chk_user->email&t_c=$t_c
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
					$_SESSION['result']="چنین کاربری وجود ندارد";
					$_SESSION['alert']="error";
				}
			}
			header("location: /club/forgot");
		}

		if(isset($_GET['username'])&&isset($_GET['email'])&&isset($_GET['t_c']))
		{
			$arr_get=array(
						"username" => $_GET['username'],
						"email" => $_GET['email'],
						"password_temp_code" => $_GET['t_c']
			);
			$chk_user=ItakUser::get($arr_get);
			if(isset($chk_user))
			{
				require_once(__COREROOT__."/libs/utility/hashing.php");
				$n_p=rndstring(8);
				$password_salt=saltit($chk_user->username);
				$password=hashit($n_p, $password_salt);

				$arr_update=array(
							"id" => $chk_user->id,
							"password_temp_code" => "NULL",
							"password" => $password,
							"password_salt" => $password_salt
				);
				ItakUser::update($arr_update);

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
			header("location: /club");
		}
	}
}

function register()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /club/dashboard");
	}
	else
	{
		if(isset($_POST['register']))
		{
			if(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha'])
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
			else if($_POST['name']=="")
			{
				$_SESSION['result']="نام را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['username']=="")
			{
				$_SESSION['result']="نام کاربری را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else
			{
				if($_POST['invitation_code']!="")
				{
					require_once(__COREROOT__."/libs/utility/hashing.php");
					$referrer=ItakUser::get(array("id" => decryptit($_POST['invitation_code'])));
				}
				//checking duplicate username
				$chk_username=ItakUser::get(array("username" => $_POST['username']));
				if(isset($chk_username))
				{
					$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
					$_SESSION['alert']="alarm";
				}
				else if($_POST['invitation_code']!=""&&!isset($referrer))
				{
					$_SESSION['result']="کد دعوت‌نامه معتبر نیست";
					$_SESSION['alert']="alarm";
				}
				else
				{
					require_once(__COREROOT__."/libs/utility/hashing.php");
					//adding user to db
					$password_salt=saltit($_POST['username']);
					$password=hashit($_POST['password'], $password_salt);
					$arr_insert=array(
								"username" => $_POST['username'],
								"email" => "NULL",
								"email_temp_code" => "NULL",
								"password" => $password,
								"password_salt" => $password_salt,
								"password_attempts_failed" => 0,
								"password_temp_code" => "NULL",
								"status" => "invalid",
								"user_level" => $_POST['user_level'],
								"date_created" => date("Y-m-d H:i:s"),
								"name" => $_POST['name'],
								"cell" => "NULL",
								"cell_temp_code" => "NULL",
								"birth_date" => "NULL",
								"gender" => "NULL",
								"marital" => "NULL",
								"address" => "NULL",
								"avatar" => "NULL",
								"nickname" => "NULL",
								"type" => "public"
					);
					if(ItakUser::insert($arr_insert))
					{
						$new_id=mysql_insert_id();
						//UserScore register
						$point=ItakPoint::get(array("type" => "membership", "name" => "register"));
						$arr_insert=array(
									"id_user" => $new_id,
									"score" => $point->user_rate,
									"id_point" => $point->id,
									"date" => date("Y-m-d H:i:s")
						);
						ItakUserScore::insert($arr_insert);

						if(isset($referrer))
						{
							ItakFriend::insert(
									array(
												"id_user_refrence" => $referrer->id,
												"id_friend" => $new_id,
												"friend_reg_date" => date("Y-m-d H:i:s"),
												"friend_buy_date" => "NULL"
									));
							//TODO send email to referrer
							$point=ItakPoint::get(array("type" => "membership", "name" => "friend"));
							$arr_insert=array(
									"id_user" => $new_id,
									"score" => $point->user_rate,
									"id_point" => $point->id,
									"date" => date("Y-m-d H:i:s")
							);
							ItakUserScore::insert($arr_insert);
							
							$point=ItakPoint::get(array("type" => "membership", "name" => "invite"));
							$arr_insert=array(
										"id_user" => $referrer->id,
										"score" => $point->user_rate,
										"id_point" => $point->id,
										"date" => date("Y-m-d H:i:s")
							);
							ItakUserScore::insert($arr_insert);
							
						}
						//TODO send email to admin
						$_SESSION["glogin_username"]=$_POST['username'];
						$_SESSION["glogin_name"]=$_POST['name'];
						$_SESSION["glogin_avatar"]="";
						$_SESSION["glogin_email"]="";
						$_SESSION["glogin_cell"]="";
						$_SESSION["glogin_user_level"]=$_POST['user_level'];
						$_SESSION["glogin_user_id"]=$new_id;
						$_SESSION['result']="ثبت‌نام با موفقیت انجام شد، لطفا اطلاعات پروفایل کاربری را تکمیل کنید";
						$_SESSION['alert']="success";
						header("location: /club/profile");
						return;
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
					}
				}
			}
			header("location: /club/register");
		}
	}
}

function chngpass()
{
	if(isset($_SESSION["glogin_username"]))
	{
		if(isset($_POST['chngpass']))
		{
			if($_POST['password']=="")
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
				if(ItakUser::update($arr_update))
				{
					$_SESSION['result']="کلمه عبور تغییر کرد";
					$_SESSION['alert']="success";
					header("location: /club/chngpass");
					return;
				}
				else
				{
					$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
				}
			}
			header("location: /club/chngpass");
		}
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function logout()
{
	if(isset($_SESSION["glogin_username"]))
	{
		unset($_SESSION["glogin_username"]);
		unset($_SESSION["glogin_name"]);
		unset($_SESSION["glogin_avatar"]);
		unset($_SESSION["glogin_email"]);
		unset($_SESSION["glogin_cell"]);
		unset($_SESSION["glogin_user_level"]);
		unset($_SESSION["glogin_user_id"]);
	}
	header("location: /club");
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
					header("location: /club/profile");
					return;
				}
				else if(ItakUser::get_count(array("email" => $_POST['email']))>0)
				{
					$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
					header("location: /club/profile");
					return;
				}
			}
			if($_POST['cell']!=$_SESSION["glogin_cell"])
			{
				if(!cell_validation($_POST['cell']))
				{
					$_SESSION['result']="شماره همراه معتبر نیست";
					$_SESSION['alert']="alarm";
					header("location: /club/profile");
					return;
				}
				else if(ItakUser::get_count(array("cell" => $_POST['cell']))>0)
				{
					$_SESSION['result']="شماره موبایل قبلا استفاده شده، لطفا شماره دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
					header("location: /club/profile");
					return;
				}
			}
			if($_POST['birth_date']!="")
				$birth_date=shamsi_to_miladi($_POST['birth_date']);
			else
				$birth_date="NULL";
			$arr_update=array(
						"id" => $_SESSION["glogin_user_id"],
						"name" => $_POST['name'],
						"email" => $_POST['email'],
						"cell" => $_POST['cell'],
						"birth_date" => $birth_date,
						"gender" => $_POST['gender'],
						"marital" => $_POST['marital'],
						"address" => $_POST['address'],
						"avatar" => $_POST['avatar'],
						"nickname" => $_POST['nickname'],
						"type" => $_POST['type']
			);
			ItakUser::update($arr_update);
			$_SESSION['result']="تغییرات با موفقیت انجام شد";
			$_SESSION['alert']="success";

			if($_POST['name']!=$_SESSION["glogin_name"])
			{
				$_SESSION["glogin_name"]=$_POST['name'];
			}
			if($_POST['avatar']!=$_SESSION["glogin_avatar"])
			{
				$_SESSION["glogin_avatar"]=$_POST['avatar'];
			}
			if($_POST['email']!=$_SESSION["glogin_email"])
			{
				$_SESSION["glogin_email"]=$_POST['email'];
				if(email_confirm_code($_SESSION["glogin_user_id"]))
					$_SESSION['result']=$_SESSION['result']
							." و کد تایید آدرس ایمیل به شما ارسال شد";
				else
					$_SESSION['result']=$_SESSION['result']." اما کد تایید آدرس ایمیل ارسال نشد";
			}
			if($_POST['cell']!=$_SESSION["glogin_cell"])
			{
				$_SESSION["glogin_cell"]=$_POST['cell'];
				if(sms_confirm_code($_SESSION["glogin_user_id"]))
				{
					$_SESSION['result']=$_SESSION['result']
							." و همچنین کد تایید شماره همراه با پیام کوتاه به شما ارسال شد";
					header("location: /club/confirm/?cell=true");
					return;
				}
				else
					$_SESSION['result']=$_SESSION['result']." اما کد تایید شماره همراه ارسال نشد";
			}
			header("location: /club/profile");
		}
		$GLOBALS['GCMS']->assign('user', ItakUser::get(array("id" => $_SESSION["glogin_user_id"])));
		$GLOBALS['GCMS']
				->assign('group',
						ItakRelGroupUser::get(
								array(
											"id_user" => $_SESSION["glogin_user_id"],
											"status" => "member"
								), false, NULL, "group"));
		$GLOBALS['GCMS']
				->assign('referrer',
						ItakFriend::get(array("id_friend" => $_SESSION["glogin_user_id"]), false,
								NULL, "referrer"));
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function confirm()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$user=ItakUser::get(array("id" => $_SESSION["glogin_user_id"]));
		if(isset($_POST['confirm_cell']))
		{
			if($user->cell_temp_code==""||$user->status=="valid"||$user->status=="cell_valid")
			{
				$_SESSION['result']="درخواست معتبر نیست";
				$_SESSION['alert']="error";
			}
			else
			{
				if($user->cell_temp_code==$_POST['confirm_cell_code'])
				{
					$arr_update=array(
								"id" => $user->id,
								"cell_temp_code" => "NULL"
					);
					if($user->status=="invalid")
						$arr_update['status']="cell_valid";
					else if($user->status=="email_valid")
						$arr_update['status']="valid";
					ItakUser::update($arr_update);
					//
					if ($user->status=="email_valid")
					{
						$point=ItakPoint::get(array("type" => "membership", "name" => "complate"));
						$arr_insert=array(
								"id_user" => $_SESSION["glogin_user_id"],
								"score" => $point->user_rate,
								"id_point" => $point->id,
								"date" => date("Y-m-d H:i:s")
						);
						ItakUserScore::insert($arr_insert);
					}
					$_SESSION['result']="شماره همراه شما تایید شد";
					$_SESSION['alert']="success";
				}
				else
				{
					$_SESSION['result']="کد صحیح نیست";
					$_SESSION['alert']="error";
				}
			}
			header("location: /club/profile");
		}
		if(isset($_POST['confirm_email']))
		{
			if($user->email_temp_code==""||$user->status=="valid"||$user->status=="email_valid")
			{
				$_SESSION['result']="درخواست معتبر نیست";
				$_SESSION['alert']="error";
			}
			else
			{
				if($user->email_temp_code==$_POST['confirm_email_code'])
				{
					$arr_update=array(
								"id" => $user->id,
								"email_temp_code" => "NULL"
					);
					if($user->status=="invalid")
						$arr_update['status']="email_valid";
					else if($user->status=="cell_valid")
						$arr_update['status']="valid";
					ItakUser::update($arr_update);
					//
					if ($user->status=="cell_valid")
					{
						$point=ItakPoint::get(array("type" => "membership", "name" => "complate"));
						$arr_insert=array(
								"id_user" => $_SESSION["glogin_user_id"],
								"score" => $point->user_rate,
								"id_point" => $point->id,
								"date" => date("Y-m-d H:i:s")
						);
						ItakUserScore::insert($arr_insert);
					}
					$_SESSION['result']="آدرس ایمیل شما تایید شد";
					$_SESSION['alert']="success";
				}
				else
				{
					$_SESSION['result']="کد صحیح نیست";
					$_SESSION['alert']="error";
				}
			}
			header("location: /club/profile");
		}
		$GLOBALS['GCMS']->assign('user', $user);
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function invite()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$user=ItakUser::get(array("id" => $_SESSION["glogin_user_id"]));
		if(isset($_POST['invite_cell']))
		{
			if($user->status!="valid")
			{
				$_SESSION['result']="درخواست معتبر نیست، شما کاربر فعال نیستید";
				$_SESSION['alert']="error";
				header("location: /club/profile");
			}
			else
			{
				require_once(__COREROOT__."/libs/utility/validating.php");
				if(!cell_validation($_POST['invite_cell_number']))
				{
					$_SESSION['result']="شماره همراه معتبر نیست";
					$_SESSION['alert']="alarm";
					header("location: /club/invite/?cell=true");
				}
				else if(ItakUser::get_count(array("cell" => $_POST['invite_cell_number']))>0)
				{
					$_SESSION['result']="دارنده شماره موبایل در باشگاه عضو شده است، لطفا شماره دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
					header("location: /club/invite/?cell=true");
				}
				else
				{
					if(sms_invitation($_SESSION["glogin_user_id"], $_POST['invite_cell_number']))
					{
						$_SESSION['result']="دعوت‌نامه عضویت در سایت با پیام کوتاه ارسال شد";
						$_SESSION['alert']="success";
						header("location: /club/profile");
					}
					else
					{
						$_SESSION['result']="پیام کوتاه ارسال نشد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
						header("location: /club/invite/?cell=true");
					}
				}
			}
		}
		if(isset($_POST['invite_email']))
		{
			if($user->status!="valid")
			{
				$_SESSION['result']="درخواست معتبر نیست، شما کاربر فعال نیستید";
				$_SESSION['alert']="error";
				header("location: /club/profile");
			}
			else
			{
				require_once(__COREROOT__."/libs/utility/validating.php");
				if(!email_validation($_POST['invite_email_address']))
				{
					$_SESSION['result']="آدرس ایمیل معتبر نیست";
					$_SESSION['alert']="error";
					header("location: /club/invite/?email=true");
				}
				else if(ItakUser::get_count(array("email" => $_POST['invite_email_address']))>0)
				{
					$_SESSION['result']="دارنده ایمیل در باشگاه عضو شده است، لطفا ایمیل دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
					header("location: /club/invite/?email=true");
				}
				else
				{
					if(email_invitation($_SESSION["glogin_user_id"], $_POST['invite_email_address']))
					{
						$_SESSION['result']="دعوت‌نامه عضویت در سایت با ایمیل ارسال شد";
						$_SESSION['alert']="success";
						header("location: /club/profile");
					}
					else
					{
						$_SESSION['result']="ایمیل ارسال نشد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
						header("location: /club/invite/?email=true");
					}
				}
			}
		}
		$GLOBALS['GCMS']->assign('user', $user);
		$GLOBALS['GCMS']
				->assign('friends',
						ItakFriend::get(array("id_user_refrence" => $_SESSION["glogin_user_id"]),
								true, NULL, "friend"));
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function newgroup()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$user=ItakUser::get(array("id" => $_SESSION["glogin_user_id"]));
		if(isset($_POST['submit']))
		{
			if($user->status!="valid")
			{
				$_SESSION['result']="درخواست معتبر نیست، شما کاربر فعال نیستید";
				$_SESSION['alert']="error";
				header("location: /club/profile");
			}
			else if(ItakRelGroupUser::get_count(array("id_user" => $user->id, "status" => "member"))
					>0)
			{
				$_SESSION['result']="درخواست معتبر نیست، شما در گروه دیگری عضو هستید";
				$_SESSION['alert']="error";
				header("location: /club/profile");
			}
			else if($_POST['name']=="")
			{
				$_SESSION['result']="نام را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
				header("location: /club/newgroup");
			}
			else if(ItakGroup::get_count(array("name" => $_POST['name']))>0)
			{
				$_SESSION['result']="نام درخواستی قبلا گرفته شده، لطفا نام دیگری انتخاب کنید";
				$_SESSION['alert']="alarm";
				header("location: /club/newgroup");
			}
			else
			{
				$arr_insert=array(
							"id_manager" => $user->id,
							"name" => $_POST['name'],
							"avatar" => $_POST['avatar'],
							"date" => date("Y-m-d H:i:s"),
							"status" => "active"
				);
				if(ItakGroup::insert($arr_insert))
				{
					$new_id=mysql_insert_id();
					ItakRelGroupUser::insert(
							array(
										"id_group" => $new_id,
										"id_user" => $user->id,
										"status" => "member"
							));
					//
					$point=ItakPoint::get(array("type" => "membership", "name" => "create_group"));
					$arr_insert=array(
							"id_user" => $user->id,
							"score" => $point->group_rate,
							"id_point" => $point->id,
							"date" => date("Y-m-d H:i:s")
					);
					ItakUserScore::insert($arr_insert);
					
					$_SESSION['result']="ایجاد گروه با موفقیت انجام شد";
					$_SESSION['alert']="success";
					header("location: /club/group/".$new_id);
				}
				else
				{
					$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
					header("location: /club/newgroup");
				}
			}
		}
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function group($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
		$group=ItakGroup::get(array("id" => $id, "status_not" => "delete"));
		if(isset($id)&&isset($group))
		{
			if(ItakRelGroupUser::get_count(
					array(
								"id_group" => $id,
								"id_user" => $_SESSION["glogin_user_id"],
								"status" => "member"
					))==0)
			{
				$_SESSION['result']="درخواست معتبر نیست";
				$_SESSION['alert']="error";
				header("location: /club/profile");
			}
			else
			{
				if(isset($_POST['update']))
				{
					if($group->id_manager!=$_SESSION["glogin_user_id"])
					{
						$_SESSION['result']="درخواست معتبر نیست، شما مدیر گروه نیستید";
						$_SESSION['alert']="error";
						header("location: /club/group/".$id);
					}
					else if($_POST['name']=="")
					{
						$_SESSION['result']="نام را وارد نکرده‌اید";
						$_SESSION['alert']="alarm";
						header("location: /club/group/".$id);
					}
					else if($group->name!=$_POST['name']
							&&ItakGroup::get_count(array("name" => $_POST['name']))>0)
					{
						$_SESSION['result']="نام درخواستی قبلا گرفته شده، لطفا نام دیگری انتخاب کنید";
						$_SESSION['alert']="alarm";
						header("location: /club/group/".$id);
					}
					else
					{
						$arr_update=array(
									"id" => $id,
									"name" => $_POST['name'],
									"avatar" => $_POST['avatar']
						);
						if(ItakGroup::update($arr_update))
						{
							$_SESSION['result']="به‌روز‌رسانی انجام شد";
							$_SESSION['alert']="success";
							header("location: /club/group/".$id);
						}
						else
						{
							$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
							$_SESSION['alert']="error";
							header("location: /club/group/".$id);
						}
					}
				}
				if(isset($_POST['board']) and $_POST['txt'] != "")
				{
					$arr_insert=array(
								"id_group" => $id,
								"id_user" => $_SESSION["glogin_user_id"],
								"txt" => $_POST['txt'],
								"date" => date("Y-m-d H:i:s")
					);
					if(ItakGroupBoard::insert($arr_insert))
					{
						//$_SESSION['result']="پیام ثبت شد";
						//$_SESSION['alert']="success";
						header("location: /club/group/".$id);
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
						header("location: /club/group/".$id);
					}
				}
				$GLOBALS['GCMS']->assign('group', $group);
				$max_results=10;
				$arr_get=array();
				$order=array(
							"by" => "date",
							"sort" => "DESC"
				);
				if(!isset($_GET['paging']))
					$paging=1;
				else
					$paging=$_GET['paging'];
				$limit=array(
							"start" => (($paging*$max_results)-$max_results),
							"end" => $max_results
				);
				$boards=ItakGroupBoard::get(array("id_group" => $id), true, $order, $limit);
				foreach($boards as $board)
				{
					if($board->id_user==0)
						$board->name="مدیر سایت";
					else
					{
						$user=ItakUser::get(array("id" => $board->id_user));
						$board->name=$user->name;
					}
				}
				$GLOBALS['GCMS']->assign('boards', $boards);
				$GLOBALS['GCMS']
						->assign('paging',
								ceil(
										ItakGroupBoard::get_count(array("id_group" => $id))
												/$max_results));
				$mmbrs = ItakRelGroupUser::get(array("id_group" => $id, "status" => "member"), true, NULL,"user");
				$GLOBALS['GCMS']->assign('members',$mmbrs);
				$GLOBALS['GCMS']
						->assign('scores',
								ItakGroupScore::get(array("id_group" => $id), true,
										array("by" => "date", "sort" => "DESC"), "point"));
				$userscormrg = array();
				foreach ($mmbrs as $mmbr)
				{
					$userscor =  ItakUserScore::get(array("id_user" => $mmbr->id_user), true,array("by" => "date", "sort" => "DESC"), "point");
					$userscormrg = array_merge($userscor, $userscormrg);
				}
				$GLOBALS['GCMS']->assign('userscores',$userscormrg);
				
			}
		}
		else
			header("location: /error404?error=club&reason=group_not_exist");
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function groupinvitation($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
		$group=ItakGroup::get(array("id" => $id, "status_not" => "delete"));
		if(isset($id)&&isset($group))
		{
			if($group->id_manager!=$_SESSION["glogin_user_id"])
			{
				$_SESSION['result']="درخواست معتبر نیست، شما مدیر گروه نیستید";
				$_SESSION['alert']="error";
				header("location: /club/group/".$id);
			}
			else if($group->status=="suspend")
			{
				$_SESSION['result']="درخواست معتبر نیست، گروه معلق شده است";
				$_SESSION['alert']="error";
				header("location: /club/group/".$id);
			}
			else
			{
				$user=ItakUser::get(array("id" => $_SESSION["glogin_user_id"]));
				if(isset($_POST['invite_cell']))
				{
					if($user->status!="valid")
					{
						$_SESSION['result']="درخواست معتبر نیست، شما کاربر فعال نیستید";
						$_SESSION['alert']="error";
						header("location: /club/profile");
					}
					else
					{
						$invited_user=ItakUser::get(array("cell" => $_POST['invite_cell_number']));
						require_once(__COREROOT__."/libs/utility/validating.php");
						if(!cell_validation($_POST['invite_cell_number'])
								||$_POST['invite_cell_number']==$user->cell)
						{
							$_SESSION['result']="شماره همراه معتبر نیست";
							$_SESSION['alert']="alarm";
							header("location: /club/groupinvitation/".$id."/?cell=true");
						}
						else if(!isset($invited_user))
						{
							$_SESSION['result']="دارنده شماره موبایل در باشگاه عضو نیست، لطفا ابتدا دعوت‌نامه عضویت در سایت بفرستید";
							$_SESSION['alert']="alarm";
							header("location: /club/invite/?cell=true");
						}
						else if($invited_user->status!="valid")
						{
							$_SESSION['result']="دارنده شماره موبایل کاربر فعال نیست";
							$_SESSION['alert']="alarm";
							header("location: /club/groupinvitation/".$id."/?cell=true");
						}
						else if(ItakRelGroupUser::get_count(
								array(
											"id_group" => $id,
											"id_user" => $invited_user->id,
											"status" => "invited"
								))>0)
						{
							$_SESSION['result']="کاربر مورد نظر قبلا به گروه دعوت شده است";
							$_SESSION['alert']="alarm";
							header("location: /club/groupinvitation/".$id."/?cell=true");
						}
						else if(ItakRelGroupUser::get_count(
								array("id_user" => $invited_user->id, "status" => "member"))>0)
						{
							$_SESSION['result']="کاربر مورد نظر عضو یک گروه است";
							$_SESSION['alert']="alarm";
							header("location: /club/groupinvitation/".$id."/?cell=true");
						}
						else
						{
							if(sms_group_invitation($id, $_POST['invite_cell_number']))
							{
								ItakRelGroupUser::insert(
										array(
													"id_group" => $id,
													"id_user" => $invited_user->id,
													"status" => "invited"
										));
								$_SESSION['result']="دعوت‌نامه عضویت در گروه با پیام کوتاه ارسال شد";
								$_SESSION['alert']="success";
								header("location: /club/groupinvitation/".$id);
							}
							else
							{
								$_SESSION['result']="پیام کوتاه ارسال نشد، دوباره تلاش کنید";
								$_SESSION['alert']="error";
								header("location: /club/groupinvitation/".$id."/?cell=true");
							}
						}
					}
				}
				if(isset($_POST['invite_email']))
				{
					if($user->status!="valid")
					{
						$_SESSION['result']="درخواست معتبر نیست، شما کاربر فعال نیستید";
						$_SESSION['alert']="error";
						header("location: /club/profile");
					}
					else
					{
						$invited_user=ItakUser::get(
								array("email" => $_POST['invite_email_address']));
						require_once(__COREROOT__."/libs/utility/validating.php");
						if(!email_validation($_POST['invite_email_address'])
								||$_POST['invite_email_address']==$user->email)
						{
							$_SESSION['result']="آدرس ایمیل معتبر نیست";
							$_SESSION['alert']="error";
							header("location: /club/groupinvitation/".$id."/?email=true");
						}
						else if(!isset($invited_user))
						{
							$_SESSION['result']="دارنده آدرس ایمیل در باشگاه عضو نیست، لطفا ابتدا دعوت‌نامه عضویت در سایت بفرستید";
							$_SESSION['alert']="alarm";
							header("location: /club/invite/?email=true");
						}
						else if($invited_user->status!="valid")
						{
							$_SESSION['result']="دارنده آدرس ایمیل کاربر فعال نیست";
							$_SESSION['alert']="alarm";
							header("location: /club/groupinvitation/".$id."/?email=true");
						}
						else if(ItakRelGroupUser::get_count(
								array(
											"id_group" => $id,
											"id_user" => $invited_user->id,
											"status" => "invited"
								))>0)
						{
							$_SESSION['result']="کاربر مورد نظر قبلا به گروه دعوت شده است";
							$_SESSION['alert']="alarm";
							header("location: /club/groupinvitation/".$id."/?email=true");
						}
						else if(ItakRelGroupUser::get_count(
								array("id_user" => $invited_user->id, "status" => "member"))>0)
						{
							$_SESSION['result']="کاربر مورد نظر عضو یک گروه است";
							$_SESSION['alert']="alarm";
							header("location: /club/groupinvitation/".$id."/?email=true");
						}
						else
						{
							if(email_group_invitation($id, $_POST['invite_email_address']))
							{
								ItakRelGroupUser::insert(
										array(
													"id_group" => $id,
													"id_user" => $invited_user->id,
													"status" => "invited"
										));
								$_SESSION['result']="دعوت‌نامه عضویت در گروه با ایمیل ارسال شد";
								$_SESSION['alert']="success";
								header("location: /club/groupinvitation/".$id);
							}
							else
							{
								$_SESSION['result']="ایمیل ارسال نشد، دوباره تلاش کنید";
								$_SESSION['alert']="error";
								header("location: /club/groupinvitation/".$id."/?email=true");
							}
						}
					}
				}
				$GLOBALS['GCMS']->assign('group', $group);
				$GLOBALS['GCMS']
						->assign('invited_users',
								ItakRelGroupUser::get(
										array("id_group" => $id, "status" => "invited"), true,
										NULL, "user"));
			}
		}
		else
			header("location: /error404?error=club&reason=group_not_exist");
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function joingroup()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$user=ItakUser::get(array("id" => $_SESSION["glogin_user_id"]));
		if(isset($_POST['join_group']))
		{
			if($user->status!="valid")
			{
				$_SESSION['result']="درخواست معتبر نیست، شما کاربر فعال نیستید";
				$_SESSION['alert']="error";
				header("location: /club/profile");
			}
			else if(ItakRelGroupUser::get_count(array("id_user" => $user->id, "status" => "member"))
					>0)
			{
				$_SESSION['result']="درخواست معتبر نیست، شما بدون گروه نیستید";
				$_SESSION['alert']="error";
				header("location: /club/profile");
			}
			else
			{
				require_once(__COREROOT__."/libs/utility/hashing.php");
				$invite_reg=ItakRelGroupUser::get(
						array(
									"id_group" => decryptit($_POST['join_group_code']),
									"id_user" => $user->id,
									"status" => "invited"
						));
				$group=ItakGroup::get(
						array("id" => $invite_reg->id_group, "status_not" => "delete"));
				if(isset($invite_reg)&&isset($group))
				{
					if($group->status=="suspend")
					{
						$_SESSION['result']="درخواست معتبر نیست، گروه معلق شده است";
						$_SESSION['alert']="error";
						header("location: /club/joingroup");
					}
					else if($group->status=="full")
					{
						$_SESSION['result']="ظرفیت گروه تکمیل است";
						$_SESSION['alert']="error";
						header("location: /club/joingroup");
					}
					else
					{
						$arr_update=array(
									"id" => $invite_reg->id,
									"status" => "member"
						);
						ItakRelGroupUser::update($arr_update);
						if(ItakRelGroupUser::get_count(
								array("id_group" => $invite_reg->id_group, "status" => "member"))
								==4)
						{
							ItakGroup::update(
									array("id" => $invite_reg->id_group, "status" => "full"));
						}
						
						$point=ItakPoint::get(array("type" => "membership", "name" => "signin_group"));
						$arr_insert=array(
								"id_user" => $_SESSION["glogin_user_id"],
								"score" => $point->group_rate,
								"id_point" => $point->id,
								"date" => date("Y-m-d H:i:s")
						);
						ItakUserScore::insert($arr_insert);
						
						$_SESSION['result']="کد عضویت تایید شد، شما عضو گروه شدید";
						$_SESSION['alert']="success";
						header("location: /club/group/".$invite_reg->id_group);
					}
				}
				else
				{
					$_SESSION['result']="کد صحیح نیست";
					$_SESSION['alert']="error";
					header("location: /club/joingroup");
				}
			}
		}
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function delboard($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
		$board=ItakGroupBoard::get(array("id" => $id), false,$order , $limit, "group");
		if(isset($id)&&isset($board)&&$board->status!="delete")
		{
			if($board->id_manager!=$_SESSION["glogin_user_id"])
			{
				$_SESSION['result']="درخواست معتبر نیست، شما مدیر گروه نیستید";
				$_SESSION['alert']="error";
				header("location: /club/group/".$board->id_group);
			}
			else if($board->status=="suspend")
			{
				$_SESSION['result']="درخواست معتبر نیست، گروه معلق شده است";
				$_SESSION['alert']="error";
				header("location: /club/group/".$board->id_group);
			}
			else
			{
				ItakGroupBoard::del($id);
				$_SESSION['result']="پیام از تابلوی اعلانات حذف شد";
				$_SESSION['alert']="success";
				header("location: /club/group/".$board->id_group);
			}
		}
		else
			header("location: /error404?error=club&reason=board_not_exist");
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function delmember($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
		$member=ItakRelGroupUser::get(array("id" => $id, "status" => "member"), false, NULL,
				"group");
		
		if(isset($id)&&isset($member)&&$member->status!="delete"
				&&$member->id_user!=$_SESSION["glogin_user_id"])
		{
			$chekdelmember = ItakGroupScore::get(array("id_group" => $member->id_group), true,array("by" => "date", "sort" => "DESC"), "point");
			$flagdelmember = false;
			foreach ($chekdelmember as $row)
			{
				if ($row->score < 0)
					$flagdelmember = true;
			}
			/* //die($member->id_user);
			$sum_q=$GLOBALS['GCMS_SAFESQL']->query(
					"
					SELECT SUM( score )
					FROM `gcms_itak_user_score`  
					WHERE TRUE
					[ AND `id_user` =  %I ]
					",array(
					$member->id_user
			));
			die($sum_q);
					$sum = $GLOBALS['GCMS_DB']->get_results($sum_q); */
					
			if($member->id_manager!=$_SESSION["glogin_user_id"])
			{
				$_SESSION['result']="درخواست معتبر نیست، شما مدیر گروه نیستید";
				$_SESSION['alert']="error";
				header("location: /club/group/".$member->id_group);
			}
			else if($member->status=="suspend")
			{
				$_SESSION['result']="درخواست معتبر نیست، گروه معلق شده است";
				$_SESSION['alert']="error";
				header("location: /club/group/".$member->id_group);
			}
			else if($flagdelmember)
			{
				$_SESSION['result']="امکان حذف این کاربر وجود ندارد";
				$_SESSION['alert']="error";
				header("location: /club/group/".$member->id_group);
			}
			else
			{
				$arr_update=array(
							"id" => $id,
							"status" => "left"
				);
				ItakRelGroupUser::update($arr_update);
				
				$point=ItakPoint::get(array("type" => "remove", "name" => "signout_group"));
				$arr_insert=array(
						"id_user" => $member->id_user,
						"score" => $point->group_rate,
						"id_point" => $point->id,
						"date" => date("Y-m-d H:i:s")
				);
				ItakUserScore::insert($arr_insert);
				
				$_SESSION['result']="عضو از گروه حذف شد";
				$_SESSION['alert']="success";
				header("location: /club/group/".$member->id_group);
			}
		}
		else
			header("location: /error404?error=club&reason=member_not_exist");
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function delgroup($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
		$group=ItakGroup::get(array("id" => $id, "status_not" => "delete"));
		if(isset($id)&&isset($group))
		{
			if($group->id_manager!=$_SESSION["glogin_user_id"])
			{
				$_SESSION['result']="درخواست معتبر نیست، شما مدیر گروه نیستید";
				$_SESSION['alert']="error";
				header("location: /club/group/".$id);
			}
			else if(ItakRelGroupUser::get_count(array("id_group" => $id, "status" => "member"))!=1)
			{
				$_SESSION['result']="درخواست معتبر نیست، شما تنها عضو گروه نیستید";
				$_SESSION['alert']="error";
				header("location: /club/group/".$id);
			}
			else if($group->status=="suspend")
			{
				$_SESSION['result']="درخواست معتبر نیست، گروه معلق شده است";
				$_SESSION['alert']="error";
				header("location: /club/group/".$id);
			}
			else
			{
				$member=ItakRelGroupUser::get(
						array(
									"id_group" => $id,
									"id_user" => $_SESSION["glogin_user_id"],
									"status" => "member"
						));
				ItakRelGroupUser::update(array("id" => $member->id, "status" => "left"));
				ItakGroup::update(array("id" => $id, "status" => "delete"));
				
				$point=ItakPoint::get(array("type" => "remove", "name" => "del_group"));
				$arr_insert=array(
						"id_user" => $_SESSION["glogin_user_id"],
						"score" => $point->group_rate,
						"id_point" => $point->id,
						"date" => date("Y-m-d H:i:s")
				);
				ItakUserScore::insert($arr_insert);
				
				$_SESSION['result']="گروه حذف شد";
				$_SESSION['alert']="success";
				header("location: /club/profile");
			}
		}
		else
			header("location: /error404?error=club&reason=member_not_exist");
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function regcard()
{
	if(isset($_SESSION["glogin_username"]))
	{
		if(isset($_POST['register_card']))
		{
			$user=ItakUser::get(array("id" => $_SESSION["glogin_user_id"]));
			if($user->status!="valid")
			{
				$_SESSION['result']="درخواست معتبر نیست، شما کاربر فعال نیستید";
				$_SESSION['alert']="error";
				header("location: /club/profile");
			}
			else if(ItakCard::get_count(array("serial" => $_POST['serial']))==0)
			{
				$_SESSION['result']="سریال کارت نادرست است";
				$_SESSION['alert']="error";
				header("location: /club/regcard");
			}
			else
			{
				$card=ItakCard::get(array("serial" => $_POST['serial'], "code" => $_POST['code']));
				if(isset($card))
				{
					if($card->id_user!=0)
					{
						$_SESSION['result']="کارت قبلا ثبت شده است";
						$_SESSION['alert']="error";
						header("location: /club/regcard");
					}
					else
					{
						if(ItakCard::update(
								array(
											"id" => $card->id,
											"id_user" => $_SESSION["glogin_user_id"],
											"reg_date" => date("Y-m-d H:i:s")
								)))
						{
							//UserScore register
						$point=ItakPoint::get(array("type" => "purchase", "name" => $card->type));
						$arr_insert=array(
									"id_user" => $_SESSION["glogin_user_id"],
									"score" => $card->rate,
									"id_point" => $point->id,
									"date" => date("Y-m-d H:i:s")
						);
						ItakUserScore::insert($arr_insert);
						
							$_SESSION['result']="کارت ثبت شد";
							$_SESSION['alert']="success";
							header("location: /club/scores");
						}
						else
						{
							$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
							$_SESSION['alert']="error";
							header("location: /club/regcard");
						}
					}
				}
				else
				{
					$_SESSION['result']="کد کارت نادرست است";
					$_SESSION['alert']="error";
					header("location: /club/regcard");
				}
			}
		}
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function scores()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$cards=ItakCard::get(array("id_user" => $_SESSION["glogin_user_id"]), true,
				array("by" => "reg_date", "sort" => "DESC"));
		foreach($cards as $card)
			if($card->status=="both"||$card->status=="product")
			{
				$products=ItakRelCardProduct::get(array("id_card" => $card->id), true, NULL,
						"product");
				$card->products=array();
				$card->products=$products;
			}
		$GLOBALS['GCMS']->assign('cards', $cards);
		$GLOBALS['GCMS']
				->assign('scores',
						ItakUserScore::get(array("id_user" => $_SESSION["glogin_user_id"]), true,
								array("by" => "date", "sort" => "DESC"), "point"));
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function cardpoll($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
		$card=ItakCard::get(array("id" => $id, "id_user" => $_SESSION["glogin_user_id"]));
		if(isset($id)&&isset($card))
		{
			if(isset($_POST['submit']))
			{
				if($card->status=="both"||$card->status=="poll")
				{
					$_SESSION['result']="نظرسنجی کارت قبلا ثبت شده است";
					$_SESSION['alert']="error";
					header("location: /club/scores");
				}
				else if($_POST['poll_behavior']==""||$_POST['poll_buy_date']=="")
				{
					$_SESSION['result']="فرم را کامل نکرده‌اید";
					$_SESSION['alert']="alarm";
					header("location: /club/cardpoll/".$id);
				}
				else
				{
					$arr_update=array(
								"id" => $card->id,
								"poll_behavior" => $_POST['poll_behavior'],
								"poll_txt" => $_POST['poll_txt'],
								"poll_buy_date" => shamsi_to_miladi($_POST['poll_buy_date'])
					);
					if($card->status=="none")
						$arr_update['status']="poll";
					else
						$arr_update['status']="both";
					if(ItakCard::update($arr_update))
					{
						//TODO add score
						$_SESSION['result']="نظرسنجی کارت ثبت شد";
						$_SESSION['alert']="success";
						header("location: /club/scores");
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
						header("location: /club/cardpoll/".$id);
					}
				}
			}
			$GLOBALS['GCMS']->assign('card', $card);
		}
		else
			header("location: /error404?error=club&reason=card_not_exist");
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}

function cardproduct($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
		$card=ItakCard::get(array("id" => $id, "id_user" => $_SESSION["glogin_user_id"]));
		if(isset($id)&&isset($card))
		{
			if(isset($_POST['submit']))
			{
				if($card->status=="both"||$card->status=="product")
				{
					$_SESSION['result']="محصولات مربوط به کارت قبلا انتخاب شده است";
					$_SESSION['alert']="error";
					header("location: /club/scores");
				}
				else if($_POST['products']=="")
				{
					$_SESSION['result']="محصولی انتخاب نکرده‌اید";
					$_SESSION['alert']="alarm";
					header("location: /club/cardproduct/".$id);
				}
				else
				{
					foreach($_POST['products'] as $id_product)
					{
						ItakRelCardProduct::insert(
								array("id_card" => $id, "id_product" => $id_product));
					}
					$arr_update=array(
								"id" => $card->id
					);
					if($card->status=="none")
						$arr_update['status']="product";
					else
						$arr_update['status']="both";
					if(ItakCard::update($arr_update))
					{
						$point=ItakPoint::get(array("type" => "purchase", "name" => "cardpro_".$card->type));
						$arr_insert=array(
									"id_user" => $_SESSION["glogin_user_id"],
									"score" => $point->user_rate,
									"id_point" => $point->id,
									"date" => date("Y-m-d H:i:s")
						);
						ItakUserScore::insert($arr_insert);
							
						$_SESSION['result']="محصولات کارت انتخاب شد";
						$_SESSION['alert']="success";
						header("location: /club/scores");
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
						header("location: /club/cardproduct/".$id);
					}
				}
			}
			$GLOBALS['GCMS']
					->assign('product_groups',
							Page::get(
									array("pg_type" => "product_group", "pg_status" => "publish"),
									true));
			$GLOBALS['GCMS']->assign('card', $card);
		}
		else
			header("location: /error404?error=club&reason=card_not_exist");
	}
	else
		header("location: /club?redirect=".$_SERVER["REQUEST_URI"]);
}
