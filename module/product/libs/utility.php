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

function smarty_function_find_special_param($params, &$smarty)
{
	//$params['id_product'] $params['id_product_group'] $params['param_tag']
    $GLOBALS['GCMS']->assign('findSpecialParam', RelProParam::get(array("id_product" => $params['id_product'],"id_product_group" =>$params['id_product_group'],"param_tag"=>$params['param_tag']), false, null, "param" ));
}
function smarty_function_getProduct($params, &$smarty)
{
    //$params['id']
    $arr_get=array(
        "id" => $params['id']
    );

    $GLOBALS['GCMS']
        ->assign('getProduct',
            Products::get($arr_get, false));
}
/**
 * 
 * UTILITY
 *
 */


function smarty_function_find_special_model($params, &$smarty)
{
    // $params['modelSearch']
    $GLOBALS['GCMS']->assign('findSpecialModels', Products::get(array("modelSearch" => $params['modelSearch'] , "status" => "publish"),true));
}
