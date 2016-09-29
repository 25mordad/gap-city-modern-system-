<?php

/**
 * menu.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > menu
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/utility/selecting.php");

function index()
{
	if(!isset($_GET['parent']))
		header("location: /gadmin/menu/?parent=all");
	$arr_get=array();
	$order=array(
				"by" => "parent",
				"by2" => "order"
	);
	if($_GET['parent']!="all")
		$arr_get['parent']=$_GET['parent'];
	$GLOBALS['GCMS']->assign('menus', Menu::get($arr_get, true, $order));
	$GLOBALS['GCMS']->assign('main_menu', select_main_menu());
}

function new_menu()
{
	if(isset($_POST['title']))
	{
		$arr_insert=array(
					"title" => $_POST['title'],
					"link" => $_POST['link'],
					"order" => $_POST['order'],
					"parent" => $_POST['parent']
		);
		Menu::insert($arr_insert);
		$_SESSION['result']="منوی جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/menu/edit/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('main_menu', select_main_menu());
}

function edit($id)
{
	$menu=Menu::get(array("id" => $id));
	if(isset($id)&&isset($menu))
	{
		if(isset($_POST['title']))
		{
			$arr_update=array(
						"id" => $id,
						"title" => $_POST['title'],
						"link" => $_POST['link'],
						"order" => $_POST['order'],
						"parent" => $_POST['parent']
			);
			Menu::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/menu/edit/".$id);
		}
		$GLOBALS['GCMS']->assign('menu', $menu);
		$GLOBALS['GCMS']->assign('main_menu', select_main_menu());
	}
	else
		header("location: /error404?error=menu&reason=menu_not_exist");
}

function del($id)
{
	$menu=Menu::get(array("id" => $id));
	if(isset($id)&&isset($menu))
	{
		Menu::del($id);

		$_SESSION['result']="منو حذف شد";
		$_SESSION['alert']="success";

		if(!isset($_GET['parent']))
			$_GET['parent']="all";
		header("location: /gadmin/menu/?parent=".$_GET['parent']);
	}
	else
		header("location: /error404?error=menu&reason=menu_not_exist");
}
