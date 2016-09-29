<?php

/**
 * SalamatVisit.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_salamat_visit
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class SalamatVisit
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_salamat_visit` (
				         `id`  , 
                         `id_info`  , 
                         `day`  , 
                         `az`  , 
                         `ta` 
						) VALUES(
						 NULL  , 
                         %i  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['id_info'] , $arr['day'] , $arr['az'] , $arr['ta']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_salamat_visit` SET
						 `id` =  %i 
                         [ , `id_info` = %I ] 
                         [ , `day` = %N ] 
                         [ , `az` = %N ] 
                         [ , `ta` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_info'] , $arr['day'] , $arr['az'] , $arr['ta'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_salamat_visit` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_info` = %I ] 
                         [ AND `day` = %N ]
                         [ AND `az` = %N ]
                         [ AND `ta` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_info'] , $arr['day'] , $arr['az'] , $arr['ta'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_salamat_visit` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_info` = %I ] 
                         [ AND `day` = %N ]
                         [ AND `az` = %N ]
                         [ AND `ta` = %N ]
                        
						",
						array($arr['id'] , $arr['id_info'] , $arr['day'] , $arr['az'] , $arr['ta']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_salamat_visit`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    