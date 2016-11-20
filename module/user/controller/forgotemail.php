<?php
require_once(__COREROOT__."/module/user/controller/emailTemplate.php");


$bodyStatus = '
					
					';

$bodyInfo="
<div style='direction:rtl;text-align:right;font:tahoma' >
برای رسیدن به کلمه عبور جدید ، <a href=\"http://$_SERVER[HTTP_HOST]/user/forgot?email=$chk_user->email&t_c=$t_c\" >اینجا</a> را کلیک کنید و یا لینک زیر را دنبال کنید : <br/>
						http://$_SERVER[HTTP_HOST]/user/forgot?email=$chk_user->email&t_c=$t_c
						<br/>
</div>
					";
$bodyTransaction= '
					
					';

//send to client
sendEmailWithPhpmailer(
		emailTemp($bodyStatus,$bodyInfo,$bodyTransaction),
		" تغییر کلمه‌عبور  ".$GLOBALS['GCMS_SETTING']['seo']['title'],$_SERVER['HTTP_HOST'],
		$GLOBALS['GCMS_SETTING']['general']['emaillogin'],$GLOBALS['GCMS_SETTING']['general']['hostmail'],
		$GLOBALS['GCMS_SETTING']['general']['emaillogin'],$GLOBALS['GCMS_SETTING']['general']['emailpassword'],
		$chk_user->email);

//send to client
sendEmailWithPhpmailer(
		emailTemp($bodyStatus,$bodyInfo,$bodyTransaction),
		" تغییر کلمه‌عبور  ".$GLOBALS['GCMS_SETTING']['seo']['title']."  .",$_SERVER['HTTP_HOST'],
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

