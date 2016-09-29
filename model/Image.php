<?php

/**
 * Image.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_image
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

class Image
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_image` (
				        `id` ,
				        `im_name` ,
				        `im_path` ,
				        `im_type`
						) VALUES(
						NULL ,
						%n,
						%n,
						%n
						)", array($arr['im_name'], $arr['im_path'], $arr['im_type']));
		if ($GLOBALS['GCMS_DB']->query($query)){
			return $GLOBALS['GCMS_DB']->insert_id;
		}else{
			return 0;
		}
	}

	public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_image` SET
						`id` =  %i
						[ , `im_name` = %N ]
						[ , `im_path` = %N ]
						[ , `im_type` = %N ]
						WHERE `id` =  %i",
						array(
									$arr['id'],
									$arr['im_name'],
									$arr['im_path'],
									$arr['im_type'],
									$arr['id']
						));
		return $GLOBALS['GCMS_DB']->query($query);
	}

	public function get($arr, $list = false, $order = "", $join_param = "")
	{
		$join_query_helper=array();
		if($join_param!=NULL)
		{
			$join_query_helper['select']=", `gcms_rel_image_other`.`id` as rel_id";
			$join_query_helper['join']="INNER JOIN `gcms_rel_image_other` ON `gcms_image`.`id` = `gcms_rel_image_other`.`image_id`";
			$join_query_helper['where']="AND `gcms_rel_image_other`.`other_id` = ";
			$join_query_helper['param']=$join_param;
		}
		if(isset($arr['im_type_or']))
		{
			$par1="AND (";
			$par2=")";
		}
		else if(isset($arr['im_type']))
		{
			$par1="AND";
		}
		
		if(isset($order['rand'])&&$order['rand']=="true")
			$order_query_helper="ORDER BY RAND( ) LIMIT 0 , 10";
		
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT `gcms_image`.* [ %S ] FROM `gcms_image` [ %S ]
						WHERE TRUE
						[ %S ][ %N ]
						[ AND `gcms_image`.`id` = %I ]
						[ AND `gcms_image`.`im_name` = %N ]
						[ AND `gcms_image`.`im_path` = %N ]
						[ %S ] [ `gcms_image`.`im_type` = %N ]
						[ OR  `gcms_image`.`im_type` = %N ] [ %S ] 
						[ %S ] [ ORDER BY `gcms_image`.`%S` ] [ %S ]
						",
						array(
									$join_query_helper['select'],
									$join_query_helper['join'],
									$join_query_helper['where'],
									$join_query_helper['param'],
									$arr['id'],
									$arr['im_name'],
									$arr['im_path'],
									$par1,
									$arr['im_type'],
									$arr['im_type_or'],
									$par2,
									$order_query_helper,
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
						"SELECT COUNT(*) as Num FROM `gcms_image` WHERE TRUE
						[ AND `id` = %I ]
						[ AND `im_name` = %N ]
						[ AND `im_path` = %N ]
						[ AND `im_type` = %N ]
						", array($arr['id'], $arr['im_name'], $arr['im_path'], $arr['im_type']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

    public function del($id)
    {
        $query=$GLOBALS['GCMS_SAFESQL']
            ->query("DELETE FROM `gcms_image`
						WHERE `id` =  %i", array($id));
        return $GLOBALS['GCMS_DB']->query($query);
    }
}
