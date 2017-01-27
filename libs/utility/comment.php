<?php

/**
 * comment.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Utility Component.
 * Main use: send & recieve comment
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function new_comment($id_other, $cm_type)
{
	require_once(__COREROOT__."/libs/utility/validating.php");
	/*if(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha'])
	{
		$_SESSION['result']= "Capcha code error.".$_POST['capcha']."-".$_SESSION['gcms_cpcha'];
		$_SESSION['alert']="warning";
	}
	else */ if(trim($_POST['cm_author'])=="")
	{
		$_SESSION['result']="Please enter your Name";
		$_SESSION['alert']="warning";
	}
	else if(trim($_POST['cm_content'])=="")
	{
		$_SESSION['result']="Did not enter any text.";
		$_SESSION['alert']="warning";
	}
	else if(!email_validation($_POST['cm_email']))
	{
		$_SESSION['result']="emailValidation";
		$_SESSION['alert']="warning";
	}
	else
	{
		$arr_insert=array(
					"id_other" => $id_other,
					"cm_type" => $cm_type,
					"id_parent" => 0,
					"cm_author" => $_POST['cm_author'],
					"cm_email" => $_POST['cm_email'],
					"cm_url" => $_POST['cm_url'],
					"cm_ip" => $_SERVER['REMOTE_ADDR'],
					"cm_date" => date("Y-m-d H:i:s"),
					"cm_content" => $_POST['cm_content'],
					"cm_plus" => 0,
					"cm_decrease" => 0,
					"cm_status" => "pending"
		);
		if(Comment::insert($arr_insert))
		{
			$arr_email=array(
						"from" => $_POST['cm_email'],
						"to" => $GLOBALS['GCMS_SETTING']['comment']['email'],
						"subject" => "Comment from ".$_SERVER['HTTP_HOST'],
						"text" => $_POST['cm_content']." <br> Email : ".$_POST['cm_email'],
						"sign" => ":: Automatically Send From GCMS ::",
						"URL" => "URL :: ".$_SERVER['HTTP_HOST'],
			);
			$sendmail=new Email();
			$sendmail->set("html", true);
			$sendmail->getParams($arr_email);
			$sendmail->parseBody();
			$sendmail->setHeaders();
			$sendmail->send();
			$_SESSION['result']="Thank you";
			$_SESSION['alert']="success";
		}
		else
		{
			$_SESSION['result']="Please try again.";
			$_SESSION['alert']="danger";
		}
	}
}

function get_comments($id_other, $cm_type)
{
	if(!isset($_GET['commentpaging']))
		$_GET['commentpaging']=1;
	$max_results=15;
	$arr_get=array(
				"id_other" => $id_other,
				"cm_type" => $cm_type,
				"cm_status" => "publish"
	);
	$order=array(
				"by" => "cm_date",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['commentpaging']*$max_results)-$max_results),
				"end" => $max_results
	);
	$GLOBALS['GCMS']->assign('all_comments', Comment::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('commentpaging', ceil(Comment::get_count($arr_get)/$max_results));
}
