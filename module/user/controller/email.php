<?php
require_once(__COREROOT__."/module/user/controller/emailTemplate.php");


$bodyStatus = '
					
					';

$bodyInfo="
<div style='direction:rtl;text-align:right;font:tahoma' >
کاربر گرامی ".$_POST['email']
." <br />
شما    در وب سایت ". $GLOBALS['GCMS_SETTING']['seo']['title']
. " "
. "http://".$_SERVER['HTTP_HOST']
." عضو شدید <br />
		شما می توانید از طریق اطلاعات  زیر وارد پروفایل کاربری خود شوید . <br />
		آدرس ورود به کنترل پنل : " ."http://".$_SERVER['HTTP_HOST']
		."/user <br />
				نام کاربری : ".$_POST['username']
		."<br />

				با تشکر

</div>
					";
$bodyTransaction= '
					
					';

//send to client
sendEmailWithPhpmailer(
		emailTemp($bodyStatus,$bodyInfo,$bodyTransaction),
		"به وب سایت ".$GLOBALS['GCMS_SETTING']['seo']['title']." خوش آمدید.",$_SERVER['HTTP_HOST'],
		$GLOBALS['GCMS_SETTING']['general']['emaillogin'],$GLOBALS['GCMS_SETTING']['general']['hostmail'],
		$GLOBALS['GCMS_SETTING']['general']['emaillogin'],$GLOBALS['GCMS_SETTING']['general']['emailpassword'],
		$_POST['email']);

//send to client
sendEmailWithPhpmailer(
		emailTemp($bodyStatus,$bodyInfo,$bodyTransaction),
		" کاربر جدید  ".$GLOBALS['GCMS_SETTING']['seo']['title']."  .",$_SERVER['HTTP_HOST'],
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

