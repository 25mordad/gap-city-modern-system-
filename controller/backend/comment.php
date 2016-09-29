<?php

/**
 * comment.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > comment
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function index()
{
	//setting $_GET if not set
	if(!isset($_GET['cm_type']))
		$_GET['cm_type']="all";
	if(!isset($_GET['cm_status']))
		$_GET['cm_status']="all";
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
	{
		$pending_count=Comment::get_count(array("cm_status" => "pending"));
		if($pending_count>0)
		{
			$_SESSION['result']="$pending_count نظر در انتظار تایید ";
			$_SESSION['alert']="warning";
		}
		header(
				"location: /gadmin/comment/?paging=1&search=".$_GET['search']."&cm_type=".$_GET['cm_type']
						."&cm_status=".$_GET['cm_status']);
	}
	//preparing to query
	$max_results=15;
	$arr_get=array(
				"cm_status_not" => "delete"
	);
	$order=array(
				"by" => "cm_date",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//setting filters
	if($_GET['cm_type']!="all")
		$arr_get['cm_type']=$_GET['cm_type'];
	if($_GET['cm_status']!="all")
		$arr_get['cm_status']=$_GET['cm_status'];
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('comments', Comment::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(Comment::get_count($arr_get)/$max_results));
}

function edit($id)
{
	$comment=Comment::get(array("id" => $id));
	if(isset($id)&&isset($comment))
	{
		if(isset($_POST['cm_content']))
		{
			$arr_update=array(
						"id" => $id,
						"cm_content" => stripcslashes($_POST['cm_content']),
						"cm_status" => $_POST['cm_status']
			);
			Comment::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/comment/edit/".$id);
		}
		require_once(__COREROOT__."/libs/ip2location/ip2locationlite.php");
		$ipLite = new ip2location_lite;
		$ipLite->setKey('1d9480f01aa778d21e52c3e8a6d48cc1be49f18a31bb2987bcb54bc7d4c5629e');
		$GLOBALS['GCMS']->assign('countryCode',$ipLite->getCity($comment->cm_ip));
		$GLOBALS['GCMS']->assign('comment', $comment);
	}
	else
		header("location: /error404?error=comment&reason=comment_not_exist");
}

function del($id)
{
	$comment=Comment::get(array("id" => $id, "cm_status_not" => "delete"));
	if(isset($id)&&isset($comment))
	{
		$arr_update=array(
					"id" => $id,
					"cm_status" => "delete"
		);
		Comment::update($arr_update);

		$_SESSION['result']="نظر حذف شد";
		$_SESSION['alert']="success";

		//setting $_GET if not set
		if(!isset($_GET['cm_type']))
			$_GET['cm_type']="all";
		if(!isset($_GET['cm_status']))
			$_GET['cm_status']="all";
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header(
				"location: /gadmin/comment/?paging=".$_GET['paging']."&search=".$_GET['search']."&cm_type="
						.$_GET['cm_type']."&cm_status=".$_GET['cm_status']);
	}
	else
		header("location: /error404?error=comment&reason=comment_not_exist");
}

function undel($id)
{
	$comment=Comment::get(array("id" => $id, "cm_status" => "delete"));
	if(isset($id)&&isset($comment))
	{
		$arr_update=array(
					"id" => $id,
					"cm_status" => "pending"
		);
		Comment::update($arr_update);

		$_SESSION['result']="نظر بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/comment/edit/".$id);
	}
	else
		header("location: /error404?error=comment&reason=comment_not_exist");
}

function confirm($id)
{
	$comment=Comment::get(array("id" => $id, "cm_status" => "pending"));
	if(isset($id)&&isset($comment))
	{
		$arr_update=array(
					"id" => $id,
					"cm_status" => "publish"
		);
		Comment::update($arr_update);

		$_SESSION['result']="نظر تایید شد";
		$_SESSION['alert']="success";

		//setting $_GET if not set
		if(!isset($_GET['cm_type']))
			$_GET['cm_type']="all";
		if(!isset($_GET['cm_status']))
			$_GET['cm_status']="all";
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header(
				"location: /gadmin/comment/?paging=".$_GET['paging']."&search=".$_GET['search']."&cm_type="
						.$_GET['cm_type']."&cm_status=".$_GET['cm_status']);
	}
	else
		header("location: /error404?error=comment&reason=comment_not_exist");
}

function unconfirm($id)
{
	$comment=Comment::get(array("id" => $id, "cm_status" => "publish"));
	if(isset($id)&&isset($comment))
	{
		$arr_update=array(
					"id" => $id,
					"cm_status" => "pending"
		);
		Comment::update($arr_update);

		$_SESSION['result']="نظر از حالت تایید خارج شد";
		$_SESSION['alert']="success";

		//setting $_GET if not set
		if(!isset($_GET['cm_type']))
			$_GET['cm_type']="all";
		if(!isset($_GET['cm_status']))
			$_GET['cm_status']="all";
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header(
				"location: /gadmin/comment/?paging=".$_GET['paging']."&search=".$_GET['search']."&cm_type="
						.$_GET['cm_type']."&cm_status=".$_GET['cm_status']);
	}
	else
		header("location: /error404?error=comment&reason=comment_not_exist");
}
