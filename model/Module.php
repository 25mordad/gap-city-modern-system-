<?php

/**
 * Module.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_module
 * 
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class Module
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_module` (
						`id`,
						`module_name`,
						`status`
						) VALUES(
						NULL ,
						%n,
						%n
						)",
						array(
									$arr['module_name'],
									$arr['status']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_module` SET
						`id` =  %i
						[ , `module_name` = %N ]
						[ , `status` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['module_name'],
									$arr['status'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_module` WHERE TRUE 
						[ AND `id` = %I ]
						[ AND `module_name` = %N ]
						[ AND `status` = %N ]
						",
						array(
									$arr['id'],
									$arr['module_name'],
									$arr['status']
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
						"SELECT COUNT(*) as Num FROM `gcms_module` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `module_name` = %N ]
						[ AND `status` = %N ]
						",
						array(
									$arr['id'],
									$arr['module_name'],
									$arr['status']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
