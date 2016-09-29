<?php

/**
 * backend-sarfejo_user.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > sarfejo_user
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/sarfejo_user/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//setting $_GET if not set
	if(!isset($_GET['f_gender']))
		$_GET['f_gender']="all";
	if(!isset($_GET['f_level']))
		$_GET['f_level']="all";
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/sarfejo_user/?paging=1&search=".$_GET['search']."&f_gender=".$_GET['f_gender']."&f_level="
						.$_GET['f_level']);
	//preparing to query
	$max_results=10;
	$arr_get=array();
	$order=array(
			"by" => "created_date",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	//setting filters
	if($_GET['f_gender']!="all")
		$arr_get['gender']=$_GET['f_gender'];
	if($_GET['f_level']!="all")
		$arr_get['level']=$_GET['f_level'];
	//setting search
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$users=Sarfejo_user::get($arr_get, true, $order, $limit);
	$GLOBALS['GCMS']->assign('users', $users);
	$GLOBALS['GCMS']->assign('paging', ceil(Sarfejo_user::get_count($arr_get)/$max_results));
}

function show($id)
{
	$user=Sarfejo_user::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		$GLOBALS['GCMS']->assign('user', $user);
	}
	else
		header("location: /error404?error=sarfejo_user&reason=user_not_exist");
}