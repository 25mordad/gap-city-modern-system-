<?php

/**
 * ItakUserScore.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_itak_user_score
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class ItakUserScore
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_itak_user_score` (
				        `id` ,
				        `id_user`,
				   		`score` ,
				        `id_point`  ,
				        `date` 
						) VALUES(
						NULL ,
						%i,
						%n,
						%i,
						%n
						)", array($arr['id_user'], $arr['score'], $arr['id_point'], $arr['date']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_itak_user_score` SET
						`id` =  %i
						[ , `id_user` = %I ]
						[ , `score` = %N ]
				        [ , `id_point` = %I ]
				        [ , `date` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_user'],
									$arr['score'],
									$arr['id_point'],
									$arr['date'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			if($join_param=="user")
			{
				$join_query_helper['select']=", `gcms_itak_user`.`name``";
				$join_query_helper['join']="INNER JOIN `gcms_itak_user` ON `gcms_itak_user_score`.`id_user` = `gcms_itak_user`.`id`";
			}
			else if($join_param=="point")
			{
				$join_query_helper['select']=", `gcms_itak_point`.`title`";
				$join_query_helper['join']="INNER JOIN `gcms_itak_point` ON `gcms_itak_user_score`.`id_point` = `gcms_itak_point`.`id`";
			}
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_itak_user_score`.* [ %S ] FROM `gcms_itak_user_score` [ %S ] WHERE TRUE
						[ AND `gcms_itak_user_score`.`id` = %I ]
						[ AND `gcms_itak_user_score`.`id_user` = %I ]
						[ AND `gcms_itak_user_score`.`score` = %N ]
				        [ AND `gcms_itak_user_score`.`id_point` = %I ]
				        [ AND `gcms_itak_user_score`.`date` = %N ]
						[ ORDER BY `gcms_itak_user_score`.`%S` ] [ %S ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$arr['id'],
									$arr['id_user'],
									$arr['score'],
									$arr['id_point'],
									$arr['date'],
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
						"SELECT COUNT(*) as Num FROM `gcms_itak_user_score` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_user` = %I ]
						[ AND `score` = %N ]
				        [ AND `id_point` = %I ]
				        [ AND `date` = %N ]
						",
						array(
									$arr['id'],
									$arr['id_user'],
									$arr['score'],
									$arr['id_point'],
									$arr['date']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
