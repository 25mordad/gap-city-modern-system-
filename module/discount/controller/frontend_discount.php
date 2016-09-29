<?php

/**
 * frontend_discount.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > discount
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile=__COREROOT__."/module/discount/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
    $arr_get=array("status"=>"active");
    $today = new DateTime('today');

    if (isset($_GET['g']))
    {
        $arr_get = $arr_get  + array("id_group"=>$_GET['g']);
    }

    if (isset($_GET['e']))
    {
        $today = new DateTime('today');
        $monago = new DateTime('today');
        $monago->modify('-1 month');
        $arr_get = $arr_get  + array("expire_betweenfrom"=>$monago->format('Y/m/d'),"expire_betweento"=>$today->format('Y/m/d'));
    }else{
        if (isset($_GET['d']))
        {
            $tommarow = new DateTime('tomorrow');
            $today = new DateTime('today');
            $arr_get = $arr_get  + array("expire_betweenfrom"=>$today->format('Y/m/d'),"expire_betweento"=>$tommarow->format('Y/m/d'));
        }else
            $arr_get = $arr_get  + array("expire_betweenfrom"=>$today->format('Y/m/d'));
    }
    $order=array(
        "by" => "created_date",
        "sort" => "DESC"
    );

    //assigning variables
    $GLOBALS['GCMS']->assign('discounts', ShirazDiscount::get($arr_get, true, $order));
}

function show($id)
{
	$discount=ShirazDiscount::get(array("id" => $id));
	if(isset($id)&&isset($discount))
	{
        if (isset($_GET['comment']))
        {
            $arr_ins = array(
                "id_discount"   =>   $id,
                "id_user"       =>   $_SESSION["glogin_user_id"],
                "text"          =>   $_POST['text'],
                "created_date"  =>   date("Y-m-d H:i:s"),
            );
            ShirazDiscountComment::insert($arr_ins);
            $_SESSION['result']="با تشکر از شما";
            $_SESSION['alert']="success";
            header("location: /discount/show/$id");
        }
        $discount=ShirazDiscount::get(array("id" => $id));
        $discount_group=ShirazDiscountGroup::get(array("id" => $discount->id_group));
        $images=Image::get(array("im_type" => "discount"), true, null, $id);
        $GLOBALS['GCMS']->assign('discountImages', $images);
        $GLOBALS['GCMS']->assign('discount_group', $discount_group);
        $GLOBALS['GCMS']->assign('discount', $discount);
        $GLOBALS['GCMS']->assign('all_comments', ShirazDiscountComment::get(array(
            "id_discount"=>$id
        ), true));
	}
	else
		header("location: /error404?error=discount&reason=discount_not_exist");
}

function buy($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
        $today = new DateTime('today');
		$discount=ShirazDiscount::get(array("id" => $id ,
            "expire_betweenfrom"=>$today->format('Y-m-d H:i')
        ));

		if(isset($id)&&isset($discount))
		{
            if (isset($_GET['back']) and $discount->max_sell > $_POST['no'])
            {
                $discount_pay=Shirazpay::get(array("id" => $_GET['r']));
                if( false)//$discount_pay->id_user!=$_SESSION["glogin_user_id"] or $discount_pay->amount!=$_GET['fee']  or $_POST['resnumber']!= $_GET['r'] )
                {
                    $_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
                    $_SESSION['alert']="error";
                    header("location: /error404?error=discount&reason=backBank");
                }else {


                    $booking = ShirazBooking::get(array("id"=>$_GET['booking'],"id_discount"=>$id
                    , "id_user" => $_SESSION["glogin_user_id"]));
                    if (count($booking) == 1)
                    {



                        /////////////
                        $MerchantID = '2516902';
                        $Password = '69e5umEFH';

                        $Price = $_GET['fee']; //Price By Toman
                        if(isset($_POST['status']) && $_POST['status'] == 100)
                        {
                            $Status = $_POST['status'];

                            $Refnumber = $_POST['refnumber'];

                            $Resnumber = $_POST['resnumber'];//Your Order ID

                            $client = new SoapClient('http://merchant.parspal.com/WebService.asmx?wsdl');

                            $res = $client->VerifyPayment(array("MerchantID" => $MerchantID , "Password" =>$Password , "Price" =>$Price,"RefNum" =>$Refnumber ));

                            $Status = $res->verifyPaymentResult->ResultStatus;
                            $PayPrice = $res->verifyPaymentResult->PayementedPrice;
                            if($Status == 'success')// Your Peyment Code Only This Event
                            {
                                for ($i=1 ; $i <= $booking->no ; ++$i)
                                {
                                    $couponPass = substr(str_shuffle(md5(time())),0,6);
                                    $arr_insert=array(
                                        "id_user"     => $_SESSION["glogin_user_id"],
                                        "id_discount" => $id,
                                        "coupon_pass" => $couponPass ,
                                        "coupon_no"   => $booking->id*7+$i  ,
                                        "date_sell"   => date("Y-m-d H:i:s")
                                    );
                                    ShirazRelDiscountUser::insert($arr_insert);

                                    //update-plus
                                    $arr_upd = array(
                                        "id"=>$_SESSION["glogin_user_id"],
                                        "plus_count"=>$_SESSION["glogin_user_plus"]+$discount->plus_count,
                                    );
                                    Shiraz_user::update($arr_upd);
                                    $_SESSION["glogin_user_plus"] = $_SESSION["glogin_user_plus"]+$discount->plus_count;
                                    if ($booking->fr_cell != "")
                                    {
                                        //sms send
                                        require_once(__COREROOT__."/libs/utility/sms.php");
                                        $arr_send=array(
                                            "cell" => $booking->fr_cell,
                                            "sms_text" => "
                                            شما یک تخفیف هدیه دریافت کردید
                                         شیراز پلاس
                                         "
                                        );
                                        send_sms($arr_send);
                                        //TODO -send email to fr
                                    }else
                                        ShirazBooking::del($booking->id);

                                    //update-maxsell
                                    $arr_upd = array(
                                        "id"=>$id ,
                                        "max_sell"=> --$discount->max_sell ,
                                    );
                                    ShirazDiscount::update($arr_upd);

                                    //find sms seller
                                    $aag = array(
                                        "id" => $_SESSION["glogin_user_id"]
                                    );
                                    $chk_user=Shiraz_user::get($aag); //cell
                                    //sms send
                                    require_once(__COREROOT__."/libs/utility/sms.php");
                                    $arr_send=array(
                                        "cell" => $chk_user->cell,
                                        "sms_text" => "
                                        خرید با رمز کوپن $couponPass انجام شد
                                         شیراز پلاس
                                         "
                                    );
                                    send_sms($arr_send);
                                    //send email
/*
                                    $email_text="
				        کلمه عبور شما : $n_p
				 		";
                                    $arr_email=array(
                                        "from" => "noreply@".$_SERVER['HTTP_HOST'],
                                        "to" => $_POST['email'],
                                        "subject" => "Register  ".$_SERVER['HTTP_HOST'],
                                        "text" => "<div style=\"direction:rtl;text-align=justify;font-family: \"tahoma\";\" >".$email_text."</div>",
                                        "sign" => ":: این ایمیل به صورت خودکار برای شما ارسال شده است ::",
                                        "URL" => $_SERVER['HTTP_HOST'],
                                    );
                                    $sendmail=new Email();
                                    $sendmail->set("html", true);
                                    $sendmail->getParams($arr_email);
                                    $sendmail->parseBody();
                                    $sendmail->setHeaders();
                                    if (isset($_POST['email']))
                                        $sendmail->send();*/
                                    //end send mail
                                    //TODO -send sms ro shoper
                                    $aag = array(
                                        "id" => $discount->id_user_seller
                                    );
                                    $chk_user=Shiraz_user::get($aag); //cell
                                    //sms send
                                    require_once(__COREROOT__."/libs/utility/sms.php");
                                    $arr_send=array(
                                        "cell" => $chk_user->cell,
                                        "sms_text" => "  باتشکر از خرید شما.
                                        رمز کوپن شما: $couponPass
                                         شیراز پلاس
                                         "
                                    );
                                    send_sms($arr_send);
                                }

                                $arr_update=array(
                                    "id" => $Resnumber,
                                    "bank_info" => $discount_pay->bank_info." | شماره رسید پرداخت : ".$Refnumber,
                                    "pay_status" => "confirm"
                                );
                                Shirazpay::update($arr_update);
                                //TODO send sms and email
                                $_SESSION['result']="پرداخت شما با موفقیت در سیستم ثبت شد";
                                $_SESSION['alert']="success";
                                $GLOBALS['GCMS']->assign('discount_pay', $discount_pay);
                                $GLOBALS['GCMS']->assign('Refnumber' , $Refnumber);
                                header("location: /discount/my_discount");

                            }else{
                                $_SESSION['result']="خطا در پردازش عملیات پرداخت ، نتیجه پرداخت : $Status !";
                                $_SESSION['alert']="error";
                                header("location: /error404?error=discount&reason=$Status");
                            }
                        }else{
                            $arr_update=array(
                                "id" => $_GET['r'],
                                "pay_status" => "cancel"
                            );
                            Shirazpay::update($arr_update);
                            $_SESSION['result']="بازگشت از عمليات پرداخت، خطا در انجام عملیات پرداخت ( پرداخت ناموق ) !";
                            $_SESSION['alert']="error";
                            header("location: /error404?error=discount&reason=unsuccess");
                        }


                    }


                }



            }
            if (isset($_GET['bank']))
            {
                if ($discount->max_sell > $_POST['no'])
                {
                    if (is_int((int) $_POST['no']))
                    {
                        $price = $_POST['no']*($discount->{"real-price"} - ($discount->discount_percent*$discount->{"real-price"}/100));
                        $arr_insert=array(
                            "id_user"     => $_SESSION["glogin_user_id"],
                            "id_discount" => $id,
                            "no"          => $_POST['no'] ,
                            "pay"         => $price ,
                            "date"        => date("Y-m-d H:i:s")
                        );
                        if (isset($_POST['fr_cell']))
                        {
                            $arr_insert = $arr_insert + array(
                                    "fr_email"         => $_POST['fr_email'] ,
                                    "fr_name"          => $_POST['fr_name'] ,
                                    "fr_cell"          => $_POST['fr_cell'] ,
                                );
                        }
                        ShirazBooking::insert($arr_insert);
                        $bookingNumber = mysql_insert_id() ;
                        $arr_insert=array(
                            "id_user" => $_SESSION["glogin_user_id"],
                            "amount" => $price,
                            "txt" => "پرداخت آنلاین با پارس پال",
                            "date" => date("Y-m-d H:i:s"),
                            "bank_info" => "",
                            "status" => "pending"
                        );
                        Shirazpay::insert($arr_insert);
                        $ResNumber = mysql_insert_id() ;

                        $MerchantID = '2516902';
                        $Password = '69e5umEFH';
                        $Price = $price; //Price By Toman
                        $site_url= "http://".$_SERVER['SERVER_NAME'];
                        require_once(__COREROOT__."/libs/utility/hashing.php");
                        $ReturnPath = $site_url.'/discount/buy/'.$id.'?back=true&id='.rndstring(20).'&r='.$ResNumber.'&fee='.$Price.'&booking='.$bookingNumber;
                        $Description = $_POST['pay_text'];
                        $client = new SoapClient('http://merchant.parspal.com/WebService.asmx?wsdl');

                        $arr_get = array ( "id" =>  $_SESSION["glogin_user_id"]);
                        $userSh =  Shiraz_user::get($arr_get);
                        $Paymenter = $userSh->name;
                        $Email = $userSh->email;
                        $Mobile = $userSh->cell;

                        $res = $client->RequestPayment(array("MerchantID" => $MerchantID , "Password" =>$Password , "Price" =>$Price, "ReturnPath" =>$ReturnPath, "ResNumber" =>$ResNumber, "Description" =>$Description, "Paymenter" =>$Paymenter, "Email" =>$Email, "Mobile" =>$Mobile));

                        $PayPath = $res->RequestPaymentResult->PaymentPath;
                        $Status = $res->RequestPaymentResult->ResultStatus;

                        if($Status == 'Succeed')
                            header("location: $PayPath");
                        else
                            header("location: /error404?error=discount&reason=buy_status_$Status");
                        //header("location: /discount/buy/$id?back=true&booking=".mysql_insert_id());
                    }
                }else
                    header("location: /error404?error=discount&reason=error_max_sell");

            }
			$GLOBALS['GCMS']->assign('discount', $discount);
		}
		else
			header("location: /error404?error=discount&reason=discount_not_exist");
	}
	else
		header("location: /shiraz_user?redirect=".$_SERVER["REQUEST_URI"]);
}



