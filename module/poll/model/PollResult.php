<?php

/**
 * PollResult.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_poll_result
 * 
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class PollResult
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_poll_result` (
						`id`,
						`date`,
						`id_answer`,
						`ip`
						) VALUES(
						NULL ,
						%n,
						%i,
						%n
						)", array($arr['date'], $arr['id_answer'], $arr['ip']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_poll_result` SET
						`id` =  %i
						[ , `date` = %N ]
						[ , `id_answer` = %I ]
						[ , `ip` = %N ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['date'], $arr['id_answer'], $arr['ip'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			$join_query_helper['join']="INNER JOIN `gcms_poll_answer` ON `gcms_poll_result`.`id_answer` = `gcms_poll_answer`.`id`";
			$join_query_helper['where']="AND `gcms_poll_answer`.`id_question` = ";
			$join_query_helper['param']=$join_param;
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_poll_result` [ %S ] WHERE TRUE
						[ %S ][ %N ] 
						[ AND `gcms_poll_result`.`id` = %I ]
						[ AND `gcms_poll_result`.`date` = %N ]
						[ AND `gcms_poll_result`.`id_answer` = %I ]
						[ AND `gcms_poll_result`.`ip` = %N ]
						",
						array(
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['date'],
									$arr['id_answer'],
									$arr['ip']
						));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

	public function get_count($arr, $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			$join_query_helper['join']="INNER JOIN `gcms_poll_answer` ON `gcms_poll_result`.`id_answer` = `gcms_poll_answer`.`id`";
			$join_query_helper['where']="AND `gcms_poll_answer`.`id_question` = ";
			$join_query_helper['param']=$join_param;
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_poll_result` [ %S ] WHERE TRUE
						[ %S ][ %N ] 
						[ AND `gcms_poll_result`.`id` = %I ]
						[ AND `gcms_poll_result`.`date` = %N ]
						[ AND `gcms_poll_result`.`id_answer` = %I ]
						[ AND `gcms_poll_result`.`ip` = %N ]
						",
						array(
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['date'],
									$arr['id_answer'],
									$arr['ip']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
