<?php

/**
 * backend_up.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > up
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/up/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);
require_once(__COREROOT__."/libs/utility/selecting.php");

function index()
{
	//setting $_GET if not set
	if(!isset($_GET['f_status']))
		$_GET['f_status']="all";
	if(!isset($_GET['f_parent']))
		$_GET['f_parent']="all";
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /gadmin/up/?paging=1&search=".$_GET['search']."&f_parent=".$_GET['f_parent']."&f_status="
						.$_GET['f_status']);
	//preparing to query
	$max_results=15;
	$arr_get=array(
				"pg_type" => "user_page",
				"pg_status_not" => "delete"
	);
	$order=array(
				"by" => "date_created",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//setting filters
	if($_GET['f_status']!="all")
		$arr_get['pg_status']=$_GET['f_status'];
	if($_GET['f_parent']!="all")
		$arr_get['parent_id']=$_GET['f_parent'];
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('pages', Page::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));
	$GLOBALS['GCMS']->assign('select_parent', select_page_parental("user_page"));
}

function new_up()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
					"pg_type" => "user_page",
					"parent_id" => $_POST['parent_id'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => stripcslashes($_POST['pg_content']),
					"pg_excerpt" => "12,13,", //mesle ghadim
					"pg_status" => $_POST['pg_status'],
					"comment_status" => $_POST['comment_status'],
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="صفحه کاربر جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/up/edit/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('select_parent', select_page_parental("user_page"));
}

function edit($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "user_page"));
	if(isset($id)&&isset($page))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
					"id" => $id,
					"parent_id" => $_POST['parent_id'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => stripcslashes($_POST['pg_content']),
					"pg_status" => $_POST['pg_status'],
					"comment_status" => $_POST['comment_status'],
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/up/edit/".$id);
		}

		$GLOBALS['GCMS']->assign('operator', Operator::get(array("id" => $page->author_id)));
		$GLOBALS['GCMS']->assign('up', $page);
		$GLOBALS['GCMS']->assign('select_parent', select_page_parental("user_page", $id));
	}
	else
		header("location: /error404?error=up&reason=page_not_exist");

}

function del($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "user_page"));
	if(isset($id)&&isset($page))
	{
		$arr_update=array(
				"id" => $id,
				"pg_status" => "delete",
				"author_id" => $_SESSION["userid"],
				"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="صفحه حذف شد";
		$_SESSION['alert']="success";

		//setting $_GET if not set
		if(!isset($_GET['f_status']))
			$_GET['f_status']="all";
		if(!isset($_GET['f_parent']))
			$_GET['f_parent']="all";
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header(
		"location: /gadmin/up/?paging=".$_GET['paging']."&search=".$_GET['search']."&f_parent="
				.$_GET['f_parent']."&f_status=".$_GET['f_status']);
	}
	else
		header("location: /error404?error=up&reason=page_not_exist");
}

function undel($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "user_page"));
	if(isset($id)&&isset($page))
	{
		$arr_update=array(
				"id" => $id,
				"pg_status" => "pending",
				"author_id" => $_SESSION["userid"],
				"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="صفحه بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/up/edit/".$id);
	}
	else
		header("location: /error404?error=up&reason=page_not_exist");
}
