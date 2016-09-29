<?php

/**
 * Routing.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_routing
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class Routing
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"INSERT INTO `gcms_routing` (
				`id`  ,
				`url`  ,
				`module`  ,
				`action`  ,
				`action_id`
		) VALUES(
				NULL  ,
				%n  ,
				%n  ,
				%n  ,
				%i
		)", array($arr['url'] , $arr['module'] , $arr['action'] , $arr['action_id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"UPDATE `gcms_routing` SET
				`id` =  %i
				[ , `url` = %N ]
				[ , `module` = %N ]
				[ , `action` = %N ]
				[ , `action_id` = %I ]

				WHERE `id` =  %i",
				array($arr['id'] , $arr['url'] , $arr['module'] , $arr['action'] , $arr['action_id'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"SELECT * FROM `gcms_routing` WHERE TRUE
				[ AND `id` = %I ]
				[ AND `url` = %N ]
				[ AND `module` = %N ]
				[ AND `action` = %N ]
				[ AND `action_id` = %I ]

				[ ORDER BY `%S` ] [ %S ]
				[ LIMIT %I ][ , %I ]
				",
				array($arr['id'] , $arr['url'] , $arr['module'] , $arr['action'] , $arr['action_id'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"SELECT COUNT(*) as Num FROM `gcms_routing` WHERE TRUE
				[ AND `id` = %I ]
				[ AND `url` = %N ]
				[ AND `module` = %N ]
				[ AND `action` = %N ]
				[ AND `action_id` = %I ]

				",
				array($arr['id'] , $arr['url'] , $arr['module'] , $arr['action'] , $arr['action_id']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query("DELETE FROM `gcms_routing`
				WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}
