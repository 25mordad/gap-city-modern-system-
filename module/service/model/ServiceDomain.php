<?php

/**
 * ServiceDomain.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_service_domain
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class ServiceDomain
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"INSERT INTO `gcms_service_domain` (
				`id`  ,
				`id_user`  ,
				`title`  ,
				`register_date`  ,
				`expire_date`  ,
				`status`
		) VALUES(
				NULL  ,
				%i  ,
				%n  ,
				%n  ,
				%n  ,
				%n
		)", array($arr['id_user'] , $arr['title'] , $arr['register_date'] , $arr['expire_date'] , $arr['status']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"UPDATE `gcms_service_domain` SET
				`id` =  %i
				[ , `id_user` = %I ]
				[ , `title` = %N ]
				[ , `register_date` = %N ]
				[ , `expire_date` = %N ]
				[ , `status` = %N ]

				WHERE `id` =  %i",
				array($arr['id'] , $arr['id_user'] , $arr['title'] , $arr['register_date'] , $arr['expire_date'] , $arr['status'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"SELECT * FROM `gcms_service_domain` WHERE TRUE
				[ AND `id` = %I ]
				[ AND `id_user` = %I ]
				[ AND `title` = %N ]
				[ AND `register_date` = %N ]
				[ AND `expire_date` = %N ]
				[ AND `status` = %N ]
				[ AND `title` LIKE %N ]

				[ ORDER BY `%S` ] [ %S ]
				[ LIMIT %I ][ , %I ]
				",
				array($arr['id'] , $arr['id_user'] , $arr['title'] , $arr['register_date'] , $arr['expire_date'] , $arr['status'], $arr['search'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(
				"SELECT COUNT(*) as Num FROM `gcms_service_domain` WHERE TRUE
				[ AND `id` = %I ]
				[ AND `id_user` = %I ]
				[ AND `title` = %N ]
				[ AND `register_date` = %N ]
				[ AND `expire_date` = %N ]
				[ AND `status` = %N ]
				[ AND `title` LIKE %N ]

				",
				array($arr['id'] , $arr['id_user'] , $arr['title'] , $arr['register_date'] , $arr['expire_date'] , $arr['status'], $arr['search']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query("DELETE FROM `gcms_service_domain`
				WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}