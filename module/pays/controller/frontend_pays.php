<?php

/**
 * frontend_pays.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > pays
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/pays/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

require_once(__COREROOT__."/libs/nusoap/nusoap_client.php");


function index()
{
	if(isset($_SESSION["glogin_username"]) )
	{
		if(isset($_GET['confirm'])and valid_form())
		{
            if ($_GET['type'])
                zarinType($_POST['amount'],$_POST['txt']);

		}
}
else
	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function offline()
{
	if(isset($_SESSION["glogin_username"]) )
	{
		if(isset($_GET['confirm'])and valid_form())
		{
            $arr_insert=array(
                "id_user" => $_SESSION["glogin_user_id"],
                "amount" => $_POST['amount'],
                "txt" => $_SESSION["glogin_username"]." ".$_POST['txt'],
                "date" => shamsi_to_miladi($_POST['date']),
                "bank_info" => " پرداخت آفلاین ",
                "status" => "pending"
            );

            Pays::insert($arr_insert);
            $_SESSION['result']=" اطلاعات ارسالی شما در سیستم ثبت شد، اطلاعات ارسالی شما نیاز به تایید مدیر دارد. ";
            $_SESSION['alert']="success";
            header("location: /pays/list");
		}
}
else
	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function back($id)
{
	if(isset($_SESSION["glogin_username"]) )
	{
        if ($_GET['type'])
            zarinBack($id);
	}
	else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function list_pays()
{
	if(isset($_SESSION["glogin_username"]))
	{
		$GLOBALS['GCMS']
		->assign('lists_pay',
				Pays::get(
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
function zarinType($amount,$txt)
{
    $merchantID= $GLOBALS['GCMS_SETTING']['pays']['merchantID'];
    $arr_insert=array(
        "id_user" => $_SESSION["glogin_user_id"],
        "amount" => $amount,
        "txt" => $_SESSION["glogin_username"]." ".$txt,
        "date" => date("Y-m-d H:i:s"),
        "bank_info" => "پرداخت با زرین پال",
        "status" => "pending"
    );

    Pays::insert($arr_insert);
    $orderId=mysql_insert_id();
    $amount="$amount";
    $site_url= "http://".$_SERVER['SERVER_NAME'];
    require_once(__COREROOT__."/libs/utility/hashing.php");
    $callBackUrl=$site_url."/pays/back/".$orderId."?&type=zarin&id=".rndstring(90)."&id_user=".$_SESSION["glogin_user_id"]."&amount=".$amount;
    $client = new SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8')); 
    $result = $client->PaymentRequest(
						array(
								'MerchantID' 	=> $merchantID,
								'Amount' 	=> $amount/10,
								'Description' 	=> urlencode($_SESSION["glogin_username"]." ".$txt),
								'Email' 	=> "",
								'Mobile' 	=> "",
								'CallbackURL' 	=> $callBackUrl
							)
	);
	if($result->Status == 100)
	{
		Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
	} else {
		echo'ERR: '.$result->Status;
	}
    //$res=$client->PaymentRequest($merchantID, $amount/10, $callBackUrl, urlencode($_SESSION["glogin_username"]." ".$txt));
    //header('Location: https://www.zarinpal.com/users/pay_invoice/'.$res);
}
function zarinBack($id)
{
    $merchantID = $GLOBALS['GCMS_SETTING']['pays']['merchantID'];
    $pay=Pays::get(array("id" => $id));
    if($pay->id_user!=$_SESSION["glogin_user_id"])
    {
        $_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
        $_SESSION['alert']="error";
        header("location: /pays/list");
    }
    if($_GET['Status'] == 'OK')
    {
        $client = new SoapClient('https://de.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8')); 
        $result = $client->PaymentVerification(
						  	array(
									'MerchantID'	 => $merchantID,
									'Authority' 	 => $_GET['Authority'],
									'Amount'	 => $pay->amount /10
								)
		);
        if($result->Status == 100){
			$arr_update=array(
            "id" => $id,
            "bank_info" => $pay->bank_info." | refID : ".$result->RefID,
            "status" => "confirm"
			);
			Pays::update($arr_update);

			$_SESSION['result']="پرداخت شما با موفقیت در سیستم ثبت شد";
			$_SESSION['alert']="success";
			header("location: /pays/list");
		} else {
			$_SESSION['result']="خطا در پرداخت " . $result->Status;
			$_SESSION['alert']="danger";
			header("location: /pays/list");
		}
        
        
    }
    else
    {
        $_SESSION['result']="خطا در پرداخت ";
        $_SESSION['alert']="danger";
        header("location: /pays/list");
    }
}
