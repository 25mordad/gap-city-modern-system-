<?php

/**
 * gcms.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Smarty Utility Plugins.
 * Main use: getting contact info
 * Functions may use in tpl files.
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */


function smarty_function_get_redirect($params, &$smarty)
{
    //$params['url']
    $redirect = explode("?redirect=", $params['url']);
	echo $redirect[1];


}
function smarty_function_rndstring($params, &$smarty)
{
     //$params['length']
    $characters="0123456789abcdefghijklmnopqrstuvwxyz";
	$string="";

	for($p=0; $p<$params['length']; $p++)
	{
		$string.=$characters[mt_rand(0, strlen($characters))];
	}
	echo $string;
}

function smarty_function_showmenu($params, &$smarty)
{
	//$params['module']
	$file = __COREROOT__."/module/".$params['module']."/libs/menu.php";
	if(file_exists($file))
		require_once($file);
	
}
function smarty_function_showhelp($params, &$smarty)
{
	//$params['module']
	$file = __COREROOT__."/module/".$params['module']."/libs/help.php";
	if(file_exists($file))
		require_once($file);

}