<?php

/**
 * GroupContact.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_group_contact
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class GroupContact
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_group_contact` (
				        `id` ,
				        `name` ,
				        `status` 
						) VALUES(
						NULL ,
						%n,
						%n
						)", array($arr['name'], $arr['status']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_group_contact` SET
						`id` =  %i 
				        [ , `name` = %N ]
				        [ , `status` = %N ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['name'], $arr['status'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_group_contact` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `name` = %N ]
				        [ AND `status` = %N ]
						",
						array($arr['id'], $arr['name'], $arr['status']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_group_contact` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `name` = %N ]
				        [ AND `status` = %N ]
						",
						array($arr['id'], $arr['name'], $arr['status']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
