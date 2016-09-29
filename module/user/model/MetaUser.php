<?php

/**
 * MetaUser.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_meta_user
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class MetaUser
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_meta_user` (
				        `id` ,
				        `id_user` ,
				        `name` ,
				        `value`
						) VALUES(
						NULL ,
						%i,
						%n,
						%n
						)", array($arr['id_user'], $arr['name'], $arr['value']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_meta_user` SET
						`id` =  %i
						[ , `id_user` = %I ]
						[ , `name` = %N ]
						[ , `value` = %N ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['id_user'], $arr['name'], $arr['value'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_meta_user` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_user` = %I ]
						[ AND `name` = %N ]
						[ AND `value` = %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array($arr['id'], $arr['id_user'], $arr['name'], $arr['value'], $order['by'], $order['sort']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_meta_user` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_user` = %I ]
						[ AND `name` = %N ]
						[ AND `value` = %N ]
						",
						array($arr['id'], $arr['id_user'], $arr['name'], $arr['value']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_meta_user`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
