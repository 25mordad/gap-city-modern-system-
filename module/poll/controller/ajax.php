<?php

/**
 * ajax.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Use: backend > AJAX Functions
 *
 * @author 25mordad <25mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

$controller=$_GET['controller'];
if(function_exists($controller))
{
	$controller();
}

function get_answers()
{
	$answers=PollAnswer::get(array("id_question" => $_POST['id']), true);
	$result="";
	if($answers)
	{
		foreach($answers as $answer)
		{
			$result=$result
			."<input type=\"text\" class=\"answer right\" id=\"$answer->id\" value=\"$answer->answer\" />"
			."<a href=\"javascript:edit_answer($answer->id)\" class=\"del_btn right\" style=\"margin: 5px;\">ویرایش پاسخ</a>"
			."<a href=\"javascript:del_answer($answer->id)\" class=\"del_btn right confirm_del\" style=\"margin: 5px;\">حذف پاسخ</a>"
			."<div class=\"clear\"></div>";
		}
	}
	else
	{
		$result="هیچ پاسخی اضافه نشده است";
	}
	echo $result;
}

function add_answer()
{
	PollAnswer::insert(array("id_question" => $_POST['id'], "answer" => "NULL"));
}

function edit_answer()
{
	PollAnswer::update(array("id" => $_POST['id'], "answer" => $_POST['answer']));
	echo "پاسخ مورد نظر ویرایش شد";
}

function del_answer()
{
	PollAnswer::del($_POST['id']);
	//echo "پاسخ مورد نظر پاک شد";
}