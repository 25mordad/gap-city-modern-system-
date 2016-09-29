<?php

/**
 * Domains.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_domains
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class Domains
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_domains` (
				        `id` ,
				        `id_contract` ,
				        `domain_name` ,
				        `domain_exp`
						) VALUES(
						NULL ,
						%i,
						%n,
						%n
						)",
						array($arr['id_contract'], $arr['domain_name'], $arr['domain_exp']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_domains` SET
						`id` =  %i
						[ , `id_contract` = %I ]
						[ , `domain_name` = %N ]
						[ , `domain_exp` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_contract'],
									$arr['domain_name'],
									$arr['domain_exp'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{


		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_domains` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_contract` = %I ]
						[ AND `domain_name` = %N ]
						[ AND `domain_exp`  = %N ]
						[ AND (`domain_name` LIKE %N )]
						[ ORDER BY `%S` ] [ %S ]
						[ LIMIT %I ][ , %I ]
						",
						array(

									$arr['id'],
									$arr['id_contract'],
									$arr['domain_name'],
									$arr['domain_exp'],
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
						"SELECT COUNT(*) as Num FROM `gcms_domains` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_contract` = %I ]
						[ AND `domain_name` = %N ]
						[ AND `domain_exp` = %N ]
						", array($arr['id'], $arr['id_contract'], $arr['domain_name'], $arr['domain_exp']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
    public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_domains`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
