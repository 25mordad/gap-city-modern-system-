<?php

/**
 * runall_frontend.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file will be excuted before other controllers in frontend section.
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */
//User
if($GLOBALS['GCMS_MODULE']['user']=='active')
{
	$levels=Setting::get(array("st_group" => "user", "st_key" => "level"), true);
	$params=Setting::get(array("st_group" => "user", "st_key" => "param"), true);
	foreach($levels as $level)
	{
		$GCMS_USER_LEVEL[$level->id]=$level->st_value;
	}
	foreach($params as $param)
	{
		$GCMS_USER_PARAM[$param->id]=$param->st_value;
	}
	$GLOBALS['GCMS']->assign('GCMS_USER_LEVEL', $GCMS_USER_LEVEL);
	$GLOBALS['GCMS']->assign('GCMS_USER_PARAM', $GCMS_USER_PARAM);

	/**
	 * Old bug. Please do not use user_param_list & level_name in further projects.
	 * Use GCMS_USER_PARAM & GCMS_USER_LEVEL instead.
	 */
	if(isset($_SESSION["glogin_username"]))
	{
		$i=0;
		foreach($params as $param)
		{
			$user_param_list[$i]['value']=$param->id;
			$user_param_list[$i]['name']=$param->st_value;
			$i++;
		}
		$GLOBALS['GCMS']->assign('user_param_list', $user_param_list);
		$GLOBALS['GCMS']
				->assign('level_name', Setting::get(array("id" => $_SESSION["glogin_user_level"])));
	}
}