function my_discount()
{
    if (isset($_GET['print']))
    {
        $data = ShirazRelDiscountUser::get (array(
            "id"          =>$_GET['id'],
            "id_discount" =>$_GET['idd'],
            "id_user"     =>$_SESSION["glogin_user_id"]
        ));
        if (count($data) == 1)
        {
            $GLOBALS['GCMS']->assign('discount', ShirazDiscount::get(array( "id" => $_GET['idd'])));
            $GLOBALS['GCMS']->assign('data',$data);
        }else
            header("location: /error404?error=discount&reason=my_discount_print");
    }else{
        if(isset($_SESSION["glogin_username"]))
        {
            $GLOBALS['GCMS']->assign('discounts', ShirazRelDiscountUser::get(array("id_user"=>$_SESSION["glogin_user_id"]), true,array(
                "by"=> "date_sell" , "sort"=> "DESC"
            ), NULL, "shiraz_discount"));
        }
        else
            header("location: /shiraz_user?redirect=".$_SERVER["REQUEST_URI"]);
    }

}

function my_deal()
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="seller")
	{
		$GLOBALS['GCMS']->assign('discounts', ShirazDiscount::get(array("id_user_seller"=>$_SESSION["glogin_user_id"]), true));
	}
	else
		header("location: /shiraz_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function my_deal_buyer($id)
{
	if(isset($_SESSION["glogin_username"])&&$_SESSION["glogin_user_level"]=="seller")
	{
		$discount=ShirazDiscount::get(array("id" => $id));
		if(isset($id)&&isset($discount))
		{


			$GLOBALS['GCMS']->assign('discount', $discount);
			$GLOBALS['GCMS']->assign('users', ShirazRelDiscountUser::get(array("id_discount"=>$id), true, NULL, NULL, "shiraz_user"));
		}
		else
			header("location: /error404?error=discount&reason=discount_not_exist");
	}
	else
		header("location: /shiraz_user?redirect=".$_SERVER["REQUEST_URI"]);
}

