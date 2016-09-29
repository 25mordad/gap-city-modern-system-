<?php

/**
 * backend_pays.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > pays
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/pays/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


function index()
{
	//setting $_GET if not set
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/pays/?paging=1");
	//preparing to query
	$max_results=10;
	$arr_get=array(
				"status_not" => "del"
	);
	$order=array(
				"by" => "date",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);

	//assigning variables
	$GLOBALS['GCMS']->assign('pays', Pays::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']
			->assign('paging', ceil(Pays::get_count($arr_get)/$max_results));
}


function setting()
{

	if(isset($_POST['merchantID']))
	{
		$merchantID=Setting::get(array("st_group" => "pays", "st_key" => "merchantID"));
		Setting::update(array("id" => $merchantID->id, "st_value" => $_POST['merchantID']));
		$_SESSION['result']="ویرایش انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/pays/setting/");
	}
}
