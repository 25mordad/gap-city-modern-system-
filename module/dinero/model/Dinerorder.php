<?php

/**
 * Dinerorder.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_dinerorder
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class Dinerorder
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_dinerorder` (
				         `id`  , 
                         `id_user`  , 
                         `email`  , 
                         `name`  , 
                         `cell`  , 
                         `idnumber`  , 
                         `address`  , 
                         `country`  , 
                         `bankname`  , 
                         `iban`  , 
                         `paymethod`  , 
                         `moneytransfereu`  , 
                         `moneytransfertm`  , 
                         `paymentstatus`  , 
                         `status`  , 
                         `date` 
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
                         %n  , 
                         %n  , 
                         %n  , 
                         %n  , 
                         %n 
						)", array($arr['id_user'] , $arr['email'] , $arr['name'] , $arr['cell'] , $arr['idnumber'] , $arr['address'] , $arr['country'] , $arr['bankname'] , $arr['iban'] , $arr['paymethod'] , $arr['moneytransfereu'] , $arr['moneytransfertm'] , $arr['paymentstatus'] , $arr['status'] , $arr['date']));
				return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_dinerorder` SET
						 `id` =  %i 
                         [ , `id_user` = %I ] 
                         [ , `email` = %N ] 
                         [ , `name` = %N ] 
                         [ , `cell` = %N ] 
                         [ , `idnumber` = %N ] 
                         [ , `address` = %N ] 
                         [ , `country` = %N ] 
                         [ , `bankname` = %N ] 
                         [ , `iban` = %N ] 
                         [ , `paymethod` = %N ] 
                         [ , `moneytransfereu` = %N ] 
                         [ , `moneytransfertm` = %N ] 
                         [ , `paymentstatus` = %N ] 
                         [ , `status` = %N ] 
                         [ , `date` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_user'] , $arr['email'] , $arr['name'] , $arr['cell'] , $arr['idnumber'] , $arr['address'] , $arr['country'] , $arr['bankname'] , $arr['iban'] , $arr['paymethod'] , $arr['moneytransfereu'] , $arr['moneytransfertm'] , $arr['paymentstatus'] , $arr['status'] , $arr['date'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_dinerorder` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `email` = %N ]
                         [ AND `name` = %N ]
                         [ AND `cell` = %N ]
                         [ AND `idnumber` = %N ]
                         [ AND `address` = %N ]
                         [ AND `country` = %N ]
                         [ AND `bankname` = %N ]
                         [ AND `iban` = %N ]
                         [ AND `paymethod` = %N ]
                         [ AND `moneytransfereu` = %N ]
                         [ AND `moneytransfertm` = %N ]
                         [ AND `paymentstatus` = %N ]
                         [ AND `status` = %N ]
                         [ AND `date` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_user'] , $arr['email'] , $arr['name'] , $arr['cell'] , $arr['idnumber'] , $arr['address'] , $arr['country'] , $arr['bankname'] , $arr['iban'] , $arr['paymethod'] , $arr['moneytransfereu'] , $arr['moneytransfertm'] , $arr['paymentstatus'] , $arr['status'] , $arr['date'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_dinerorder` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `email` = %N ]
                         [ AND `name` = %N ]
                         [ AND `cell` = %N ]
                         [ AND `idnumber` = %N ]
                         [ AND `address` = %N ]
                         [ AND `country` = %N ]
                         [ AND `bankname` = %N ]
                         [ AND `iban` = %N ]
                         [ AND `paymethod` = %N ]
                         [ AND `moneytransfereu` = %N ]
                         [ AND `moneytransfertm` = %N ]
                         [ AND `paymentstatus` = %N ]
                         [ AND `status` = %N ]
                         [ AND `date` = %N ]
                        
						",
						array($arr['id'] , $arr['id_user'] , $arr['email'] , $arr['name'] , $arr['cell'] , $arr['idnumber'] , $arr['address'] , $arr['country'] , $arr['bankname'] , $arr['iban'] , $arr['paymethod'] , $arr['moneytransfereu'] , $arr['moneytransfertm'] , $arr['paymentstatus'] , $arr['status'] , $arr['date']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_dinerorder`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    