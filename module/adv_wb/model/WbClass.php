<?php

/**
 * WbClass.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_class
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbClass
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_class` (
				        `id` ,
				        `id_grade` ,
				        `name` ,
				        `capacity` ,
				        `text` ,
				        `id_branch` ,
				        `ages` ,
				        `sex` ,
				        `tuition`
						) VALUES(
						NULL ,
						%i,
						%n,
						%n,
						%n,
						%i,
						%n,
						%n,
						%n
						)",
						array(
									$arr['id_grade'],
									$arr['name'],
									$arr['capacity'],
									$arr['text'],
									$arr['id_branch'],
									$arr['ages'],
									$arr['sex'],
									$arr['tuition']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_class` SET
						`id` =  %i
				        [ , `id_grade` = %I ]
				        [ , `name` = %N ]
				        [ , `capacity` = %N ]
				        [ , `text` = %N ]
				        [ , `id_branch` = %I ]
				        [ , `ages` = %N ]
				        [ , `sex` = %N ]
				        [ , `tuition` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_grade'],
									$arr['name'],
									$arr['capacity'],
									$arr['text'],
									$arr['id_branch'],
									$arr['ages'],
									$arr['sex'],
									$arr['tuition'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "", $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			$join_query_helper['select']=", `gcms_wb_grade`.`name` as grade_name";
			$join_query_helper['join']="INNER JOIN `gcms_wb_grade` ON `gcms_wb_class`.`id_grade` = `gcms_wb_grade`.`id`";
			$join_query_helper['where']="AND `gcms_wb_grade`.`id_year` = ";
			$join_query_helper['param']=$join_param;
		}

		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_wb_class`.* [ %S ] FROM `gcms_wb_class` [ %S ]
						WHERE TRUE
						[ %S ][ %N ]
						[ AND `gcms_wb_class`.`id` = %I ]
				        [ AND `gcms_wb_class`.`id_grade` = %I ]
				        [ AND `gcms_wb_class`.`name` = %N ]
				        [ AND `gcms_wb_class`.`capacity` = %N ]
				        [ AND `gcms_wb_class`.`text` = %N ]
				        [ AND `gcms_wb_class`.`id_branch` = %I ]
				        [ AND `gcms_wb_class`.`ages` = %N ]
				        [ AND `gcms_wb_class`.`sex` = %N ]
				        [ AND `gcms_wb_class`.`tuition` = %N ]
						[ AND (`gcms_wb_class`.`text` LIKE %N OR `gcms_wb_class`.`name` LIKE %N )]
						[ ORDER BY `gcms_wb_class`.`%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['id_grade'],
									$arr['name'],
									$arr['capacity'],
									$arr['text'],
									$arr['id_branch'],
									$arr['ages'],
									$arr['sex'],
									$arr['tuition'],
									$arr['search'],
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

	public function get_count($arr, $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			$join_query_helper['join']="INNER JOIN `gcms_wb_grade` ON `gcms_wb_class`.`id_grade` = `gcms_wb_grade`.`id`";
			$join_query_helper['where']="AND `gcms_wb_grade`.`id_year` = ";
			$join_query_helper['param']=$join_param;
		}
		
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_wb_class` [ %S ]
						WHERE TRUE
						[ %S ][ %N ]
						[ AND `gcms_wb_class`.`id` = %I ]
				        [ AND `gcms_wb_class`.`id_grade` = %I ]
				        [ AND `gcms_wb_class`.`name` = %N ]
				        [ AND `gcms_wb_class`.`capacity` = %N ]
				        [ AND `gcms_wb_class`.`text` = %N ]
				        [ AND `gcms_wb_class`.`id_branch` = %I ]
				        [ AND `gcms_wb_class`.`ages` = %N ]
				        [ AND `gcms_wb_class`.`sex` = %N ]
				        [ AND `gcms_wb_class`.`tuition` = %N ]
						[ AND (`gcms_wb_class`.`text` LIKE %N OR `gcms_wb_class`.`name` LIKE %N )]
						",
						array(
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['id_grade'],
									$arr['name'],
									$arr['capacity'],
									$arr['text'],
									$arr['id_branch'],
									$arr['ages'],
									$arr['sex'],
									$arr['tuition'],
									$arr['search'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_wb_class`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
