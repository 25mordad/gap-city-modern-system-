<?php

/**
 * SarfejoJobparam.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_sarfejo_jobparam
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class SarfejoJobparam
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_sarfejo_jobparam` (
				         `id`  ,
						 `id_group`  , 
                         `en_name`  , 
                         `fa_name`  , 
                         `type`  , 
                         `status` 
						) VALUES(
						 NULL  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['id_group'], $arr['en_name'] , $arr['fa_name'] , $arr['type'] , $arr['status']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_sarfejo_jobparam` SET
						 `id` =  %i
						 [ , `id_group` = %I ] 
                         [ , `en_name` = %N ] 
                         [ , `fa_name` = %N ] 
                         [ , `type` = %N ] 
                         [ , `status` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_group'], $arr['en_name'] , $arr['fa_name'] , $arr['type'] , $arr['status'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_sarfejo_jobparam` WHERE TRUE
						 [ AND `id` = %I ] 
						 [ AND `id_group` = %I ]
                         [ AND `en_name` = %N ]
                         [ AND `fa_name` = %N ]
                         [ AND `type` = %N ]
                         [ AND `status` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_group'], $arr['en_name'] , $arr['fa_name'] , $arr['type'] , $arr['status'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_sarfejo_jobparam` WHERE TRUE
					    [ AND `id` = %I ] 
						 [ AND `id_group` = %I ]
                         [ AND `en_name` = %N ]
                         [ AND `fa_name` = %N ]
                         [ AND `type` = %N ]
                         [ AND `status` = %N ]
                        
						",
						array($arr['id'] , $arr['id_group'], $arr['en_name'] , $arr['fa_name'] , $arr['type'] , $arr['status']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_sarfejo_jobparam`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    