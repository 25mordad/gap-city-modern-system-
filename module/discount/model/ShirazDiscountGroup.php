<?php

/**
 * ShirazDiscountGroup.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_shiraz_discount_group
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class ShirazDiscountGroup
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_shiraz_discount_group` (
				         `id`  , 
                         `name`  , 
                         `city`  , 
                         `status` 
						) VALUES(
						 NULL  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['name'] , $arr['city'] , $arr['status']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_shiraz_discount_group` SET
						 `id` =  %i 
                         [ , `name` = %N ] 
                         [ , `city` = %N ] 
                         [ , `status` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['name'] , $arr['city'] , $arr['status'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_shiraz_discount_group` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `name` = %N ]
                         [ AND `city` = %N ]
                         [ AND `status` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['name'] , $arr['city'] , $arr['status'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_shiraz_discount_group` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `name` = %N ]
                         [ AND `city` = %N ]
                         [ AND `status` = %N ]
                        
						",
						array($arr['id'] , $arr['name'] , $arr['city'] , $arr['status']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_shiraz_discount_group`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    