<?php

/**
 * WbTeacher.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_teacher
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbTeacher
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_teacher` (
				        `id` ,
				        `name` ,
				        `txt` 
						) VALUES(
						NULL ,
						%n,
						%n
						)", array($arr['name'], $arr['txt']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_teacher` SET
						`id` =  %i 
				        [ , `name` = %N ]
				        [ , `txt` = %N ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['name'], $arr['txt'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_wb_teacher` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `name` = %N ]
				        [ AND `txt` = %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array($arr['id'], $arr['name'], $arr['txt'], $order['by'], $order['sort']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_wb_teacher` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `name` = %N ]
				        [ AND `txt` = %N ]
						", array($arr['id'], $arr['name'], $arr['txt']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
