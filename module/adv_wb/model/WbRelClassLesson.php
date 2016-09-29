<?php

/**
 * WbRelClassLesson.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_rel_class_lesson
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbRelClassLesson
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_rel_class_lesson` (
				        `id` ,
				        `id_class`,
				   		`id_lesson`
						) VALUES(
						NULL ,
						%i,
						%i
						)", array($arr['id_class'], $arr['id_lesson']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_rel_class_lesson` SET
						`id` =  %i
						[ , `id_class` = %I ]
						[ , `id_lesson` = %I ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['id_class'], $arr['id_lesson'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "",  $join_param = false)
	{
		$join_query_helper=array();
		if($join_param)
		{
			$join_query_helper['select']=", `gcms_wb_lesson`.`name`, `gcms_wb_lesson`.`rate`, `gcms_wb_lesson`.`accept_score`, `gcms_wb_lesson`.`id_parent`";
			$join_query_helper['join']="INNER JOIN `gcms_wb_lesson` ON `gcms_wb_rel_class_lesson`.`id_lesson` = `gcms_wb_lesson`.`id`";
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_wb_rel_class_lesson`.* [ %S ] FROM `gcms_wb_rel_class_lesson` [ %S ] WHERE TRUE
						[ AND `gcms_wb_rel_class_lesson`.`id` = %I ]
						[ AND `gcms_wb_rel_class_lesson`.`id_class` = %I ]
						[ AND `gcms_wb_rel_class_lesson`.`id_lesson` = %I ]
						[ ORDER BY `gcms_wb_rel_class_lesson`.`%S` ] [ %S ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$arr['id'],
									$arr['id_class'],
									$arr['id_lesson'],
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
						"SELECT COUNT(*) as Num FROM `gcms_wb_rel_class_lesson` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_class` = %I ]
						[ AND `id_lesson` = %I ]
						", array($arr['id'], $arr['id_class'], $arr['id_lesson']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_wb_rel_class_lesson`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
