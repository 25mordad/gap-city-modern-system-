<?php

/**
 * Shirazpay.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_shirazpay
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class Shirazpay
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_shirazpay` (
				         `id`  , 
                         `id_user`  , 
                         `amount`  , 
                         `txt`  , 
                         `date`  , 
                         `bank_info`  , 
                         `status` 
						) VALUES(
						 NULL  , 
                         %i  , 
                         %i  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['id_user'] , $arr['amount'] , $arr['txt'] , $arr['date'] , $arr['bank_info'] , $arr['status']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_shirazpay` SET
						 `id` =  %i 
                         [ , `id_user` = %I ] 
                         [ , `amount` = %I ] 
                         [ , `txt` = %N ] 
                         [ , `date` = %N ] 
                         [ , `bank_info` = %N ] 
                         [ , `status` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_user'] , $arr['amount'] , $arr['txt'] , $arr['date'] , $arr['bank_info'] , $arr['status'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_shirazpay` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `amount` = %I ] 
                         [ AND `txt` = %N ]
                         [ AND `date` = %N ]
                         [ AND `bank_info` = %N ]
                         [ AND `status` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_user'] , $arr['amount'] , $arr['txt'] , $arr['date'] , $arr['bank_info'] , $arr['status'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_shirazpay` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `amount` = %I ] 
                         [ AND `txt` = %N ]
                         [ AND `date` = %N ]
                         [ AND `bank_info` = %N ]
                         [ AND `status` = %N ]
                        
						",
						array($arr['id'] , $arr['id_user'] , $arr['amount'] , $arr['txt'] , $arr['date'] , $arr['bank_info'] , $arr['status']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_shirazpay`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    