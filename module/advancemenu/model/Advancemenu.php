<?php
/**
 * Advancemenu.php
 *
 * This file is part of GCMS > MODULE MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: 
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

class AdvanceMenu
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"INSERT INTO `gcms_advance_menu` (
				         `id`  ,
                         `group`  ,
                         `title`  ,
                         `link`  ,
                         `order`  ,
                         `parent`
						) VALUES(
						 NULL  ,
                         %n  ,
                         %n  ,
                         %n  ,
                         %n  ,
                         %i
						)",
				array(
						$arr['group'],
						$arr['title'],
						$arr['link'],
						$arr['order'],
						$arr['parent']
				));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"UPDATE `gcms_advance_menu` SET
						 `id` =  %i
                         [ , `group` = %N ]
                         [ , `title` = %N ]
                         [ , `link` = %N ]
                         [ , `order` = %N ]
                         [ , `parent` = %I ]

						WHERE `id` =  %i",
				array(
						$arr['id'],
						$arr['group'],
						$arr['title'],
						$arr['link'],
						$arr['order'],
						$arr['parent'],
						$arr['id']
				));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"SELECT * FROM `gcms_advance_menu` WHERE TRUE
						 [ AND `id` = %I ]
                         [ AND `group` = %N ]
                         [ AND `title` = %N ]
                         [ AND `link` = %N ]
                         [ AND `order` = %N ]
                         [ AND `parent` = %I ]

						[ ORDER BY `%S` ] [ %S ] [, `%S` ] [ %S ] [, `%S` ] [ %S ]
                        [ LIMIT %I ][ , %I ]
						",
				array(
						$arr['id'],
						$arr['group'],
						$arr['title'],
						$arr['link'],
						$arr['order'],
						$arr['parent'],
						$order['by'],
						$order['sort'],
						$order['by2'],
						$order['sort2'],
						$order['by3'],
						$order['sort3'],
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
				"SELECT COUNT(*) as Num FROM `gcms_advance_menu` WHERE TRUE
					    [ AND `id` = %I ]
                         [ AND `group` = %N ]
                         [ AND `title` = %N ]
                         [ AND `link` = %N ]
                         [ AND `order` = %N ]
                         [ AND `parent` = %I ]

						",
				array(
						$arr['id'],
						$arr['group'],
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
		->query("DELETE FROM `gcms_advance_menu`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}
 

