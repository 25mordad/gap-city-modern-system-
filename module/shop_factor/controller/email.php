<?php
require_once(__COREROOT__."/module/user/controller/emailTemplate.php");
$array_get = array(
		"id"      =>$_GET['sfid'],
		"id_user" => $_SESSION["glogin_user_id"],
);
$factor = ShopFactor::get($array_get);
$id = $factor->id;
$no = $factor->id*1234+567;
$http = $_SERVER['HTTP_HOST'];

$bodyStatus = '
				<div>
                          <h1 style="color:green"> از خرید شما سپاسگزاریم </h1>
                        </div>	
					';

$bodyInfo='
<div style="direction:rtl;text-align:right;font:tahoma" >
 
<h4>
	'.jdate("j F y",strtotime($factor->date)).' <br>	
		شماره فاکتور خرید شما 
                     <a href="'.$http.'/shop_factor/show/'.$id.'">
		'. $no .'#
		</a> 
                     است. همچنین ارسال بسته به آدرس شما، از طریق پیامک و ایمیل به اطلاع شما می‌رسد.
                    </h4>	
				
</div>
					';
$bodyTransaction= '
					
					';

//send to client
sendEmailWithPhpmailer(
		emailTemp($bodyStatus,$bodyInfo,$bodyTransaction),
		"خرید موفق - ".$GLOBALS['GCMS_SETTING']['seo']['title'],$_SERVER['HTTP_HOST'],
		$GLOBALS['GCMS_SETTING']['general']['emaillogin'],$GLOBALS['GCMS_SETTING']['general']['hostmail'],
		$GLOBALS['GCMS_SETTING']['general']['emaillogin'],$GLOBALS['GCMS_SETTING']['general']['emailpassword'],
		$_SESSION["glogin_email"]);

//send to client
sendEmailWithPhpmailer(
		emailTemp($bodyStatus,$bodyInfo,$bodyTransaction),
		" خرید در  ".$GLOBALS['GCMS_SETTING']['seo']['title'],$_SERVER['HTTP_HOST'],
		$GLOBALS['GCMS_SETTING']['general']['emaillogin'],$GLOBALS['GCMS_SETTING']['general']['hostmail'],
		$GLOBALS['GCMS_SETTING']['general']['emaillogin'],$GLOBALS['GCMS_SETTING']['general']['emailpassword'],
		$GLOBALS['GCMS_SETTING']['general']['email']);



function sendEmailWithPhpmailer($body,$subject,$title,$from,$host,$userName,$password,$toEmail)
{
	$to= $title;
	$from= $from;
	$mail= new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth=true;
	$mail->Host       = $host;
	$mail->Username= $userName;
	$mail->Password= $password;
	$mail->AddAddress($toEmail,$toEmail );
	$mail->SetFrom($from, $name);
	$mail->AddReplyTo($from, $name);
	$mail->Subject    = $subject;
	$mail->IsHTML(true);
	$mail->MsgHTML($body);
	$mail->AltBody= $text_form;
	$mail->Send();
}

