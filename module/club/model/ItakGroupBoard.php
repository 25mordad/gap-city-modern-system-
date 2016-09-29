<?php

/**
 * ItakGroupBoard.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_itak_group_board
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class ItakGroupBoard
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_itak_group_board` (
				        `id` ,
				        `id_group`,
				   		`id_user` ,
				        `txt`  ,
				        `date` 
						) VALUES(
						NULL ,
						%i,
						%i,
						%n,
						%n
						)", array($arr['id_group'], $arr['id_user'], $arr['txt'], $arr['date']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_itak_group_board` SET
						`id` =  %i
						[ , `id_group` = %I ]
						[ , `id_user` = %I ]
				        [ , `txt` = %N ]
				        [ , `date` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_group'],
									$arr['id_user'],
									$arr['txt'],
									$arr['date'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "", $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			if($join_param=="group")
			{
				$join_query_helper['select']=", `gcms_itak_group`.`name`, `gcms_itak_group`.`status`, `gcms_itak_group`.`id_manager`";
				$join_query_helper['join']="INNER JOIN `gcms_itak_group` ON `gcms_itak_group_board`.`id_group` = `gcms_itak_group`.`id`";
			}
			else if($join_param=="user")
			{
				$join_query_helper['select']=", `gcms_itak_user`.`name`";
				$join_query_helper['join']="INNER JOIN `gcms_itak_user` ON `gcms_itak_group_board`.`id_user` = `gcms_itak_user`.`id`";
			}
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_itak_group_board`.* [ %S ] FROM `gcms_itak_group_board` [ %S ] WHERE TRUE
						[ AND `gcms_itak_group_board`.`id` = %I ]
						[ AND `gcms_itak_group_board`.`id_group` = %I ]
						[ AND `gcms_itak_group_board`.`id_user` = %I ]
				        [ AND `gcms_itak_group_board`.`txt` = %N ]
				        [ AND `gcms_itak_group_board`.`date` = %N ]
						[ ORDER BY `gcms_itak_group_board`.`%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$arr['id'],
									$arr['id_group'],
									$arr['id_user'],
									$arr['txt'],
									$arr['date'],
									$order['by'],
									$order['sort'],
									$limit['start'],
									$limit['end']
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
						"SELECT COUNT(*) as Num FROM `gcms_itak_group_board` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_group` = %I ]
						[ AND `id_user` = %I ]
				        [ AND `txt` = %N ]
				        [ AND `date` = %N ]
						",
						array(
									$arr['id'],
									$arr['id_group'],
									$arr['id_user'],
									$arr['txt'],
									$arr['date']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_itak_group_board`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
