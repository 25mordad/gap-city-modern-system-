<?php
/**
 * utility.php
 *
 * This file is part of GCMS > MODULE LIBS
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

/**
 *
 * SMARTY
 *
 */
function smarty_function_get_itakcard($params, &$smarty)
{
	//$params['id']
	$arr_get=array(
			"id" => $params['id']

	);
	$GLOBALS['GCMS']->assign('getitakcard',ItakCard::get($arr_get, false));

}
function smarty_function_get_itakuser($params, &$smarty)
{
	//$params['id']
	$arr_get=array(
			"id" => $params['id']

	);
	$GLOBALS['GCMS']->assign('getitakuser',ItakUser::get($arr_get, false));

}

/**
 *
 * UTILITY
 *
 */

function sms_confirm_code($id_user)
{
	require_once(__COREROOT__."/libs/utility/sms.php");
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$user=ItakUser::get(array("id" => $id_user));
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
		if(ItakUser::update($arr_update))
			return true;
	}
	return false;
}

function email_confirm_code($id_user)
{
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$user=ItakUser::get(array("id" => $id_user));
	$t_c=rndstring(8);
	$email_text="<div style=\"direction:rtl\" >
	برای تایید آدرس ایمیل ، <a href=\"http://$_SERVER[HTTP_HOST]/club/confirm/?email=true&t_c=$t_c\" >اینجا</a> را کلیک کنید و یا کد   <b>$t_c</b>   را در آدرس زیر وارد کنید: <br/>
	http://$_SERVER[HTTP_HOST]/club/confirm/?email=true
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
		if(ItakUser::update($arr_update))
			return true;
	}
	return false;
}

function sms_invitation($id_user, $cell)
{
	require_once(__COREROOT__."/libs/utility/sms.php");
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$user=ItakUser::get(array("id" => $id_user));
	$invite_code=cryptit($id_user);
	$arr_send=array(
			"cell" => $cell,
			"sms_text" => $user->name." شما را به عضویت در کلوب آیتک دعوت کرده است. \r\nکد دعو‌ت‌نامه: ".$invite_code."\r\n".$_SERVER[HTTP_HOST]
	);
	if(send_sms($arr_send))
		return true;
	else
		return false;
}

function email_invitation($id_user, $email)
{
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$user=ItakUser::get(array("id" => $id_user));
	$invite_code=cryptit($id_user);
	$email_text="<div style=\"direction:rtl\" >
	برای ثبت‌نام در کلوب آیتک، <a href=\"http://$_SERVER[HTTP_HOST]/club/register/?invitation=true&code=$invite_code\" >اینجا</a> را کلیک کنید و یا کد   <b>$invite_code</b>   را در آدرس زیر وارد کنید: <br/>
	http://$_SERVER[HTTP_HOST]/club/register/?invitation=true
	<br/></div>
	";
	$arr_email=array(
			"from" => "noreply@".$_SERVER['HTTP_HOST'],
			"to" => $email,
			"subject" => $user->name." شما را به عضویت در کلوب آیتک دعوت کرده است",
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
		return true;
	else
		return false;
}

function sms_group_invitation($id_group, $cell)
{
	require_once(__COREROOT__."/libs/utility/sms.php");
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$group=ItakGroup::get(array("id" => $id_group));
	$user=ItakUser::get(array("id" => $group->id_manager));
	$invite_code=cryptit($id_group);
	$arr_send=array(
			"cell" => $cell,
			"sms_text" => $user->name." شما را به عضویت در گروه ".$group->name." کلوب آیتک دعوت کرده است. \r\nکد عضویت: ".$invite_code."\r\n".$_SERVER[HTTP_HOST]
	);
	if(send_sms($arr_send))
		return true;
	else
		return false;
}

function email_group_invitation($id_group, $email)
{
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$group=ItakGroup::get(array("id" => $id_group));
	$user=ItakUser::get(array("id" => $group->id_manager));
	$invite_code=cryptit($id_group);
	$email_text="<div style=\"direction:rtl\" >
	برای عضویت در گروه $group->name در کلوب آیتک، <a href=\"http://$_SERVER[HTTP_HOST]/club/joingroup/?code=$invite_code\" >اینجا</a> را کلیک کنید و یا کد   <b>$invite_code</b>   را در آدرس زیر وارد کنید: <br/>
	http://$_SERVER[HTTP_HOST]/club/joingroup
	<br/></div>
	";
	$arr_email=array(
			"from" => "noreply@".$_SERVER['HTTP_HOST'],
			"to" => $email,
			"subject" => $user->name." شما را به عضویت در گروه ".$group->name." کلوب آیتک دعوت کرده است",
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
		return true;
	else
		return false;
}
