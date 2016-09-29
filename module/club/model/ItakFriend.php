<?php

/**
 * ItakFriend.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_itak_friend
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class ItakFriend
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_itak_friend` (
				        `id` ,
				        `id_user_refrence` ,
				        `id_friend` ,
				        `friend_reg_date`,
				        `friend_buy_date`
						) VALUES(
						NULL ,
						%i,
						%i,
						%n,
						%n
						)",
						array(
									$arr['id_user_refrence'],
									$arr['id_friend'],
									$arr['friend_reg_date'],
									$arr['friend_buy_date']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_itak_friend` SET
						`id` =  %i
						[ , `id_user_refrence` = %I ]
						[ , `id_friend` = %I ]
						[ , `friend_reg_date` = %N ]
						[ , `friend_buy_date` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_user_refrence'],
									$arr['id_friend'],
									$arr['friend_reg_date'],
									$arr['friend_buy_date'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			$join_query_helper['select']=", `gcms_itak_user`.`name`";
			if($join_param=="referrer")
				$join_query_helper['join']="INNER JOIN `gcms_itak_user` ON `gcms_itak_friend`.`id_user_refrence` = `gcms_itak_user`.`id`";
			else if($join_param=="friend")
				$join_query_helper['join']="INNER JOIN `gcms_itak_user` ON `gcms_itak_friend`.`id_friend` = `gcms_itak_user`.`id`";
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_itak_friend`.* [ %S ] FROM `gcms_itak_friend` [ %S ] WHERE TRUE
						[ AND `gcms_itak_friend`.`id` = %I ]
						[ AND `gcms_itak_friend`.`id_user_refrence` = %I ]
						[ AND `gcms_itak_friend`.`id_friend` = %I ]
						[ AND `gcms_itak_friend`.`friend_reg_date` = %N ]
						[ AND `gcms_itak_friend`.`friend_buy_date` = %N ]
						[ ORDER BY `gcms_itak_friend`.`%S` ] [ %S ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$arr['id'],
									$arr['id_user_refrence'],
									$arr['id_friend'],
									$arr['friend_reg_date'],
									$arr['friend_buy_date'],
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
						"SELECT COUNT(*) as Num FROM `gcms_itak_friend` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_user_refrence` = %I ]
						[ AND `id_friend` = %I ]
						[ AND `friend_reg_date` = %N ]
						[ AND `friend_buy_date` = %N ]
						",
						array(
									$arr['id'],
									$arr['id_user_refrence'],
									$arr['id_friend'],
									$arr['friend_reg_date'],
									$arr['friend_buy_date']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
