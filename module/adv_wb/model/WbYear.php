<?php

/**
 * WbYear.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wb_year
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class WbYear
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wb_year` (
				        `id` ,
				        `name` ,
				        `default` 
						) VALUES(
						NULL ,
						%n,
						%n
						)", array($arr['name'], $arr['default']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wb_year` SET
						`id` =  %i 
				        [ , `name` = %N ]
				        [ , `default` = %N ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['name'], $arr['default'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_wb_year` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `name` = %N ]
				        [ AND `default` = %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['name'],
									$arr['default'],
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
						"SELECT COUNT(*) as Num FROM `gcms_wb_year` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `name` = %N ]
				        [ AND `default` = %N ]
						", array($arr['id'], $arr['name'], $arr['default']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
