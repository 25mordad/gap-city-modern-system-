<?php

/**
 * backend_pay_mellat.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > pay_mellat
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/pay_mellat/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


function index()
{
	//setting $_GET if not set
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/pay_mellat/?paging=1&search=".$_GET['search']);
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
	//setting search
	$join_param="";
	if($_GET['search']!="NULL")
		$join_param="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('pays', PayMellat::get($arr_get, true, $order, $limit, $join_param));
	$GLOBALS['GCMS']
			->assign('paging', ceil(PayMellat::get_count($arr_get, $join_param)/$max_results));
}

function del($id)
{
	$pay=PayMellat::get(array("id" => $id, "status_not" => "del"));
	if(isset($id)&&isset($pay))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "del"
		);
		PayMellat::update($arr_update);

		$_SESSION['result']="پرداخت حذف شد";
		$_SESSION['alert']="success";

		//setting $_GET if not set
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/pay_mellat/?paging=".$_GET['paging']."&search=".$_GET['search']);
	}
	else
		header("location: /error404?error=pay_mellat&reason=pay_not_exist");
}

function setting()
{
	if(!isset($GLOBALS['GCMS_SETTING']['pay_mellat']))
	{
		Setting::insert(
				array("st_group" => "pay_mellat", "st_key" => "terminal_id", "st_value" => "NULL"));
		Setting::insert(
				array("st_group" => "pay_mellat", "st_key" => "username", "st_value" => "NULL"));
		Setting::insert(
				array("st_group" => "pay_mellat", "st_key" => "password", "st_value" => "NULL"));
		Setting::insert(
				array("st_group" => "pay_mellat", "st_key" => "site_url", "st_value" => "NULL"));
		header("location: /gadmin/pay_mellat/setting");
	}
	if(isset($_POST['submit']))
	{
		$terminal_id=Setting::get(array("st_group" => "pay_mellat", "st_key" => "terminal_id"));
		$username=Setting::get(array("st_group" => "pay_mellat", "st_key" => "username"));
		$password=Setting::get(array("st_group" => "pay_mellat", "st_key" => "password"));
		$site_url=Setting::get(array("st_group" => "pay_mellat", "st_key" => "site_url"));
		Setting::update(array("id" => $terminal_id->id, "st_value" => $_POST['terminal_id']));
		Setting::update(array("id" => $username->id, "st_value" => $_POST['username']));
		Setting::update(array("id" => $password->id, "st_value" => $_POST['password']));
		Setting::update(array("id" => $site_url->id, "st_value" => $_POST['site_url']));
		$_SESSION['result']="ویرایش انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/pay_mellat/setting/");
	}
}
