<?php

/**
 * salamatuser.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Utility Component.
 * Main use: salamatuser functions
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function sms_confirm_code($id_user)
{
	require_once(__COREROOT__."/libs/utility/sms.php");
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$user=SalamatUser::get(array("id" => $id_user));
	$t_c=rndstring(4);
	$arr_send=array(
				"cell" => $user->cell,
				"sms_text" => "کد تایید: ".$t_c
	);
	if(send_sms($arr_send))
	{
		$arr_update=array(
					"id" => $user->id,
					"cell_temp_code" => $t_c
		);
		if($user->status=="valid")
			$arr_update['status']="email_valid";
		if($user->status=="cell_valid")
			$arr_update['status']="invalid";
		if(SalamatUser::update($arr_update))
			return true;
	}
	return false;
}

function email_confirm_code($id_user)
{
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$user=SalamatUser::get(array("id" => $id_user));
	$t_c=rndstring(8);
	$email_text="<div style=\"direction:rtl\" >
	برای تایید آدرس ایمیل ، <a href=\"http://$_SERVER[HTTP_HOST]/salamatuser/confirm/?email=true&t_c=$t_c\" >اینجا</a> را کلیک کنید و یا کد   <b>$t_c</b>   را در آدرس زیر وارد کنید: <br/>
	http://$_SERVER[HTTP_HOST]/salamatuser/confirm/?email=true
	<br/></div>
	";
	$arr_email=array(
				"from" => "noreply@".$_SERVER['HTTP_HOST'],
				"to" => $user->email,
				"subject" => $_SERVER['HTTP_HOST'].":: Confirm Email Address",
				"text" => $email_text,
				"sign" => ":: این ایمیل به صورت خودکار برای شما ارسال شده است ::",
				"URL" => $_SERVER['HTTP_HOST'],
	);
	$sendmail=new Email();
	$sendmail->set("html", true);
	$sendmail->getParams($arr_email);
	$sendmail->parseBody();
	$sendmail->setHeaders();
	if($sendmail->send())
	{
		$arr_update=array(
					"id" => $user->id,
					"email_temp_code" => $t_c
		);
		if($user->status=="valid")
			$arr_update['status']="cell_valid";
		if($user->status=="email_valid")
			$arr_update['status']="invalid";
		if(SalamatUser::update($arr_update))
			return true;
	}
	return false;
}