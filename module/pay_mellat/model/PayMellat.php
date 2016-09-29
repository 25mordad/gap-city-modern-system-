<?php

/**
 * PayMellat.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_pay_mellat
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class PayMellat
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_pay_mellat` (
				        `id` ,
						`id_user` ,
						`amount` ,
						`txt` ,
						`date` ,
						`bank_info` ,
						`status`
						) VALUES(
						NULL ,
						%i,
						%i,
						%n,
						%n,
						%n,
						%n
						)",
						array(
									$arr['id_user'],
									$arr['amount'],
									$arr['txt'],
									$arr['date'],
									$arr['bank_info'],
									$arr['status']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_pay_mellat` SET
						`id` =  %i
				        [ , `id_user` = %I ]
				        [ , `amount` = %I ]
				        [ , `txt` = %N ]
				        [ , `date` = %N ]
				        [ , `bank_info` = %N ]
				        [ , `status` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_user'],
									$arr['amount'],
									$arr['txt'],
									$arr['date'],
									$arr['bank_info'],
									$arr['status'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "", $join_param = "")
	{
		$join_query_helper=array();
		$join_query_helper['select']=", `gcms_user`.`username`";
		$join_query_helper['join']="INNER JOIN `gcms_user` ON `gcms_user`.`id` = `gcms_pay_mellat`.`id_user`";
		if($join_param!=NULL)
		{
			$join_query_helper['where']="AND `gcms_user`.`username` LIKE ";
			$join_query_helper['param']=$join_param;
		}

		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_pay_mellat`.* [ %S ] FROM `gcms_pay_mellat` [ %S ]
						WHERE TRUE
						[ %S ][ %N ]
						[ AND `gcms_pay_mellat`.`id` = %I ]
				        [ AND `gcms_pay_mellat`.`id_user` = %I ]
				        [ AND `gcms_pay_mellat`.`amount` = %I ]
				        [ AND `gcms_pay_mellat`.`txt` = %N ]
				        [ AND `gcms_pay_mellat`.`date` = %N ]
				        [ AND `gcms_pay_mellat`.`bank_info` = %N ]
				        [ AND `gcms_pay_mellat`.`status` = %N ]
				        [ AND `gcms_pay_mellat`.`status` != %N ]
						[ AND (`gcms_pay_mellat`.`txt` LIKE %N OR `gcms_pay_mellat`.`bank_info` LIKE %N )]
						[ ORDER BY `gcms_pay_mellat`.`%S` ] [ %S ]
						[ LIMIT %I ][ , %I ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['id_user'],
									$arr['amount'],
									$arr['txt'],
									$arr['date'],
									$arr['bank_info'],
									$arr['status'],
									$arr['status_not'],
									$arr['search'],
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

	public function get_count($arr, $join_param = "")
	{
		$join_query_helper=array();
		$join_query_helper['join']="INNER JOIN `gcms_user` ON `gcms_user`.`id` = `gcms_pay_mellat`.`id_user`";
		if($join_param!=NULL)
		{
			$join_query_helper['where']="AND `gcms_user`.`username` LIKE ";
			$join_query_helper['param']=$join_param;
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_pay_mellat` [ %S ]
						WHERE TRUE
						[ %S ][ %N ]
						[ AND `gcms_pay_mellat`.`id` = %I ]
				        [ AND `gcms_pay_mellat`.`id_user` = %I ]
				        [ AND `gcms_pay_mellat`.`amount` = %I ]
				        [ AND `gcms_pay_mellat`.`txt` = %N ]
				        [ AND `gcms_pay_mellat`.`date` = %N ]
				        [ AND `gcms_pay_mellat`.`bank_info` = %N ]
				        [ AND `gcms_pay_mellat`.`status` = %N ]
				        [ AND `gcms_pay_mellat`.`status` != %N ]
						[ AND (`gcms_pay_mellat`.`txt` LIKE %N OR `gcms_pay_mellat`.`bank_info` LIKE %N )]
						",
						array(
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['id_user'],
									$arr['amount'],
									$arr['txt'],
									$arr['date'],
									$arr['bank_info'],
									$arr['status'],
									$arr['status_not'],
									$arr['search'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query("DELETE FROM `gcms_pay_mellat`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get_sum_amount($id_user)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
		->query(" SELECT SUM(amount) as Sum  FROM `gcms_pay_mellat` as pm WHERE
				[  `pm`.`id_user` = %I ]
				AND pm.`status`='confirm'
				", array($id_user));

		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Sum;
	}
}
