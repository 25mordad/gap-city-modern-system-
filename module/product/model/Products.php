<?php

/**
 * Products.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_products
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class Products
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_products` (
				         `id`  , 
                         `group_id`  , 
                         `brand`  , 
                         `name`  , 
                         `text`  , 
                         `model`  , 
                         `price`  , 
                         `quantity`  , 
                         `transport`  , 
                         `p_order`  , 
                         `weight`  , 
                         `dimension`  , 
                         `status`  , 
                         `barcode` 
						) VALUES(
						 NULL  , 
                         %i  , 
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
                         %n  , 
                         %n 
						)", array($arr['group_id'] , $arr['brand'] , $arr['name'] , $arr['text'] , $arr['model'] , $arr['price'] , $arr['quantity'] , $arr['transport'] , $arr['p_order'] , $arr['weight'] , $arr['dimension'] , $arr['status'] , $arr['barcode']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_products` SET
						 `id` =  %i 
                         [ , `group_id` = %I ] 
                         [ , `brand` = %I ] 
                         [ , `name` = %N ] 
                         [ , `text` = %N ] 
                         [ , `model` = %N ] 
                         [ , `price` = %N ] 
                         [ , `quantity` = %N ] 
                         [ , `transport` = %N ] 
                         [ , `p_order` = %N ] 
                         [ , `weight` = %N ] 
                         [ , `dimension` = %N ] 
                         [ , `status` = %N ] 
                         [ , `barcode` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['group_id'] , $arr['brand'] , $arr['name'] , $arr['text'] , $arr['model'] , $arr['price'] , $arr['quantity'] , $arr['transport'] , $arr['p_order'] , $arr['weight'] , $arr['dimension'] , $arr['status'] , $arr['barcode'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_products` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `group_id` = %I ] 
                         [ AND `brand` = %I ] 
                         [ AND `name` = %N ]
                         [ AND `text` = %N ]
                         [ AND `model` = %N ]
                         [ AND `price` = %N ]
                         [ AND `quantity` = %N ]
                         [ AND `transport` = %N ]
                         [ AND `p_order` = %N ]
                         [ AND `weight` = %N ]
                         [ AND `dimension` = %N ]
                         [ AND `status` = %N ]
                         [ AND `barcode` = %N ]
                        [ AND (`name` LIKE %N OR `text` LIKE %N )]
                        [ AND (`model` LIKE %N )]
						[ ORDER BY `%S` ] [ %S ]
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['group_id'] , $arr['brand'] , $arr['name'] , $arr['text'] , $arr['model'] , $arr['price'] ,
                            $arr['quantity'] , $arr['transport'] , $arr['p_order'] , $arr['weight'] , $arr['dimension'] , $arr['status'] ,
                            $arr['barcode'], $arr['search'],$arr['search'],$arr['modelSearch'],
                            $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_products` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `group_id` = %I ] 
                         [ AND `brand` = %I ] 
                         [ AND `name` = %N ]
                         [ AND `text` = %N ]
                         [ AND `model` = %N ]
                         [ AND `price` = %N ]
                         [ AND `quantity` = %N ]
                         [ AND `transport` = %N ]
                         [ AND `p_order` = %N ]
                         [ AND `weight` = %N ]
                         [ AND `dimension` = %N ]
                         [ AND `status` = %N ]
                         [ AND `barcode` = %N ]
                        
						",
						array($arr['id'] , $arr['group_id'] , $arr['brand'] , $arr['name'] , $arr['text'] , $arr['model'] , $arr['price'] , $arr['quantity'] , $arr['transport'] , $arr['p_order'] , $arr['weight'] , $arr['dimension'] , $arr['status'] , $arr['barcode']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_products`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    