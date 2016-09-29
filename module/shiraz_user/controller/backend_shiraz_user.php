<?php

/**
 * backend-shiraz_user.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > shiraz_user
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/shiraz_user/libs/utility.php";
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
		header("location: /gadmin/shiraz_user/?paging=1&search=".$_GET['search']."&f_gender=".$_GET['f_gender']."&f_level="
						.$_GET['f_level']);
	//preparing to query
	$max_results=10;
	$arr_get=array();
	$order=array(
			"by" => "plus_count",
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
	$users=Shiraz_user::get($arr_get, true, $order, $limit);
	$GLOBALS['GCMS']->assign('users', $users);
	$GLOBALS['GCMS']->assign('paging', ceil(Shiraz_user::get_count($arr_get)/$max_results));
}

function changelevel($id)
{
	$user=Shiraz_user::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		if($user->level=="member")
		{
			$arr_update=array(
					"id" => $id,
					"level" => "seller"
			);	
			$_SESSION['result']="دسترسی ".$user->username." به فروشنده تغییر کرد";
		}
		else
		{
			$arr_update=array(
					"id" => $id,
					"level" => "member"
			);	
			$_SESSION['result']="دسترسی ".$user->username." به عضو تغییر کرد";
		}
		Shiraz_user::update($arr_update);
		$_SESSION['alert']="success";
		if(!isset($_GET['f_gender']))
			$_GET['f_gender']="all";
		if(!isset($_GET['f_level']))
			$_GET['f_level']="all";
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/shiraz_user/?paging=".$_GET['paging']."&search=".$_GET['search']."&f_gender=".$_GET['f_gender']."&f_level="
							.$_GET['f_level']);
	}
	else
		header("location: /error404?error=shiraz_user&reason=user_not_exist");
}


function show($id)
{
	$user=Shiraz_user::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		$GLOBALS['GCMS']->assign('user', $user);
        $GLOBALS['GCMS']->assign('pays',  Shirazpay::get(array("id_user"=>$id,"status"=>"confirm"),true));
	}
	else
		header("location: /error404?error=shiraz_user&reason=user_not_exist");
}
function pay()
{
    $GLOBALS['GCMS']->assign('pays',  Shirazpay::get(array(),true));
}
