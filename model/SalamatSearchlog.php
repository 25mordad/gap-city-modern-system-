<?php

/**
 * SalamatSearchlog.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_salamat_searchlog
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class SalamatSearchlog
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_salamat_searchlog` (
				         `id`  , 
                         `id_user`  , 
                         `text`  , 
                         `type`  , 
                         `date` 
						) VALUES(
						 NULL  , 
                         %i  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['id_user'], $arr['text'], $arr['type'], $arr['date']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_salamat_searchlog` SET
						 `id` =  %i 
                         [ , `id_user` = %I ] 
                         [ , `text` = %N ] 
                         [ , `type` = %N ] 
                         [ , `date` = %N ] 
                        
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_user'],
									$arr['text'],
									$arr['type'],
									$arr['date'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_salamat_searchlog` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `text` = %N ]
                         [ AND `type` = %N ]
                         [ AND `date` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array(
									$arr['id'],
									$arr['id_user'],
									$arr['text'],
									$arr['type'],
									$arr['date'],
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
						"SELECT COUNT(*) as Num FROM `gcms_salamat_searchlog` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `text` = %N ]
                         [ AND `type` = %N ]
                         [ AND `date` = %N ]
                        
						",
						array($arr['id'], $arr['id_user'], $arr['text'], $arr['type'], $arr['date']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_salamat_searchlog`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}
   
    
