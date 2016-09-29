<?php

/**
 * backend_link.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > link
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/link/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);
require_once(__COREROOT__."/libs/utility/selecting.php");

function index()
{
	if(!isset($_GET['paging']))
		header("location: /gadmin/link/?paging=1");
	//preparing to query
	$max_results=10;
	$arr_get=array(
				"pg_type" => "link",
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
	//assigning variables
	$GLOBALS['GCMS']->assign('link_list', Page::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));
}

function listgroup()
{
	if(isset($_GET['edit']))
	{
		$group_link=Page::get(array("id" => $_GET['edit'], "pg_type" => "group_link"));
		if(isset($group_link))
			$GLOBALS['GCMS']->assign('group_link', $group_link);
	}
	$arr_get=array(
			"pg_type" => "group_link",
			"pg_status_not" => "delete"
	);
	$order=array(
				"by" => "date_created",
				"sort" => "ASC"
	);
	$GLOBALS['GCMS']->assign('groups', Page::get($arr_get, true, $order));
}

function newgroup()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
					"pg_type" => "group_link",
					"parent_id" => "0",
					"pg_title" => $_POST['pg_title'],
					"pg_content" => "NULL",
					"pg_excerpt" => "NULL",
					"pg_status" => "publish",
					"comment_status" => "close",
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="گروه‌پیوند جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/link/listgroup");
	}
}

function editgroup($id)
{
	$group=Page::get(array("id" => $id, "pg_type" => "group_link"));
	if(isset($id)&&isset($group))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
						"id" => $id,
						"pg_title" => $_POST['pg_title'],
						"author_id" => $_SESSION["userid"],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/link/listgroup");
		}
	}
	else
		header("location: /error404?error=link&reason=linkgroup_not_exist");
}

function new_link()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
					"pg_type" => "link",
					"parent_id" => $_POST['parent_id'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => $_POST['pg_content'],
					"pg_excerpt" => $_POST['pg_excerpt'],
					"pg_status" => $_POST['pg_status'],
					"comment_status" => "close",
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="پیوند جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/link/edit/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('select_group', select_page("group_link"));
}

function edit($id)
{
	$link=Page::get(array("id" => $id, "pg_type" => "link"));
	if(isset($id)&&isset($link))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
						"id" => $id,
						"parent_id" => $_POST['parent_id'],
						"pg_title" => $_POST['pg_title'],
						"pg_content" => stripcslashes($_POST['pg_content']),
						"pg_excerpt" => $_POST['pg_excerpt'],
						"pg_status" => $_POST['pg_status'],
						"author_id" => $_SESSION["userid"],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/link/edit/".$id);
		}

		$GLOBALS['GCMS']->assign('operator', Operator::get(array("id" => $link->author_id)));
		$GLOBALS['GCMS']->assign('link', $link);
		$GLOBALS['GCMS']->assign('select_group', select_page("group_link"));
	}
	else
		header("location: /error404?error=link&reason=link_not_exist");
}

function del($id)
{
	$link=Page::get(array("id" => $id, "pg_type" => "link"));
	if(isset($id)&&isset($link))
	{
		$arr_update=array(
					"id" => $id,
					"pg_status" => "delete",
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="پیوند حذف شد";
		$_SESSION['alert']="success";

		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header(
				"location: /gadmin/link/?paging=".$_GET['paging']);
	}
	else
		header("location: /error404?error=link&reason=link_not_exist");
}

function undel($id)
{
	$link=Page::get(array("id" => $id, "pg_type" => "link"));
	if(isset($id)&&isset($link))
	{
		$arr_update=array(
					"id" => $id,
					"pg_status" => "pending",
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="پیوند بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/link/edit/".$id);
	}
	else
		header("location: /error404?error=link&reason=link_not_exist");
}
