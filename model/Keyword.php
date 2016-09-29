<?php

/**
 * Keyword.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_keyword
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class Keyword
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_keyword` (
				        `id` ,
				        `kw_title`
						) VALUES(
						NULL ,
						%n
						)", array($arr['kw_title']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_keyword` SET
						`kw_title` =  %n
						WHERE `id` =  %i", array($arr['kw_title'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "", $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			$join_query_helper['select']=", `gcms_rel_keyword_page`.`id` as rel_id";
			$join_query_helper['join']="INNER JOIN `gcms_rel_keyword_page` ON `gcms_keyword`.`id` = `gcms_rel_keyword_page`.`key_id`";
			$join_query_helper['where']="AND `gcms_rel_keyword_page`.`page_id` = ";
			$join_query_helper['param']=$join_param;
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_keyword`.* [ %S ] FROM `gcms_keyword` [ %S ] 
						WHERE TRUE
						[ %S ][ %N ]
						[ AND `gcms_keyword`.`id` = %I ]
						[ AND `gcms_keyword`.`kw_title` = %N ]
						[ AND `gcms_keyword`.`kw_title` LIKE %N ]
						[ ORDER BY `%S` ] [ %S ]
						[ LIMIT %I ][ , %I ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['kw_title'],
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
						"SELECT COUNT(*) as Num FROM `gcms_keyword` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `kw_title` = %N ]
						", array($arr['id'], $arr['kw_title']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
