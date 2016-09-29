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
$top_menu['part']="khodro";
$top_menu['title']="مدیریت خودرو مرجع";
$top_menu['img']="/core/module/khodro/backend/images/car.png";
$top_menu['r1']['a']="khodro/brand";
$top_menu['r1']['t']="برند";
$top_menu['r2']['a']="khodro";
$top_menu['r2']['t']="لیست مدل‌ها";
$top_menu['r3']['a']="khodro/tips";
$top_menu['r3']['t']="لیست تیپ‌ها";
$top_menu['l1']['a']="khodro/newmodel";
$top_menu['l1']['t']="تعریف مدل جدید";
$top_menu['l2']['a']="khodro/newtip";
$top_menu['l2']['t']="تعریف تیپ جدید";
$top_menu['l3']['a']="khodro/sms?date=".date("Y-m-d",strtotime("-1 days"));
$top_menu['l3']['t']="ارسال پیامک";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="khodro";
$bott_menu['title']="خودرو";
array_push($bott_menus, $bott_menu);