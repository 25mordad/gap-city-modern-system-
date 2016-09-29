<?php

/**
 * salamatuser.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > salamatuser
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function index()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /salamatuser/profile");
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
				$chk_user=SalamatUser::get(
						array("username" => $_POST['username'], "status_not" => "delete"));
				if(isset($chk_user))
				{
					if($chk_user->status!="disabled")
					{
						$arr_insert_log=array(
									"id_user" => $chk_user->id,
									"ip" => $_SERVER['REMOTE_ADDR'],
									"status" => "unknown",
									"user_agent" => $_SERVER['HTTP_USER_AGENT'],
									"date" => date("Y-m-d H:i:s")
						);
						//user ok. checking password...
						require_once(__COREROOT__."/libs/utility/hashing.php");
						if($chk_user->password
								==hashit($_POST['password'], $chk_user->password_salt))
						{
							$arr_insert_log["status"]="ok";
							SalamatUserLog::insert($arr_insert_log);
							//password ok. setting sessions...
							$_SESSION["glogin_username"]=$chk_user->username;
							$_SESSION["glogin_name"]=$chk_user->name;
							$_SESSION["glogin_email"]=$chk_user->email;
							$_SESSION["glogin_cell"]=$chk_user->cell;
							$_SESSION["glogin_user_level"]=$chk_user->user_level;
							$_SESSION["glogin_user_id"]=$chk_user->id;
							//reseting password_attempts_failed
							/*if($chk_user->password_attempts_failed>0)
							{
							$arr_update=array(
							        "id" => $chk_user->id,
							        "password_attempts_failed" => 0
							);
							SalamatUser::update($arr_update);
							}*/
							$_SESSION['result']="خوش‌آمدید";
							$_SESSION['alert']="success";

							if(isset($_POST['redirect']))
							{
								header("location: ".$_POST['redirect']);
							}
							else
							{
								header("location: /salamatuser/profile");
							}
							return;
						}
						else
						{
							$arr_insert_log["status"]="error";
							SalamatUserLog::insert($arr_insert_log);
							//wrong pass. disabling user after 5 attempts...
							/*if($chk_user->password_attempts_failed==4)
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
							SalamatUser::update($arr_update);*/

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
			header("location: /salamatuser");
		}
	}
}

function forgot()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /salamatuser/profile");
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
				$chk_user=SalamatUser::get(
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
						SalamatUser::update($arr_update);

						$email_text="
						برای رسیدن به کلمه عبور جدید ، <a href=\"http://$_SERVER[HTTP_HOST]/salamatuser/forgot?username=$chk_user->username&email=$chk_user->email&t_c=$t_c\" >اینجا</a> را کلیک کنید و یا لینک زیر را دنبال کنید : <br/>
						http://$_SERVER[HTTP_HOST]/salamatuser/forgot?username=$chk_user->username&email=$chk_user->email&t_c=$t_c
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
			header("location: /salamatuser/forgot");
		}

		if(isset($_GET['username'])&&isset($_GET['email'])&&isset($_GET['t_c']))
		{
			$arr_get=array(
						"username" => $_GET['username'],
						"email" => $_GET['email'],
						"password_temp_code" => $_GET['t_c']
			);
			$chk_user=SalamatUser::get($arr_get);
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
				SalamatUser::update($arr_update);

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
				$_SESSION['result']="درخواست شما معتبر نیست،‌ دوباره تلاش کنید";
				$_SESSION['alert']="error";
			}
			header("location: /salamatuser");
		}
	}
}

function register()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /salamatuser/profile");
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
				//checking duplicate username
				$chk_username=SalamatUser::get(array("username" => $_POST['username']));
				if(isset($chk_username))
				{
					$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
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
								"password_temp_code" => "NULL",
								"status" => "invalid",
								"user_level" => $_POST['user_level'],
								"date_created" => date("Y-m-d H:i:s"),
								"name" => $_POST['name'],
								"cell" => "NULL",
								"cell_temp_code" => "NULL",
								"birth_date" => "NULL",
								"gender" => "NULL",
								"city" => "NULL",
								"address" => "NULL",
								"avatar" => "NULL",
								"created_by" => "0",
								"credit" => "0"
					);
					if(SalamatUser::insert($arr_insert))
					{
						$new_id=mysql_insert_id();
						//TODO send email to admin
						$arr_insert_log=array(
									"id_user" => $new_id,
									"ip" => $_SERVER['REMOTE_ADDR'],
									"status" => "ok",
									"user_agent" => $_SERVER['HTTP_USER_AGENT'],
									"date" => date("Y-m-d H:i:s")
						);
						SalamatUserLog::insert($arr_insert_log);
						$_SESSION["glogin_username"]=$_POST['username'];
						$_SESSION["glogin_name"]=$_POST['name'];
						$_SESSION["glogin_email"]="";
						$_SESSION["glogin_cell"]="";
						$_SESSION["glogin_user_level"]=$_POST['user_level'];
						$_SESSION["glogin_user_id"]=$new_id;
						$_SESSION['result']="ثبت‌نام با موفقیت انجام شد، لطفا اطلاعات پروفایل کاربری را تکمیل کنید";
						$_SESSION['alert']="success";
						header("location: /salamatuser/profile");
						return;
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
					}
				}
			}
			header("location: /salamatuser/register");
		}
	}
}

