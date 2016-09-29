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
function smarty_function_get_contact($params, &$smarty)
{
	if(isset($params['cell']))
		$GLOBALS['GCMS']
		->assign('contact',
				Contact::get(array("status" => "active", "cell" => $params['cell'])));
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
}*/