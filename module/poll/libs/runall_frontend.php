<?php

/**
 * runall_frontend.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file will be excuted before other controllers in frontend section.
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */


$last_activ_poll=PollQuestion::get(array("status" => "open"), false,
		array("by" => "id", "sort" => "DESC"));
$GLOBALS['GCMS']->assign('poll_all', $last_activ_poll);
if(isset($last_activ_poll->id))
	$GLOBALS['GCMS']
	->assign('poll_all_answer',
			PollAnswer::get(array("id_question" => $last_activ_poll->id), true));

$GLOBALS['GCMS']->assign('poll_lists',PollQuestion::get(array("status" => "open"), true, array("by" => "id", "sort" => "ASC")));
