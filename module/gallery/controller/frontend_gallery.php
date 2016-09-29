<?php

/**
 * frontend_gallery.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > gallery
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/user/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	$GLOBALS['GCMS']
			->assign('gcms_page_title',
					$GLOBALS['GCMS_SETTING']['seo']['title']." | @@PhotoGallery@@");
	$GLOBALS['GCMS']
			->assign('lists_gallery',
					Page::get(array("pg_type" => "gallery", "pg_status" => "publish"), true,
							array("by" => "pg_order", "sort" => "ASC")));
}

function show($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "gallery", "pg_status" => "publish"));
	if(isset($id)&&isset($page))
	{
		if($page->comment_status=="open")
		{
			require_once(__COREROOT__."/libs/utility/comment.php");
			if(isset($_GET['comment'])&&$_GET['comment']=="true")
			{
                if(isset($_POST['capcha'])&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']) )
                {
                    $_SESSION['result'] = "Capcha code error.";
                    $_SESSION['alert'] = "warning";
                    header("location: /gallery/show/".$id);
                }else{
                    new_comment($id, "gallery");
                    header("location: /gallery/show/".$id);
                    return;
                }

			}
			get_comments($id, "gallery");
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
						Image::get(array("im_type" => "gallery"), true,
								array("by" => "id", "sort" => "ASC"), $id));
		$GLOBALS['GCMS']->assign('show_gallery', $page);
	}
	else
		header("location: /error404?error=gallery&reason=gallery_not_exist");
}
