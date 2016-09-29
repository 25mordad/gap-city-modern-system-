<?php

/**
 * Supprtext.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_supprtext
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class Supprtext
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_supprtext` (
				         `id`  , 
                         `id_support`  , 
                         `id_user`  , 
                         `text`  , 
                         `date` 
						) VALUES(
						 NULL  , 
                         %i  , 
                         %i  , 
                         %n  , 
                         %n 
						)", array($arr['id_support'] , $arr['id_user'] , $arr['text'] , $arr['date']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_supprtext` SET
						 `id` =  %i 
                         [ , `id_support` = %I ] 
                         [ , `id_user` = %I ] 
                         [ , `text` = %N ] 
                         [ , `date` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_support'] , $arr['id_user'] , $arr['text'] , $arr['date'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_supprtext` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `id_support` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `text` = %N ]
                         [ AND `date` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_support'] , $arr['id_user'] , $arr['text'] , $arr['date'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}
    
    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_supprtext` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `id_support` = %I ] 
                         [ AND `id_user` = %I ] 
                         [ AND `text` = %N ]
                         [ AND `date` = %N ]
                        
						",
						array($arr['id'] , $arr['id_support'] , $arr['id_user'] , $arr['text'] , $arr['date']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_supprtext`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    