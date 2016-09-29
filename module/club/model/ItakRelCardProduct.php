<?php

/**
 * ItakRelCardProduct.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_itak_rel_card_product
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class ItakRelCardProduct
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_itak_rel_card_product` (
				        `id` ,
				        `id_card`,
				   		`id_product`
						) VALUES(
						NULL ,
						%i,
						%i
						)", array($arr['id_card'], $arr['id_product']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_itak_rel_card_product` SET
						`id` =  %i
						[ , `id_card` = %I ]
						[ , `id_product` = %I ]
						WHERE `id` =  %i",
						array($arr['id'], $arr['id_card'], $arr['id_product'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $join_param = "" ,$limit = "")
	{
		$join_query_helper=array();
		if($join_param=="product")
		{
			$join_query_helper['select']=", `gcms_page`.`pg_title`";
			$join_query_helper['join']="INNER JOIN `gcms_page` ON `gcms_itak_rel_card_product`.`id_product` = `gcms_page`.`id`";
		}
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_itak_rel_card_product`.* [ %S ] FROM `gcms_itak_rel_card_product` [ %S ] WHERE TRUE
						[ AND `gcms_itak_rel_card_product`.`id` = %I ]
						[ AND `gcms_itak_rel_card_product`.`id_card` = %I ]
						[ AND `gcms_itak_rel_card_product`.`id_product` = %I ]
						[ ORDER BY `gcms_itak_rel_card_product`.`%S` ] [ %S ]
						[ LIMIT %I ][ , %I ] 
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$arr['id'],
									$arr['id_card'],
									$arr['id_product'],
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
						"SELECT COUNT(*) as Num FROM `gcms_itak_rel_card_product` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `id_card` = %I ]
						[ AND `id_product` = %I ]
						", array($arr['id'], $arr['id_card'], $arr['id_product']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_itak_rel_card_product`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}
}
