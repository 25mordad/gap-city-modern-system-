<?php

/**
 * Setting.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_setting
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class Setting
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_setting` (
				        `id` ,
				        `st_group` ,
				        `st_key` ,
				        `st_value`
						) VALUES(
						NULL ,
						%n,
						%n,
						%n
						)", array($arr['st_group'], $arr['st_key'], $arr['st_value']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_setting` SET
						`id` =  %i
						[ , `st_group` = %N ]
						[ , `st_key` = %N ]
						[ , `st_value` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['st_group'],
									$arr['st_key'],
									$arr['st_value'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_setting` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `st_group` = %N ]
						[ AND `st_key` = %N ]
						[ AND `st_value` = %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['st_group'],
									$arr['st_key'],
									$arr['st_value'],
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
						"SELECT COUNT(*) as Num FROM `gcms_setting` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `st_group` = %N ]
						[ AND `st_key` = %N ]
						[ AND `st_value` = %N ]
						", array($arr['id'], $arr['st_group'], $arr['st_key'], $arr['st_value']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
