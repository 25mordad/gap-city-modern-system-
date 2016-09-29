<?php

/**
 * WbLesson.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_lesson
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbLesson
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_lesson` (
				        `id` ,
				        `name` ,
				        `id_parent` ,
				        `rate` ,
				        `code` ,
				        `accept_score`
						) VALUES(
						NULL ,
						%n,
						%i,
						%n,
						%n,
						%n
						)",
						array(
									$arr['name'],
									$arr['id_parent'],
									$arr['rate'],
									$arr['code'],
									$arr['accept_score']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_lesson` SET
						`id` =  %i
						[ , `name` = %N ]
						[ , `id_parent` = %I ]
						[ , `rate` = %N ]
						[ , `code` = %N ]
						[ , `accept_score` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['name'],
									$arr['id_parent'],
									$arr['rate'],
									$arr['code'],
									$arr['accept_score'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_wb_lesson` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id` != %I ]
						[ AND `name` = %N ]
						[ AND `id_parent` = %I ]
						[ AND `rate` = %N ]
						[ AND `code` = %N ]
						[ AND `accept_score` = %N ]
						[ ORDER BY `%S` ] [ %S ]
						[ LIMIT %I ][ , %I ]
						",
						array(
									$arr['id'],
									$arr['id_not'],
									$arr['name'],
									$arr['id_parent'],
									$arr['rate'],
									$arr['code'],
									$arr['accept_score'],
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
						"SELECT COUNT(*) as Num FROM `gcms_wb_lesson` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id` != %I ]
						[ AND `name` = %N ]
						[ AND `id_parent` = %I ]
						[ AND `rate` = %N ]
						[ AND `code` = %N ]
						[ AND `accept_score` = %N ]
						",
						array(
									$arr['id'],
									$arr['id_not'],
									$arr['name'],
									$arr['id_parent'],
									$arr['rate'],
									$arr['code'],
									$arr['accept_score']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_wb_lesson`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
