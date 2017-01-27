<?php

/**
 * frontend_accountkit.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > accountkit
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/accountkit/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	if(isset($_SESSION["gak_email"]))
		exit(header("Location: /dashboard"));
	
	if (isset($_GET['login']) and isset($_POST["code"])){
	
		$final = connecToAccKit($_POST["code"],$_POST["csrf_nonce"]);
		
		if (isset($final->error->message)){
			$_SESSION['result'] =" خطا ";
			$_SESSION['alert']  ="warning";
			exit(header("Location: /accountkit/"));
		}
			
		//check in DB
		$checkEmail=AccountKit::get(array("number" => $final->phone->number));
		if(isset($checkEmail))
		{
			if($checkEmail->status=="active")
			{
				Accountkitlog::insert(array("iduser" => $checkEmail->id, "date" => date("Y-m-d H:i:s"), "title" => "login"));
				
				$_SESSION["gak_id"]     = $checkEmail->id;
				$_SESSION["gak_email"]  = $checkEmail->email;
				$_SESSION["gak_number"] = $checkEmail->number;
				$_SESSION["gak_level"]  = $checkEmail->level;
				
				//
				$_SESSION['result'] ="با موفقیت وارد سایت شدید.";
				$_SESSION['alert']  ="success";
				exit(header("Location: /dashboard"));
			}else {
				$_SESSION['result'] =" وضعیت کاربری شما غیرفعال شده است. با مدیر سایت تماس بگیرید.";
				$_SESSION['alert']  ="warning";
				exit(header("Location: /accountkit/"));
			}
				
		}else{
			$_SESSION['result'] =" شماره موبایل شما در سیستم ثبت نشده است ";
			$_SESSION['alert']  = "warning";
			exit(header("Location: /accountkit"));
		}
	
		
	}	
}

function changeEmail()
{
	if(!isset($_SESSION["gak_email"]))
		header("location: /accountkit?redirect=".$_SERVER["REQUEST_URI"]);
	
	if (isset($_GET['changeemail']) and isset($_POST["code"]) ){
		
		$final = connecToAccKit($_POST["code"],$_POST["csrf_nonce"]);
		
		if (isset($final->error->message)){
			$_SESSION['result'] =" خطا ";
			$_SESSION['alert']  ="warning";
			exit(header("Location: /accountkit/"));
		}
		
		//check in DB
		$checkEmail=AccountKit::get(array("email" => $final->email->address));
		if(isset($checkEmail))
		{
			$_SESSION['result'] =" این ایمیل قبلا در سیستم ثبت شده. لطفا ایمیل دیگری وارد کنید ";
			$_SESSION['alert']  = "warning";
			exit(header("Location: /accountkit/changeEmail"));
			
		}else{
			AccountKit::update(array("id" => $_SESSION["gak_id"],"email" => $final->email->address));
			Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], "date" => date("Y-m-d H:i:s"), "title" => "changeEmail|".$_SESSION["gak_email"]));
			$_SESSION["gak_email"] = $final->email->address;
			//
			$_SESSION['result'] =" ایمیل با موفقیت تغییر کرد ";
			$_SESSION['alert']  ="success";
			exit(header("Location: /accountkit/changeEmail"));
		}
		
	}
			
}
function activeNumber()
{
	if(!isset($_SESSION["gak_email"]))
		header("location: /accountkit?redirect=".$_SERVER["REQUEST_URI"]);
	
	if (isset($_GET['cellnumber']) and isset($_POST["code"]) ){
		
		$final = connecToAccKit($_POST["code"],$_POST["csrf_nonce"]);
		
		if (isset($final->error->message)){
			$_SESSION['result'] =" خطا ";
			$_SESSION['alert']  ="warning";
			exit(header("Location: /accountkit/"));
		}
		
		//check in DB
		$checkEmail=AccountKit::get(array("number" => $final->phone->number));
		if(isset($checkEmail))
		{
			$_SESSION['result'] =" این شماره قبلا در سیستم ثبت شده. لطفا شماره دیگری وارد کنید ";
			$_SESSION['alert']  = "warning";
			exit(header("Location: /accountkit/activeNumber"));
			
		}else{
			AccountKit::update(array("id" => $_SESSION["gak_id"],"number" => $final->phone->number));
			if ($_GET['cellnumber'] == "activeNumber")
				$logTxt = "activeNumber";
			else 
				$logTxt = "changeNumber";
			Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], "date" => date("Y-m-d H:i:s"), "title" => $logTxt."|".$_SESSION["gak_number"]));
			$_SESSION["gak_number"] = $final->phone->number;
			//
			$_SESSION['result'] =" شماره شما فعال شد ";
			$_SESSION['alert']  ="success";
			exit(header("Location: /accountkit/activeNumber"));
		}
		
	}
			
}

function dashboard()
{
	if(!isset($_SESSION["gak_email"]))
		header("location: /accountkit?redirect=".$_SERVER["REQUEST_URI"]);
}

function register()
{
	if(isset($_SESSION["gak_email"]))
		exit(header("Location: /dashboard"));
	
	if (isset($_GET['login']) and isset($_POST["code"]) ){

		$final = connecToAccKit($_POST["code"],$_POST["csrf_nonce"]);
		
		if (isset($final->error->message)){
			$_SESSION['result'] =" خطا ";
			$_SESSION['alert']  ="warning";
			exit(header("Location: /accountkit/"));
		}
			
		if (!isset($final->email->address)){
			$_SESSION['result'] =" خطا ";
			$_SESSION['alert']  ="warning";
			exit(header("Location: /accountkit/"));
		}
			
		//check in DB
		$checkEmail=AccountKit::get(array("email" => $final->email->address));
		if(isset($checkEmail))
		{
			if($checkEmail->status=="active")
			{
				Accountkitlog::insert(array("iduser" => $checkEmail->id, "date" => date("Y-m-d H:i:s"), "title" => "login"));
				$_SESSION["gak_id"]     = $checkEmail->id;
				$_SESSION["gak_email"]  = $checkEmail->email;
				$_SESSION["gak_number"] = $checkEmail->number;
				$_SESSION["gak_level"]  = $checkEmail->level;
				
				//	
				$_SESSION['result'] ="با موفقیت وارد سایت شدید.";
				$_SESSION['alert']  ="success";
			}else {
				$_SESSION['result'] =" وضعیت کاربری شما غیرفعال شده است. با مدیر سایت تماس بگیرید.";
				$_SESSION['alert']  ="warning";
				exit(header("Location: /accountkit/"));
			}
			
		}else{
			// Add to DB
			$arr_insert=array(
					"email"  => $final->email->address,
					"number" => "",
					"status" => "active",
					"level"  => "customer"
			);
			AccountKit::insert($arr_insert);
			$idUser = mysql_insert_id();
			Accountkitlog::insert(array("iduser" => $idUser, "date" => date("Y-m-d H:i:s"), "title" => "registeredDay"));
			//
			$_SESSION["gak_id"]     = $idUser;
			$_SESSION["gak_email"]  = $final->email->address;
			$_SESSION["gak_number"] = "";
			$_SESSION["gak_level"]  = "customer";
			//
			$_SESSION['result'] = " ثبت‌نام با موفقیت انجام شد";
			$_SESSION['alert']  = "success";
		}
		
		exit(header("Location: /dashboard"));
	}
}


function logout()
{
	if(isset($_SESSION["gak_email"]))
	{
		Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], "date" => date("Y-m-d H:i:s"), "title" => "logout"));
		unset($_SESSION["gak_id"]);
		unset($_SESSION["gak_email"]);
		unset($_SESSION["gak_number"]);
		unset($_SESSION["gak_level"]);
	}
	exit(header("Location: /accountkit/"));
}


function connecToAccKit($postCode,$postCsrf)
{
	if(isset($postCode) and isset($postCsrf))
	{
		$_SESSION["code"] = $postCode;
		$_SESSION["csrf_nonce"] = $postCsrf;
		$ch = curl_init();
		// Set url elements
		$fb_app_id = $GLOBALS['GCMS_SETTING']['accountkit']['fb_app_id'];
		$ak_secret = $GLOBALS['GCMS_SETTING']['accountkit']['ak_secret'];
		$token = 'AA|'.$fb_app_id.'|'.$ak_secret;
		
		// Get access token
		$url = 'https://graph.accountkit.com/v1.0/access_token?grant_type=authorization_code&code='.$postCode.'&access_token='.$token;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		$info = json_decode($result);
		
		// Get account information
		$appsecret_proof = hash_hmac('sha256', $info->access_token, $ak_secret);
		
		$url = 'https://graph.accountkit.com/v1.0/me/?access_token='.$info->access_token . '&appsecret_proof='.$appsecret_proof;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		$final = json_decode($result);
		return $final;
	}
	exit(header("Location: /accountkit/"));
}

function userList()
{
	if(!isset($_SESSION["username"]))
		exit(header("Location: /accountkit"));
	
	$Ulist = AccountKit::get(null,true);
	$GLOBALS['GCMS']->assign('Ulist', $Ulist);
}


