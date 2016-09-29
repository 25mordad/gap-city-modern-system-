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
function smarty_function_get_khodro_user($params, &$smarty)
{
    //$params['id_user']
	$GLOBALS['GCMS']->assign('getkhodrouser',KhodroUser::get(array("id" => $params['id_user'])));


}

function smarty_function_get_brand($params, &$smarty)
{
    //param list :: $params['id_brand'] , 
	$GLOBALS['GCMS']->assign('getbrand',KhodroBrand::get(array("id" => $params['id_brand'])));
}

function smarty_function_get_model($params, &$smarty)
{
    //param list :: $params['id_model'] , 
	$GLOBALS['GCMS']->assign('getmodel',KhodroModel::get(array("id" => $params['id_model'])));
}

function smarty_function_get_tip($params, &$smarty)
{
    //param list :: $params['id_tip'] , 
	$GLOBALS['GCMS']->assign('gettip',KhodroTip::get(array("id" => $params['id_tip'])));
}


function smarty_function_get_tips($params, &$smarty)
{
    //param list :: $params['id_model'] , $params['brand'] , $params['tip_status'] 
	$GLOBALS['GCMS']->assign('gettips',KhodroTip::get(array(
    "id_model"   => $params['id_model'],
    "id_brand"   => $params['id_brand'],
    "tip_status" => $params['tip_status']
    ),true));
}

/**
 * 
 * UTILITY
 *
 */

/* function SAMPLE()
{
	//SAMPLE
} */