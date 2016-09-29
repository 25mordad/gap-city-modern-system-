<?php

/**
 * ItakCard.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_itak_card
 * 
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class ItakCard
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_itak_card` (
						`id`,
						`id_user`,
						`type`,
						`serial`,
						`code`,
						`status`,
						`rate`,
						`info`,
						`reg_date`,
						`poll_behavior`,
						`poll_txt`,
						`poll_buy_date`
						) VALUES(
						NULL ,
						%i,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n
						)",
						array(
									$arr['id_user'],
									$arr['type'],
									$arr['serial'],
									$arr['code'],
									$arr['status'],
									$arr['rate'],
									$arr['info'],
									$arr['reg_date'],
									$arr['poll_behavior'],
									$arr['poll_txt'],
									$arr['poll_buy_date']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_itak_card` SET
						`id` =  %i
						[ , `id_user` = %I ]
						[ , `type` = %N ]
						[ , `serial` = %N ]
						[ , `code` = %N ]
						[ , `status` = %N ]
						[ , `rate` = %N ]
						[ , `info` = %N ]
						[ , `reg_date` = %N ]
						[ , `poll_behavior` = %N ]
						[ , `poll_txt` = %N ]
						[ , `poll_buy_date` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_user'],
									$arr['type'],
									$arr['serial'],
									$arr['code'],
									$arr['status'],
									$arr['rate'],
									$arr['info'],
									$arr['reg_date'],
									$arr['poll_behavior'],
									$arr['poll_txt'],
									$arr['poll_buy_date'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_itak_card` WHERE TRUE 
						[ AND `id` = %I ]
						[ AND `id_user` = %I ]
						[ AND `type` = %N ]
						[ AND `serial` = %N ]
						[ AND `code` = %N ]
						[ AND `status` = %N ]
						[ AND `rate` = %N ]
						[ AND `info` = %N ]
						[ AND `reg_date` = %N ]
						[ AND `poll_behavior` = %N ]
						[ AND `poll_txt` = %N ]
						[ AND `poll_buy_date` = %N ]
						[ AND `serial` LIKE %N ]
						[ ORDER BY `%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$arr['id'],
									$arr['id_user'],
									$arr['type'],
									$arr['serial'],
									$arr['code'],
									$arr['status'],
									$arr['rate'],
									$arr['info'],
									$arr['reg_date'],
									$arr['poll_behavior'],
									$arr['poll_txt'],
									$arr['poll_buy_date'],
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
						"SELECT COUNT(*) as Num FROM `gcms_itak_card` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_user` = %N ]
						[ AND `type` = %N ]
						[ AND `serial` = %N ]
						[ AND `code` = %N ]
						[ AND `status` = %N ]
						[ AND `rate` = %N ]
						[ AND `info` = %N ]
						[ AND `reg_date` = %N ]
						[ AND `poll_behavior` = %N ]
						[ AND `poll_txt` = %N ]
						[ AND `poll_buy_date` = %N ]
						[ AND `serial` LIKE %N ]
						",
						array(
									$arr['id'],
									$arr['id_user'],
									$arr['type'],
									$arr['serial'],
									$arr['code'],
									$arr['status'],
									$arr['rate'],
									$arr['info'],
									$arr['reg_date'],
									$arr['poll_behavior'],
									$arr['poll_txt'],
									$arr['poll_buy_date'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
