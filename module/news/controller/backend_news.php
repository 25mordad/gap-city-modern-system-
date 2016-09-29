<?php

/**
 * backend_news.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > news
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/news/libs/utility.php";
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
				"location: /gadmin/news/?paging=1&search=".$_GET['search']."&f_parent=".$_GET['f_parent']."&f_status="
						.$_GET['f_status']);
	//preparing to query
	$max_results=15;
	$arr_get=array(
				"pg_type" => "news",
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
	$GLOBALS['GCMS']->assign('news_list', Page::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));
	$GLOBALS['GCMS']->assign('select_group', select_page_parental("news_group"));
}

function listgroup()
{
	$arr_get=array(
			"pg_type" => "news_group",
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
	if(isset($_POST['pg_title']))
	{
		$arr_insert=array(
					"pg_type" => "news_group",
					"parent_id" => $_POST['parent_id'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => "",
					"pg_excerpt" => "NULL",
					"pg_status" => "publish",
					"comment_status" => "close",
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="گروه خبری جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/news/editgroup/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('select_group', select_page_parental("news_group"));
}

function editgroup($id)
{
	$group=Page::get(array("id" => $id, "pg_type" => "news_group"));
    if (isset($_GET['delImgInx']))
    {
        RelImageOther::del($_GET['delImgInx']);
        header("location: /gadmin/news/editgroup/".$id."#PicDisplay");
    }
	if(isset($id)&&isset($group))
	{
		if(isset($_POST['pg_title']))
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
			header("location: /gadmin/news/editgroup/".$id);
		}

		$GLOBALS['GCMS']->assign('news', $group);
		$GLOBALS['GCMS']->assign('select_group', select_page_parental("news_group", $id));
        $GLOBALS['GCMS']->assign('operator', Operator::get(array("id" => $group->author_id)));
        $GLOBALS['GCMS']->assign('pageImg', Image::get(array("im_type" => "newsgroup"), true, array("by" => "id","sort" => "DESC"), $id));
	}
	else
		header("location: /error404?error=news&reason=newsgroup_not_exist");
}

function new_news()
{
	if(isset($_POST['pg_title']))
	{
		$arr_insert=array(
					"pg_type" => "news",
					"parent_id" => $_POST['parent_id'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => "",
					"pg_excerpt" => "",
					"pg_status" => "pending",
					"comment_status" => "close",
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="خبر جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/news/edit/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('select_group', select_page("news_group"));
}

function edit($id)
{
	$news=Page::get(array("id" => $id, "pg_type" => "news"));
    if (isset($_GET['delImgInx']))
    {
        RelImageOther::del($_GET['delImgInx']);
        header("location: /gadmin/news/edit/".$id."#PicDisplay");
    }
	if(isset($id)&&isset($news))
	{
		if(isset($_POST['pg_title']))
		{
			$arr_update=array(
						"id" => $id,
						"parent_id" => $_POST['parent_id'],
						"pg_title" => $_POST['pg_title'],
						"pg_content" => stripcslashes($_POST['pg_content']),
						"pg_excerpt" => $_POST['pg_excerpt'],
						"pg_status" => $_POST['pg_status'],
						"comment_status" => $_POST['comment_status'],
						"author_id" => $_SESSION["userid"],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/news/edit/".$id);
		}

		$GLOBALS['GCMS']->assign('operator', Operator::get(array("id" => $news->author_id)));
		$GLOBALS['GCMS']->assign('news', $news);
		$GLOBALS['GCMS']->assign('select_group', select_page("news_group"));
        $GLOBALS['GCMS']->assign('pageImg', Image::get(array("im_type" => "news"), true, array("by" => "id","sort" => "DESC"), $id));
	}
	else
		header("location: /error404?error=news&reason=news_not_exist");
}

function del($id)
{
	$news=Page::get(array("id" => $id, "pg_type" => "news"));
	if(isset($id)&&isset($news))
	{
		$arr_update=array(
					"id" => $id,
					"pg_status" => "delete",
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="خبر حذف شد";
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
				"location: /gadmin/news/?paging=".$_GET['paging']."&search=".$_GET['search']."&f_parent="
						.$_GET['f_parent']."&f_status=".$_GET['f_status']);
	}
	else
		header("location: /error404?error=news&reason=news_not_exist");
}

function undel($id)
{
	$news=Page::get(array("id" => $id, "pg_type" => "news"));
	if(isset($id)&&isset($news))
	{
		$arr_update=array(
					"id" => $id,
					"pg_status" => "pending",
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="خبر بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/news/edit/".$id);
	}
	else
		header("location: /error404?error=news&reason=news_not_exist");
}
