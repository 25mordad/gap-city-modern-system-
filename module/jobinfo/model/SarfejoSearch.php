<?php

/**
 * SarfejoSearch.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_sarfejo_search
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class SarfejoSearch
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_sarfejo_search` (
				         `id`  , 
                         `search` 
						) VALUES(
						 NULL  , 
                         %n 
						)", array($arr['search']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_sarfejo_search` SET
						 `id` =  %i 
                         [ , `search` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['search'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_sarfejo_search` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `search` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['search'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_sarfejo_search` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `search` = %N ]
                        
						",
						array($arr['id'] , $arr['search']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_sarfejo_search`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    