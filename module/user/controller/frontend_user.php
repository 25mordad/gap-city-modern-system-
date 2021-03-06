<?php

/**
 * frontend-user.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > user
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

function index()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /user/dashboard");
	}
	else
	{
		if(isset($_POST['login']))
		{
			if($_POST['capcha']
					&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']))
			{
				$_SESSION['result']="Please input the code";
				$_SESSION['alert']="warning";
			}
			else if($_POST['username']=="")
			{
				$_SESSION['result']="Please input username";
				$_SESSION['alert']="warning";
			}
			else if($_POST['password']=="")
			{
				$_SESSION['result']="Please input password";
				$_SESSION['alert']="warning";
			}
			else
			{
				$chk_user=User::get(array("username" => $_POST['username']));
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
							$_SESSION["glogin_user_level"]=$chk_user->user_level;
							$_SESSION["glogin_user_id"]=$chk_user->id;
							$credit=MetaUser::get(array("id_user" => $chk_user->id, "name" => "credit"));
							if(isset($credit))
								$_SESSION["glogin_user_credit"]=$credit->value;
							else
								$_SESSION["glogin_user_credit"]=0;
							//reseting password_attempts_failed
							if($chk_user->password_attempts_failed>0)
							{
								$arr_update=array(
										"id" => $chk_user->id,
										"password_attempts_failed" => 0
								);
								User::update($arr_update);
							}
							$_SESSION['result']="Welcome";
							$_SESSION['alert']="success";

							if(isset($_POST['redirect']))
							{
								header("location: ".$_POST['redirect']);
							}
							else
							{
								header("location: /user/dashboard");
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
										"status" => "pending"
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
							User::update($arr_update);

							$_SESSION['result']="Password is incorrect";
							$_SESSION['alert']="warning";
						}
					}
					else
					{
						$_SESSION['result']="Your account is suspended";
						$_SESSION['alert']="warning";
					}
				}
				else
				{
					$_SESSION['result']="Username is incorrect";
					$_SESSION['alert']="warning";
				}
			}
			header("location: /user");
		}
	}
}

function forgot()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /user/profile");
	}
	else
	{
		if(isset($_GET['forgot'])&&$_GET['forgot']=="true")
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			
			if(isset($_POST['g-recaptcha-response']))
				$captcha=$_POST['g-recaptcha-response'];

			if(!$captcha)
			{
				$_SESSION['result']="Please check I am not a robot";
					$_SESSION['alert']="warning";
			}
			else if(!email_validation($_POST['email']))
			{
				$_SESSION['result']="Email address is not valid";
				$_SESSION['alert']="warning";
			}
			else
			{
				$chk_user=User::get(array("email" => $_POST['email']));
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
						User::update($arr_update);
						require_once(__COREROOT__."/module/user/controller/forgotemail.php");
						
						$_SESSION['result']="Please check your email inbox";
						$_SESSION['alert']="success";
					}
					else
					{
						$_SESSION['result']="Your account is suspended";
						$_SESSION['alert']="error";
					}
				}
				else
				{
					$_SESSION['result']="Email address is not valid";
					$_SESSION['alert']="error";
				}
			}
			header("location: /user/forgot");
		}

		if(isset($_GET['email'])&&isset($_GET['t_c']))
		{
			$arr_get=array(
					"email" => $_GET['email'],
					"temp_code" => $_GET['t_c']
			);
			$chk_user=User::get($arr_get);
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
				User::update($arr_update);
				require_once(__COREROOT__."/module/user/controller/resetemail.php");
				$_SESSION['result']="New password sent to your email";
				$_SESSION['alert']="success";
			}
			else
			{
				$_SESSION['result']="Your request is not valid, please try again";
				$_SESSION['alert']="error";
			}
			header("location: /user");
		}
	}
}

function profile()
{
	if(isset($_SESSION["glogin_username"]))
	{
		/**
		 * Old Profile Form
		 */
		if(isset($_REQUEST['edit']))
		{
			$param=$_POST['param'];
			$id_meta=key($param);
			foreach($param as &$p_value)
			{
				$arr_update_meta=array(
						"id" => $id_meta,
						"value" => $p_value,
				);
				MetaUser::update($arr_update_meta);
				$id_meta=key($param);
			}
			$_SESSION['result']="Successfully changed";
			$_SESSION['alert']="success";
			header("location: /user/profile");
		}
		/**
		 * New Profile Form
		 */
		$user_params=user_params($_SESSION["glogin_user_id"]);
		if(isset($_GET['edit_params'])&&$_GET['edit_params']=="true")
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
			$_SESSION['result']="Successfully changed";
			$_SESSION['alert']="success";
			header("location: /user/profile");
		}
		$GLOBALS['GCMS']->assign('user_params', $user_params);
	}
	else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function chngpass()
{
	if(isset($_SESSION["glogin_username"]))
	{
		if(isset($_POST['password']))
		{
			if($_POST['capcha']
					&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']))
			{
				$_SESSION['result']="Please input the code";
				$_SESSION['alert']="warning";
			}
			else if($_POST['password']=="")
			{
				$_SESSION['result']="Please input password";
				$_SESSION['alert']="warning";
			}
			else if($_POST['password']!=$_POST['re_password'])
			{
				$_SESSION['result']="Check the passwords";
				$_SESSION['alert']="warning";
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
				if(User::update($arr_update))
				{
					$_SESSION['result']="Password has changed";
					$_SESSION['alert']="success";
					header("location: /user/profile");
					return;
				}
				else
				{
					$_SESSION['result']="Problem occurred, please try again";
					$_SESSION['alert']="error";
				}
			}
			header("location: /user/chngpass");
		}
	}
	else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
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
	header("location: /user");
}

function register()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /user/profile");
	}
	else
	{
		if(isset($_POST['email']))
		{
			require_once(__COREROOT__."/libs/utility/validating.php");
			
			if(isset($_POST['g-recaptcha-response']))
				$captcha=$_POST['g-recaptcha-response'];
			
			if(!$captcha){
				$_SESSION['result']="Please check I'm not a robot";
				$_SESSION['alert']="warning";
				
			}
			
			if($_POST['password']=="")
			{
				$_SESSION['result']="Password error";
				$_SESSION['alert']="warning";
			}
				
			if(!email_validation($_POST['email']) )
			{
				$_SESSION['result']="Input Error";
				$_SESSION['alert']="warning";
			}
			
			if($captcha)
			{
				$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$GLOBALS['GCMS_SETTING']['general']['recaptcha']."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
				if($response['success'] == false)
				{
					$_SESSION['result']="Please Confirm I am not a robot";
					$_SESSION['alert']="warning";
				}else{
					//checking duplicate username & email...
					if(!isset($_POST['username']))
						$_POST['username']=$_POST['email'];
					$chk_username=User::get(array("username" => $_POST['username']));
					$chk_email=User::get(array("email" => $_POST['email']));
					if(isset($chk_username))
					{
						$_SESSION['result']="Username is taken, choose another one";
						$_SESSION['alert']="warning";
					}
					else if(isset($chk_email))
					{
						$_SESSION['result']="Email address is taken, choose another one";
						$_SESSION['alert']="warning";
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
								"password_attempts_failed" => 0,
								"status" => "active",
								"user_level" => $_POST['userlevel'],
								"added_id" => 0,
								"date_created" => date("Y-m-d H:i:s")
						);
						if(User::insert($arr_insert))
						{
							$id_user=mysql_insert_id();
							$param=$_POST['param'];
							$id_param=key($param);
							foreach($param as &$p_value)
							{
								$p_value=htmlspecialchars(trim($p_value), ENT_QUOTES);
								$arr_new_meta=array(
										"id_user" => $id_user,
										"name" => "param_".$id_param,
										"value" => $p_value,
								);
								MetaUser::insert($arr_new_meta);
								$id_param=key($param);
							}
							
							require_once(__COREROOT__."/module/user/controller/email.php");
	
	                        //password ok. setting sessions...
	                        $_SESSION["glogin_username"]=$_POST['username'];
	                        $_SESSION["glogin_email"]=$_POST['email'];
	                        $_SESSION["glogin_user_level"]=$_POST['userlevel'];
	                        $_SESSION["glogin_user_id"]=$id_user;
	
							$_SESSION['result']="Please check your email and check the spam box, you can add "
									.$GLOBALS['GCMS_SETTING']['general']['email'].
							" to contact book.";
							$_SESSION['alert']="success";
							header("location: /user/dashboard");
							return;
						}
						else
						{
							$_SESSION['result']="Error, please try again";
							$_SESSION['alert']="error";
						}
					}
				}
			}
			
			header("location: /register");
		}
	}
}


function dashboard()
{
	if(!isset($_SESSION["glogin_username"]))
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
	
	// COUSTOM DASHBOARD FOR GATRIYA USER

	require_once(__COREROOT__."/libs/utility/phpwhois/whois.main.php");
	require_once(__COREROOT__."/libs/utility/phpwhois/whois.utils.php");

	if (isset($_POST['domain']))
	{

		$domain= trim(@$_POST['domain']);
		$whois= new Whois();
		$result= $whois->Lookup($domain.".".$_POST['ext']);

		/* $domain_result .=  "<b>نتیجه جستجو برای " . $domain . ":</b><br />\n";
		$domain_result .=  "<br />\n"; */

		/* if (!empty($result['rawdata']))
		{
			$utils= new utils;
			$domain_result .=  $utils->showHTML($result);
		}
		else
		{
			//$domain_result .=  implode($whois->domain['errstr'],"<br />\n");
		}

		$domain_result .=  "<br />\n"; */

		$GLOBALS['GCMS']->assign('domain_result',$result);
	}

	// END OF COUSTOM DASHBOARD FOR GATRIYA USER

}


