<?php

/**
 * backend_poll.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > poll
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/poll/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


function index()
{
	$GLOBALS['GCMS']
			->assign('polls',
					PollQuestion::get(array("status_not" => "del"), true,
							array("by" => "id", "sort" => "DESC")));
}

function new_poll()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
					"question" => $_POST['question'],
					"answer_rel" => $_POST['answer_rel'],
					"status" => $_POST['status']
		);
		PollQuestion::insert($arr_insert);
		$_SESSION['result']="نظرسنجی جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/poll/edit/".mysql_insert_id());
	}
}

function edit($id)
{
	$poll=PollQuestion::get(array("id" => $id));
	if(isset($id)&&isset($poll))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
						"id" => $id,
						"question" => $_POST['question'],
						"answer_rel" => $_POST['answer_rel'],
						"status" => $_POST['status']
			);
			PollQuestion::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/poll/edit/".$id);
		}
		$GLOBALS['GCMS']->assign('poll', $poll);
	}
	else
		header("location: /error404?error=poll&reason=poll_not_exist");
}

function show($id)
{
	$poll=PollQuestion::get(array("id" => $id));
	if(isset($id)&&isset($poll))
	{
		$answers=PollAnswer::get(array("id_question" => $id), true);
		foreach($answers as $answer)
		{
			$answer->count=PollResult::get_count(array("id_answer" => $answer->id));
		}
		$GLOBALS['GCMS']->assign('answers', $answers);
		$GLOBALS['GCMS']->assign('poll', $poll);
	}
	else
		header("location: /error404?error=poll&reason=poll_not_exist");
}

function del($id)
{
	$poll=PollQuestion::get(array("id" => $id, "status_not" => "del"));
	if(isset($id)&&isset($poll))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "del"
		);
		PollQuestion::update($arr_update);

		$_SESSION['result']="نظرسنجی حذف شد";
		$_SESSION['alert']="success";

		header("location: /gadmin/poll/");
	}
	else
		header("location: /error404?error=poll&reason=poll_not_exist");
}

function undel($id)
{
	$poll=PollQuestion::get(array("id" => $id, "status" => "del"));
	if(isset($id)&&isset($poll))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "close"
		);
		PollQuestion::update($arr_update);

		$_SESSION['result']="نظرسنجی بازیابی شد";
		$_SESSION['alert']="success";

		header("location: /gadmin/poll/edit/".$id);
	}
	else
		header("location: /error404?error=poll&reason=poll_not_exist");
}
