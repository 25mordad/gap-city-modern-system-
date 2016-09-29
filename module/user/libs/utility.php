<?php
/**
 * utility.php
 *
 * This file is part of GCMS > MODULE LIBS
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

/**
 *
 * SMARTY
 *
 */
function smarty_function_get_user_params($params, &$smarty)
{
	//$params['id_user'] $params['name']
	$row=MetaUser::get(array("id_user" => $params['id_user'], "name" => "param_".$params['name']));
	(isset($row->value)) ? $rt=$row->value : $rt="";
	return $rt;
}
function smarty_function_get_user_name($params, &$smarty)
{
	//$params['id_user']
	$GLOBALS['GCMS']->assign('getuser',User::get(array("id" => $params['id_user'])));


}

/**
 * 
 * UTILITY
 *
 */

function user_params($id)
{
	$metas=MetaUser::get(array("id_user" => $id), true);
	$result=array();
	foreach($metas as $meta)
	{
		$par = explode("_", $meta->name, 2);
		if($par[0]=="param")
		{
			$result[$par[1]]=array();
			$result[$par[1]]["label"]=$GLOBALS['GCMS_USER_PARAM'][$par[1]];
			$result[$par[1]]["value"]=$meta->value;
			$result[$par[1]]["id"]=$meta->id;
		}
	}
	return $result;
}