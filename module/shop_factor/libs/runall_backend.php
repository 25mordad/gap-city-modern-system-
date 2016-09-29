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
$top_menu['part']=" shop_factor ";
$top_menu['title']=" فاکتور فروشگاه ";
$top_menu['img']="/core/module/shop_factor/backend/images/shf.png";
$top_menu['r1']['a']="shop_factor";
$top_menu['r1']['t']=" لیست فاکتور ها  ";
$top_menu['r2']['a']="";
$top_menu['r2']['t']="";
$top_menu['r3']['a']="";
$top_menu['r3']['t']="";
$top_menu['l1']['a']="";
$top_menu['l1']['t']="";
$top_menu['l2']['a']="";
$top_menu['l2']['t']="";
$top_menu['l3']['a']="";
$top_menu['l3']['t']="";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="SAMPLE";
$bott_menu['title']="";
array_push($bott_menus, $bott_menu);
/////////////////////////////// New Menu
$GCMSmenu_contact=array();
//
$GCMSmenu_contact['part']="shop_factor";
$GCMSmenu_contact['title']=" فاکتور فروشگاه ";
$GCMSmenu_contact['icon']="fa fa-shopping-cart ";
///
$GCMSmenu_contact['child'][0]['action']="index";
$GCMSmenu_contact['child'][0]['link']="shop_factor/";
$GCMSmenu_contact['child'][0]['title']="  لیست فاکتورها  ";


array_push($GLOBALS["backend_menu"], $GCMSmenu_contact);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);

