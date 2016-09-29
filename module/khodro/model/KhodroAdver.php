<?php

/**
 * KhodroAdver.php
 *
 * This file is part of GCMS > MODEL
 * The file is part of the layer for interacting with database.
 * Linked table in DB: gcms_khodro_adver
 *
 * @author AutoGenerated <25Mordad@gmail.com>
 * @version 2.0
 *
 */

class KhodroAdver
{

	public function __construct()
	{

	}

	public function insert($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"INSERT INTO `gcms_khodro_adver` (
				         `id`  ,
                         `id_brand`  ,
                         `id_model`  ,
                         `id_tip`  ,
                         `id_user`  ,
                         `cell`  ,
                         `year`  ,
                         `auto_gear`  ,
                         `two_some`  ,
                         `fee`  ,
                         `used_zero`  ,
                         `used`  ,
                         `color`  ,
                         `bim_month`  ,
                         `bim_body`  ,
                         `fabric`  ,
                         `txt`  ,
                         `adv_type`  ,
                         `adv_status`  ,
                         `register_date`  ,
                         `expire_date`  ,
                         `error_report_count`  ,
                         `error_report_type` ,
                         `aghsat`
						) VALUES(
						 NULL  ,
                         %i  ,
                         %i  ,
                         %i  ,
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
                         %n  ,
                         %n  ,
                         %n  ,
                         %n  ,
                         %n  ,
                         %n
						)", array($arr['id_brand'] , $arr['id_model'] , $arr['id_tip'] , $arr['id_user'] , $arr['cell'] , $arr['year'] , $arr['auto_gear'] , $arr['two_some'] , $arr['fee'] , $arr['used_zero'] , $arr['used'] , $arr['color'] , $arr['bim_month'] , $arr['bim_body'] , $arr['fabric'] , $arr['txt'] , $arr['adv_type'] , $arr['adv_status'] , $arr['register_date'] , $arr['expire_date'] , $arr['error_report_count'] , $arr['error_report_type'], $arr['aghsat']));
		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function update($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"UPDATE `gcms_khodro_adver` SET
						 `id` =  %i
                         [ , `id_brand` = %I ]
                         [ , `id_model` = %I ]
                         [ , `id_tip` = %I ]
                         [ , `id_user` = %I ]
                         [ , `cell` = %N ]
                         [ , `year` = %N ]
                         [ , `auto_gear` = %N ]
                         [ , `two_some` = %N ]
                         [ , `fee` = %N ]
                         [ , `used_zero` = %N ]
                         [ , `used` = %N ]
                         [ , `color` = %N ]
                         [ , `bim_month` = %N ]
                         [ , `bim_body` = %N ]
                         [ , `fabric` = %N ]
                         [ , `txt` = %N ]
                         [ , `adv_type` = %N ]
                         [ , `adv_status` = %N ]
                         [ , `register_date` = %N ]
                         [ , `expire_date` = %N ]
                         [ , `error_report_count` = %N ]
                         [ , `error_report_type` = %N ]
						 [ , `aghsat` = %N ]
						WHERE `id` =  %i",
						array($arr['id'] , $arr['id_brand'] , $arr['id_model'] , $arr['id_tip'] , $arr['id_user'] , $arr['cell'] , $arr['year'] , $arr['auto_gear'] , $arr['two_some'] , $arr['fee'] , $arr['used_zero'] , $arr['used'] , $arr['color'] , $arr['bim_month'] , $arr['bim_body'] , $arr['fabric'] , $arr['txt'] , $arr['adv_type'] , $arr['adv_status'] , $arr['register_date'] , $arr['expire_date'] , $arr['error_report_count'] , $arr['error_report_type'], $arr['aghsat'],$arr['id'] ));

