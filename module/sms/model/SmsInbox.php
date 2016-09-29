<?php

/**
 * SmsInbox.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_sms_inbox
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class SmsInbox
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_sms_inbox` (
				        `id` ,
			            `id_afe` ,
			            `text` ,
			            `cell_no` ,
			            `date` 
						) VALUES(
						NULL ,
						%i,
						%n,
						%n,
						%n
						)",
						array($arr['id_afe'], $arr['text'], $arr['cell_no'], $arr['date']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_sms_inbox` SET
						`id` =  %i 
				        [ , `id_afe` = %I ]
				        [ , `text` = %N ]
				        [ , `cell_no` = %N ]
				        [ , `date` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_afe'],
									$arr['text'],
									$arr['cell_no'],
									$arr['date'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "", $join = false)
	{
		$join_query_helper=array();
		if($join)
		{
			$join_query_helper['select']=", `gcms_contact`.`id` as contact_id, `gcms_contact`.`name`";
			$join_query_helper['join']="INNER JOIN `gcms_contact` ON `gcms_sms_inbox`.`cell_no` = `gcms_contact`.`cell`";
			$join_query_helper['where']="AND `gcms_contact`.`status` = ";
			$join_query_helper['param']="active";
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_sms_inbox`.* [ %S ] FROM `gcms_sms_inbox` [ %S ] 
						WHERE TRUE
						[ %S ][ %N ]
						[ AND `gcms_sms_inbox`.`id` = %I ]
				        [ AND `gcms_sms_inbox`.`id_afe` = %I ]
				        [ AND `gcms_sms_inbox`.`text` = %N ]
				        [ AND `gcms_sms_inbox`.`cell_no` = %N ]
				        [ AND `gcms_sms_inbox`.`date` = %N ]
						[ AND (`gcms_sms_inbox`.`cell_no` LIKE %N OR `gcms_sms_inbox`.`text` LIKE %N )]
						[ ORDER BY `gcms_sms_inbox`.`%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['id_afe'],
									$arr['text'],
									$arr['cell_no'],
									$arr['date'],
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

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_sms_inbox` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `id_afe` = %I ]
				        [ AND `text` = %N ]
				        [ AND `cell_no` = %N ]
				        [ AND `date` = %N ]
						[ AND (`cell_no` LIKE %N OR `text` LIKE %N )]
						",
						array(
									$arr['id'],
									$arr['id_afe'],
									$arr['text'],
									$arr['cell_no'],
									$arr['date'],
									$arr['search'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_sms_inbox`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
