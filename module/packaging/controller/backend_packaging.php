<?php

/**
 * backend_packaging.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > SAMPLE
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/packaging/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	
	$arr_get_user=array(
			"user_level" => "53"
	);
	$order_user=array(
			"by" => "username",
	
	);
	$users= User::get($arr_get_user, true, $order_user);
	foreach($users as $user)
	{
		$par1=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		next($GLOBALS['GCMS_USER_PARAM']);
	
		prev($GLOBALS['GCMS_USER_PARAM']);
		$user->params="";
		if(isset($par1))
			$user->params=$user->params.$par1->value;
	
	
	}
	$GLOBALS['GCMS']->assign('users', $users);
	
	
	if(isset($_GET['edit']))
	{
		if(isset($_POST['pg_title']))
		{
			$arr_update=array(
					"id" => $_GET['edit'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => $_POST['pg_content'],
					"date_modified" => $_POST['date_modified']
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/packaging/?edit=".$_GET['edit']);
		}
		$arr_get=array(
				"id" => $_GET['edit'],
		);
		$GLOBALS['GCMS']->assign('bag', Page::get($arr_get));
	}
	
	$arr_get=array(
			"pg_type" => "packaging"
	);
	
	$GLOBALS['GCMS']->assign('packs', Page::get($arr_get, true,array("by"=>'pg_order',"sort"=>'ASC')));
}

function new_packaging()
{
	if(isset($_POST['pg_title']) && $_POST['pg_title'] != "" )
	{
		$arr_insert=array(
				"pg_type" => "packaging",
				"parent_id" => 0,
				"pg_title" => $_POST['pg_title'],
				"pg_content" => $_POST['pg_content'],
				"pg_excerpt" => null,
				"pg_status" => "pending",
				"comment_status" => NULL,
				"pg_order" => "0",
				"author_id" => $_SESSION["userid"],
				"date_created" => date("Y-m-d H:i:s"),
				"date_modified" => $_POST['date_modified']
		);
		Page::insert($arr_insert);
		$_SESSION['result']="گروه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/packaging");
	}else {
		header("location: /gadmin/packaging");
	}
}

function products()
{
	$packing =Page::get(array("id" => $id, "pg_type" => "packaging"));
	$GLOBALS['GCMS']->assign('packing', $packing);
}


