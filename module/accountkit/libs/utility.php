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
function smarty_function_get_accountkitparam($params, &$smarty)
{
	//$params['iduser'] $params['type']
	$row   = Acountkitparam::get(array("iduser" => $params['iduser'], "type" => $params['type']));
	return $row->text;
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