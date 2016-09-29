<?php

/**
 * WbRelClassStudent.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_rel_class_student
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbRelClassStudent
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_rel_class_student` (
				        `id` ,
				        `id_class`,
				   		`id_student`
						) VALUES(
						NULL ,
						%i,
						%i
						)", array($arr['id_class'], $arr['id_student']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_rel_class_student` SET
						`id` =  %i
						[ , `id_class` = %I ]
						[ , `id_student` = %I ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['id_class'], $arr['id_student'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $join_param = "")
	{
		$join_query_helper=array();
		if($join_param=="user")
		{
			$join_query_helper['select']=", `gcms_user`.`username`";
			$join_query_helper['join']="INNER JOIN `gcms_user` ON `gcms_wb_rel_class_student`.`id_student` = `gcms_user`.`id`";
		}
		else if($join_param=="class")
		{
			$join_query_helper['select']=", `gcms_wb_class`.*, `gcms_wb_branch`.`name` as branch_name, `gcms_wb_grade`.`name` as grade_name, `gcms_wb_grade`.`id_year`";
			$join_query_helper['join']="INNER JOIN `gcms_wb_class` ON `gcms_wb_rel_class_student`.`id_class` = `gcms_wb_class`.`id`"
					."INNER JOIN `gcms_wb_branch` ON `gcms_wb_class`.`id_branch` = `gcms_wb_branch`.`id`"
					."INNER JOIN `gcms_wb_grade` ON `gcms_wb_class`.`id_grade` = `gcms_wb_grade`.`id`";
		}
		else if($join_param!=NULL)
		{
			$join_query_helper['select']=", `gcms_wb_score`.`type`, `gcms_wb_score_student`.`number`";
			$join_query_helper['join']="INNER JOIN `gcms_wb_rel_class_lesson` ON `gcms_wb_rel_class_student`.`id_class` = `gcms_wb_rel_class_lesson`.`id_class`"
					."INNER JOIN `gcms_wb_score` ON `gcms_wb_rel_class_lesson`.`id` = `gcms_wb_score`.`id_rel_class_lesson`"
					."INNER JOIN `gcms_wb_score_student` ON `gcms_wb_score_student`.`id_score` = `gcms_wb_score`.`id`";
			$join_query_helper['where']="AND `gcms_wb_rel_class_lesson`.`id_lesson` = ";
			$join_query_helper['param']=$join_param;
			if($arr['id_student']!=NULL)
			{
				$join_query_helper['where_2']="AND `gcms_wb_score_student`.`id_student` = ";
				$join_query_helper['param_2']=$arr['id_student'];
			}
		}

		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_wb_rel_class_student`.* [ %S ] FROM `gcms_wb_rel_class_student` [ %S ] 
						WHERE TRUE [ %S ][ %N ] [ %S ][ %N ]
						[ AND `gcms_wb_rel_class_student`.`id` = %I ]
						[ AND `gcms_wb_rel_class_student`.`id_class` = %I ]
						[ AND `gcms_wb_rel_class_student`.`id_student` = %I ]
						[ ORDER BY `gcms_wb_rel_class_student`.`%S` ] [ %S ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$join_query_helper['where_2'],
									$join_query_helper['param_2'],
									$arr['id'],
									$arr['id_class'],
									$arr['id_student'],
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
						"SELECT COUNT(*) as Num FROM `gcms_wb_rel_class_student` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_class` = %I ]
						[ AND `id_student` = %I ]
						", array($arr['id'], $arr['id_class'], $arr['id_student']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_wb_rel_class_student`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
