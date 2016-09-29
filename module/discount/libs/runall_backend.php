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
$top_menu['part']="discount";
$top_menu['title']="مدیریت تخفیف گروهی";
$top_menu['img']="/core/module/discount/backend/images/discount.png";
$top_menu['r1']['a']="discount/grouping";
$top_menu['r1']['t']="لیست گروه‌ها";
$top_menu['r2']['a']="discount/index";
$top_menu['r2']['t']="لیست تخفیف‌ها";
$top_menu['r3']['a']="discount/new";
$top_menu['r3']['t']="تخفیف جدید";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="discount";
$bott_menu['title']="تخفیف گروهی";
array_push($bott_menus, $bott_menu);
