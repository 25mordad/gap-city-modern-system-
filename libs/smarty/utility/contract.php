<?php

/**
 * contract.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Smarty Utility Plugins.
 * Main use: getting contact info
 * Functions may use in tpl files.
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

function smarty_function_get_contract($params, &$smarty)
{
	$arr_get=array(
			"id" => $params['id']
	);

	$GLOBALS['GCMS']->assign('getcontract',Contract::get($arr_get));
}
function smarty_function_get_domain($params, &$smarty)
{
	$arr_get=array(
			"id_contract" => $params['id_contract']
	);

	$GLOBALS['GCMS']->assign('domains',Domains::get($arr_get,true));
}
