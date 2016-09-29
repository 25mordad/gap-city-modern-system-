<?php

/**
 * backend_discount.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > discount
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/discount/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//setting $_GET if not set
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/discount/?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=15;
	$arr_get=array();
	$order=array(
				"by" => "created_date",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//setting filters
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('discounts', ShirazDiscount::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(ShirazDiscount::get_count($arr_get)/$max_results));
	$users=Shiraz_user::get(array("level"=>"seller", "status"=>"active"), true);
	foreach($users as $user)
	{
		$result[$user->id]=$user->name." (".$user->username.")";
	}
	$GLOBALS['GCMS']->assign('users', $result);
}

function grouping()
{

	if(isset($_GET['edit']))
	{
		$discount_group=ShirazDiscountGroup::get(array("id" => $_GET['edit']));
		if(isset($discount_group))
			$GLOBALS['GCMS']->assign('discount_group', $discount_group);
	}
	$GLOBALS['GCMS']->assign('groups', ShirazDiscountGroup::get(array(), true));

}

function newgroup()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
					"name" => $_POST['name'],
					"city" => "NULL",
					"status" => $_POST['status'] 
		);
		ShirazDiscountGroup::insert($arr_insert);
		$_SESSION['result']="گروه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/discount/grouping");
	}
}

function editgroup($id)
{
	$discount_group=ShirazDiscountGroup::get(array("id" => $id));
	if(isset($id)&&isset($discount_group))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
						"id" => $id,
						"name" => $_POST['name'],
						"status" => $_POST['status'] 
			);
			ShirazDiscountGroup::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/discount/grouping");
		}
	}
	else
		header("location: /error404?error=discount&reason=group_not_exist");
}

function new_discount()
{
	if(isset($_POST['submit']))
	{

		$expdate=new DateTime($_POST['expire_date']);
		if($_POST['expire_date']!="")
			$expire_date=shamsi_to_miladi($_POST['expire_date'])." ".$expdate->format('H:i:s');
		else
			$expire_date="NULL";
		$arr_insert=array(
				"id_group" => $_POST['id_group'],
				"title" => $_POST['title'],
				"real-price" => $_POST['real-price'],
				"discount_percent" => $_POST['discount_percent'],
				"expire_date" => $expire_date,
				"max_sell" => $_POST['max_sell'],
				"type_delivery" => $_POST['type_delivery'],
				"plus_count" => $_POST['plus_count'],
				"shop_name" => $_POST['shop_name'],
				"shop_address" => $_POST['shop_address'],
				"shop_tell" => $_POST['shop_tell'],
				"shop_cell" => $_POST['shop_cell'],
				"latitude" => $_POST['latitude'],
				"longitude" => $_POST['longitude'],
				"url" => $_POST['url'],
				"shop_specification" => $_POST['shop_specification'],
				"ismoment" => $_POST['ismoment'],
				"text" => $_POST['text'],
				"info" => $_POST['info'],
				"conditions" => $_POST['conditions'],
				"status" => $_POST['status'],
				"id_user_seller" => $_POST['id_user_seller'],
				"created_date" => date("Y-m-d H:i:s"),
				"code" => "NULL"
		);
		ShirazDiscount::insert($arr_insert);
		$_SESSION['result']="تخفیف جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/discount/edit/".mysql_insert_id());
	}
		$GLOBALS['GCMS']->assign('groups', ShirazDiscountGroup::get(array("status"=>"active"), true));
		$GLOBALS['GCMS']->assign('users', Shiraz_user::get(array("level"=>"seller", "status"=>"active"), true));
}

function edit($id)
{
	$discount=ShirazDiscount::get(array("id" => $id));
	if(isset($id)&&isset($discount))
	{
		if(isset($_POST['submit']))
		{
			$expdate=new DateTime($_POST['expire_date']);
			if($_POST['expire_date']!="")
				$expire_date=shamsi_to_miladi($_POST['expire_date'])." ".$expdate->format('H:i:s');
			else
				$expire_date="NULL";
			$arr_update=array(
				"id" => $id,
				"id_group" => $_POST['id_group'],
				"title" => $_POST['title'],
				"real-price" => $_POST['real-price'],
				"discount_percent" => $_POST['discount_percent'],
				"expire_date" => $expire_date,
				"max_sell" => $_POST['max_sell'],
				"type_delivery" => $_POST['type_delivery'],
				"plus_count" => $_POST['plus_count'],
				"shop_name" => $_POST['shop_name'],
				"shop_address" => $_POST['shop_address'],
				"shop_tell" => $_POST['shop_tell'],
				"shop_cell" => $_POST['shop_cell'],
				"latitude" => $_POST['latitude'],
				"longitude" => $_POST['longitude'],
				"url" => $_POST['url'],
				"shop_specification" => $_POST['shop_specification'],
				"ismoment" => $_POST['ismoment'],
				"text" => $_POST['text'],
				"info" => $_POST['info'],
				"conditions" => $_POST['conditions'],
				"status" => $_POST['status'],
				"id_user_seller" => $_POST['id_user_seller']
			);
			ShirazDiscount::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/discount/edit/".$id);
		}

		$GLOBALS['GCMS']->assign('discount', $discount);
		$GLOBALS['GCMS']->assign('groups', ShirazDiscountGroup::get(array("status"=>"active"), true));
		$GLOBALS['GCMS']->assign('users', Shiraz_user::get(array("level"=>"seller", "status"=>"active"), true));
	}
	else
		header("location: /error404?error=discount&reason=discount_not_exist");
}

function users($id)
{
	$discount=ShirazDiscount::get(array("id" => $id));
	if(isset($id)&&isset($discount))
	{
		$GLOBALS['GCMS']->assign('discount', $discount);
		$GLOBALS['GCMS']->assign('users', ShirazRelDiscountUser::get(array("id_discount"=>$id), true, NULL, NULL, "shiraz_user"));
	}
	else
		header("location: /error404?error=discount&reason=discount_not_exist");
}
