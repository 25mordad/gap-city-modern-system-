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
function smarty_function_get_advancemenu_children($params, &$smarty)
{
	$arr_get=array(
			"parent" => $params['id']
	);
	$order=array(
			"by" => "order"
	);
	$GLOBALS['GCMS']->assign('advancemenu_children', AdvanceMenu::get($arr_get, true, $order));
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