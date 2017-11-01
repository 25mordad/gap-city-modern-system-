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
function smarty_function_get_dineroadv($params, &$smarty)
{
	//$params['idadv']
	$GLOBALS['GCMS']->assign('Adv', Dineroadv::get(array("id" => $params['idadv'])));
}
function smarty_function_get_wallet($params, &$smarty)
{
	//$params['id'] @important get wallet by id_user
	$GLOBALS['GCMS']->assign('Wallet', Wallet::get(array("id_user" => $params['id'], "currency" => "Toman")));
}
function smarty_function_get_walletbyid($params, &$smarty)
{
	//$params['id'] @important get wallet by id wallet
	$GLOBALS['GCMS']->assign('Walletbyid', Wallet::get(array("id" => $params['id'], "currency" => "Toman")));
}
/**
 * 
 * UTILITY
 *
 */
/*
function SAMPLE()
{
	//SAMPLE
}
*/