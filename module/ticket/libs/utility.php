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
function smarty_function_get_ticketprice($params, &$smarty)
{
	//$params['id_ticket'] $params['name']
	$GLOBALS['GCMS']->assign('ticketPrice', Ticketprice::get(array("id_ticket" => $params['id_ticket'],"name" => $params['name'])));
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