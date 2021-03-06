<?php

/**
 * SalamatRegister.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_salamat_register
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class SalamatRegister
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_salamat_register` (
				         `id`  , 
                         `code`  , 
                         `id_old_user`  , 
                         `id_new_user`  , 
                         `status`  , 
                         `code_date` 
						) VALUES(
						 NULL  , 
                         %n  , 
                         %i  , 
                         %i  , 
                         %n  , 
                         %n 
						)",
						array(
									$arr['code'],
									$arr['id_old_user'],
									$arr['id_new_user'],
									$arr['status'],
									$arr['code_date']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_salamat_register` SET
						 `id` =  %i 
                         [ , `code` = %N ] 
                         [ , `id_old_user` = %I ] 
                         [ , `id_new_user` = %I ] 
                         [ , `status` = %N ] 
                         [ , `code_date` = %N ] 
                        
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['code'],
									$arr['id_old_user'],
									$arr['id_new_user'],
									$arr['status'],
									$arr['code_date'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_salamat_register` WHERE TRUE
						 [ AND `id` = %I ] 
                         [ AND `code` = %N ]
                         [ AND `id_old_user` = %I ] 
                         [ AND `id_new_user` = %I ] 
                         [ AND `status` = %N ]
                         [ AND `code_date` = %N ]
                        
						[ ORDER BY `%S` ] [ %S ] 
                        [ LIMIT %I ][ , %I ]
						",
						array(
									$arr['id'],
									$arr['code'],
									$arr['id_old_user'],
									$arr['id_new_user'],
									$arr['status'],
									$arr['code_date'],
									$order['by'],
									$order['sort'],
									$limit['start'],
									$limit['end']
						));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

	public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_salamat_register` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `code` = %N ]
                         [ AND `id_old_user` = %I ] 
                         [ AND `id_new_user` = %I ] 
                         [ AND `status` = %N ]
                         [ AND `code_date` = %N ]
                        
						",
						array(
									$arr['id'],
									$arr['code'],
									$arr['id_old_user'],
									$arr['id_new_user'],
									$arr['status'],
									$arr['code_date']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_salamat_register`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}
