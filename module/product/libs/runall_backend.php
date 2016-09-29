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
$top_menu['part']="product";
$top_menu['title']="مدیریت محصولات";
$top_menu['img']="/core/module/product/backend/images/product.png";
$top_menu['r1']['a']="product";
$top_menu['r1']['t']="لیست محصولات";
$top_menu['r2']['a']="product/grouping";
$top_menu['r2']['t']="گروه‌بندی محصولات";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="product";
$bott_menu['title']="محصولات";
array_push($bott_menus, $bott_menu);

/////////////////////////////// New Menu
$GCMSmenu_contact=array();
//
$GCMSmenu_contact['part']="product";
$GCMSmenu_contact['title']=" محصولات ";
$GCMSmenu_contact['icon']="fa fa-diamond ";
///
$GCMSmenu_contact['child'][0]['action']="grouping";
$GCMSmenu_contact['child'][0]['link']="product/grouping";
$GCMSmenu_contact['child'][0]['title']="  لیست گروه های محصول  ";

///
$GCMSmenu_contact['child'][1]['action']="index";
$GCMSmenu_contact['child'][1]['link']="product/";
$GCMSmenu_contact['child'][1]['title']="  لیست محصولات  ";


array_push($GLOBALS["backend_menu"], $GCMSmenu_contact);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);