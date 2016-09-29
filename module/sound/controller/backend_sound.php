<?php

/**
 * backend_sound.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > sound
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
	$arr_get=array(
			"pg_type" => "sound",
			"pg_status_not" => "delete"
	);
	$order=array(
			"by" => "date_created",
			"sort" => "ASC"
	);
	$GLOBALS['GCMS']->assign('sounds', Page::get($arr_get, true, $order));
}

function new_sound()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
				"pg_type" => "sound",
				"parent_id" => "0",
				"pg_title" => $_POST['pg_title'],
				"pg_content" => $_POST['pg_content'],
				"pg_excerpt" => $_POST['pg_excerpt'],
				"pg_status" => $_POST['pg_status'],
				"comment_status" => $_POST['comment_status'],
				"author_id" => $_SESSION["userid"],
				"date_created" => date("Y-m-d H:i:s"),
				"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="گالری صوت جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/sound/edit/".mysql_insert_id());
	}
}

function edit($id)
{
	$sound=Page::get(array("id" => $id, "pg_type" => "sound"));
	if(isset($id)&&isset($sound))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
					"id" => $id,
					"pg_title" => $_POST['pg_title'],
					"pg_content" => $_POST['pg_content'],
					"pg_excerpt" => $_POST['pg_excerpt'],
					"pg_status" => $_POST['pg_status'],
					"comment_status" => $_POST['comment_status'],
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/sound/edit/".$id);
		}

		$GLOBALS['GCMS']->assign('operator', Operator::get(array("id" => $sound->author_id)));
		$GLOBALS['GCMS']->assign('sound', $sound);
	}
	else
		header("location: /error404?error=sound&reason=sound_not_exist");
}

function del($id)
{
	$sound=Page::get(array("id" => $id, "pg_type" => "sound"));
	if(isset($id)&&isset($sound))
	{
		$arr_update=array(
				"id" => $id,
				"pg_status" => "delete",
				"author_id" => $_SESSION["userid"],
				"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="گالری صوت حذف شد";
		$_SESSION['alert']="success";

		header("location: /gadmin/sound/");
	}
	else
		header("location: /error404?error=sound&reason=sound_not_exist");
}

function undel($id)
{
	$sound=Page::get(array("id" => $id, "pg_type" => "sound"));
	if(isset($id)&&isset($sound))
	{
		$arr_update=array(
				"id" => $id,
				"pg_status" => "pending",
				"author_id" => $_SESSION["userid"],
				"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="گالری صوت بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/sound/edit/".$id);
	}
	else
		header("location: /error404?error=sound&reason=sound_not_exist");
}
