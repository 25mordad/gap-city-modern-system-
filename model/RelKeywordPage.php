<?php

/**
 * RelKeywordPage.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_rel_keyword_page
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class RelKeywordPage
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_rel_keyword_page` (
				        `id` ,
				        `key_id`,
				   		`page_id`
						) VALUES(
						NULL ,
						%i,
						%i
						)", array($arr['key_id'], $arr['page_id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_rel_keyword_page` SET
						`id` =  %i
						[ , `key_id` = %I ]
						[ , `page_id` = %I ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['key_id'], $arr['page_id'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_rel_keyword_page` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `key_id` = %I ]
						[ AND `page_id` = %I ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['key_id'],
									$arr['page_id'],
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
						"SELECT COUNT(*) as Num FROM `gcms_rel_keyword_page` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `key_id` = %I ]
						[ AND `page_id` = %I ]
						", array($arr['id'], $arr['key_id'], $arr['page_id']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_rel_keyword_page`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
