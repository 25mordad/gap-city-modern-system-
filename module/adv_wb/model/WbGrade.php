<?php

/**
 * WbGrade.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_grade
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbGrade
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_grade` (
				        `id` ,
				        `name` ,
				        `id_year` 
						) VALUES(
						NULL ,
						%n,
						%i
						)", array($arr['name'], $arr['id_year']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_grade` SET
						`id` =  %i 
				        [ , `name` = %N ]
				        [ , `id_year` = %I ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['name'], $arr['id_year'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_wb_grade` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `name` = %N ]
				        [ AND `id_year` = %I ]
						[ ORDER BY `%S` ] [ %S ]
						[ LIMIT %I ][ , %I ]
						",
						array(
									$arr['id'],
									$arr['name'],
									$arr['id_year'],
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
						"SELECT COUNT(*) as Num FROM `gcms_wb_grade` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `name` = %N ]
				        [ AND `id_year` = %I ]
						", array($arr['id'], $arr['name'], $arr['id_year']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_wb_grade`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
