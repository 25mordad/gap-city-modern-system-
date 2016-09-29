<?php

/**
 * ShopFactor.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_shop_factor
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class ShopFactor
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_shop_factor` (
				         `id`  , 
                         `id_user`  , 
                         `address`  , 
                         `zipcode`  , 
                         `name`  , 
                         `text`  , 
                         `status_pay`  , 
                         `status`  , 
                         `date`  , 
                         `fee`  , 
                         `distinct`  , 
                         `delivery` 
						) VALUES(
						 NULL  , 
                         %i  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['id_user'] , $arr['address'] , $arr['zipcode'] , $arr['name'] , $arr['text'] , $arr['status_pay'] , $arr['status'] , $arr['date'] , $arr['fee'] , $arr['distinct'] , $arr['delivery']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_shop_factor` SET
						 `id` =  %i 
                         [ , `id_user` = %I ] 
                         [ , `address` = %N ] 
                         [ , `zipcode` = %N ] 
                         [ , `name` = %N ] 
                         [ , `text` = %N ] 
                         [ , `status_pay` = %N ] 
                         [ , `status` = %N ] 
                         [ , `date` = %N ] 
                         [ , `fee` = %N ] 
                         [ , `distinct` = %N ] 
                         [ , `delivery` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_user'] , $arr['address'] , $arr['zipcode'] , $arr['name'] , $arr['text'] , $arr['status_pay'] , $arr['status'] , $arr['date'] , $arr['fee'] , $arr['distinct'] , $arr['delivery'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_shop_factor` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `address` = %N ]
                         [ AND `zipcode` = %N ]
                         [ AND `name` = %N ]
                         [ AND `text` = %N ]
                         [ AND `status_pay` = %N ]
                         [ AND `status` = %N ]
                         [ AND `date` = %N ]
                         [ AND `fee` = %N ]
                         [ AND `distinct` = %N ]
                         [ AND `delivery` = %N ]
                        [ AND (`address` LIKE %N OR `name` LIKE %N OR `text` LIKE %N )]

						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_user'] , $arr['address'] , $arr['zipcode'] , $arr['name'] , $arr['text'] , $arr['status_pay'] , $arr['status'] , $arr['date'] , $arr['fee'] , $arr['distinct'] , $arr['delivery'],
                            $arr['search'],
                            $arr['search'],
                            $arr['search'],
                            $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		//echo $query;
        if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_shop_factor` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `address` = %N ]
                         [ AND `zipcode` = %N ]
                         [ AND `name` = %N ]
                         [ AND `text` = %N ]
                         [ AND `status_pay` = %N ]
                         [ AND `status` = %N ]
                         [ AND `date` = %N ]
                         [ AND `fee` = %N ]
                         [ AND `distinct` = %N ]
                         [ AND `delivery` = %N ]
                        
						",
						array($arr['id'] , $arr['id_user'] , $arr['address'] , $arr['zipcode'] , $arr['name'] , $arr['text'] , $arr['status_pay'] , $arr['status'] , $arr['date'] , $arr['fee'] , $arr['distinct'] , $arr['delivery']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_shop_factor`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    