function regbycode()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /salamatuser/profile");
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
			else if($_POST['code']=="")
			{
				$_SESSION['result']="کد عضویت را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if(SalamatRegister::get_count(
					array("code" => $_POST['code'], "id_new_user" => "0"))!=1)
			{
				$_SESSION['result']="کد عضویت معتبر نیست";
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
				//checking duplicate username
				$chk_username=SalamatUser::get(array("username" => $_POST['username']));
				if(isset($chk_username))
				{
					$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
					$_SESSION['alert']="alarm";
				}
				else
				{
					$sr=SalamatRegister::get(array("code" => $_POST['code'], "id_new_user" => "0"));
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
								"password_temp_code" => "NULL",
								"status" => "invalid",
								"user_level" => $sr->status,
								"date_created" => date("Y-m-d H:i:s"),
								"name" => $_POST['name'],
								"cell" => "NULL",
								"cell_temp_code" => "NULL",
								"birth_date" => "NULL",
								"gender" => "NULL",
								"city" => "NULL",
								"address" => "NULL",
								"avatar" => "NULL",
								"created_by" => "0",
								"credit" => "0"
					);
					if(SalamatUser::insert($arr_insert))
					{
						$new_id=mysql_insert_id();
						//TODO send email to admin
						SalamatRegister::update(array("id" => $sr->id, "id_new_user" => $new_id));
						$arr_insert_log=array(
									"id_user" => $new_id,
									"ip" => $_SERVER['REMOTE_ADDR'],
									"status" => "ok",
									"user_agent" => $_SERVER['HTTP_USER_AGENT'],
									"date" => date("Y-m-d H:i:s")
						);
						SalamatUserLog::insert($arr_insert_log);
						$_SESSION["glogin_username"]=$_POST['username'];
						$_SESSION["glogin_name"]=$_POST['name'];
						$_SESSION["glogin_email"]="";
						$_SESSION["glogin_cell"]="";
						$_SESSION["glogin_user_level"]=$sr->status;
						$_SESSION["glogin_user_id"]=$new_id;
						$_SESSION['result']="ثبت‌نام با موفقیت انجام شد، لطفا اطلاعات پروفایل کاربری را تکمیل کنید";
						$_SESSION['alert']="success";
						header("location: /salamatuser/profile");
						return;
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
					}
				}
			}
			header("location: /salamatuser/regbycode");
		}
	}
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
				if(SalamatUser::update($arr_update))
				{
					$_SESSION['result']="کلمه عبور تغییر کرد";
					$_SESSION['alert']="success";
					header("location: /salamatuser/profile");
					return;
				}
				else
				{
					$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
				}
			}
			header("location: /salamatuser/chngpass");
		}
	}
	else
		header("location: /salamatuser?redirect=".$_SERVER["REQUEST_URI"]);
}

function logout()
{
	if(isset($_SESSION["glogin_username"]))
	{
		unset($_SESSION["glogin_username"]);
		unset($_SESSION["glogin_name"]);
		unset($_SESSION["glogin_email"]);
		unset($_SESSION["glogin_cell"]);
		unset($_SESSION["glogin_user_level"]);
		unset($_SESSION["glogin_user_id"]);
	}
	header("location: /salamatuser");
}

