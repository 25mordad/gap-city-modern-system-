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
$top_menu['part']="pay_mellat";
$top_menu['title']="مدیریت پرداخت‌ها";
$top_menu['img']="/core/images/icon/page.png";
$top_menu['r1']['a']="pay_mellat/index";
$top_menu['r1']['t']="لیست پرداخت‌ها";
$top_menu['r2']['a']="pay_mellat/setting";
$top_menu['r2']['t']="تنظیمات";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="pay_mellat";
$bott_menu['title']="پرداخت‌ها";
array_push($bott_menus, $bott_menu);
