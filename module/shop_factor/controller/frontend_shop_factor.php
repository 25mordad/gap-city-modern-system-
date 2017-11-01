<?php

/**
 * frontend_shop_factor.php
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

$utilityfile = __COREROOT__."/module/shop_factor/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
    if( (isset($_SESSION["glogin_username"]) and isset($_SESSION['gcmsCart'])) or  (isset($_SESSION["glogin_username"]) and isset($_GET['back'])))
    {
        $GLOBALS['GCMS']->assign('user', User::get(array("id" => $_SESSION["glogin_user_id"])));
        //find
        $GLOBALS['GCMS']->assign('PishFactorId', ShopFactor::get(null,false,array("by"=>"id","sort"=>"DESC"),null));
        if (isset($_GET['back']))
        {
        	
        	if ($GLOBALS['GCMS_SETTING']['shopfactor']['type'] == "zarin")
        		zarinBack();
        	if ($GLOBALS['GCMS_SETTING']['shopfactor']['type'] == "paypal")
        		paypalBack();

        }
        if (isset($_GET['step']) and isset($_POST['name']) and isset($_SESSION['sumShopFee']))
        {
        	$tx = $_POST['text'];
			if ($_POST['discount'] != "")
				$tx = $_POST['text']." |Discount Code: ".$_POST['discount'] ;
            $array_insert = array(
                "id_user"    => $_SESSION["glogin_user_id"] ,
                "address"    => $_POST['province'] . " - " . $_POST['city'] . " - " . $_POST['address'] . " - "
            		."Cell:‌" .$_POST['mobile'] . " Tell: " . $_POST['tell'],
                "zipcode"    => $_POST['zipcode'] ,
                "name"       => $_POST['name'] ,
                "text"       => $tx,
                "status_pay" => "pending",
                "status"     => "step1",
                "date"       => date("Y-m-d H:i:s"),
                "fee"        => $_SESSION['sumShopFee'] ,
                "distinct"   => $_SESSION['sumDiscountFee'] ,
                "delivery"   => $_POST['delivery']
            );
            
            ShopFactor::insert($array_insert);
            $id_shop_factor = mysql_insert_id();
            $gcmsCart       = $_SESSION['gcmsCart'];
            foreach ($gcmsCart as $prow )
            {

                $arr_get = array("id" => $prow['productId']);
                $product = Products::get($arr_get, false);

                if (1 > $product->quantity)
                {
                    header("location: /error404?error=shop_factor&reason=count");
                    die();
                }else{
                    //
                    Products::update(array("id"=>$product->id,"quantity"=>$product->quantity-1));

                    $array_insert2  =  array(
                        "id_shop_factor"   => $id_shop_factor,
                        "name"             => "[id=$product->id][title=$product->fa_title][size=".$prow['size']."] [color=".$prow['color']."]" ,
                        "fee"              => $prow['price'] ,
                        "number"           => "1" ,
                        "distinct"         => $prow['discount']
                    );
                    ShopFcrelpro::insert($array_insert2);
                }



            }
            
            zarinType($_SESSION['sumShopFee'],$id_shop_factor,$id_shop_factor);
            unset($_SESSION['gcmsCart']);
            unset($_SESSION['sumShopFee']);
            unset($_SESSION['sumDiscountFee']);
            

        }

        if (isset($_GET['final']) and isset($_POST['shopfactor']))
        {

            $array_insert = array(
                "id_user"    => $_SESSION["glogin_user_id"] ,
                "address"    => $_POST['address'] ,
                "zipcode"    => $_POST['zipcode'] ,
                "name"       => $_POST['name'] ,
                "text"       => $_POST['text'] ,
                "status_pay" => "pending",
                "status"     => "step1",
                "date"       => date("Y-m-d H:i:s"),
                "fee"        => $_SESSION['shop_factor_fee'] ,
                "distinct"   => "0" ,
                "delivery"   => "none"
            );
            ShopFactor::insert($array_insert);
            $id_shop_factor = mysql_insert_id();
            $gcmsCart       = $_SESSION['gcmsCart'];
            $price = 0;
            foreach ($gcmsCart as $prow )
            {

                $arr_get = array("id" => $prow['productId']);
                $product = Products::get($arr_get, false);

                if ($prow['qty'] > $product->quantity)
                {
                    header("location: /error404?error=shop_factor&reason=count");
                    die();
                }else{
                    //
                    Products::update(array("id"=>$product->id,"quantity"=>$product->quantity-$prow['qty']));

                    $array_insert2  =  array(
                        "id_shop_factor"   => $id_shop_factor ,
                        "name"             => $product->name ,
                        "fee"              => $product->price*$prow['qty'] ,
                        "number"           => $prow['qty'] ,
                        "distinct"         => "0"
                    );
                    ShopFcrelpro::insert($array_insert2);
                    $price = $price + $product->price*$prow['qty'] ;
                }



            }

            unset($_SESSION['gcmsCart']);
            if ($GLOBALS['GCMS_SETTING']['shopfactor']['type'] == "zarin")
            	zarinType($price,"پرداخت آنلاین فاکتور شماره ".$id_shop_factor,$id_shop_factor);
            if ($GLOBALS['GCMS_SETTING']['shopfactor']['type'] == "paypal")
            	paypalType($price,"Text".$id_shop_factor,$id_shop_factor);

        }


    }
    else
    	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}



function paypalBack()
{
	$pay=Pays::get(array("id" => $_GET['oid']));
	if($pay->id_user!=$_SESSION["glogin_user_id"])
	{
		$_SESSION['result']="ERROR";
		$_SESSION['alert']="error";
		header("location: /pays/list");
		exit();
	}
	$Amount = $pay->amount;
	if ($Amount == $_GET['amount']){
		$arr_update=array(
				"id" => $_GET['oid'],
				"bank_info" => $pay->bank_info." paypal|refID:".date("Y-m-d H:i:s"),
				"status" => "confirm"
		);
		Pays::update($arr_update);
		$arr_update=array(
				"id" => $_GET['sfid'],
				"status_pay" => "confirm"
		);
		ShopFactor::update($arr_update);
		
		//require_once(__COREROOT__."/module/shop_factor/controller/email.php");
		
		$_SESSION['result']="Payment successfully registred";
		$_SESSION['alert']="success";
		header("location: /shop_factor/thanks/".$_GET['sfid']);
	}else{
		$_SESSION['result']="ERROR";
		$_SESSION['alert']="error";
		header("location: /pays/list");
		exit();
	}
	
	
}


function zarinBack()
{
	$MerchantID = $GLOBALS['GCMS_SETTING']['pays']['merchantID'];
	$Authority = $_GET['Authority'];
	$pay=Pays::get(array("id" => $_GET['oid']));
	if($pay->id_user!=$_SESSION["glogin_user_id"])
	{
		$_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
		$_SESSION['alert']="error";
		header("location: /pays/list");
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
					"status_pay" => "confirm"
			);
			ShopFactor::update($arr_update);
			
			require_once(__COREROOT__."/module/shop_factor/controller/email.php");
			
			$_SESSION['result']="پرداخت شما با موفقیت در سیستم ثبت شد";
			$_SESSION['alert']="success";
			header("location: /shop_factor/thanks/".$_GET['sfid']);
		} else {
			$_SESSION['result']="خطا در پرداخت " .$result->Status;
			$_SESSION['alert']="danger";
			header("location: /shop_factor/my");
		}
	} else {
		$_SESSION['result']=" پرداخت لغو شد  " ;
		$_SESSION['alert']="danger";
		header("location: /shop_factor/my");
	}
}


function paypalType($amount,$txt,$id_shop_factor)
{
	$arr_insert=array(
			"id_user" => $_SESSION["glogin_user_id"],
			"amount" => $amount,
			"txt" => $_SESSION["glogin_username"]." ".$txt,
			"date" => date("Y-m-d H:i:s"),
			"bank_info" => "Paypal Payment",
			"status" => "pending"
	);
	Pays::insert($arr_insert);
	$orderId=mysql_insert_id();
	
	$site_url= "http://".$_SERVER['SERVER_NAME'];
	$paypal_email = $GLOBALS['GCMS_SETTING']['pays']['paypalemail'];
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$CallbackURL = $site_url."/shop_factor/?back=true&oid=".$orderId."&type=paypal&id=".rndstring(90)."&sfid=".$id_shop_factor."&id_user=".$_SESSION["glogin_user_id"]."&amount=".$amount;
	
	$querystring  = "?business=".urlencode($paypal_email)."&amount=".urlencode($amount).
	"&cmd=_xclick&lc=ES&currency_code=EUR&payer_email".$_SESSION["glogin_username"].
	"&return=".urlencode(stripslashes($CallbackURL));
	
	header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	exit();
	
}
function zarinType($amount,$txt,$id_shop_factor)
{
	
	$MerchantID = $GLOBALS['GCMS_SETTING']['pays']['merchantID'];
	
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
	$site_url= "http://".$_SERVER['SERVER_NAME'];
	require_once(__COREROOT__."/libs/utility/hashing.php");
	
	$Amount = $amount;
	$Description = $txt;
	$CallbackURL = $site_url."/shop_factor/?back=true&oid=".$orderId."&type=zarin&id=".rndstring(90)."&sfid=".$id_shop_factor."&id_user=".$_SESSION["glogin_user_id"]."&amount=".$amount;
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
		header("location: /user/dashboard");
	}
	
}

function my ()
{
    if( isset($_SESSION["glogin_username"]) )
    {
        $array_get = array(
            "id_user" => $_SESSION["glogin_user_id"]
        );
        $GLOBALS['GCMS']->assign('factors', ShopFactor::get($array_get,true));
    }
    else
    header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

function show ($id)
{
    if(isset($_SESSION["glogin_username"]))
    {
        $array_get = array(
            "id"      => $id ,
            "id_user" => $_SESSION["glogin_user_id"],
        );
        $factor = ShopFactor::get($array_get);
        if (isset($factor))
        	$GLOBALS['GCMS']->assign('factor', $factor);
        else
        	header("location: /shop_factor/my");
    }else
        header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);

}

function thanks ($id)
{
    if(isset($_SESSION["glogin_username"]))
    {
        $array_get = array(
            "id"      => $id ,
            "id_user" => $_SESSION["glogin_user_id"],
        );
        $factor = ShopFactor::get($array_get);
        if (isset($factor))
        	$GLOBALS['GCMS']->assign('factor', $factor);
        else
        	header("location: /shop_factor/my");
    }else
        header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);

}
function aprint ($id)
{
    if(isset($_SESSION["userid"]) and $_SESSION['level'] == 10)
    {
        $array_get = array(
            "id"      => $id
        );
        $GLOBALS['GCMS']->assign('factor', ShopFactor::get($array_get));
    }else
        header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}

