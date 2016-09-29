<?php

/**
 * frontend_ppage.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > ppage
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/ppage/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function create()
{
	if(!isset($_SESSION["glogin_username"]) || $_SESSION["glogin_user_level"] != 12)
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
	else
	{
		$ppage = Page::get(array("pg_type" => "private_page", "author_id" => $_SESSION["glogin_user_id"]));
		if ($ppage)
		{
			header("location: /ppage/edit/".$ppage->id);
		}
		else
		{
			$arr_insert = array(
					"pg_type"        => "private_page",
					"parent_id"      => "0",
					"pg_title"       => NULL,
					"pg_content"     => NULL,
					"pg_excerpt"     => NULL,
					"pg_status"      => "publish",
					"comment_status" => "close",
					"author_id"      => $_SESSION["glogin_user_id"],
					"date_created"   => date("Y-m-d H:i:s"),
					"date_modified"  => date("Y-m-d H:i:s"),
			);
			if( Page::insert($arr_insert) )
			{
				$_SESSION['result'] = "صفحه شما ساخته شد";
				$_SESSION['alert'] = "success";
				header("location: /ppage/edit/".mysql_insert_id() );
			}
			else
			{
				$_SESSION['result'] = "error_insert";
				$_SESSION['alert'] = "error";
				header("location: /ppage" );
			}
		}
	}
}

function edit($id)
{
	if(!isset($_SESSION["glogin_username"]) || $_SESSION["glogin_user_level"] != 12)
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
	else
	{
		$GLOBALS['GCMS']->assign('ppage',Page::get(array("id" => $id, "pg_type" => "private_page")));
		if (isset($_POST['edit']))
		{
				$arr_update = array(
						"id"  			 => $id,
						"pg_title"    	 => $_POST['pg_title'],
						"pg_content"     => $_POST['pg_content'],
						"pg_excerpt"     => $_POST['pg_excerpt'],
						"date_modified"  => date("Y-m-d H:i:s")
				);

				Page::update($arr_update);

				$_SESSION['result'] = "صفحه شما به روز شد";
				$_SESSION['alert'] = "success";
				header("location: /ppage/edit/".$id);
		}
	}
}

function show($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "private_page", "pg_status" => "publish"));
	if(isset($id)&&isset($page))
	{
		$GLOBALS['GCMS']
		->assign('gcms_page_title',
				$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$page->pg_title);
		$GLOBALS['GCMS']->assign('show_page', $page);
	}
	else
		header("location: /error404?error=ppage&reason=private_page_not_exist");
}

function showall()
{
	if (!isset($_GET['search']))$_GET['search']="NULL";
	if (!isset($_GET['paging']))header("location: /ppage/showall/?paging=1&search=".$_GET['search']);
	$max_results=15;
	$arr_get=array(
			"pg_type" => "private_page",
			"pg_status" => "publish"
	);
	$order=array(
			"by" => "date_modified",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('ppage_list', Page::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));

}
