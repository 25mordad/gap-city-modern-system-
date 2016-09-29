<?php

/**
 * KhodroTip.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_khodro_tip
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class KhodroTip
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_khodro_tip` (
				         `id`  , 
                         `id_brand`  , 
                         `id_model`  , 
                         `tip_name`  , 
                         `tip_form`  , 
                         `tip_status` 
						) VALUES(
						 NULL  , 
                         %i  , 
                         %i  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['id_brand'] , $arr['id_model'] , $arr['tip_name'] , $arr['tip_form'] , $arr['tip_status']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_khodro_tip` SET
						 `id` =  %i 
                         [ , `id_brand` = %I ] 
                         [ , `id_model` = %I ] 
                         [ , `tip_name` = %N ] 
                         [ , `tip_form` = %N ] 
                         [ , `tip_status` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_brand'] , $arr['id_model'] , $arr['tip_name'] , $arr['tip_form'] , $arr['tip_status'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_khodro_tip` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_brand` = %I ] 
                         [ AND `id_model` = %I ] 
                         [ AND `tip_name` = %N ]
                         [ AND `tip_form` = %N ]
                         [ AND `tip_status` = %N ]
                        [ AND (`gcms_khodro_tip`.`tip_name` LIKE %N )]
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_brand'] , $arr['id_model'] , $arr['tip_name'] , $arr['tip_form'] , $arr['tip_status'], $arr['search'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_khodro_tip` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_brand` = %I ] 
                         [ AND `id_model` = %I ] 
                         [ AND `tip_name` = %N ]
                         [ AND `tip_form` = %N ]
                         [ AND `tip_status` = %N ]
                        
						",
						array($arr['id'] , $arr['id_brand'] , $arr['id_model'] , $arr['tip_name'] , $arr['tip_form'] , $arr['tip_status']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_khodro_tip`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    