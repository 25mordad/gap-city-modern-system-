<?php

/**
 * PollQuestion.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_poll_question
 * 
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class PollQuestion
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_poll_question` (
						`id`,
						`question`,
						`answer_rel`,
						`status`
						) VALUES(
						NULL ,
						%n,
						%n,
						%n
						)", array($arr['question'], $arr['answer_rel'], $arr['status']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_poll_question` SET
						`id` =  %i
						[ , `question` = %N ]
						[ , `answer_rel` = %N ]
						[ , `status` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['question'],
									$arr['answer_rel'],
									$arr['status'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_poll_question` WHERE TRUE 
						[ AND `id` = %I ]
						[ AND `question` = %N ]
						[ AND `answer_rel` = %N ]
						[ AND `status` = %N ]
						[ AND `status` != %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['question'],
									$arr['answer_rel'],
									$arr['status'],
									$arr['status_not'],
									$order['by'],
									$order['sort']
						));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_poll_question` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `question` = %N ]
						[ AND `answer_rel` = %N ]
						[ AND `status` = %N ]
						[ AND `status` != %N ]
						",
						array(
									$arr['id'],
									$arr['question'],
									$arr['answer_rel'],
									$arr['status'],
									$arr['status_not']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
