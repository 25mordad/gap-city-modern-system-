<?php

/**
 * ShopFcrelpro.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_shop_fcrelpro
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class ShopFcrelpro
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_shop_fcrelpro` (
				         `id`  , 
                         `id_shop_factor`  , 
                         `name`  , 
                         `fee`  , 
                         `number`  , 
                         `distinct` 
						) VALUES(
						 NULL  , 
                         %i  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['id_shop_factor'] , $arr['name'] , $arr['fee'] , $arr['number'] , $arr['distinct']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_shop_fcrelpro` SET
						 `id` =  %i 
                         [ , `id_shop_factor` = %I ] 
                         [ , `name` = %N ] 
                         [ , `fee` = %N ] 
                         [ , `number` = %N ] 
                         [ , `distinct` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_shop_factor'] , $arr['name'] , $arr['fee'] , $arr['number'] , $arr['distinct'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_shop_fcrelpro` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_shop_factor` = %I ] 
                         [ AND `name` = %N ]
                         [ AND `fee` = %N ]
                         [ AND `number` = %N ]
                         [ AND `distinct` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_shop_factor'] , $arr['name'] , $arr['fee'] , $arr['number'] , $arr['distinct'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_shop_fcrelpro` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_shop_factor` = %I ] 
                         [ AND `name` = %N ]
                         [ AND `fee` = %N ]
                         [ AND `number` = %N ]
                         [ AND `distinct` = %N ]
                        
						",
						array($arr['id'] , $arr['id_shop_factor'] , $arr['name'] , $arr['fee'] , $arr['number'] , $arr['distinct']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_shop_fcrelpro`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    