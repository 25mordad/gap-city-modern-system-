<?php

/**
 * ProductParam.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_rel_image_other
 *
 * @author 25mordad <25mordad@gmail.com>
 * @version 2.0
 *
 */

class ProductParam
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_product_param` (
				        `id` ,
				        `id_product_group`,
				   		`param_name`,
                        `param_tag`,
				   		`status`
						) VALUES(
						NULL ,
						%i,
						%n,
                        %n,
						%n
						)",
						array(
									$arr['id_product_group'],
									$arr['param_name'],
									$arr['param_tag'],
									$arr['status']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_product_param` SET
						`id` =  %i
						[ , `id_product_group` = %I ]
						[ , `param_name` = %N ]
						[ , `param_tag` = %N ]
                        [ , `status` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_product_group'],
									$arr['param_name'],
									$arr['param_tag'],
									$arr['status'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "")
	{

		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_product_param` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_product_group` = %I ]
						[ AND `param_name` = %N ]
						[ AND `param_tag` = %N ]
                        [ AND `status` = %N ]
				        [ AND `status` != %N ]
						[ ORDER BY `%S` ] [ %S ]
						",
						array(
									$arr['id'],
									$arr['id_product_group'],
									$arr['param_name'],
									$arr['param_tag'],
									$arr['status'],
									$arr['status_not'],
									$order['by'],
									$order['sort']
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
						"SELECT COUNT(*) as Num FROM `gcms_product_param` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_product_group` = %I ]
						[ AND `param_name` = %N ]
						[ AND `param_tag` = %N ]
                        [ AND `status` = %N ]
				        [ AND `status` != %N ]
						",
						array(
									$arr['id'],
									$arr['id_product_group'],
									$arr['param_name'],
									$arr['param_tag'],
									$arr['status'],
									$arr['status_not']
						));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_product_param`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
