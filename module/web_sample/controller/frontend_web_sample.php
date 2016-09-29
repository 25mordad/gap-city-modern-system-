<?php

/**
 * frontend_web_sample.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > web_sample
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/web_sample/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	if(!isset($_GET['paging']))
		header(
				"location: /web_sample/?paging=1");
	//preparing to query
	$max_results=10;
    
    $arr_get=array(
			
	);
 	$order=array(
			"by" => "active_date",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
   
	$GLOBALS['GCMS']->assign('lists_sample',WebSample::get($arr_get,true,$order,$limit)); 
    $GLOBALS['GCMS']->assign('count_lists_sample',WebSample::get_count($arr_get)); 
    $GLOBALS['GCMS']->assign('paging', ceil(WebSample::get_count($arr_get)/$max_results));
}