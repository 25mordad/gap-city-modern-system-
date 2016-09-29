<?php

/**
 * ItakPoint.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_itak_point
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class ItakPoint
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_itak_point` (
				        `id` ,
				        `title` ,
				        `name` ,
				        `type` ,
				        `user_rate` ,
				        `group_rate` 
						) VALUES(
						NULL ,
						%n,
						%n,
						%n,
						%n,
						%n
						)",
						array(
									$arr['title'],
									$arr['name'],
									$arr['type'],
									$arr['user_rate'],
									$arr['group_rate']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_itak_point` SET
						`id` =  %i 
				        [ , `title` = %N ]
				        [ , `name` = %N ]
				        [ , `type` = %N ]
				        [ , `user_rate` = %N ]
				        [ , `group_rate` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['title'],
									$arr['name'],
									$arr['type'],
									$arr['user_rate'],
									$arr['group_rate'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_itak_point`.* FROM `gcms_itak_point` WHERE TRUE
						[ AND `gcms_itak_point`.`id` = %I ]
				        [ AND `gcms_itak_point`.`title` = %N ]
				        [ AND `gcms_itak_point`.`name` = %N ]
				        [ AND `gcms_itak_point`.`type` = %N ]
				        [ AND `gcms_itak_point`.`user_rate` = %N ]
				        [ AND `gcms_itak_point`.`group_rate` = %N ]
						[ AND `gcms_itak_point`.`name` LIKE %N ]
						[ ORDER BY `gcms_itak_point`.`%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$arr['id'], 
									$arr['title'],
									$arr['name'],
									$arr['type'],
									$arr['user_rate'],
									$arr['group_rate'],
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
						"SELECT COUNT(*) as Num FROM `gcms_itak_point` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `title` = %N ]
				        [ AND `name` = %N ]
				        [ AND `type` = %N ]
				        [ AND `user_rate` = %N ]
				        [ AND `group_rate` = %N ]
						[ AND `name` LIKE %N ]
						",
						array(
									$arr['id'],
									$arr['title'],
									$arr['name'],
									$arr['type'],
									$arr['user_rate'],
									$arr['group_rate'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
