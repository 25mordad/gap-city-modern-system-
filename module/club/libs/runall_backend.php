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
$top_menu['part']="club";
$top_menu['title']="مدیریت باشگاه مشتریان";
$top_menu['img']="/core/backend/images/icon/page.png";
$top_menu['r1']['a']="club/newuser";
$top_menu['r1']['t']="عضو جدید";
$top_menu['r2']['a']="club/index";
$top_menu['r2']['t']="لیست اعضا";
$top_menu['r3']['a']="club/groups";
$top_menu['r3']['t']="لیست گروه‌ها";
$top_menu['l1']['a']="club/cards";
$top_menu['l1']['t']="لیست کارت‌ها";
$top_menu['l2']['a']="club/points";
$top_menu['l2']['t']="لیست موارد امتیازی";
$top_menu['l3']['a']="club/sendboard";
$top_menu['l3']['t']="پیام به گروه‌ها";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="club";
$bott_menu['title']="باشگاه مشتریان";
array_push($bott_menus, $bott_menu);
