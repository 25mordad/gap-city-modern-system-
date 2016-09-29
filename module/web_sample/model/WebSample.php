<?php

/**
 * WebSample.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_web_sample
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class WebSample
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_web_sample` (
				        `id` ,
			            `name` ,
			            `url` ,
			            `site_status` ,
			            `activity` , 
			            `active_date` ,
			            `status` 
						) VALUES(
						NULL ,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n
						)",
						array(
									$arr['name'],
									$arr['url'],
									$arr['site_status'],
									$arr['activity'],
									$arr['active_date'],
									$arr['status']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_web_sample` SET
						`id` =  %i 
				        [ , `name` = %N ]
				        [ , `url` = %N ]
				        [ , `site_status` = %N ]
				        [ , `activity` = %N ]
				        [ , `active_date` = %N ]
				        [ , `status` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['name'],
									$arr['url'],
									$arr['site_status'],
									$arr['activity'],
									$arr['active_date'],
									$arr['status'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
	
	
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_web_sample` 
						WHERE TRUE 
						[ AND `gcms_web_sample`.`id` = %I ]
				        [ AND `gcms_web_sample`.`name` = %N ]
				        [ AND `gcms_web_sample`.`url` = %N ]
				        [ AND `gcms_web_sample`.`site_status` = %N ]
				        [ AND `gcms_web_sample`.`activity` = %N ]
				        [ AND `gcms_web_sample`.`active_date` = %N ]
				        [ AND `gcms_web_sample`.`status` = %N ]
						[ AND `gcms_web_sample`.`url` LIKE %N ]
						[ ORDER BY `gcms_web_sample`.`%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$arr['id'],
									$arr['name'],
									$arr['url'],
									$arr['site_status'],
									$arr['activity'],
									$arr['active_date'],
									$arr['status'],
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
						"SELECT COUNT(*) as Num FROM `gcms_web_sample` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `name` = %N ]
				        [ AND `url` = %N ]
				        [ AND `site_status` = %N ]
				        [ AND `activity` = %N ]
				        [ AND `active_date` = %N ]
				        [ AND `status` = %N ]
						[ `url` LIKE %N ]
						",
						array(
									$arr['id'],
									$arr['name'],
									$arr['url'],
									$arr['site_status'],
									$arr['activity'],
									$arr['active_date'],
									$arr['status'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_web_sample`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
