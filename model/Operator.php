<?php

/**
 * Operator.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_operators
 * 
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class Operator
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_operators` (
						`id`,
						`username`,
						`email`,
						`temp_code`,
						`password`,
						`password_salt`,
						`password_attempts_failed`,
						`name`,
						`status`,
						`op_level`,
						`add_id`,
						`date_created`
						) VALUES(
						NULL ,
						%n,
						%n,
						%n,
						%n,
						%n,
						%i,
						%n,
						%n,
						%n,
						%i,
						%n
						)",
						array(
									$arr['username'],
									$arr['email'],
									$arr['temp_code'],
									$arr['password'],
									$arr['password_salt'],
									$arr['password_attempts_failed'],
									$arr['name'],
									$arr['status'],
									$arr['op_level'],
									$arr['add_id'],
									$arr['date_created']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_operators` SET
						`id` =  %i
						[ , `username` = %N ]
						[ , `email` = %N ]
						[ , `temp_code` = %N ]
						[ , `password` = %N ]
						[ , `password_salt` = %N ]
						[ , `password_attempts_failed` = %I ]
						[ , `name` = %N ]
						[ , `status` = %N ]
						[ , `op_level` = %N ]
						[ , `add_id` = %I ]
						[ , `date_created` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['username'],
									$arr['email'],
									$arr['temp_code'],
									$arr['password'],
									$arr['password_salt'],
									$arr['password_attempts_failed'],
									$arr['name'],
									$arr['status'],
									$arr['op_level'],
									$arr['add_id'],
									$arr['date_created'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_operators` WHERE TRUE 
						[ AND `id` = %I ]
						[ AND `username` = %N ]
						[ AND `email` = %N ]
						[ AND `temp_code` = %N ]
						[ AND `password` = %N ]
						[ AND `password_salt` = %N ]
						[ AND `password_attempts_failed` = %I ]
						[ AND `name` = %N ]
						[ AND `status` = %N ]
						[ AND `op_level` = %N ]
						[ AND `add_id` = %I ]
						[ AND `date_created` = %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['username'],
									$arr['email'],
									$arr['temp_code'],
									$arr['password'],
									$arr['password_salt'],
									$arr['password_attempts_failed'],
									$arr['name'],
									$arr['status'],
									$arr['op_level'],
									$arr['add_id'],
									$arr['date_created'],
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
						"SELECT COUNT(*) as Num FROM `gcms_operators` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `username` = %N ]
						[ AND `email` = %N ]
						[ AND `temp_code` = %N ]
						[ AND `password` = %N ]
						[ AND `password_salt` = %N ]
						[ AND `password_attempts_failed` = %I ]
						[ AND `name` = %N ]
						[ AND `status` = %N ]
						[ AND `op_level` = %N ]
						[ AND `add_id` = %I ]
						[ AND `date_created` = %N ]
						",
						array(
									$arr['id'],
									$arr['username'],
									$arr['email'],
									$arr['temp_code'],
									$arr['password'],
									$arr['password_salt'],
									$arr['password_attempts_failed'],
									$arr['name'],
									$arr['status'],
									$arr['op_level'],
									$arr['add_id'],
									$arr['date_created']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
