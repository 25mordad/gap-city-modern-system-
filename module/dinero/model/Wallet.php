<?php

/**
 * Wallet.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_wallet
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class Wallet
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_wallet` (
				         `id`  , 
                         `id_user`  , 
                         `amount`  , 
                         `currency`  , 
                         `iban`  , 
                         `cardno`  , 
                         `accountholder`  , 
                         `cvv`  , 
                         `expdate`  , 
                         `bankname`  , 
                         `status` 
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
						)", array($arr['id_user'] , $arr['amount'] , $arr['currency'] , $arr['iban'] , $arr['cardno'] , $arr['accountholder'] , $arr['cvv'] , $arr['expdate'] , $arr['bankname'] , $arr['status']));
				return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_wallet` SET
						 `id` =  %i 
                         [ , `id_user` = %I ] 
                         [ , `amount` = %N ] 
                         [ , `currency` = %N ] 
                         [ , `iban` = %N ] 
                         [ , `cardno` = %N ] 
                         [ , `accountholder` = %N ] 
                         [ , `cvv` = %N ] 
                         [ , `expdate` = %N ] 
                         [ , `bankname` = %N ] 
                         [ , `status` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_user'] , $arr['amount'] , $arr['currency'] , $arr['iban'] , $arr['cardno'] , $arr['accountholder'] , $arr['cvv'] , $arr['expdate'] , $arr['bankname'] , $arr['status'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_wallet` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `amount` = %N ]
                         [ AND `currency` = %N ]
                         [ AND `iban` = %N ]
                         [ AND `cardno` = %N ]
                         [ AND `accountholder` = %N ]
                         [ AND `cvv` = %N ]
                         [ AND `expdate` = %N ]
                         [ AND `bankname` = %N ]
                         [ AND `status` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_user'] , $arr['amount'] , $arr['currency'] , $arr['iban'] , $arr['cardno'] , $arr['accountholder'] , $arr['cvv'] , $arr['expdate'] , $arr['bankname'] , $arr['status'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_wallet` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `amount` = %N ]
                         [ AND `currency` = %N ]
                         [ AND `iban` = %N ]
                         [ AND `cardno` = %N ]
                         [ AND `accountholder` = %N ]
                         [ AND `cvv` = %N ]
                         [ AND `expdate` = %N ]
                         [ AND `bankname` = %N ]
                         [ AND `status` = %N ]
                        
						",
						array($arr['id'] , $arr['id_user'] , $arr['amount'] , $arr['currency'] , $arr['iban'] , $arr['cardno'] , $arr['accountholder'] , $arr['cvv'] , $arr['expdate'] , $arr['bankname'] , $arr['status']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_wallet`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    