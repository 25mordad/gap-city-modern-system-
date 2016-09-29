<?php

/**
 * RelImageOther.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_rel_image_other
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class RelImageOther
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_rel_image_other` (
				        `id` ,
				        `image_id`,
				   		`other_id`,
				   		`rel_type`
						) VALUES(
						NULL ,
						%i,
						%i,
						%n
						)", array($arr['image_id'], $arr['other_id'], $arr['rel_type']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_rel_image_other` SET
						`id` =  %i
						[ , `image_id` = %I ]
						[ , `other_id` = %I ]
						[ , `rel_type` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['image_id'],
									$arr['other_id'],
									$arr['rel_type'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "" , $limit)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_rel_image_other` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `image_id` = %I ]
						[ AND `other_id` = %I ]
						[ AND `rel_type` = %N ]
						[ ORDER BY %S ] [ %S ]
                        [ LIMIT %I ][ , %I ]
						",
						array(
									$arr['id'],
									$arr['image_id'],
									$arr['other_id'],
									$arr['rel_type'],
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
						"SELECT COUNT(*) as Num FROM `gcms_rel_image_other` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `image_id` = %I ]
						[ AND `other_id` = %I ]
						[ AND `rel_type` = %N ]
						", array($arr['id'], $arr['image_id'], $arr['other_id'], $arr['rel_type']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_rel_image_other`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
