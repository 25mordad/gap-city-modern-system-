<?php

/**
 * frontend_pay_zarin.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > pay_zarin
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/pay_zarin/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


function index()
{
	if(isset($_SESSION["glogin_username"]))
	{

		if(isset($_GET['confirm']) and valid_form() )
		{
			$merchantID='4f5b2081-38cc-4ff4-a6a6-29605ee8aeb5';
			$arr_insert=array(
					"id_user" => $_SESSION["glogin_user_id"],
					"amount" => $_POST['amount'],
					"txt" => $_SESSION["glogin_username"]." ".$_POST['txt'],
					"date" => date("Y-m-d H:i:s"),
					"bank_info" => "پرداخت با زرین پال",
					"status" => "pending"
			);

			PayMellat::insert($arr_insert);
			$orderId=mysql_insert_id();
			$amount="$_POST[amount]";
			// 			$site_url="http://gatriya.com"; // آدرس برگشت
			$site_url= "http://".$_SERVER['SERVER_NAME'];//$GLOBALS['GCMS_SETTING']['pay_mellat']['site_url'];
			require_once(__COREROOT__."/libs/utility/hashing.php");
			$callBackUrl=$site_url."/pay_zarin/back/".$orderId."?id=".rndstring(90)."&id_user="
					.$_SESSION["glogin_user_id"]."&amount=".$_POST['amount'];
			$client=new SoapClient('http://www.zarinpal.com/WebserviceGateway/wsdl',
					array(
							'encoding' => 'UTF-8'
					));
			$res=$client
			->PaymentRequest($merchantID, $amount/10, $callBackUrl,
					urlencode($_SESSION["glogin_username"]." ".$_POST['txt']));
			 
			header('Location: https://www.zarinpal.com/users/pay_invoice/'.$res);
		}
	}
	else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function back($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
		$merchantID='4f5b2081-38cc-4ff4-a6a6-29605ee8aeb5';
		$pay=PayMellat::get(array("id" => $id));
		if($pay->id_user!=$_SESSION["glogin_user_id"])
		{
			$_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
			$_SESSION['alert']="error";
			header("location: /pay_zarin");
		}
		if($pay->amount==$_GET['amount'])
		{
			$client=new SoapClient('http://www.zarinpal.com/WebserviceGateway/wsdl',
					array(
							'encoding' => 'UTF-8'
					));
			$res=$client->PaymentVerification($merchantID, $_GET['au'], $_GET['amount']);
			$arr_update=array(
					"id" => $id,
					"bank_info" => $pay->bank_info." | refID : ".$_GET['refID']." | au : "
					.$_GET['au'],
					"status" => "confirm"
			);
			PayMellat::update($arr_update);
			$row_c=MetaUser::get(
					array("id_user" => $_SESSION["glogin_user_id"], "name" => "credit"));
			if(!isset($row_c->id))
			{
				$arr_new_meta=array(
						"id_user" => $_SESSION["glogin_user_id"],
						"name" => "credit",
						"value" => 0,
				);
				MetaUser::insert($arr_new_meta);
				$row_c=MetaUser::get(
						array("id_user" => $_SESSION["glogin_user_id"], "name" => "credit"));
			}
			$new_credit=$row_c->value+$pay->amount;
			$arr_update_meta=array(
					"id" => $row_c->id,
					"value" => $new_credit,
			);
			MetaUser::update($arr_update_meta);
			//
			$text_form="
					پرداخت در سیستم ثبت شد
					";
			$arr_email=array(
					"from" => "info@rses.ir",
					"to" => $GLOBALS['GCMS_SETTING']['general']['email'],
					//"support@rses.ir",
					"subject" => "Pay Form ".$_SERVER['HTTP_HOST'],
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
			$_SESSION['result']="پرداخت شما با موفقیت در سیستم ثبت شد";
			$_SESSION['alert']="success";
			header("location: /pay_zarin");
		}
		else
		{
			$_SESSION['result']="خطا در پرداخت ";
			$_SESSION['alert']="error";
			header("location: /pay_zarin");
		}
	}
	else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function list_pay_zarin()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$GLOBALS['GCMS']
		->assign('lists_pay',
				PayMellat::get(
						array(
								"id_user" => $_SESSION["glogin_user_id"],
								"status" => "confirm"
						), true, array("by" => "date", "sort" => "DESC")));
	}
	else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function valid_form()
{
	$validation=true;

	$_POST['amount']=htmlspecialchars(trim($_POST['amount']), ENT_QUOTES);
	$_POST['txt']=htmlspecialchars(trim($_POST['txt']), ENT_QUOTES);

	if(trim($_POST['amount'])=="")
	{
		$validation=false;
		$_SESSION['result']="فیلد مبلغ خالی است.";
		$_SESSION['alert']="alarm";
		header("location: /pay_zarin");
	}
	return $validation;
}
