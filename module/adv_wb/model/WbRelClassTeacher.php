<?php

/**
 * WbRelClassTeacher.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_rel_class_teacher
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbRelClassTeacher
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_rel_class_teacher` (
				        `id` ,
				        `id_class`,
				   		`id_teacher`
						) VALUES(
						NULL ,
						%i,
						%i
						)", array($arr['id_class'], $arr['id_teacher']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_rel_class_teacher` SET
						`id` =  %i
						[ , `id_class` = %I ]
						[ , `id_teacher` = %I ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['id_class'], $arr['id_teacher'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "",  $join_param = "")
	{
		$join_query_helper=array();
		if($join_param=="user")
		{
			$join_query_helper['select']=", `gcms_user`.`username`";
			$join_query_helper['join']="INNER JOIN `gcms_user` ON `gcms_wb_rel_class_teacher`.`id_teacher` = `gcms_user`.`id`";
		}
		else if($join_param=="class")
		{
			$join_query_helper['select']=", `gcms_wb_class`.*, `gcms_wb_branch`.`name` as branch_name, `gcms_wb_grade`.`name` as grade_name";
			$join_query_helper['join']="INNER JOIN `gcms_wb_class` ON `gcms_wb_rel_class_teacher`.`id_class` = `gcms_wb_class`.`id`". 
										"INNER JOIN `gcms_wb_branch` ON `gcms_wb_class`.`id_branch` = `gcms_wb_branch`.`id`". 
										"INNER JOIN `gcms_wb_grade` ON `gcms_wb_class`.`id_grade` = `gcms_wb_grade`.`id`";
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_wb_rel_class_teacher`.* [ %S ] FROM `gcms_wb_rel_class_teacher` [ %S ] WHERE TRUE
						[ AND `gcms_wb_rel_class_teacher`.`id` = %I ]
						[ AND `gcms_wb_rel_class_teacher`.`id_class` = %I ]
						[ AND `gcms_wb_rel_class_teacher`.`id_teacher` = %I ]
						[ ORDER BY `gcms_wb_rel_class_teacher`.`%S` ] [ %S ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$arr['id'],
									$arr['id_class'],
									$arr['id_teacher'],
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
						"SELECT COUNT(*) as Num FROM `gcms_wb_rel_class_teacher` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_class` = %I ]
						[ AND `id_teacher` = %I ]
						", array($arr['id'], $arr['id_class'], $arr['id_teacher']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_wb_rel_class_teacher`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
