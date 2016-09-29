<?php

/**
 * SalamatArea.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_salamat_area
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class SalamatArea
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_salamat_area` (
				         `id`  , 
                         `id_parent`  , 
                         `name` 
						) VALUES(
						 NULL  , 
                         %i  , 
                         %n 
						)", array($arr['id_parent'], $arr['name']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_salamat_area` SET
						 `id` =  %i 
                         [ , `id_parent` = %I ] 
                         [ , `name` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'], $arr['id_parent'], $arr['name'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_salamat_area` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_parent` = %I ] 
                         [ AND `id_parent` != %I ] 
                         [ AND `name` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array(
									$arr['id'],
									$arr['id_parent'],
									$arr['id_parent_not'],
									$arr['name'],
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
						"SELECT COUNT(*) as Num FROM `gcms_salamat_area` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_parent` = %I ] 
                         [ AND `name` = %N ]
                        
						", array($arr['id'], $arr['id_parent'], $arr['name']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_salamat_area`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}
   
    
