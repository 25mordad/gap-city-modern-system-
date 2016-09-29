<?php

/**
 * backend_advancemenu.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > advancemenu
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/advancemenu/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

require_once(__COREROOT__."/libs/utility/selecting.php");

function index()
{
	if(!isset($_GET['parent']))
		header("location: /gadmin/advancemenu/?parent=all");
	$arr_get=array();
	$order=array(
				"by" => "group",
				"sort" => "DESC",
				"by2" => "parent",
				"by3" => "order"
	);
	if($_GET['parent']!="all")
		$arr_get['parent']=$_GET['parent'];
	$GLOBALS['GCMS']->assign('menus', AdvanceMenu::get($arr_get, true, $order));
	$GLOBALS['GCMS']->assign('main_menu', select_advance_menu());
}

function new_advancemenu()
{
	if(isset($_POST['submit']))
	{
		if($_POST['parent']!=0)
		{
			$parent=AdvanceMenu::get(array("id"=>$_POST['parent']));
			if($parent->group!=$_POST['group'])
			{
				$_SESSION['result']="گروه منوی مادر با گروه انتخابی یکسان نیست";
				$_SESSION['alert']="error";
				header("location: /gadmin/advancemenu/new");
				return;
			}
		}
		$arr_insert=array(
					"title" => $_POST['title'],
					"group" => $_POST['group'],
					"link" => $_POST['link'],
					"order" => $_POST['order'],
					"parent" => $_POST['parent']
		);
		AdvanceMenu::insert($arr_insert);
		$_SESSION['result']="منوی جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/advancemenu/edit/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('main_menu', select_advance_menu());
}

function edit($id)
{
	$menu=AdvanceMenu::get(array("id" => $id));
	if(isset($id)&&isset($menu))
	{
		if($_POST['parent']!=0)
		{
			if($_POST['parent']==$id)
			{
				$_SESSION['result']="منوی مادر نمی‌تواند خود منو باشد";
				$_SESSION['alert']="error";
				header("location: /gadmin/advancemenu/edit/".$id);
				return;
			}
			$parent=AdvanceMenu::get(array("id"=>$_POST['parent']));
			if($parent->group!=$_POST['group'])
			{
				$_SESSION['result']="گروه منوی مادر با گروه انتخابی یکسان نیست";
				$_SESSION['alert']="error";
				header("location: /gadmin/advancemenu/edit/".$id);
				return;
			}
		}
		if(isset($_POST['submit']))
		{
			$arr_update=array(
						"id" => $id,
						"title" => $_POST['title'],
						"group" => $_POST['group'],
						"link" => $_POST['link'],
						"order" => $_POST['order'],
						"parent" => $_POST['parent']
			);
			AdvanceMenu::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/advancemenu/edit/".$id);
		}
		$GLOBALS['GCMS']->assign('menu', $menu);
		$GLOBALS['GCMS']->assign('main_menu', select_advance_menu());
	}
	else
		header("location: /error404?error=advancemenu&reason=advancemenu_not_exist");
}

function del($id)
{
	$menu=AdvanceMenu::get(array("id" => $id));
	if(isset($id)&&isset($menu))
	{
		AdvanceMenu::del($id);

		$_SESSION['result']="منو حذف شد";
		$_SESSION['alert']="success";

		if(!isset($_GET['parent']))
			$_GET['parent']="all";
		header("location: /gadmin/advancemenu/?parent=".$_GET['parent']);
	}
	else
		header("location: /error404?error=advancemenu&reason=advancemenu_not_exist");
}