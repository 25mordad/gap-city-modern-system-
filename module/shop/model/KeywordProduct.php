<?php

/**
 * KeywordProduct.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_keyword_product
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class KeywordProduct
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_keyword_product` (
				         `id`  , 
                         `kw_title` 
						) VALUES(
						 NULL  , 
                         %n 
						)", array($arr['kw_title']));
		return $GLOBALS['GCMS_DB']->query($query);
	}
    
    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_keyword_product` SET
						 `id` =  %i 
                         [ , `kw_title` = %N ] 
                        
						WHERE `id` =  %i",
						array($arr['id'] , $arr['kw_title'], $arr['id']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "", $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			$join_query_helper['select']=", `gcms_rel_keyword_product`.`id` as rel_id";
			$join_query_helper['join']="INNER JOIN `gcms_rel_keyword_product` ON `gcms_keyword_product`.`id` = `gcms_rel_keyword_product`.`key_id`";
			$join_query_helper['where']="AND `gcms_rel_keyword_product`.`product_id` = ";
			$join_query_helper['param']=$join_param;
		}
		
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_keyword_product`.* [ %S ] FROM `gcms_keyword_product` [ %S ] 
						WHERE TRUE
						[ %S ][ %N ]
						[ AND `gcms_keyword_product`.`id` = %I ]
						[ AND `gcms_keyword_product`.`kw_title` = %N ]
						[ AND `gcms_keyword_product`.`kw_title` LIKE %N ]
						[ ORDER BY `%S` ] [ %S ]
						[ LIMIT %I ][ , %I ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['kw_title'],
									$arr['search'],
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
						"SELECT COUNT(*) as Num FROM `gcms_keyword_product` WHERE TRUE
					    [ AND `id` = %I ] 
                         [ AND `kw_title` = %N ]
                        
						",
						array($arr['id'] , $arr['kw_title']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_keyword_product`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}   
    