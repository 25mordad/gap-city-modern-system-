<?php

/**
 * runall_backend.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file will be excuted before other controllers in backend section.
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

//top_menu
$top_menu=array();
$top_menu['part']="user";
$top_menu['title']="مدیریت اعضا";
$top_menu['img']="/core/module/user/backend/images/user.png";
$top_menu['r1']['a']="user/new";
$top_menu['r1']['t']="عضو جدید";
$top_menu['r2']['a']="user";
$top_menu['r2']['t']="لیست اعضا";
$top_menu['l1']['a']="user/setting";
$top_menu['l1']['t']="تنظیمات";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="user";
$bott_menu['title']="اعضا";
array_push($bott_menus, $bott_menu);

//levels & params
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

/////////////////////////////// New Menu
$GCMSmenu_users=array();
//
$GCMSmenu_users['part']="user";
$GCMSmenu_users['title']=" مدیریت کاربران ";
$GCMSmenu_users['icon']="fa  fa-user ";
///
$GCMSmenu_users['child'][0]['action']="new";
$GCMSmenu_users['child'][0]['link']="user/new";
$GCMSmenu_users['child'][0]['title']=" کاربر جدید ";
///
$GCMSmenu_users['child'][1]['action']="list";
$GCMSmenu_users['child'][1]['link']="user";
$GCMSmenu_users['child'][1]['title']=" لیست کاربران  ";
///
$GCMSmenu_users['child'][2]['action']="list";
$GCMSmenu_users['child'][2]['link']="user/setting";
$GCMSmenu_users['child'][2]['title']=" تنظیمات   ";

array_push($GLOBALS["backend_menu"], $GCMSmenu_users);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);