<?php
/**
 * utility.php
 *
 * This file is part of GCMS > MODULE LIBS
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

/**
 *
 * SMARTY
 *
 */
function smarty_function_shirazplus_get_user($params, &$smarty)
{
    //$params['id']
    $GLOBALS['GCMS']->assign('shirazplusgetuser',  Shiraz_user::get(array("id" => $params['id'])));
}
/**
 * 
 * UTILITY
 *
 */

function sms_register($username, $cell)
{
	require_once(__COREROOT__."/libs/utility/sms.php");
	require_once(__COREROOT__."/libs/utility/hashing.php");
	$arr_send=array(
			"cell" => $cell,
			"sms_text" => "کاربر گرامی ".$username." \r\nشما در وب سایت ".$_SERVER['HTTP_HOST']." عضو شدید"
	);
	if(send_sms($arr_send))
		return true;
	else
		return false;
}