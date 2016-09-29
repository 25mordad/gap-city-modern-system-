<?php

/**
 * RelProParam.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_rel_image_other
 *
 * @author 25mordad <25mordad@gmail.com>
 * @version 2.0
 *
 */

class RelProParam
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_rel_pro_param` (
				        `id` ,
				        `id_product`,
				   		`id_param`,
				   		`value`
						) VALUES(
						NULL ,
						%i,
						%i,
						%n
						)", array($arr['id_product'], $arr['id_param'], $arr['value']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_rel_pro_param` SET
						`id` =  %i
						[ , `id_product` = %I ]
						[ , `id_param` = %I ]
						[ , `value` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['id_product'],
									$arr['id_param'],
									$arr['value'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $join_param = "",$groupby="")
	{
		$join_query_helper=array();
		if($join_param=="param")
		{
			$join_query_helper['select']=", `gcms_product_param`.`param_name`, `gcms_product_param`.`param_tag`  , `gcms_product_param`.`status` , `gcms_product_param`.`id_product_group` ";
			$join_query_helper['join']="INNER JOIN `gcms_product_param` ON `gcms_rel_pro_param`.`id_param` = `gcms_product_param`.`id`";
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_rel_pro_param`.* [ %S ] FROM `gcms_rel_pro_param` [ %S ] WHERE TRUE
						[ AND `gcms_rel_pro_param`.`id` = %I ]
						[ AND `gcms_rel_pro_param`.`id_product` = %I ]
						[ AND `gcms_rel_pro_param`.`id_param` = %I ]
						[ AND `gcms_rel_pro_param`.`value` = %N ]
						[ AND `gcms_product_param`.`id_product_group` = %I ]
						[ AND `gcms_product_param`.`param_tag` = %N ]
						[ GROUP BY `gcms_rel_pro_param`.`%S` ]
						[ ORDER BY `gcms_rel_pro_param`.`%S` ] [ %S ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$arr['id'],
									$arr['id_product'],
									$arr['id_param'],
									$arr['value'],
                                    $arr['id_product_group'],
                                    $arr['param_tag'],
									$groupby,
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
						"SELECT COUNT(*) as Num FROM `gcms_rel_pro_param` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_product` = %I ]
						[ AND `id_param` = %I ]
						[ AND `value` = %N ]
						", array($arr['id'], $arr['id_product'], $arr['id_param'], $arr['value']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_rel_pro_param`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
