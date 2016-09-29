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
$top_menu['part']="sarfejo_dailyfee";
$top_menu['title']="قیمت روزانه";
$top_menu['img']="/core/module/sarfejo_dailyfee/backend/images/sdf.png";
$top_menu['r1']['a']="sarfejo_dailyfee";
$top_menu['r1']['t']="لیست قیمت روزانه";
$top_menu['r2']['a']="sarfejo_dailyfee/stuffs";
$top_menu['r2']['t']="لیست کالا";
$top_menu['l2']['a']="sarfejo_dailyfee/newfee";
$top_menu['l2']['t']="ثبت قیمت روزانه";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="sarfejo_dailyfee";
$bott_menu['title']="قیمت روزانه";
array_push($bott_menus, $bott_menu);
