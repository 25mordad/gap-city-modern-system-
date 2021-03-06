<?php

/**
 * Costs.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_costs
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class Costs
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_costs` (
				         `id`  , 
                         `title`  , 
                         `type`  , 
                         `fee`  , 
                         `txt`  , 
                         `date`  , 
                         `regdate`  , 
                         `id_author` 
						) VALUES(
						 NULL  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %i 
						)", array($arr['title'] , $arr['type'] , $arr['fee'] , $arr['txt'] , $arr['date'] , $arr['regdate'] , $arr['id_author']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_costs` SET
						 `id` =  %i 
                         [ , `title` = %N ] 
                         [ , `type` = %N ] 
                         [ , `fee` = %N ] 
                         [ , `txt` = %N ] 
                         [ , `date` = %N ] 
                         [ , `regdate` = %N ] 
                         [ , `id_author` = %I ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['title'] , $arr['type'] , $arr['fee'] , $arr['txt'] , $arr['date'] , $arr['regdate'] , $arr['id_author'],$arr['id'] ));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_costs` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `title` = %N ]
                         [ AND `type` = %N ]
                         [ AND `fee` = %N ]
                         [ AND `txt` = %N ]
                         [ AND `date` = %N ]
                         [ AND `regdate` = %N ]
                         [ AND `id_author` = %I ] 
                        [ AND (`title` LIKE %N OR `txt` LIKE %N )]
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['title'] , $arr['type'] , $arr['fee'] , $arr['txt'] , $arr['date'] , $arr['regdate'] , $arr['id_author']
								,$arr['search'],
								$arr['search']
								, $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_costs` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `title` = %N ]
                         [ AND `type` = %N ]
                         [ AND `fee` = %N ]
                         [ AND `txt` = %N ]
                         [ AND `date` = %N ]
                         [ AND `regdate` = %N ]
                         [ AND `id_author` = %I ] 
                        [ AND (`title` LIKE %N OR `txt` LIKE %N )]
						",
						array($arr['id'] , $arr['title'] , $arr['type'] , $arr['fee'] , $arr['txt'] , $arr['date'] , $arr['regdate'] , $arr['id_author'])
						,$arr['search'],
						$arr['search']
						);
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_costs`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    