<?php

/**
 * ItakUser.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_itak_user
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class ItakUser
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_itak_user` (
				        `id` ,
				        `username` ,
				        `email` ,
				        `email_temp_code` ,
				        `password` ,
				        `password_salt` ,
				        `password_attempts_failed` ,
				        `password_temp_code` ,
				        `status` ,
				        `user_level` ,
				        `date_created` ,
				        `name` ,
				        `cell` ,
				        `cell_temp_code` ,
				        `birth_date` ,
				        `gender` ,
				        `marital` ,
				        `address` ,
				        `avatar` ,
				        `nickname` ,
				        `type`
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
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n
						)",
						array(
									$arr['username'],
									$arr['email'],
									$arr['email_temp_code'],
									$arr['password'],
									$arr['password_salt'],
									$arr['password_attempts_failed'],
									$arr['password_temp_code'],
									$arr['status'],
									$arr['user_level'],
									$arr['date_created'],
									$arr['name'],
									$arr['cell'],
									$arr['cell_temp_code'],
									$arr['birth_date'],
									$arr['gender'],
									$arr['marital'],
									$arr['address'],
									$arr['avatar'],
									$arr['nickname'],
									$arr['type']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_itak_user` SET
						`id` =  %i
				        [ , `username` = %N ]
				        [ , `email` = %N ]
				        [ , `email_temp_code` = %N ]
				        [ , `password` = %N ]
				        [ , `password_salt` = %N ]
				        [ , `password_attempts_failed` = %I ]
				        [ , `password_temp_code` = %N ]
				        [ , `status` = %N ]
				        [ , `user_level` = %N ]
				        [ , `date_created` = %N ]
				        [ , `name` = %N ]
				        [ , `cell` = %N ]
				        [ , `cell_temp_code` = %N ]
				        [ , `birth_date` = %N ]
				        [ , `gender` = %N ]
				        [ , `marital` = %N ]
				        [ , `address` = %N ]
				        [ , `avatar` = %N ]
				        [ , `nickname` = %N ]
				        [ , `type` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['username'],
									$arr['email'],
									$arr['email_temp_code'],
									$arr['password'],
									$arr['password_salt'],
									$arr['password_attempts_failed'],
									$arr['password_temp_code'],
									$arr['status'],
									$arr['user_level'],
									$arr['date_created'],
									$arr['name'],
									$arr['cell'],
									$arr['cell_temp_code'],
									$arr['birth_date'],
									$arr['gender'],
									$arr['marital'],
									$arr['address'],
									$arr['avatar'],
									$arr['nickname'],
									$arr['type'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_itak_user`.* FROM `gcms_itak_user`
						WHERE TRUE
						[ AND `gcms_itak_user`.`id` = %I ]
				        [ AND `gcms_itak_user`.`username` = %N ]
				        [ AND `gcms_itak_user`.`email` = %N ]
				        [ AND `gcms_itak_user`.`email_temp_code` = %N ]
				        [ AND `gcms_itak_user`.`password` = %N ]
				        [ AND `gcms_itak_user`.`password_salt` = %N ]
				        [ AND `gcms_itak_user`.`password_attempts_failed` = %I ]
				        [ AND `gcms_itak_user`.`password_temp_code` = %N ]
				        [ AND `gcms_itak_user`.`status` = %N ]
				        [ AND `gcms_itak_user`.`status` != %N ]
				        [ AND `gcms_itak_user`.`user_level` = %N ]
						[ AND `gcms_itak_user`.`date_created` = %N ]
				        [ AND `gcms_itak_user`.`name` = %N ]
				        [ AND `gcms_itak_user`.`cell` = %N ]
				        [ AND `gcms_itak_user`.`cell_temp_code` = %N ]
				        [ AND `gcms_itak_user`.`birth_date` = %N ]
				        [ AND `gcms_itak_user`.`gender` = %N ]
				        [ AND `gcms_itak_user`.`marital` = %N ]
				        [ AND `gcms_itak_user`.`address` = %N ]
				        [ AND `gcms_itak_user`.`avatar` = %N ]
				        [ AND `gcms_itak_user`.`nickname` = %N ]
				        [ AND `gcms_itak_user`.`type` = %N ]
						[ AND (`gcms_itak_user`.`username` LIKE %N OR `gcms_itak_user`.`name` LIKE %N )]
						[ ORDER BY `gcms_itak_user`.`%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$arr['id'],
									$arr['username'],
									$arr['email'],
									$arr['email_temp_code'],
									$arr['password'],
									$arr['password_salt'],
									$arr['password_attempts_failed'],
									$arr['password_temp_code'],
									$arr['status'],
									$arr['status_not'],
									$arr['user_level'],
									$arr['date_created'],
									$arr['name'],
									$arr['cell'],
									$arr['cell_temp_code'],
									$arr['birth_date'],
									$arr['gender'],
									$arr['marital'],
									$arr['address'],
									$arr['avatar'],
									$arr['nickname'],
									$arr['type'],
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

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_itak_user` WHERE TRUE
						[ AND `gcms_itak_user`.`id` = %I ]
				        [ AND `gcms_itak_user`.`username` = %N ]
				        [ AND `gcms_itak_user`.`email` = %N ]
				        [ AND `gcms_itak_user`.`email_temp_code` = %N ]
				        [ AND `gcms_itak_user`.`password` = %N ]
				        [ AND `gcms_itak_user`.`password_salt` = %N ]
				        [ AND `gcms_itak_user`.`password_attempts_failed` = %I ]
				        [ AND `gcms_itak_user`.`password_temp_code` = %N ]
				        [ AND `gcms_itak_user`.`status` = %N ]
				        [ AND `gcms_itak_user`.`status` != %N ]
				        [ AND `gcms_itak_user`.`user_level` = %N ]
						[ AND `gcms_itak_user`.`date_created` = %N ]
				        [ AND `gcms_itak_user`.`name` = %N ]
				        [ AND `gcms_itak_user`.`cell` = %N ]
				        [ AND `gcms_itak_user`.`cell_temp_code` = %N ]
				        [ AND `gcms_itak_user`.`birth_date` = %N ]
				        [ AND `gcms_itak_user`.`gender` = %N ]
				        [ AND `gcms_itak_user`.`marital` = %N ]
				        [ AND `gcms_itak_user`.`address` = %N ]
				        [ AND `gcms_itak_user`.`avatar` = %N ]
				        [ AND `gcms_itak_user`.`nickname` = %N ]
				        [ AND `gcms_itak_user`.`type` = %N ]
						[ AND (`gcms_itak_user`.`username` LIKE %N OR `gcms_itak_user`.`name` LIKE %N )]
						",
						array(
									$arr['id'],
									$arr['username'],
									$arr['email'],
									$arr['email_temp_code'],
									$arr['password'],
									$arr['password_salt'],
									$arr['password_attempts_failed'],
									$arr['password_temp_code'],
									$arr['status'],
									$arr['status_not'],
									$arr['user_level'],
									$arr['date_created'],
									$arr['name'],
									$arr['cell'],
									$arr['cell_temp_code'],
									$arr['birth_date'],
									$arr['gender'],
									$arr['marital'],
									$arr['address'],
									$arr['avatar'],
									$arr['nickname'],
									$arr['type'],
									$arr['search'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
