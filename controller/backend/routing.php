<?php

/**
 * routing.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > routing
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function index()
{
	//just superadmin!
	if($_SESSION["level"]!="10")
		header("location: /error404?error=permission_denied");
	else
	{
		$arr_get=array();
		$order=array(
				"by" => "module",
				"sort" => "ASC"
		);
		$GLOBALS['GCMS']->assign('routs', Routing::get($arr_get, true, $order));
	}
}

function new_routing()
{
	//just superadmin!
	if($_SESSION["level"]!="10")
		header("location: /error404?error=permission_denied");
	else
	{
		if(isset($_POST['submit']))
		{
			$arr_insert=array(
					"url" => $_POST['url'],
					"module" => $_POST['module'],
					"action" => $_POST['action'],
					"action_id" => $_POST['action_id']
			);
			Routing::insert($arr_insert);
			$_SESSION['result']="منوی جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/routing/edit/".mysql_insert_id());
		}
	}
}

function edit($id)
{
	//just superadmin!
	if($_SESSION["level"]!="10")
		header("location: /error404?error=permission_denied");
	else
	{
		$rout=Routing::get(array("id" => $id));
		if(isset($id)&&isset($rout))
		{
			if(isset($_POST['submit']))
			{
				$arr_update=array(
						"id" => $id,
						"url" => $_POST['url'],
						"module" => $_POST['module'],
						"action" => $_POST['action'],
						"action_id" => $_POST['action_id']
				);
				Routing::update($arr_update);
				$_SESSION['result']="ویرایش انجام شد";
				$_SESSION['alert']="success";
				header("location: /gadmin/routing/edit/".$id);
			}
			$GLOBALS['GCMS']->assign('rout', $rout);
		}
		else
			header("location: /error404?error=routing&reason=rout_not_exist");
	}
}

function del($id)
{
	//just superadmin!
	if($_SESSION["level"]!="10")
		header("location: /error404?error=permission_denied");
	else
	{
		$rout=Routing::get(array("id" => $id));
		if(isset($id)&&isset($rout))
		{
			Routing::del($id);
		
			$_SESSION['result']="مسیر حذف شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/routing");
		}
		else
			header("location: /error404?error=routing&reason=rout_not_exist");
	}
}
