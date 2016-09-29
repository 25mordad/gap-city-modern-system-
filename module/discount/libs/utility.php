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

function smarty_function_get_shiraz_user($params, &$smarty)
{
	//$params['id']
    $GLOBALS['GCMS']->assign('getshirazuser', Shiraz_user::get(array(
        "id"=>$params['id']
    )));
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