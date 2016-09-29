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
$top_menu['part']="adv_wb";
$top_menu['title']="مدیریت آموزشگاه";
$top_menu['img']="/core/backend/images/icon/page.png";
$top_menu['r1']['a']="adv_wb/branches";
$top_menu['r1']['t']="شعبه‌ها";
$top_menu['r2']['a']="adv_wb/grades";
$top_menu['r2']['t']="پایه‌ها";
$top_menu['r3']['a']="adv_wb/lessons";
$top_menu['r3']['t']="درس‌ها";
$top_menu['l1']['a']="adv_wb/newclass";
$top_menu['l1']['t']="کلاس جدید";
$top_menu['l2']['a']="adv_wb/index";
$top_menu['l2']['t']="لیست کلاس‌ها";
$top_menu['l3']['a']="adv_wb/discounts";
$top_menu['l3']['t']="تخفیف شهریه";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="adv_wb";
$bott_menu['title']="آموزشگاه";
array_push($bott_menus, $bott_menu);
