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

function smarty_function_setFee($params, &$smarty)
{
    //$params['fee']
    $_SESSION['shop_factor_fee'] = $params['fee'];
}
function smarty_function_get_factor_row($params, &$smarty)
{
    //$params['id_shop_factor']
    $GLOBALS['GCMS']->assign('getfactorrow', ShopFcrelpro::get(array(
                "id_shop_factor" => $params['id_shop_factor']
    ),true));
}
function smarty_function_setSessionFeeandDiscount($params, &$smarty)
{
	//$params['fee'] //$params['discount']
	$_SESSION['sumShopFee']     = $params['fee'];
	$_SESSION['sumDiscountFee'] = $params['discount'];
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