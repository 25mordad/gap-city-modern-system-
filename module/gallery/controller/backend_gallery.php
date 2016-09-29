<?php

/**
 * backend_gallery.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > gallery
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
	$arr_get=array(
			"pg_type" => "gallery",
			"pg_status_not" => "delete"
	);
	$order=array(
			"by" => "date_created",
			"sort" => "ASC"
	);
	$GLOBALS['GCMS']->assign('galleries', Page::get($arr_get, true, $order));
}

function new_gallery()
{
	if(isset($_POST['pg_title']))
	{
		$arr_insert=array(
				"pg_type" => "gallery",
				"parent_id" => "0",
				"pg_title" => $_POST['pg_title'],
				"pg_content" => "",
				"pg_excerpt" => "",
				"pg_status" => "pending",
				"comment_status" => "close",
				"pg_order" => "0",
				"author_id" => $_SESSION["userid"],
				"date_created" => date("Y-m-d H:i:s"),
				"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="گالری عکس جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/gallery/edit/".mysql_insert_id());
	}
}

function edit($id)
{
	$gallery=Page::get(array("id" => $id, "pg_type" => "gallery"));
    if (isset($_GET['delImgInx']))
    {
        $findImg=RelImageOther::get(array("id"=>$_GET['delImgInx']),false,null,null);
        RelImageOther::del($_GET['delImgInx']);
        Image::del($findImg->image_id);
        header("location: /gadmin/gallery/edit/".$id."#PicDisplay");
    }
	if(isset($id)&&isset($gallery))
	{
		if(isset($_POST['pg_title']))
		{
			$arr_update=array(
					"id" => $id,
					"pg_title" => $_POST['pg_title'],
					"pg_content" => $_POST['pg_content'],
					"pg_excerpt" => $_POST['pg_excerpt'],
					"pg_status" => $_POST['pg_status'],
					"comment_status" => $_POST['comment_status'],
					"pg_order" => $_POST['pg_order'],
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/gallery/edit/".$id);
		}

		$GLOBALS['GCMS']->assign('operator', Operator::get(array("id" => $gallery->author_id)));
		$GLOBALS['GCMS']->assign('gallery', $gallery);
        $GLOBALS['GCMS']->assign('pageImg', Image::get(array("im_type" => "gallery"), true, array("by" => "id","sort" => "DESC"), $id));
	}
	else
		header("location: /error404?error=gallery&reason=gallery_not_exist");
}

function del($id)
{
	$gallery=Page::get(array("id" => $id, "pg_type" => "gallery"));
	if(isset($id)&&isset($gallery))
	{
		$arr_update=array(
				"id" => $id,
				"pg_status" => "delete",
				"author_id" => $_SESSION["userid"],
				"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="گالری عکس حذف شد";
		$_SESSION['alert']="success";

		header("location: /gadmin/gallery/");
	}
	else
		header("location: /error404?error=gallery&reason=gallery_not_exist");
}

function undel($id)
{
	$gallery=Page::get(array("id" => $id, "pg_type" => "gallery"));
	if(isset($id)&&isset($gallery))
	{
		$arr_update=array(
				"id" => $id,
				"pg_status" => "pending",
				"author_id" => $_SESSION["userid"],
				"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="گالری عکس بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/gallery/edit/".$id);
	}
	else
		header("location: /error404?error=gallery&reason=gallery_not_exist");
}
