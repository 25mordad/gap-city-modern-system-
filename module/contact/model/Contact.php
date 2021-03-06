<?php
/**
 * contact.php
 *
 * This file is part of GCMS > MODULE MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: 
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */
require_once(__COREROOT__."/module/contact/model/GroupContact.php");
class Contact
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_contact` (
				        `id` ,
				        `id_group` ,
				        `name` ,
				        `cell` ,
				        `email` ,
				        `status` 
						) VALUES(
						NULL ,
						%i,
						%n,
						%n,
						%n,
						%n
						)",
						array(
									$arr['id_group'],
									$arr['name'],
									$arr['cell'],
									$arr['email'],
									$arr['status']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_contact` SET
						`id` =  %i 
				        [ , `id_group` = %I ]
				        [ , `name` = %N ]
				        [ , `cell` = %N ]
				        [ , `email` = %N ]
				        [ , `status` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_group'],
									$arr['name'],
									$arr['cell'],
									$arr['email'],
									$arr['status'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_contact` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `id_group` = %I ]
				        [ AND `name` = %N ]
				        [ AND `cell` = %N ]
				        [ AND `email` = %N ]
				        [ AND `status` = %N ]
				        [ AND `status` != %N ]
						[ AND (`name` LIKE %N OR `cell` LIKE %N OR `email` LIKE %N )]
						[ ORDER BY `%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$arr['id'],
									$arr['id_group'],
									$arr['name'],
									$arr['cell'],
									$arr['email'],
									$arr['status'],
									$arr['status_not'],
									$arr['search'],
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
						"SELECT COUNT(*) as Num FROM `gcms_contact` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `id_group` = %I ]
				        [ AND `name` = %N ]
				        [ AND `cell` = %N ]
				        [ AND `email` = %N ]
				        [ AND `status` = %N ]
				        [ AND `status` != %N ]
						[ AND (`name` LIKE %N OR `cell` LIKE %N OR `email` LIKE %N )]
						",
						array(
									$arr['id'],
									$arr['id_group'],
									$arr['name'],
									$arr['cell'],
									$arr['email'],
									$arr['status'],
									$arr['status_not'],
									$arr['search'],
									$arr['search'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}