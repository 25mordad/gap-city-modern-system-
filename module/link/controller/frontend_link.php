<?php

/**
 * frontend_link.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > link
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */
$utilityfile = __COREROOT__."/module/link/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	$GLOBALS['GCMS']
	->assign('gcms_page_title',
			$GLOBALS['GCMS_SETTING']['seo']['title']." | @@Links@@");
	$GLOBALS['GCMS']
		->assign('lists_link_title',
			Page::get(array("pg_type" => "group_link", "pg_status" => "publish"), true,
					array("by" => "date_created", "sort" => "DESC")));
}