<?php

/**
 * KhodroModel.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_khodro_model
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class KhodroModel
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_khodro_model` (
				         `id`  , 
                         `id_brand`  , 
                         `model_name`  , 
                         `min_year`  , 
                         `max_year`  , 
                         `year_type`  , 
                         `auto_gear`  , 
                         `two_some`  , 
                         `min_fee`  , 
                         `max_fee`  , 
                         `model_status` 
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
                         %n 
						)", array($arr['id_brand'] , $arr['model_name'] , $arr['min_year'] , $arr['max_year'] , $arr['year_type'] , $arr['auto_gear'] , $arr['two_some'] , $arr['min_fee'] , $arr['max_fee'] , $arr['model_status']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_khodro_model` SET
						 `id` =  %i 
                         [ , `id_brand` = %I ] 
                         [ , `model_name` = %N ] 
                         [ , `min_year` = %N ] 
                         [ , `max_year` = %N ] 
                         [ , `year_type` = %N ] 
                         [ , `auto_gear` = %N ] 
                         [ , `two_some` = %N ] 
                         [ , `min_fee` = %N ] 
                         [ , `max_fee` = %N ] 
                         [ , `model_status` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_brand'] , $arr['model_name'] , $arr['min_year'] , $arr['max_year'] , $arr['year_type'] , $arr['auto_gear'] , $arr['two_some'] , $arr['min_fee'] , $arr['max_fee'] , $arr['model_status'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_khodro_model` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_brand` = %I ] 
                         [ AND `model_name` = %N ]
                         [ AND `min_year` = %N ]
                         [ AND `max_year` = %N ]
                         [ AND `year_type` = %N ]
                         [ AND `auto_gear` = %N ]
                         [ AND `two_some` = %N ]
                         [ AND `min_fee` = %N ]
                         [ AND `max_fee` = %N ]
                         [ AND `model_status` = %N ]
                        [ AND (`gcms_khodro_model`.`model_name` LIKE %N )]
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_brand'] , $arr['model_name'] , $arr['min_year'] , $arr['max_year'] , $arr['year_type'] , $arr['auto_gear'] , $arr['two_some'] , $arr['min_fee'] , $arr['max_fee'] , $arr['model_status'], $arr['search'],$order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_khodro_model` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_brand` = %I ] 
                         [ AND `model_name` = %N ]
                         [ AND `min_year` = %N ]
                         [ AND `max_year` = %N ]
                         [ AND `year_type` = %N ]
                         [ AND `auto_gear` = %N ]
                         [ AND `two_some` = %N ]
                         [ AND `min_fee` = %N ]
                         [ AND `max_fee` = %N ]
                         [ AND `model_status` = %N ]
                        [ AND (`gcms_khodro_model`.`model_name` LIKE %N )]
						",
						array($arr['id'] , $arr['id_brand'] , $arr['model_name'] , $arr['min_year'] , $arr['max_year'] , $arr['year_type'] , $arr['auto_gear'] , $arr['two_some'] , $arr['min_fee'] , $arr['max_fee'] , $arr['model_status']
                        , $arr['search']
                        ));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_khodro_model`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    