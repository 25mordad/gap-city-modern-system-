<?php

/**
 * WbScore.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_score
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbScore
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_score` (
				        `id` ,
				        `id_rel_class_lesson`,
				   		`type`,
				   		`title`
						) VALUES(
						NULL ,
						%i,
						%n,
						%n
						)", array($arr['id_rel_class_lesson'], $arr['type'], $arr['title']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_score` SET
						`id` =  %i
						[ , `id_rel_class_lesson` = %I ]
						[ , `type` = %N ]
						[ , `title` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_rel_class_lesson'],
									$arr['type'],
									$arr['title'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_wb_score` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_rel_class_lesson` = %I ]
						[ AND `type` = %N ]
						[ AND `title` = %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['id_rel_class_lesson'],
									$arr['type'],
									$arr['title'],
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
						"SELECT COUNT(*) as Num FROM `gcms_wb_score` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_rel_class_lesson` = %I ]
						[ AND `type` = %N ]
						[ AND `title` = %N ]
						",
						array($arr['id'], $arr['id_rel_class_lesson'], $arr['type'], $arr['title']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_wb_score`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
