<?php

/**
 * frontend_workbook.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > workbook
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/workbook/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	if(isset($_SESSION["glogin_username"]))
	{

		$GLOBALS['GCMS']
				->assign('list_workbook_user',
						Page::get(
								$arr_get=array(
											"pg_type" => "workbook",
											"pg_title" => $_SESSION["glogin_user_id"],
											"pg_status" => "publish"
								), true, array("by" => "date_created", "sort" => "DESC")));
	}
	else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
}
