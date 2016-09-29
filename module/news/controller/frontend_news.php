<?php

/**
 * frontend_news.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > news
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */
$utilityfile = __COREROOT__."/module/news/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

$GLOBALS['GCMS']
		->assign('lists_news_group',
				Page::get(
						array(
									"pg_type" => "news_group",
									"pg_status" => "publish",
									"parent_id" => "0"
						), true));

function index()
{
	$GLOBALS['GCMS']
			->assign('inx_last_news',
					Page::get(array("pg_type" => "news", "pg_status" => "publish"), true,
							array("by" => "date_created", "sort" => "DESC"),
							array("start" => "0", "end" => "30")));
}

function show($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "news", "pg_status" => "publish"));
	if(isset($id)&&isset($page))
	{
		if($page->comment_status=="open")
		{
			require_once(__COREROOT__."/libs/utility/comment.php");
			if(isset($_GET['comment'])&&$_GET['comment']=="true")
			{
				new_comment($id, "news");
				header("location: /news/show/".$id);
				return;
			}
			get_comments($id, "news");
		}
		$GLOBALS['GCMS']
				->assign('gcms_page_title',
						$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$page->pg_title);
		$GLOBALS['GCMS']
				->assign('allkeywords',
						Keyword::get(NULL, true, array("by" => "rel_id", "sort" => "ASC"), NULL,
								$id));
		$GLOBALS['GCMS']->assign('show_page', $page);
	}
	else
		header("location: /error404?error=news&reason=news_not_exist");
}

function groupshow($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "news_group", "pg_status" => "publish"));
	if(isset($id)&&isset($page))
	{
		$GLOBALS['GCMS']
				->assign('gcms_page_title',
						$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$page->pg_title);
		$GLOBALS['GCMS']
				->assign('all_parent',
						Page::get(
								array(
											"parent_id" => $id,
											"pg_type" => "news",
											"pg_status" => "publish"
								), true, array("by" => "date_created", "sort" => "DESC")));

		$GLOBALS['GCMS']
				->assign('child_news_groups',
						Page::get(
								array(
											"parent_id" => $id,
											"pg_type" => "news_group",
											"pg_status" => "publish"
								), true, array("by" => "date_created", "sort" => "DESC")));
		$GLOBALS['GCMS']->assign('show_page', $page);
	}
	else
		header("location: /error404?error=news&reason=news_group_not_exist");
}
