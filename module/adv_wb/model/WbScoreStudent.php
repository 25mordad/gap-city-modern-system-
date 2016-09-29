<?php

/**
 * WbScoreStudent.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_score_student
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbScoreStudent
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_score_student` (
				        `id` ,
				        `id_score`,
				   		`id_student`,
				   		`number`
						) VALUES(
						NULL ,
						%i,
						%i,
						%n
						)", array($arr['id_score'], $arr['id_student'], $arr['number']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_score_student` SET
						`id` =  %i
						[ , `id_score` = %I ]
						[ , `id_student` = %I ]
						[ , `number` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_score'],
									$arr['id_student'],
									$arr['number'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_wb_score_student` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_score` = %I ]
						[ AND `id_student` = %I ]
						[ AND `number` = %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['id_score'],
									$arr['id_student'],
									$arr['number'],
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
						"SELECT COUNT(*) as Num FROM `gcms_wb_score_student` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_score` = %I ]
						[ AND `id_student` = %I ]
						[ AND `number` = %N ]
						", array($arr['id'], $arr['id_score'], $arr['id_student'], $arr['number']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_wb_score_student`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	//TODO remove below
	public function find_number_of_student($type, $id_student, $id_class, $id_lesson)
	{
		$query="
		SELECT number FROM `gcms_wb_score_student`
		INNER JOIN  gcms_wb_score ON  gcms_wb_score.id = gcms_wb_score_student.id_score
		INNER JOIN  gcms_wb_rel_class_lesson ON  gcms_wb_rel_class_lesson.id = gcms_wb_score.id_rel_class_lesson
		WHERE gcms_wb_score.type ='$type' AND gcms_wb_rel_class_lesson.id_class=$id_class AND gcms_wb_score_student.id_student=$id_student AND id_lesson=$id_lesson
		";
		return $GLOBALS['GCMS_DB']->get_row($query);
	}
}
