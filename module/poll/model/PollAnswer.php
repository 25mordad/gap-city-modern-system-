<?php

/**
 * PollAnswer.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_poll_answer
 * 
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class PollAnswer
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_poll_answer` (
						`id`,
						`id_question`,
						`answer`
						) VALUES(
						NULL ,
						%i,
						%n
						)", array($arr['id_question'], $arr['answer']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_poll_answer` SET
						`id` =  %i
						[ , `id_question` = %I ]
						[ , `answer` = %N ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['id_question'], $arr['answer'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_poll_answer` WHERE TRUE 
						[ AND `id` = %I ]
						[ AND `id_question` = %I ]
						[ AND `answer` = %N ]
						",
						array($arr['id'], $arr['id_question'], $arr['answer']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_poll_answer` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_question` = %I ]
						[ AND `answer` = %N ]
						",
						array($arr['id'], $arr['id_question'], $arr['answer']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_poll_answer`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
