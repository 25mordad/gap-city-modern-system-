<?php

/**
 * Comment.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_comment
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class Comment
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_comment` (
				        `id` ,
				        `id_other` ,
				        `cm_type` ,
				        `id_parent` ,
				        `cm_author` ,
				        `cm_email` ,
				        `cm_url` ,
				        `cm_ip` ,
				        `cm_date` ,
				        `cm_content` ,
				        `cm_plus` ,
				        `cm_decrease` ,
				        `cm_status`
						) VALUES(
						NULL ,
						%i,
						%n,
						%i,
						%n,
						%n,
						%n,
						%n,
						%n,
						%n,
						%i,
						%i,
						%n
						)",
						array(
									$arr['id_other'],
									$arr['cm_type'],
									$arr['id_parent'],
									$arr['cm_author'],
									$arr['cm_email'],
									$arr['cm_url'],
									$arr['cm_ip'],
									$arr['cm_date'],
									$arr['cm_content'],
									$arr['cm_plus'],
									$arr['cm_decrease'],
									$arr['cm_status']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_comment` SET
						`id` =  %i
				        [ , `id_other` = %I ]
				        [ , `cm_type` = %N ]
				        [ , `id_parent` = %I ]
				        [ , `cm_author` = %N ]
				        [ , `cm_email` = %N ]
				        [ , `cm_url` = %N ]
				        [ , `cm_ip` = %N ]
				        [ , `cm_date` = %N ]
				        [ , `cm_content` = %N ]
				        [ , `cm_plus` = %I ]
				        [ , `cm_decrease` = %I ]
				        [ , `cm_status` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_other'],
									$arr['cm_type'],
									$arr['id_parent'],
									$arr['cm_author'],
									$arr['cm_email'],
									$arr['cm_url'],
									$arr['cm_ip'],
									$arr['cm_date'],
									$arr['cm_content'],
									$arr['cm_plus'],
									$arr['cm_decrease'],
									$arr['cm_status'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_comment` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `id_other` = %I ]
				        [ AND `cm_type` = %N ]
				        [ AND `id_parent` = %I ]
				        [ AND `cm_author` = %N ]
				        [ AND `cm_email` = %N ]
				        [ AND `cm_url` = %N ]
				        [ AND `cm_ip` = %N ]
				        [ AND `cm_date` = %N ]
				        [ AND `cm_content` = %N ]
				        [ AND `cm_plus` = %I ]
				        [ AND `cm_decrease` = %I ]
				        [ AND `cm_status` = %N ]
				        [ AND `cm_status` != %N ]
						[ AND (`cm_author` LIKE %N OR `cm_content` LIKE %N )]
						[ ORDER BY `%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$arr['id'],
									$arr['id_other'],
									$arr['cm_type'],
									$arr['id_parent'],
									$arr['cm_author'],
									$arr['cm_email'],
									$arr['cm_url'],
									$arr['cm_ip'],
									$arr['cm_date'],
									$arr['cm_content'],
									$arr['cm_plus'],
									$arr['cm_decrease'],
									$arr['cm_status'],
									$arr['cm_status_not'],
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
						"SELECT COUNT(*) as Num FROM `gcms_comment` WHERE TRUE
						[ AND `id` = %I ]
				        [ AND `id_other` = %I ]
				        [ AND `cm_type` = %N ]
				        [ AND `id_parent` = %I ]
				        [ AND `cm_author` = %N ]
				        [ AND `cm_email` = %N ]
				        [ AND `cm_url` = %N ]
				        [ AND `cm_ip` = %N ]
				        [ AND `cm_date` = %N ]
				        [ AND `cm_content` = %N ]
				        [ AND `cm_plus` = %I ]
				        [ AND `cm_decrease` = %I ]
				        [ AND `cm_status` = %N ]
				        [ AND `cm_status` != %N ]
						[ AND (`cm_author` LIKE %N OR `cm_content` LIKE %N )]
						",
						array(
									$arr['id'],
									$arr['id_other'],
									$arr['cm_type'],
									$arr['id_parent'],
									$arr['cm_author'],
									$arr['cm_email'],
									$arr['cm_url'],
									$arr['cm_ip'],
									$arr['cm_date'],
									$arr['cm_content'],
									$arr['cm_plus'],
									$arr['cm_decrease'],
									$arr['cm_status'],
									$arr['cm_status_not'],
									$arr['search'],
									$arr['search']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}
}
