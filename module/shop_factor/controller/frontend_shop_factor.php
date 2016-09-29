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

            $merchantID= $GLOBALS['GCMS_SETTING']['pays']['merchantID'];
            $pay=Pays::get(array("id" => $_GET['orderId']));
            if($pay->id_user!=$_SESSION["glogin_user_id"])
            {
                $_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
                $_SESSION['alert']="error";
                header("location: /pays/list");
            }
            if($pay->amount==$_GET['amount'])
            {
                $client=new SoapClient('http://www.zarinpal.com/WebserviceGateway/wsdl', array( 'encoding' => 'UTF-8'  ));
                $res=$client->PaymentVerification($merchantID, $_GET['au'], $_GET['amount']);
                $arr_update=array(
                    "id" => $_GET['orderId'],
                    "bank_info" => $pay->bank_info." | refID : ".$_GET['refID']." | au : " .$_GET['au'],
                    "status" => "confirm"
                );
                Pays::update($arr_update);
                $arr_update=array(
                    "id" => $_GET['idshfac'],
                    "status_pay" => "confirm"
                );
                ShopFactor::update($arr_update);

                $_SESSION['result']="پرداخت شما با موفقیت در سیستم ثبت شد";
                $_SESSION['alert']="success";
               // $GLOBALS['GCMS']->assign('discount_pay', $shop_pay);
               // $GLOBALS['GCMS']->assign('Refnumber' , $Refnumber);
                header("location: /shop_factor/my");
            }
            else
            {
                $_SESSION['result']="خطا در پرداخت ";
                $_SESSION['alert']="danger";
                header("location: /pays/list");
            }

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

            zarinType($price,"پرداخت آنلاین فاکتور شماره ".$id_shop_factor,$id_shop_factor);

        }


    }
    else
        header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}
function zarinType($amount,$txt,$id_shop_factor)
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
    $callBackUrl=$site_url.'/shop_factor/?back=true&id='.rndstring(90).'&orderId='.$orderId.'&amount='.$amount.'&idshfac='.$id_shop_factor;
    $client=new SoapClient('http://www.zarinpal.com/WebserviceGateway/wsdl', array( 'encoding' => 'UTF-8'  ));
    $res=$client->PaymentRequest($merchantID, $amount, $callBackUrl, urlencode($_SESSION["glogin_username"]." ".$txt));
    header('Location: https://www.zarinpal.com/users/pay_invoice/'.$res);
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
    header("location: /shiraz_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function show ($id)
{
    if(isset($_SESSION["glogin_username"]))
    {
        $array_get = array(
            "id"      => $id ,
            "id_user" => $_SESSION["glogin_user_id"],
        );
        $GLOBALS['GCMS']->assign('factor', ShopFactor::get($array_get));
    }else
        header("location: /shiraz_user?redirect=".$_SERVER["REQUEST_URI"]);

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
        header("location: /shiraz_user?redirect=".$_SERVER["REQUEST_URI"]);
}