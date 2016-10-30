<?php

/**
 * frontend_dinero.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > SAMPLE
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/SAMPLE/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//index
}
function offline()
{
	$lastRate = Dinerorate::get(array(
			"type"     => "EU",
			"refrence" => "o-xe.com",
	),false,array("by"=>'id',"sort"=>'DESC'));
	
	$rateEu =  $lastRate->ratesell+10;
	$euTransfer = $_POST['moneytransfer'];
	$tmTransfer = $euTransfer*$rateEu;
	$arr_insert=array(
			"id_user" => 0,
			"email" =>  $_POST['email'],
			"name" => $_POST['name'],
			"cell" => $_POST['cell'],
			"idnumber" => $_POST['idnumber'],
			"address" => $_POST['address'],
			"country" => $_POST['country'],
			"bankname" => $_POST['bankname'],
			"iban" => $_POST['iban'],
			"paymethod" => $_POST['paymethod'],
			"moneytransfereu" => $euTransfer,
			"moneytransfertm" => $tmTransfer,
			"paymentstatus" => "pending",
			"status" => "pending",
			"date" => date("Y-m-d H:i:s")
	);
	Dinerorder::insert($arr_insert);
	$lid = mysql_insert_id();
	
	$arr_insert=array(
                "id_user" => 0,
                "amount" => $_POST['amount'],
                "txt" => "offline|".$lid,
                "date" => $_POST['date'],
                "bank_info" => " پرداخت آفلاین | شماره پیگیری" . $_POST['bank_info'],
                "status" => "pending"
            );
			
            Pays::insert($arr_insert);
            $_SESSION['result']=" اطلاعات ارسالی شما در سیستم ثبت شد، اطلاعات ارسالی شما نیاز به تایید مدیر دارد. ";
            $_SESSION['alert']="success";
            header("location: /dinero");
}
function back()
{
	$MerchantID = $GLOBALS['GCMS_SETTING']['pays']['merchantID'];
		$Authority = $_GET['Authority'];
		$pay=Pays::get(array("id" => $_GET['oid']));
		if($pay->id_user!=0)
		{
			$_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
			$_SESSION['alert']="error";
			header("location: /dinero");
			exit();
		}
		$Amount = $pay->amount;
		 
		if ($_GET['Status'] == 'OK') {
			 
			$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
			 
			$result = $client->PaymentVerification(
					[
							'MerchantID' => $MerchantID,
							'Authority' => $Authority,
							'Amount' => $Amount,
					]
					);
			 
			if ($result->Status == 100) {
				$arr_update=array(
						"id" => $_GET['oid'],
						"bank_info" => $pay->bank_info." zarin|refID:".$result->RefID ,
						"status" => "confirm"
				);
				Pays::update($arr_update);
				$arr_update=array(
						"id" => $_GET['sfid'],
						"paymentstatus" => "confirm"
				);
				Dinerorder::update($arr_update);
				 
				$_SESSION['result']="پرداخت شما با موفقیت در سیستم ثبت شد";
				$_SESSION['alert']="success";
				header("location: /dinero/");
			} else {
				$_SESSION['result']="خطا در پرداخت " .$result->Status;
				$_SESSION['alert']="danger";
				header("location: /dinero/");
			}
		} else {
			$_SESSION['result']=" پرداخت لغو شد  " ;
			$_SESSION['alert']="danger";
			header("location: /dinero/");
		}
}
function add()
{
	
	if (isset($_POST['moneytransfer'])){
		
		
		$lastRate = Dinerorate::get(array(
				"type"     => "EU",
				"refrence" => "o-xe.com",
		),false,array("by"=>'id',"sort"=>'DESC'));
		
		$rateEu =  $lastRate->ratesell+10;
		$euTransfer = $_POST['moneytransfer'];
		$tmTransfer = $euTransfer*$rateEu;
		if ($_POST['paymethod'] == "online"){
			$arr_insert=array(
					"id_user" => 0,
					"email" =>  $_POST['email'],
					"name" => $_POST['name'],
					"cell" => $_POST['cell'],
					"idnumber" => $_POST['idnumber'],
					"address" => $_POST['address'],
					"country" => $_POST['country'],
					"bankname" => $_POST['bankname'],
					"iban" => $_POST['iban'],
					"paymethod" => $_POST['paymethod'],
					"moneytransfereu" => $euTransfer,
					"moneytransfertm" => $tmTransfer,
					"paymentstatus" => "pending",
					"status" => "pending",
					"date" => date("Y-m-d H:i:s")
			);
			Dinerorder::insert($arr_insert);
			$lid = mysql_insert_id();
			zarinType($tmTransfer,$lid,$lid,$_POST['email']);
		}else{
			
		}
	}
}




function zarinType($amount,$txt,$id_shop_factor,$email)
{

	$MerchantID = $GLOBALS['GCMS_SETTING']['pays']['merchantID'];

	$arr_insert=array(
			"id_user" => 0,
			"amount" => $amount,
			"txt" => $txt,
			"date" => date("Y-m-d H:i:s"),
			"bank_info" => "پرداخت با زرین پال",
			"status" => "pending"
	);

	Pays::insert($arr_insert);
	$orderId=mysql_insert_id();
	$site_url= "http://".$_SERVER['SERVER_NAME'];
	require_once(__COREROOT__."/libs/utility/hashing.php");

	$Amount = $amount;
	$Description = $txt;
	$CallbackURL = $site_url."/dinero/back?oid=".$orderId."&type=zarin&id=".rndstring(90)."&sfid=".$id_shop_factor."&id_user=".$email."&amount=".$amount;
	$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
	$result = $client->PaymentRequest(
			[
					'MerchantID' => $MerchantID,
					'Amount' => $Amount,
					'Description' => $Description,
					'Email' => $_SESSION["glogin_username"],
					'Mobile' => "",
					'CallbackURL' => $CallbackURL,
			]
			);
	if ($result->Status == 100) {
		Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
	} else {
		$_SESSION['result']=" یک چیزی یه‌جایی اشتباه شده.  ". 'ERR: '.$result->Status;
		$_SESSION['alert']="danger";
		header("location: /dinero/add/");
	}

}

