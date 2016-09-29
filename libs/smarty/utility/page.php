<?php

/**
 * page.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Smarty Utility Plugins.
 * Main use: getting images & their info 
 * Functions may use in tpl page.
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */



function smarty_function_get_page($params, &$smarty)
{
    //$params['id']  
	$arr_get=array(
				"id" => $params['id']
                
	);
	
	$GLOBALS['GCMS']
				->assign('getpage',
						Page::get($arr_get, false));

	
    
}

function smarty_function_get_page_childs($params, &$smarty)
{
    //$params['parent_id']   $params['orderby']      $params['ordersort']      $params['limitstart']      $params['limitend']
    //$params['pg_status']	$params['pg_type']   added by dahdash
	$arr_get=array(
				"parent_id" => $params['parent_id'] ,
                "pg_status" => "publish"
                
	);
	if(isset($params['pg_status']))
		$arr_get['pg_status']=$params['pg_status'];
	if(isset($params['pg_type']))
		$arr_get['pg_type']=$params['pg_type'];
	
	$order=array(
			"by" => $params['orderby'],
			"sort" => $params['ordersort']
	);
	$limit=array(
			"start" => $params['limitstart'],
			"end" => $params['limitend']
	);
	$GLOBALS['GCMS']
				->assign('getpagechilds',
						Page::get($arr_get, true,$order,$limit));

	
    
}
