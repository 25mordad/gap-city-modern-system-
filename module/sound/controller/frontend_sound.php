<?php

/**
 * frontend_sound.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > sound
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/sound/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


function index()
{
	$GLOBALS['GCMS']
	->assign('gcms_page_title',
			$GLOBALS['GCMS_SETTING']['seo']['title']." | @@sound@@");
	$GLOBALS['GCMS']
	->assign('lists_sound',
			Page::get(array("pg_type" => "sound", "pg_status" => "publish"), true,
					array("by" => "date_created", "sort" => "DESC")));
}

function show($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "sound", "pg_status" => "publish"));
	if(isset($id)&&isset($page))
	{
		if($page->comment_status=="open")
		{
			require_once(__COREROOT__."/libs/utility/comment.php");
			if(isset($_GET['comment'])&&$_GET['comment']=="true")
			{
				new_comment($id, "sound");
				header("location: /sound/show/".$id);
				return;
			}
			get_comments($id, "sound");
		}
		$GLOBALS['GCMS']
		->assign('gcms_page_title',
				$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$page->pg_title);
		$GLOBALS['GCMS']
		->assign('allkeywords',
				Keyword::get(NULL, true, array("by" => "rel_id", "sort" => "ASC"), NULL,
						$id));
		$GLOBALS['GCMS']
		->assign('allimages',
				Image::get(array("im_type" => "sound"), true,
						array("by" => "id", "sort" => "ASC"), $id));
		$GLOBALS['GCMS']->assign('show_sound', $page);
	}
	else
		header("location: /error404?error=sound&reason=sound_not_exist");
}