function profile()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$user=SalamatUser::get(array("id" => $_SESSION["glogin_user_id"]));
		if(isset($_GET['edit_params'])&&$_GET['edit_params']=="true")
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			if($_POST['email']!=$_SESSION["glogin_email"])
			{
				if(!email_validation($_POST['email']))
				{
					$_SESSION['result']="آدرس ایمیل معتبر نیست";
					$_SESSION['alert']="alarm";
					header("location: /salamatuser/profile");
					return;
				}
				else if(SalamatUser::get_count(array("email" => $_POST['email']))>0)
				{
					$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
					header("location: /salamatuser/profile");
					return;
				}
			}
			if($_POST['cell']!=$_SESSION["glogin_cell"])
			{
				if(!cell_validation($_POST['cell']))
				{
					$_SESSION['result']="شماره همراه معتبر نیست";
					$_SESSION['alert']="alarm";
					header("location: /salamatuser/profile");
					return;
				}
				else if(SalamatUser::get_count(array("cell" => $_POST['cell']))>0)
				{
					$_SESSION['result']="شماره موبایل قبلا استفاده شده، لطفا شماره دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
					header("location: /salamatuser/profile");
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
						"city" => $_POST['city'],
						"address" => $_POST['address']
			);
			SalamatUser::update($arr_update);
			$_SESSION['result']="تغییرات با موفقیت انجام شد";
			$_SESSION['alert']="success";

			if(!empty($_FILES["file"]['tmp_name']))
			{
				require_once(__COREROOT__."/libs/utility/image.php");
				if(upload("salamatuser", $user->id, "file", 150))
					$_SESSION['result']=$_SESSION['result']." و نمایه شما آپلود شد";
				else
					$_SESSION['result']=$_SESSION['result']." اما نمایه شما آپلود نشد";
			}

			if($_POST['name']!=$_SESSION["glogin_name"])
			{
				$_SESSION["glogin_name"]=$_POST['name'];
			}
			if($_POST['email']!=$_SESSION["glogin_email"])
			{
				$_SESSION["glogin_email"]=$_POST['email'];
				require_once(__COREROOT__."/libs/utility/salamatuser.php");
				if(email_confirm_code($_SESSION["glogin_user_id"]))
					$_SESSION['result']=$_SESSION['result']
							." و کد تایید آدرس ایمیل به شما ارسال شد";
				else
					$_SESSION['result']=$_SESSION['result']." اما کد تایید آدرس ایمیل ارسال نشد";
			}
			if($_POST['cell']!=$_SESSION["glogin_cell"])
			{
				$_SESSION["glogin_cell"]=$_POST['cell'];
				require_once(__COREROOT__."/libs/utility/salamatuser.php");
				if(sms_confirm_code($_SESSION["glogin_user_id"]))
				{
					$_SESSION['result']=$_SESSION['result']
							." و همچنین کد تایید شماره همراه با پیام کوتاه به شما ارسال شد";
					header("location: /salamatuser/confirm/?cell=true");
					return;
				}
				else
					$_SESSION['result']=$_SESSION['result']." اما کد تایید شماره همراه ارسال نشد";
			}
			header("location: /salamatuser/profile");
		}
		$GLOBALS['GCMS']->assign('user', $user);
	}
	else
		header("location: /salamatuser?redirect=".$_SERVER["REQUEST_URI"]);
}

function confirm()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$user=SalamatUser::get(array("id" => $_SESSION["glogin_user_id"]));
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
					SalamatUser::update($arr_update);
					$_SESSION['result']="شماره همراه شما تایید شد";
					$_SESSION['alert']="success";
				}
				else
				{
					$_SESSION['result']="کد صحیح نیست";
					$_SESSION['alert']="error";
				}
			}
			header("location: /salamatuser/profile");
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
					SalamatUser::update($arr_update);
					$_SESSION['result']="آدرس ایمیل شما تایید شد";
					$_SESSION['alert']="success";
				}
				else
				{
					$_SESSION['result']="کد صحیح نیست";
					$_SESSION['alert']="error";
				}
			}
			header("location: /salamatuser/profile");
		}
		$GLOBALS['GCMS']->assign('user', $user);
	}
	else
		header("location: /salamatuser?redirect=".$_SERVER["REQUEST_URI"]);
}

