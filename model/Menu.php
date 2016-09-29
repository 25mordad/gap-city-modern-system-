<?php

/**
 * Menu.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_menu
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class Menu
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_menu` (
				        `id` ,
				        `title` ,
				        `link` ,
				        `order`,
				        `parent`
						) VALUES(
						NULL ,
						%n,
						%n,
						%i,
						%i
						)", array($arr['title'], $arr['link'], $arr['order'], $arr['parent']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_menu` SET
						`id` =  %i
						[ , `title` = %N ]
						[ , `link` = %N ]
						[ , `order` = %I ]
						[ , `parent` = %I ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['title'],
									$arr['link'],
									$arr['order'],
									$arr['parent'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_menu` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `title` = %N ]
						[ AND `link` = %N ]
						[ AND `order` = %I ]
						[ AND `parent` = %I ]
						[ ORDER BY `%S` ] [ %S ] [, `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['title'],
									$arr['link'],
									$arr['order'],
									$arr['parent'],
									$order['by'],
									$order['sort'],
									$order['by2'],
									$order['sort2']
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
						"SELECT COUNT(*) as Num FROM `gcms_menu` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `title` = %N ]
						[ AND `link` = %N ]
						[ AND `order` = %I ]
						[ AND `parent` = %I ]
						",
						array(
									$arr['id'],
									$arr['title'],
									$arr['link'],
									$arr['order'],
									$arr['parent']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_menu`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
