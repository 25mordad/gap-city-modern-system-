<?php

/**
 * backend_workbook.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > workbook
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/workbook/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

require_once(__COREROOT__."/libs/utility/selecting.php");

function index()
{
	if(isset($_GET['edit']))
	{
		$workbook_title=Page::get(array("id" => $_GET['edit'], "pg_type" => "title_workbook"));
		if(isset($workbook_title))
			$GLOBALS['GCMS']->assign('workbook_title', $workbook_title);
	}
	$GLOBALS['GCMS']
			->assign('titles',
					Page::get(array("pg_type" => "title_workbook", "pg_status" => "publish"), true));
}

function newtitle()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
					"pg_type" => "title_workbook",
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
		$_SESSION['result']="عنوان کارنامه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/workbook/");
	}
}

function edittitle($id)
{
	$workbook_title=Page::get(array("id" => $id, "pg_type" => "title_workbook"));
	if(isset($id)&&isset($workbook_title))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
						"id" => $id,
						"pg_title" => $_POST['pg_title']
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/workbook/");
		}
	}
	else
		header("location: /error404?error=workbook&reason=title_not_exist");

}

function deltitle($id)
{
	$workbook_title=Page::get(array("id" => $id, "pg_type" => "title_workbook"));
	if(isset($id)&&isset($workbook_title))
	{
		if(Page::get_count(array("parent_id" => $id, "pg_status_not" => "delete"))==0)
		{
			$arr_update=array(
						"id" => $id,
						"pg_status" => "delete"
			);
			Page::update($arr_update);
			$_SESSION['result']="عنوان کارنامه حذف شد";
			$_SESSION['alert']="success";
		}
		else
		{
			$_SESSION['result']="عنوان کارنامه به دلیل کارنامه‌های موجود در آن حذف نشد";
			$_SESSION['alert']="error";
		}
		header("location: /gadmin/workbook/");
	}
	else
		header("location: /error404?error=workbook&reason=title_not_exist");
}

function undeltitle($id)
{
	$workbook_title=Page::get(array("id" => $id, "pg_type" => "title_workbook"));
	if(isset($id)&&isset($workbook_title))
	{
		$arr_update=array(
					"id" => $id,
					"pg_status" => "publish"
		);
		Page::update($arr_update);
		$_SESSION['result']="عنوان کارنامه بازیابی شد";
		header("location: /gadmin/workbook/");
	}
	else
		header("location: /error404?error=workbook&reason=title_not_exist");
}

function list_workbook()
{
	//setting $_GET if not set
	if(!isset($_GET['title']))
		$_GET['title']="all";
	if(!isset($_GET['user']))
		$_GET['user']="all";
	if(!isset($_GET['paging']))
		header(
				"location: /gadmin/workbook/list/?paging=1&title=".$_GET['title']."&user="
						.$_GET['user']);
	//preparing to query
	$max_results=15;
	$arr_get=array(
				"pg_type" => "workbook",
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
	if($_GET['title']!="all")
		$arr_get['parent_id']=$_GET['title'];
	if($_GET['user']!="all")
		$arr_get['pg_title']=$_GET['user'];
	//assigning variables
	$GLOBALS['GCMS']->assign('workbooks', Page::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));
	$GLOBALS['GCMS']->assign('select_title', select_page("title_workbook"));
	$GLOBALS['GCMS']->assign('users', select_user());
}

function chart()
{
	if(isset($_GET['id']) & $_GET['id']!="")
	{
		$GLOBALS['GCMS']
				->assign('workbooks',
						Page::get(
								$arr_get=array(
											"pg_type" => "workbook",
											"pg_title" => $_GET['id'],
											"pg_status" => "publish"
								), true,
								array("by" => "date_created", "sort" => "ASC")));
	}
	$GLOBALS['GCMS']->assign('users', select_user());
}

function new_workbook()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
					"pg_type" => "workbook",
					"parent_id" => $_POST['parent_id'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => $_POST['pg_content'],
					"pg_excerpt" => "NULL",
					"pg_status" => "publish",
					"comment_status" => "close",
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s"),
		);
		Page::insert($arr_insert);
		$_SESSION['result']="کارنامه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/workbook/edit/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('select_title', select_page("title_workbook"));
	$GLOBALS['GCMS']->assign('users', select_user());
}

function edit($id)
{
	$workbook=Page::get(array("id" => $id, "pg_type" => "workbook"));
	if(isset($id)&&isset($workbook))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
						"id" => $id,
						"parent_id" => $_POST['parent_id'],
						"pg_title" => $_POST['pg_title'],
						"pg_content" => $_POST['pg_content'],
						"author_id" => $_SESSION["userid"],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/workbook/edit/".$id);
		}
		$GLOBALS['GCMS']->assign('operator', Operator::get(array("id" => $workbook->author_id)));
		$GLOBALS['GCMS']->assign('select_title', select_page("title_workbook"));
		$GLOBALS['GCMS']->assign('users', select_user());
		$GLOBALS['GCMS']->assign('workbook', $workbook);
	}
	else
		header("location: /error404?error=workbook&reason=workbook_not_exist");
}

function del($id)
{
	$workbook=Page::get(array("id" => $id, "pg_type" => "workbook"));
	if(isset($id)&&isset($workbook))
	{
		$arr_update=array(
					"id" => $id,
					"pg_status" => "delete",
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="کارنامه حذف شد";
		$_SESSION['alert']="success";

		//setting $_GET if not set
		if(!isset($_GET['title']))
			$_GET['title']="all";
		if(!isset($_GET['user']))
			$_GET['user']="all";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header(
				"location: /gadmin/workbook/list/?paging=".$_GET['paging']."&title=".$_GET['title']
						."&user=".$_GET['user']);
	}
	else
		header("location: /error404?error=workbook&reason=workbook_not_exist");
}

function undel($id)
{
	$workbook=Page::get(array("id" => $id, "pg_type" => "workbook"));
	if(isset($id)&&isset($workbook))
	{
		if(Page::get_count(
				array(
							"id" => $workbook->parent_id,
							"pg_status_not" => "delete",
							"pg_type" => "title_workbook"
				))==1)
		{

			$arr_update=array(
						"id" => $id,
						"pg_status" => "publish",
						"author_id" => $_SESSION["userid"],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);

			$_SESSION['result']="کارنامه بازیابی شد";
			$_SESSION['alert']="success";
		}
		else
		{
			$_SESSION['result']="کارنامه به دلیل موجود نبودن عنوان کارنامه بازیابی نشد";
			$_SESSION['alert']="error";
		}
		header("location: /gadmin/workbook/edit/".$id);
	}
	else
		header("location: /error404?error=workbook&reason=workbook_not_exist");
}