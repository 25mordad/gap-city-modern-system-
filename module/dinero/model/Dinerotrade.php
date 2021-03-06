<?php

/**
 * Dinerotrade.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_dinerotrade
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class Dinerotrade
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_dinerotrade` (
				         `id`  , 
                         `id_buyer`  , 
                         `id_seller`  , 
                         `id_adv`  , 
                         `amount`  , 
                         `exchange_rate`  , 
                         `time`  , 
                         `trade_status`  , 
                         `buyerpay_status`  , 
                         `sellerpay_status`  , 
                         `buyerpay_details`  , 
                         `sellerpay_details` 
						) VALUES(
						 NULL  , 
                         %i  , 
                         %i  , 
                         %i  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['id_buyer'] , $arr['id_seller'] , $arr['id_adv'] , $arr['amount'] , $arr['exchange_rate'] , $arr['time'] , $arr['trade_status'] , $arr['buyerpay_status'] , $arr['sellerpay_status'] , $arr['buyerpay_details'] , $arr['sellerpay_details']));
		$GLOBALS['GCMS_DB']->query($query);
		return mysql_insert_id();
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_dinerotrade` SET
						 `id` =  %i 
                         [ , `id_buyer` = %I ] 
                         [ , `id_seller` = %I ] 
                         [ , `id_adv` = %I ] 
                         [ , `amount` = %N ] 
                         [ , `exchange_rate` = %N ] 
                         [ , `time` = %N ] 
                         [ , `trade_status` = %N ] 
                         [ , `buyerpay_status` = %N ] 
                         [ , `sellerpay_status` = %N ] 
                         [ , `buyerpay_details` = %N ] 
                         [ , `sellerpay_details` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_buyer'] , $arr['id_seller'] , $arr['id_adv'] , $arr['amount'] , $arr['exchange_rate'] , $arr['time'] , $arr['trade_status'] , $arr['buyerpay_status'] , $arr['sellerpay_status'] , $arr['buyerpay_details'] , $arr['sellerpay_details'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_dinerotrade` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_buyer` = %I ] 
                         [ AND `id_seller` = %I ] 
                         [ AND `id_adv` = %I ] 
                         [ AND `amount` = %N ]
                         [ AND `exchange_rate` = %N ]
                         [ AND `time` = %N ]
                         [ AND `trade_status` = %N ]
                         [ AND `trade_status` != %N ]
                         [ AND `buyerpay_status` = %N ]
                         [ AND `sellerpay_status` = %N ]
                         [ AND `buyerpay_details` = %N ]
                         [ AND `sellerpay_details` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_buyer'] , $arr['id_seller'] , $arr['id_adv'] , $arr['amount'] , $arr['exchange_rate'] , $arr['time'] , $arr['trade_status'], $arr['not_trade_status'] , $arr['buyerpay_status'] , $arr['sellerpay_status'] , $arr['buyerpay_details'] , $arr['sellerpay_details'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_dinerotrade` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_buyer` = %I ] 
                         [ AND `id_seller` = %I ] 
                         [ AND `id_adv` = %I ] 
                         [ AND `amount` = %N ]
                         [ AND `exchange_rate` = %N ]
                         [ AND `time` = %N ]
                         [ AND `trade_status` = %N ]
                         [ AND `buyerpay_status` = %N ]
                         [ AND `sellerpay_status` = %N ]
                         [ AND `buyerpay_details` = %N ]
                         [ AND `sellerpay_details` = %N ]
                        
						",
						array($arr['id'] , $arr['id_buyer'] , $arr['id_seller'] , $arr['id_adv'] , $arr['amount'] , $arr['exchange_rate'] , $arr['time'] , $arr['trade_status'] , $arr['buyerpay_status'] , $arr['sellerpay_status'] , $arr['buyerpay_details'] , $arr['sellerpay_details']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_dinerotrade`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    