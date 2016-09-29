<?php

/**
 * frontend_up.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > up
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/up/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function show($id)
{
	if(isset($_SESSION["glogin_username"]))
	{
		$page=Page::get(array("id" => $id, "pg_type" => "user_page", "pg_status" => "publish"));
		if(isset($id)&&isset($page))
		{
			if($page->comment_status=="open")
			{
				require_once(__COREROOT__."/libs/utility/comment.php");
				if(isset($_GET['comment'])&&$_GET['comment']=="true")
				{
					new_comment($id, "user_page");
					header("location: /up/show/".$id);
					return;
				}
				get_comments($id, "user_page");
			}
			$GLOBALS['GCMS']
			->assign('gcms_page_title',
					$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$page->pg_title);
			$GLOBALS['GCMS']
			->assign('all_parent',
					Page::get(
							array(
									"parent_id" => $id,
									"pg_type" => "user_page",
									"pg_status" => "publish"
							), true, array("by" => "date_created", "sort" => "DESC")));



			$GLOBALS['GCMS']->assign('show_page', $page);

		}
		else
			header("location: /error404?error=up&reason=page_not_exist");
	}else{
		header("location: /user?redirect=".$_SERVER ["REQUEST_URI"]);
	}
}