function all()
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="administrator")
	{
		//setting $_GET if not set
		if(!isset($_GET['user_level']))
			$_GET['user_level']="all";
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			header(
					"location: /salamatuser/all/?paging=1&search=".$_GET['search']."&user_level="
							.$_GET['user_level']);
		//preparing to query
		$max_results=20;
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
		//setting search & filter
		if($_GET['user_level']!="all")
			$arr_get['user_level']=$_GET['user_level'];
		if($_GET['search']!="NULL")
			$arr_get['search']="%".$_GET['search']."%";
		//assigning variables
		$GLOBALS['GCMS']->assign('users', SalamatUser::get($arr_get, true, $order, $limit));
		$GLOBALS['GCMS']->assign('paging', ceil(SalamatUser::get_count($arr_get)/$max_results));
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function show($id)
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="administrator")
	{
		$user=SalamatUser::get(array("id" => $id, "status_not" => "delete"));
		if(isset($id)&&isset($user))
		{
			$GLOBALS['GCMS']->assign('user', $user);
		}
		else
			header("location: /error404?error=salamatuser&reason=user_not_exist");
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function adduser()
{
	if(isset($_SESSION["glogin_username"])
			&&($_SESSION["glogin_user_level"]=="administrator"
					||$_SESSION["glogin_user_level"]=="supervisor"))
	{
		if(isset($_POST['register']))
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			if($_POST['user_level']=="none")
			{
				$_SESSION['result']="نوع کاربر را انتخاب نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['email']=="")
			{
				$_SESSION['result']="ایمیل را وارد نکرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else if(!email_validation($_POST['email']))
			{
				$_SESSION['result']="آدرس ایمیل معتبر نیست";
				$_SESSION['alert']="alarm";
			}
			else if(SalamatUser::get_count(array("email" => $_POST['email']))>0)
			{
				$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
				$_SESSION['alert']="alarm";
			}
			else
			{
				require_once(__COREROOT__."/libs/utility/hashing.php");
				$code=rndstring(8);
				while(SalamatRegister::get_count(array("code" => $code))>0)
					$code=rndstring(8);
				$email_text="<div style=\"direction:rtl\" >
				برای ثبت‌نام در شیرازسلامت، <a href=\"http://$_SERVER[HTTP_HOST]/salamatuser/regbycode/?code=$code\" >اینجا</a> را کلیک کنید و یا کد   <b>$code</b>   را در آدرس زیر وارد کنید: <br/>
				http://$_SERVER[HTTP_HOST]/salamatuser/regbycode
				<br/></div>
				";
				$arr_email=array(
							"from" => "noreply@".$_SERVER['HTTP_HOST'],
							"to" => $_POST['email'],
							"subject" => $_SESSION["glogin_name"]
									." شما را به عضویت در شیراز سلامت دعوت کرده است",
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
					$arr_insert=array(
								"code" => $code,
								"id_old_user" => $_SESSION["glogin_user_id"],
								"id_new_user" => 0,
								"status" => $_POST['user_level'],
								"code_date" => date("Y-m-d H:i:s")
					);
					SalamatRegister::insert($arr_insert);

					$_SESSION['result']="دعوت‌نامه و کد عضویت در سایت با ایمیل ارسال شد";
					$_SESSION['alert']="success";
				}
				else
				{
					$_SESSION['result']="کد عضویت ارسال نشد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
				}
			}
			header("location: /salamatuser/adduser");
		}
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function addinfouser()
{
	if(isset($_SESSION["glogin_username"])
			&&($_SESSION["glogin_user_level"]=="operator"
					||$_SESSION["glogin_user_level"]=="visitor"))
	{
		$user=SalamatUser::get(array("id" => $_SESSION["glogin_user_id"]));
		if($user->status!="valid")
		{
			$_SESSION['result']="شما هنوز کاربر فعال نیستید، لطفا اطلاعات خود را تکمیل کنید";
			$_SESSION['alert']="alarm";
			header("location: /salamatuser/profile");
		}
		else
		{

			if(isset($_POST['submit']))
			{
				require_once(__COREROOT__."/libs/utility/validating.php");
				if($_POST['name']=="")
				{
					$_SESSION['result']="نام را وارد نکرده‌اید";
					$_SESSION['alert']="alarm";
				}
				else if($_POST['username']=="")
				{
					$_SESSION['result']="نام کاربری را وارد نکرده‌اید";
					$_SESSION['alert']="alarm";
				}
				else if(SalamatUser::get_count(array("username" => $_POST['username']))>0)
				{
					$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
					$_SESSION['alert']="alarm";
				}
				else if(!email_validation($_POST['email']))
				{
					$_SESSION['result']="آدرس ایمیل معتبر نیست";
					$_SESSION['alert']="alarm";
				}
				else if(SalamatUser::get_count(array("email" => $_POST['email']))>0)
				{
					$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
				}
				else if(!cell_validation($_POST['cell']))
				{
					$_SESSION['result']="شماره همراه معتبر نیست";
					$_SESSION['alert']="alarm";
				}
				else if(SalamatUser::get_count(array("cell" => $_POST['cell']))>0)
				{
					$_SESSION['result']="شماره موبایل قبلا استفاده شده، لطفا شماره دیگری مشخص کنید";
					$_SESSION['alert']="alarm";
				}
				else if($_POST['birth_date']=="")
				{
					$_SESSION['result']="تاریخ تولد را وارد نکرده‌اید";
					$_SESSION['alert']="alarm";
				}
				else if($_POST['city']=="")
				{
					$_SESSION['result']="شهر را وارد نکرده‌اید";
					$_SESSION['alert']="alarm";
				}
				else if($_POST['address']=="")
				{
					$_SESSION['result']="آدرس را وارد نکرده‌اید";
					$_SESSION['alert']="alarm";
				}
				else if($_POST['gender']=="")
				{
					$_SESSION['result']="جنسیت را انتخاب نکرده‌اید";
					$_SESSION['alert']="alarm";
				}
				else
				{
					$birth_date=shamsi_to_miladi($_POST['birth_date']);
					require_once(__COREROOT__."/libs/utility/hashing.php");
					//adding user to db
					$password_generated=rndstring(8);
					$password_salt=saltit($_POST['username']);
					$password=hashit($password_generated, $password_salt);
					$arr_insert=array(
								"username" => $_POST['username'],
								"email" => $_POST['email'],
								"email_temp_code" => "NULL",
								"password" => $password,
								"password_salt" => $password_salt,
								"password_temp_code" => "NULL",
								"status" => "valid",
								"user_level" => "information",
								"date_created" => date("Y-m-d H:i:s"),
								"name" => $_POST['name'],
								"cell" => $_POST['cell'],
								"cell_temp_code" => "NULL",
								"birth_date" => $birth_date,
								"gender" => $_POST['gender'],
								"city" => $_POST['city'],
								"address" => $_POST['address'],
								"avatar" => "NULL",
								"created_by" => $_SESSION["glogin_user_id"],
								"credit" => "0"
					);
					if(SalamatUser::insert($arr_insert))
					{
						$new_id=mysql_insert_id();
						$_SESSION['result']="ثبت‌نام با موفقیت انجام شد";
						$_SESSION['alert']="success";
						//TODO send email to admin
						$email_text="<div style=\"direction:rtl\" >
						شما در سایت <a href=\"http://$_SERVER[HTTP_HOST]\" >شیراز سلامت</a> عضو شدید. برای ورود از لینک و اطلاعات زیر استفاده کنید:<br/>
						http://$_SERVER[HTTP_HOST]/salamatuser
						<br/>username: ".$_POST['username']."<br/>password: ".$password_generated
								."<br/></div>
								";
						$arr_email=array(
									"from" => "noreply@".$_SERVER['HTTP_HOST'],
									"to" => $_POST['email'],
									"subject" => $_SESSION["glogin_name"]
											." شما عضو شیراز سلامت شدید",
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
							$_SESSION['result']=$_SESSION['result']." و اطلاعات به کاربر ایمیل شد";
						require_once(__COREROOT__."/libs/utility/sms.php");
						$arr_send=array(
									"cell" => $_POST['cell'],
									"sms_text" => "شما در سایت شیراز سلامت عضو شدید. برای ورود از لینک و اطلاعات زیر استفاده کنید:
								http://$_SERVER[HTTP_HOST]/salamatuser username: "
											.$_POST['username']." password: ".$password_generated
						);
						if(send_sms($arr_send))
							$_SESSION['result']=$_SESSION['result']
									." و اطلاعات به کاربر با پیام کوتاه فرستاده شد";
						if(!empty($_FILES["file"]['tmp_name']))
						{
							require_once(__COREROOT__."/libs/utility/image.php");
							if(upload("salamatuser", $new_id, "file", 150))
								$_SESSION['result']=$_SESSION['result']." و نمایه آپلود شد";
							else
								$_SESSION['result']=$_SESSION['result']." اما نمایه آپلود نشد";
						}
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
					}
				}
				header("location: /salamatuser/addinfouser");
			}
		}
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function groups()
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="administrator")
	{
		//setting $_GET if not set
		if(!isset($_GET['paging']))
			header("location: /salamatuser/groups/?paging=1");
		//preparing to query
		$max_results=10;
		$arr_get=array();
		$order=array(
					"by" => "title",
					"sort" => "ASC"
		);
		$limit=array(
					"start" => (($_GET['paging']*$max_results)-$max_results),
					"end" => $max_results
		);
		//assigning variables
		$GLOBALS['GCMS']->assign('groups', SalamatGroup::get($arr_get, true, $order, $limit));
		$GLOBALS['GCMS']->assign('paging', ceil(SalamatGroup::get_count($arr_get)/$max_results));
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function newgroup()
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="administrator")
	{
		if(isset($_POST['submit']))
		{
			$tag="";
			if($_POST['id_parent']!=0)
			{
				$parent=SalamatGroup::get(array("id" => $_POST['id_parent']));
				$tag=$parent->tag.",";
			}
			$arr_insert=array(
						"id_parent" => $_POST['id_parent'],
						"tag" => $tag.$_POST['title'],
						"title" => $_POST['title'],
						"status" => $_POST['status']
			);
			if(SalamatGroup::insert($arr_insert))
			{
				$_SESSION['result']="دسته‌بندی ایجاد شد";
				$_SESSION['alert']="success";
				header("location: /salamatuser/editgroup/".mysql_insert_id());
			}
			else
			{
				$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
				$_SESSION['alert']="error";
				header("location: /salamatuser/newgroup/");
			}
		}
		$groups=SalamatGroup::get(array("status" => "publish"), true, array("by" => "title"));
		foreach($groups as $gr)
		{
			$parents[$gr->id]=$gr->title;
		}
		$GLOBALS['GCMS']->assign('parents', $parents);
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function editgroup($id)
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="administrator")
	{
		$group=SalamatGroup::get(array("id" => $id));
		if(isset($id)&&isset($group))
		{
			if(isset($_POST['submit']))
			{
				$tag="";
				if($_POST['id_parent']!=0)
				{
					$parent=SalamatGroup::get(array("id" => $_POST['id_parent']));
					$tag=$parent->tag.",";
				}
				$arr_update=array(
							"id" => $id,
							"id_parent" => $_POST['id_parent'],
							"tag" => $tag.$_POST['title'],
							"title" => $_POST['title'],
							"status" => $_POST['status']
				);
				if(SalamatGroup::update($arr_update))
				{
					$_SESSION['result']="دسته‌بندی ویرایش شد";
					$_SESSION['alert']="success";
				}
				else
				{
					$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
				}
				header("location: /salamatuser/editgroup/".$id);
			}
			$groups=SalamatGroup::get(array("status" => "publish"), true, array("by" => "title"));
			foreach($groups as $gr)
			{
				$parents[$gr->id]=$gr->title;
			}
			$GLOBALS['GCMS']->assign('parents', $parents);
			$GLOBALS['GCMS']->assign('group', $group);
		}
		else
			header("location: /error404?error=salamatuser&reason=group_not_exist");
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function areas()
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="administrator")
	{
		//setting $_GET if not set
		if(!isset($_GET['paging']))
			header("location: /salamatuser/areas/?paging=1");
		//preparing to query
		$max_results=10;
		$arr_get=array();
		$order=array(
					"by" => "id_parent",
					"sort" => "ASC"
		);
		$limit=array(
					"start" => (($_GET['paging']*$max_results)-$max_results),
					"end" => $max_results
		);
		//assigning variables
		$GLOBALS['GCMS']->assign('areas', SalamatArea::get($arr_get, true, $order, $limit));
		$GLOBALS['GCMS']->assign('paging', ceil(SalamatArea::get_count($arr_get)/$max_results));
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function newarea()
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="administrator")
	{
		if(isset($_POST['submit']))
		{
			$arr_insert=array(
						"id_parent" => $_POST['id_parent'],
						"name" => $_POST['name']
			);
			if(SalamatArea::insert($arr_insert))
			{
				$_SESSION['result']="منطقه / محله ایجاد شد";
				$_SESSION['alert']="success";
				header("location: /salamatuser/editarea/".mysql_insert_id());
			}
			else
			{
				$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
				$_SESSION['alert']="error";
				header("location: /salamatuser/newarea");
			}
		}
		$areas=SalamatArea::get(array("id_parent" => "0"), true, array("by" => "name"));
		foreach($areas as $ar)
		{
			$parents[$ar->id]=$ar->name;
		}
		$GLOBALS['GCMS']->assign('parents', $parents);
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function editarea($id)
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="administrator")
	{
		$area=SalamatArea::get(array("id" => $id));
		if(isset($id)&&isset($area))
		{
			if(isset($_POST['submit']))
			{
				$arr_update=array(
							"id" => $id,
							"id_parent" => $_POST['id_parent'],
							"name" => $_POST['name']
				);
				if(SalamatArea::update($arr_update))
				{
					$_SESSION['result']="منطقه / محله ویرایش شد";
					$_SESSION['alert']="success";
				}
				else
				{
					$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
				}
				header("location: /salamatuser/editarea/".$id);
			}
			$areas=SalamatArea::get(array("id_parent" => "0"), true, array("by" => "name"));
			foreach($areas as $ar)
			{
				$parents[$ar->id]=$ar->name;
			}
			$GLOBALS['GCMS']->assign('parents', $parents);
			$GLOBALS['GCMS']->assign('area', $area);
		}
		else
			header("location: /error404?error=salamatuser&reason=area_not_exist");
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function newinfo()
{
	if(isset($_SESSION["glogin_username"])
			&&($_SESSION["glogin_user_level"]=="operator"
					||$_SESSION["glogin_user_level"]=="visitor"))
	{
		$user=SalamatUser::get(array("id" => $_SESSION["glogin_user_id"]));
		if($user->status!="valid")
		{
			$_SESSION['result']="شما هنوز کاربر فعال نیستید، لطفا اطلاعات خود را تکمیل کنید";
			$_SESSION['alert']="alarm";
			header("location: /salamatuser/profile");
		}
		else
		{
			if(isset($_POST['submit']))
			{
				if($_POST['title']=="")
				{
					$_SESSION['result']="عنوان را وارد نکرده‌اید";
					$_SESSION['alert']="alarm";
				}
				else if($_POST['id_area']=="none")
				{
					$_SESSION['result']="محله را انتخاب نکرده‌اید";
					$_SESSION['alert']="alarm";
				}
				else
				{
					$arr_insert=array(
								"id_area" => $_POST['id_area'],
								"status" => "pending",
								"addresalamat" => $_POST['addresalamat'],
								"tell" => $_POST['tell'],
								"fax" => "NULL",
								"cell" => "NULL",
								"email" => "NULL",
								"url" => "NULL",
								"zip" => "NULL",
								"latitude" => "NULL",
								"longitude" => "NULL",
								"salamat_score" => "NULL",
								"user_score" => "NULL",
								"title" => $_POST['title'],
								"text" => "NULL",
								"type" => "normal"
					);
					if(SalamatInfo::insert($arr_insert))
					{
						$new_id=mysql_insert_id();
						$arr_insert_log=array(
									"id_info" => $new_id,
									"id_user" => $_SESSION["glogin_user_id"],
									"date" => date("Y-m-d H:i:s")
						);
						SalamatInfoLog::insert($arr_insert_log);
						$_SESSION['result']="اطلاعات ایجاد شد";
						$_SESSION['alert']="success";
						header("location: /salamatuser/editinfo/".$new_id);
						return;
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
					}
				}
				header("location: /salamatuser/newinfo");
			}
			$areas=SalamatArea::get(array("id_parent_not" => "0"), true, array("by" => "name"));
			foreach($areas as $ar)
			{
				$locals[$ar->id]=$ar->name;
			}
			$GLOBALS['GCMS']->assign('locals', $locals);
		}
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function editinfo($id)
{
	if(isset($_SESSION["glogin_username"])
			&&($_SESSION["glogin_user_level"]=="operator"
					||$_SESSION["glogin_user_level"]=="visitor"))
	{
		$info=SalamatInfo::get(array("id" => $id));
		$infolog=SalamatInfoLog::get(array("id_info" => $id), true, array("by" => "date"));
		if(isset($id)&&isset($info))
		{
			$user=SalamatUser::get(array("id" => $_SESSION["glogin_user_id"]));
			if($user->status!="valid")
			{
				$_SESSION['result']="شما هنوز کاربر فعال نیستید، لطفا اطلاعات خود را تکمیل کنید";
				$_SESSION['alert']="alarm";
				header("location: /salamatuser/profile");
			}
			else if($_SESSION["glogin_user_level"]=="visitor"&&$user->id!=$infolog[0]->id_user)
			{
				$_SESSION['result']="شما اجازه ندارید این اطلاعات را ویرایش کنید";
				$_SESSION['alert']="alarm";
				header("location: /salamatuser/profile");
			}
			else
			{
				if(isset($_POST['submit']))
				{
					if($_POST['title']=="")
					{
						$_SESSION['result']="عنوان را وارد نکرده‌اید";
						$_SESSION['alert']="alarm";
					}
					else if($_POST['id_area']=="none")
					{
						$_SESSION['result']="محله را انتخاب نکرده‌اید";
						$_SESSION['alert']="alarm";
					}
					else
					{
						$arr_update=array(
									"id" => $id,
									"id_area" => $_POST['id_area'],
									"status" => $_POST['status'],
									"addresalamat" => $_POST['addresalamat'],
									"tell" => $_POST['tell'],
									"fax" => $_POST['fax'],
									"cell" => $_POST['cell'],
									"email" => $_POST['email'],
									"url" => $_POST['url'],
									"zip" => $_POST['zip'],
									"latitude" => $_POST['latitude'],
									"longitude" => $_POST['longitude'],
									"salamat_score" => $_POST['salamat_score'],
									"user_score" => $_POST['user_score'],
									"title" => $_POST['title'],
									"text" => $_POST['text'],
									"type" => $_POST['type']
						);
						if(SalamatInfo::update($arr_update))
						{
							$arr_insert_log=array(
										"id_info" => $id,
										"id_user" => $user->id,
										"date" => date("Y-m-d H:i:s")
							);
							SalamatInfoLog::insert($arr_insert_log);
							$_SESSION['result']="اطلاعات ویرایش شد";
							$_SESSION['alert']="success";
						}
						else
						{
							$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
							$_SESSION['alert']="error";
						}
					}
					header("location: /salamatuser/editinfo/".$id);
				}
				$groups[]=array();
				$id_parents=array("0");
				while(count($id_parents)>0)
				{
					$id_parent=array_shift($id_parents);
					if(SalamatGroup::get_count(array("status" => "publish", "id_parent" => $id_parent))>0)
					{
						$grs=SalamatGroup::get(array("status" => "publish", "id_parent" => $id_parent), true, array("by" => "title"));
						foreach($grs as $gr)
						{
							$groups[$id_parent][$gr->id]=$gr;
							array_push($id_parents, $gr->id);
						}
					}
				}
				$GLOBALS['GCMS']->assign('groups', $groups);
				$relgis=SalamatRelGroupinfo::get(array("id_info" => $id), true);
				foreach($relgis as $relgi)
				{
					$groups_checked[$relgi->id_group]=$relgi->id;
				}
				$GLOBALS['GCMS']->assign('groups_checked', $groups_checked);
				$areas=SalamatArea::get(array("id_parent_not" => "0"), true, array("by" => "name"));
				foreach($areas as $ar)
				{
					$locals[$ar->id]=$ar->name;
				}
				$GLOBALS['GCMS']->assign('locals', $locals);
				$GLOBALS['GCMS']->assign('info', $info);
				$GLOBALS['GCMS']->assign('infolog', $infolog);
			}
		}
		else
			header("location: /error404?error=salamatuser&reason=info_not_exist");
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");
}

function showinfo($id)
{
	$info=SalamatInfo::get(array("id" => $id), false, null, null, "both");
	if(isset($id)&&isset($info))
	{
		$GLOBALS['GCMS']->assign('info', $info);
		$GLOBALS['GCMS']
				->assign('infolog',
						$infolog=SalamatInfoLog::get(array("id_info" => $id), true,
								array("by" => "date")));
	}
	else
		header("location: /error404?error=salamatuser&reason=info_not_exist");
}

function delinfo($id)
{
	if(isset($_SESSION["glogin_username"])
			&&($_SESSION["glogin_user_level"]=="operator"
					||$_SESSION["glogin_user_level"]=="visitor"))
	{
		$info=SalamatInfo::get(array("id" => $id));
		$infolog=SalamatInfoLog::get(array("id_info" => $id), true, array("by" => "date"));
		if(isset($id)&&isset($info))
		{
			$user=SalamatUser::get(array("id" => $_SESSION["glogin_user_id"]));
			if($user->status!="valid")
			{
				$_SESSION['result']="شما هنوز کاربر فعال نیستید، لطفا اطلاعات خود را تکمیل کنید";
				$_SESSION['alert']="alarm";
				header("location: /salamatuser/profile");
			}
			else if($_SESSION["glogin_user_level"]=="visitor"&&$user->id!=$infolog[0]->id_user)
			{
				$_SESSION['result']="شما اجازه ندارید این اطلاعات را حذف کنید";
				$_SESSION['alert']="alarm";
				header("location: /salamatuser/profile");
			}
			else
			{
				if(SalamatInfo::update(array("id" => $id, "status" => "delete")))
				{
					$arr_insert_log=array(
							"id_info" => $id,
							"id_user" => $user->id,
							"date" => date("Y-m-d H:i:s")
					);
					SalamatInfoLog::insert($arr_insert_log);
					$_SESSION['result']="اطلاعات حذف شد";
					$_SESSION['alert']="success";
				}
				else
				{
					$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
					$_SESSION['alert']="error";
				}
				header("location: /salamatuser/search");
			}
		}
		else
			header("location: /error404?error=salamatuser&reason=info_not_exist");
	}
	else
		header("location: /error404?error=salamatuser&reason=page_not_exist");	
}

function search()
{
	$areas=SalamatArea::get(array("id_parent" => "0"), true, array("by" => "name"));
	foreach($areas as $ar)
	{
		$area0s[$ar->id]=$ar->name;
	}
	$GLOBALS['GCMS']->assign('area0s', $area0s);
	$groups[]=array();
	$id_parents=array("0");
	while(count($id_parents)>0)
	{
		$id_parent=array_shift($id_parents);
		if(SalamatGroup::get_count(array("status" => "publish", "id_parent" => $id_parent))>0)
		{
			$grs=SalamatGroup::get(array("status" => "publish", "id_parent" => $id_parent), true, array("by" => "title"));
			foreach($grs as $gr)
			{
				$groups[$id_parent][$gr->id]=$gr;
				array_push($id_parents, $gr->id);
			}
		}
	}
	$GLOBALS['GCMS']->assign('groups', $groups);
	if(count($_GET)==0)
		return;
	if(isset($_GET['textoraddress']))
	{
		if($_GET['textoraddress']=="")
			return;
		if(SalamatInfo::get_count(array("search" => "%".$_GET['textoraddress']."%"))
				>=SalamatInfo::get_count(array("search_address" => "%".$_GET['textoraddress']."%")))
			$_GET['text']=$_GET['textoraddress'];
		else
			$_GET['address']=$_GET['textoraddress'];
	}
	if(!isset($_GET['group']))
		$_GET['group']="all";
	if(!isset($_GET['text']))
		$_GET['text']="";
	if(!isset($_GET['address']))
		$_GET['address']="";
	if(!isset($_GET['area0']))
		$_GET['area0']="all";
	else if($_GET['area0']!=all)
	{
		$locals=SalamatArea::get(array("id_parent" => $_GET['area0']), true, array("by" => "name"));
		foreach($locals as $lc)
		{
			$area1s[$lc->id]=$lc->name;
		}
		$GLOBALS['GCMS']->assign('area1s', $area1s);
	}
	if(!isset($_GET['area']))
		$_GET['area']="all";
	if(!isset($_GET['by'])||$_GET['by']=="")
		$_GET['by']="id";
	if(!isset($_GET['sort'])||$_GET['sort']=="")
		$_GET['sort']="desc";
	if(!isset($_GET['paging']))
		header(
				"location: /salamatuser/search/?paging=1&group=".$_GET['group']."&text="
						.$_GET['text']."&address=".$_GET['address']."&area0=".$_GET['area0']
						."&area=".$_GET['area']."&by=".$_GET['by']."&sort=".$_GET['sort']);
	//preparing to query
	$max_results=10;
	$arr_get=array(
				"status_not" => "delete"
	);

	if(!isset($_SESSION["glogin_username"])
			||(($_SESSION["glogin_user_level"]!="operator"
					&&$_SESSION["glogin_user_level"]!="visitor")))
		$arr_get['status']="publish";
	$order=array(
				"by" => $_GET['by'],
				"sort" => $_GET['sort']
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	$join_param="";
	//setting search & filter
	if($_GET['group']!="all")
	{
		$arr_get['group']="%".$_GET['group']."%";
	}
	if($_GET['text']!="")
		$arr_get['search']="%".$_GET['text']."%";
	if($_GET['address']!="")
		$arr_get['search_address']="%".$_GET['address']."%";
	if($_GET['area']!="all")
		$arr_get['id_area']=$_GET['area'];
	else if($_GET['area0']!="all")
	{
		$arr_get['id_area0']=$_GET['area0'];
	}
	//assigning variables
	$GLOBALS['GCMS']
			->assign('infos', SalamatInfo::get($arr_get, true, $order, $limit, "both"));
	$GLOBALS['GCMS']->assign('paging', ceil(SalamatInfo::get_count($arr_get)/$max_results));
	//TODO config below
	$arr_insert=array(
			"id_user" => (!isset($_SESSION["glogin_user_id"])) ? '0' : $_SESSION["glogin_user_id"],
			"text" => $_GET['text'],
			"type" => "?",
			"date" => date("Y-m-d H:i:s")
	);
	SalamatSearchlog::insert($arr_insert);
}
