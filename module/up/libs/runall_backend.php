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
$top_menu['part']="up";
$top_menu['title']="مدیریت صفحات کاربران";
$top_menu['img']="/core/backend/images/icon/page.png";
$top_menu['r1']['a']="up/new";
$top_menu['r1']['t']="صفحه کاربران جدید";
$top_menu['r2']['a']="up/index";
$top_menu['r2']['t']="لیست صفحات کاربران";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="up";
$bott_menu['title']="صفحات کاربران";
array_push($bott_menus, $bott_menu);
