<?php

/**
 * Page.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_page
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class Page
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_page` (
						`id` ,
						`pg_type` ,
						`parent_id` ,
						`pg_title` ,
						`pg_content` ,
						`pg_excerpt` ,
						`pg_status` ,
						`comment_status` ,
						`pg_order` ,
						`author_id` ,
						`date_created` ,
						`date_modified`
						) VALUES(
						NULL ,
						%n,
						%i,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%i,
						%n,
						%n
						)",
						array(
									$arr['pg_type'],
									$arr['parent_id'],
									$arr['pg_title'],
									$arr['pg_content'],
									$arr['pg_excerpt'],
									$arr['pg_status'],
									$arr['comment_status'],
									$arr['pg_order'],
									$arr['author_id'],
									$arr['date_created'],
									$arr['date_modified']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_page` SET
						`id` =  %i
						[ , `pg_type` = %N ]
						[ , `parent_id` = %I ]
						[ , `pg_title` = %N ]
						[ , `pg_content` = %N ]
						[ , `pg_excerpt` = %N ]
						[ , `pg_status` = %N ]
						[ , `comment_status` = %N ]
						[ , `pg_order` = %N ]
						[ , `author_id` = %I ]
						[ , `date_created` = %N ]
						[ , `date_modified` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['pg_type'],
									$arr['parent_id'],
									$arr['pg_title'],
									$arr['pg_content'],
									$arr['pg_excerpt'],
									$arr['pg_status'],
									$arr['comment_status'],
									$arr['pg_order'],
									$arr['author_id'],
									$arr['date_created'],
									$arr['date_modified'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "" , $join_meta = "")
	{
	   $join_query_helper=array();
       if($join_meta!=NULL)
		{
			$join_query_helper['select']=" , `gcms_meta_page`.`meta_value` as  meta_value";
			$join_query_helper['join']=" INNER JOIN `gcms_meta_page` ON `gcms_meta_page`.`page_id` = `gcms_page`.`id` ";
			$join_query_helper['wherekey']=" AND `gcms_meta_page`.`meta_key` =  ";
            $join_query_helper['wherevalue']=" AND `gcms_meta_page`.`meta_value` = " ;            
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_page`.* [ %S ] FROM `gcms_page` [ %S ]
                        WHERE TRUE
                        [ %S %N ] [ %S  %N ]
						[ AND `id` = %I ]
						[ AND `id` != %I ]
						[ AND `pg_type` = %N ]
						[ AND `parent_id` = %I ]
						[ AND `pg_title` = %N ]
						[ AND `pg_content` = %N ]
						[ AND `pg_excerpt` = %N ]
						[ AND `pg_status` = %N ]
						[ AND `pg_status` != %N ]
						[ AND `comment_status` = %N ]
						[ AND `pg_order` = %N ]
						[ AND `author_id` = %I ]
						[ AND `date_created` = %N ]
						[ AND `date_modified` = %N ]
						[ AND (`pg_title` LIKE %N OR `pg_content` LIKE %N )]
						[ ORDER BY `%S` ] [ %S ] [, `%S` ] [ %S ]
						[ LIMIT %I ][ , %I ]
						",
						array(
                                    $join_query_helper['select'],
                                    $join_query_helper['join'],
                                    $join_query_helper['wherekey'],
                                    $join_meta['key']   ,                          
                                    $join_query_helper['wherevalue'],
                                    $join_meta['value']  ,                                                        
									$arr['id'],
									$arr['id_not'],
									$arr['pg_type'],
									$arr['parent_id'],
									$arr['pg_title'],
									$arr['pg_content'],
									$arr['pg_excerpt'],
									$arr['pg_status'],
									$arr['pg_status_not'],
									$arr['comment_status'],
									$arr['pg_order'],
									$arr['author_id'],
									$arr['date_created'],
									$arr['date_modified'],
									$arr['search'],
									$arr['search'],
									$order['by'],
									$order['sort'],
									$order['by2'],
									$order['sort2'],
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
						"SELECT COUNT(*) as Num FROM `gcms_page` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id` != %I ]
						[ AND `pg_type` = %N ]
						[ AND `parent_id` = %I ]
						[ AND `pg_title` = %N ]
						[ AND `pg_content` = %N ]
						[ AND `pg_excerpt` = %N ]
						[ AND `pg_status` = %N ]
						[ AND `pg_status` != %N ]
						[ AND `comment_status` = %N ]
						[ AND `pg_order` = %N ]
						[ AND `author_id` = %I ]
						[ AND `date_created` = %N ]
						[ AND `date_modified` = %N ]
						[ AND (`pg_title` LIKE %N OR `pg_content` LIKE %N )]
						",
						array(
									$arr['id'],
									$arr['id_not'],
									$arr['pg_type'],
									$arr['parent_id'],
									$arr['pg_title'],
									$arr['pg_content'],
									$arr['pg_excerpt'],
									$arr['pg_status'],
									$arr['pg_status_not'],
									$arr['comment_status'],
									$arr['pg_order'],
									$arr['author_id'],
									$arr['date_created'],
									$arr['date_modified'],
									$arr['search'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
