<?php

/**
 * box.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > box
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/utility/selecting.php");

function index()
{
    $GLOBALS['GCMS']->assign('boxes', Box::get(null, true));
}
function new_box()
{
	if(isset($_POST['box_title']))
	{
		$arr_insert=array(
					"box_title" => $_POST['box_title'],
					"parent_id" => $_POST['parent_id'],
					"box_status" => "pending"
		);

		$lId = Box::insert($arr_insert);
		$_SESSION['result']="باکس جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/box/edit/".$lId);
	}
	$GLOBALS['GCMS']->assign('select_parent', select_page());
}

function edit($id)
{
    if (isset($_GET['delImgInx']))
    {
        RelImageOther::del($_GET['delImgInx']);
        header("location: /gadmin/box/edit/".$id."#PicDisplay");
    }

	$box=Box::get(array("id" => $id));
	if(isset($_POST['box_title']))
	{
		$arr_update=array(
					"id" => $id,
					"class_name" => $_POST['class_name'],
					"box_title" => $_POST['box_title'],
					"box_content" => stripcslashes($_POST['box_content']),
					"parent_id" => $_POST['parent_id'],
					"box_status" => $_POST['box_status']
		);

		Box::update($arr_update);
		$_SESSION['result']="ویرایش انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/box/edit/$id");
	}
	$GLOBALS['GCMS']->assign('boxes', Box::get(array("id_not" => $id, "parent_id" => $box->parent_id), true));
	$GLOBALS['GCMS']->assign('box', $box);
	$GLOBALS['GCMS']->assign('select_parent', select_page());

    //find all img
    $arr_get=array(
        "im_type" => "box"
    );
    $order=array(
        "by" => "id",
        "sort" => "DESC"
    );

    $GLOBALS['GCMS']->assign('pageImg', Image::get($arr_get, true, $order, $id));

}