		return $GLOBALS['GCMS_DB']->query($query);
	}

    public function get($arr, $list = false, $order = "" , $limit = "")
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT * FROM `gcms_khodro_adver` WHERE TRUE
						 [ AND `id` = %I ]
                         [ AND `id_brand` = %I ]
                         [ AND `id_model` = %I ]
                         [ AND `id_tip` = %I ]
                         [ AND `id_user` = %I ]
                         [ AND `cell` = %N ]
                         [ AND `year` = %N ]
                         [ AND `auto_gear` = %N ]
                         [ AND `two_some` = %N ]
                         [ AND `fee` = %N ]
                         [ AND `used_zero` = %N ]
                         [ AND `used` = %N ]
                         [ AND `color` = %N ]
                         [ AND `bim_month` = %N ]
                         [ AND `bim_body` = %N ]
                         [ AND `fabric` = %N ]
                         [ AND `txt` = %N ]
                         [ AND `adv_type` = %N ]
                         [ AND `adv_status` = %N ]
                         [ AND `register_date` = %N ]
						 [ AND `register_date` BETWEEN  %N and %N ]
                         [ AND `expire_date` = %N ]
                         [ AND `error_report_count` = %N ]
                         [ AND `error_report_type` = %N ]
                         [ AND `aghsat` = %N ]
						 [ GROUP BY `%S` ]

						[ ORDER BY `%S` ] [ %S ]
                        [ LIMIT %I ][ , %I ]
						",
						array($arr['id'] , $arr['id_brand'] , $arr['id_model'] , $arr['id_tip'] , $arr['id_user'] , $arr['cell'] , $arr['year'] , $arr['auto_gear'] , $arr['two_some'] , $arr['fee'] , $arr['used_zero'] , $arr['used'] , $arr['color'] , $arr['bim_month'] , $arr['bim_body'] , $arr['fabric'] , $arr['txt'] , $arr['adv_type'] , $arr['adv_status'] , $arr['register_date'], $arr['register_date_between_1'], $arr['register_date_between_2'] , $arr['expire_date'] , $arr['error_report_count'] , $arr['error_report_type'],$arr['aghsat'],$arr['groupby'], $order['by'], $order['sort'] ,$limit['start'],$limit['end']));
		if($list)
			return $GLOBALS['GCMS_DB']->get_results($query);
		else
			return $GLOBALS['GCMS_DB']->get_row($query);
	}

    public function get_count($arr)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query(
						"SELECT COUNT(*) as Num FROM `gcms_khodro_adver` WHERE TRUE
					    [ AND `id` = %I ]
                         [ AND `id_brand` = %I ]
                         [ AND `id_model` = %I ]
                         [ AND `id_tip` = %I ]
                         [ AND `id_user` = %I ]
                         [ AND `cell` = %N ]
                         [ AND `year` = %N ]
                         [ AND `auto_gear` = %N ]
                         [ AND `two_some` = %N ]
                         [ AND `fee` = %N ]
                         [ AND `used_zero` = %N ]
                         [ AND `used` = %N ]
                         [ AND `color` = %N ]
                         [ AND `bim_month` = %N ]
                         [ AND `bim_body` = %N ]
                         [ AND `fabric` = %N ]
                         [ AND `txt` = %N ]
                         [ AND `adv_type` = %N ]
                         [ AND `adv_status` = %N ]
                         [ AND `register_date` = %N ]
						 [ AND `register_date` BETWEEN  %N and %N ]
                         [ AND `expire_date` = %N ]
                         [ AND `error_report_count` = %N ]
                         [ AND `error_report_type` = %N ]
                         [ AND `aghsat` = %N ]
						 [ GROUP BY `%S` ]

						",
						array($arr['id'] , $arr['id_brand'] , $arr['id_model'] , $arr['id_tip'] , $arr['id_user'] , $arr['cell'] , $arr['year'] , $arr['auto_gear'] , $arr['two_some'] , $arr['fee'] , $arr['used_zero'] , $arr['used'] , $arr['color'] , $arr['bim_month'] , $arr['bim_body'] , $arr['fabric'] , $arr['txt'] , $arr['adv_type'] , $arr['adv_status'] , $arr['register_date'], $arr['register_date_between_1'], $arr['register_date_between_2'] , $arr['expire_date'] , $arr['error_report_count'] , $arr['error_report_type'], $arr['aghsat'], $arr['groupby']));
		$result=$GLOBALS['GCMS_DB']->get_results($query);
		return $result[0]->Num;
	}

	public function del($id)
	{
		$query=$GLOBALS['GCMS_SAFESQL']
				->query("DELETE FROM `gcms_khodro_adver`
						WHERE `id` =  %i", array($id));
		return $GLOBALS['GCMS_DB']->query($query);
	}

}