<?php

/**
 * ItakGroup.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_itak_group
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class ItakGroup
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_itak_group` (
				        `id` ,
				        `id_manager` ,
				        `name` ,
				        `avatar` ,
				        `date` ,
				        `status` 
						) VALUES(
						NULL ,
						%i,
						%n,
						%n,
						%n,
						%n
						)",
						array(
									$arr['id_manager'],
									$arr['name'],
									$arr['avatar'],
									$arr['date'],
									$arr['status']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_itak_group` SET
						`id` =  %i 
				        [ , `id_manager` = %I ]
				        [ , `name` = %N ]
				        [ , `avatar` = %N ]
				        [ , `date` = %N ]
				        [ , `status` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_manager'],
									$arr['name'],
									$arr['avatar'],
									$arr['date'],
									$arr['status'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "", $join_param = "")
	{
		$join_query_helper=array();
		if($join_param=="manager")
		{
			$join_query_helper['select']=", `gcms_itak_user`.`name` as manager_name";
			$join_query_helper['join']="INNER JOIN `gcms_itak_user` ON `gcms_itak_group`.`id_manager` = `gcms_itak_user`.`id`";
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_itak_group`.* [ %S ] FROM `gcms_itak_group` [ %S ] WHERE TRUE
						[ AND `gcms_itak_group`.`id` = %I ]
				        [ AND `gcms_itak_group`.`id_manager` = %I ]
				        [ AND `gcms_itak_group`.`name` = %N ]
				        [ AND `gcms_itak_group`.`avatar` = %N ]
				        [ AND `gcms_itak_group`.`date` = %N ]
				        [ AND `gcms_itak_group`.`status` = %N ]
				        [ AND `gcms_itak_group`.`status` != %N ]
						[ AND `gcms_itak_group`.`name` LIKE %N ]
						[ ORDER BY `gcms_itak_group`.`%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$arr['id'],
									$arr['id_manager'],
									$arr['name'],
									$arr['avatar'],
									$arr['date'],
									$arr['status'],
									$arr['status_not'],
									$arr['search'],
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
						"SELECT COUNT(*) as Num FROM `gcms_itak_group` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `id_manager` = %I ]
				        [ AND `name` = %N ]
				        [ AND `avatar` = %N ]
				        [ AND `date` = %N ]
				        [ AND `status` = %N ]
				        [ AND `status` != %N ]
						[ AND `name` LIKE %N ]
						",
						array(
									$arr['id'],
									$arr['id_manager'],
									$arr['name'],
									$arr['avatar'],
									$arr['date'],
									$arr['status'],
									$arr['status_not'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
