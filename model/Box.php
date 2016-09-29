<?php

/**
 * Box.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_box
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class Box
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_box` (
				        `id` ,
				        `class_name` ,
				        `box_title` ,
				        `box_content` ,
				        `parent_id` ,
				        `box_status`
						) VALUES(
						NULL ,
						%n,
						%n,
						%n,
						%i,
						%n
						)",
						array(
									$arr['class_name'],
									$arr['box_title'],
									$arr['box_content'],
									$arr['parent_id'],
									$arr['box_status']
						));
		if ($GLOBALS['GCMS_DB']->query($query)){
			return $GLOBALS['GCMS_DB']->insert_id;
		}else{
			return 0;
		}
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_box` SET
						`id` =  %i
						[ , `class_name` = %N ]
						[ , `box_title` = %N ]
						[ , `box_content` = %N ]
						[ , `parent_id` = %I ]
						[ , `box_status` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['class_name'],
									$arr['box_title'],
									$arr['box_content'],
									$arr['parent_id'],
									$arr['box_status'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_box` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id` != %I ]
						[ AND `class_name` = %N ]
						[ AND `box_title` = %N ]
						[ AND `box_content` = %N ]
						[ AND `parent_id` = %I ]
						[ AND `box_status` = %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['id_not'],
									$arr['class_name'],
									$arr['box_title'],
									$arr['box_content'],
									$arr['parent_id'],
									$arr['box_status'],
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
						"SELECT COUNT(*) as Num FROM `gcms_box` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id` != %I ]
						[ AND `class_name` = %N ]
						[ AND `box_title` = %N ]
						[ AND `box_content` = %N ]
						[ AND `parent_id` = %I ]
						[ AND `box_status` = %N ]
						",
						array(
									$arr['id'],
									$arr['id_not'],
									$arr['class_name'],
									$arr['box_title'],
									$arr['box_content'],
									$arr['parent_id'],
									$arr['box_status']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

}
