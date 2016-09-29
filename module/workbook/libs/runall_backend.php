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
$top_menu['part']="workbook";
$top_menu['title']="مدیریت کارنامه";
$top_menu['img']="/core/module/workbook/backend/images/workbook.png";
$top_menu['r1']['a']="workbook/new";
$top_menu['r1']['t']="کارنامه جدید";
$top_menu['r2']['a']="workbook/list";
$top_menu['r2']['t']="لیست کارنامه‌ها";
$top_menu['l1']['a']="workbook/index";
$top_menu['l1']['t']="عناوین کارنامه";
$top_menu['l2']['a']="workbook/chart";
$top_menu['l2']['t']="نمودار پیشرفت";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="workbook";
$bott_menu['title']="کارنامه";
array_push($bott_menus, $bott_menu);
