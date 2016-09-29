<?php

/**
 * frontend_poll.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > poll
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
	$last_activ_poll=PollQuestion::get(array("status" => "open"), false,
			array("by" => "id", "sort" => "DESC"));
	if(isset($_GET['poll'])&&$_GET['poll']=="send")
	{
		if(isset($_POST['capcha'])
				&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']))
		{
			$_SESSION['result']="کد تصویری را وارد نکرده‌اید و یا اشتباه وارد کرده‌اید";
			$_SESSION['alert']="alarm";
		}
		else if(isset($_POST['answer']))
		{
			// find dup ip
			$fin_dup=PollResult::get_count(array("ip" => $_SERVER['REMOTE_ADDR']),
					$last_activ_poll->id);
			if($fin_dup!=0)
			{
				$_SESSION['result']="شما یک بار در نظر سنجی شرکت کرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else
			{
				foreach($_POST['answer'] as $answr)
				{
					if(!preg_match('/^[0-9]{1,}$/', $answr))
					{
						$_SESSION['result']="پاسخ شما از طرف سیستم قبول نشد";
						$_SESSION['alert']="alarm";
						break;
					}
					else
					{
						$arr_insert=array(
									"date" => date("Y-m-d H:i:s"),
									"id_answer" => $answr,
									"ip" => $_SERVER['REMOTE_ADDR'],
						);
						if(!PollResult::insert($arr_insert))
						{
							$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
							$_SESSION['alert']="error";
							break;
						}
					}
				}
				$_SESSION['result']="با تشکر از شما، نظر شما با موفقیت ثبت شد";
				$_SESSION['alert']="success";
			}
		}
		else
		{
			$_SESSION['result']="هیچ پاسخی ارسال نشد";
			$_SESSION['alert']="alarm";
		}
		header("location: /poll/");
	}
	$GLOBALS['GCMS']->assign('show_poll', $last_activ_poll);
	$GLOBALS['GCMS']
			->assign('show_poll_answer',
					PollAnswer::get(array("id_question" => $last_activ_poll->id), true));
	
}

function show($id)
{
	$last_activ_poll=PollQuestion::get(array("status" => "open" , "id" =>$id), false,
			array("by" => "id", "sort" => "DESC"));
	if(isset($_GET['poll'])&&$_GET['poll']=="send")
	{
		if(isset($_POST['capcha'])
				&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']))
		{
			$_SESSION['result']="کد تصویری را وارد نکرده‌اید و یا اشتباه وارد کرده‌اید";
			$_SESSION['alert']="alarm";
		}
		else if(isset($_POST['answer']))
		{
			// find dup ip
			$fin_dup=PollResult::get_count(array("ip" => $_SERVER['REMOTE_ADDR']),
					$last_activ_poll->id);
			if($fin_dup!=0)
			{
				$_SESSION['result']="شما یک بار در نظر سنجی شرکت کرده‌اید";
				$_SESSION['alert']="alarm";
			}
			else
			{
				foreach($_POST['answer'] as $answr)
				{
					if(!preg_match('/^[0-9]{1,}$/', $answr))
					{
						$_SESSION['result']="پاسخ شما از طرف سیستم قبول نشد";
						$_SESSION['alert']="alarm";
						break;
					}
					else
					{
						$arr_insert=array(
								"date" => date("Y-m-d H:i:s"),
								"id_answer" => $answr,
								"ip" => $_SERVER['REMOTE_ADDR'],
						);
						if(!PollResult::insert($arr_insert))
						{
							$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
							$_SESSION['alert']="error";
							break;
						}
					}
				}
				$_SESSION['result']="با تشکر از شما، نظر شما با موفقیت ثبت شد";
				$_SESSION['alert']="success";
			}
		}
		else
		{
			$_SESSION['result']="هیچ پاسخی ارسال نشد";
			$_SESSION['alert']="alarm";
		}
		header("location: /poll/show/$id");
	}
	$GLOBALS['GCMS']->assign('show_poll', $last_activ_poll);
	$GLOBALS['GCMS']
	->assign('show_poll_answer',
			PollAnswer::get(array("id_question" => $last_activ_poll->id), true));
}