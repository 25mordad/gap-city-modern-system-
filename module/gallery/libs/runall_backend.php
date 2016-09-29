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
$top_menu['part']="gallery";
$top_menu['title']="گالری عکس";
$top_menu['img']="/core/module/gallery/backend/images/gallery.png";
$top_menu['r1']['a']="gallery/new";
$top_menu['r1']['t']="گالری جدید";
$top_menu['r2']['a']="gallery";
$top_menu['r2']['t']="لیست گالری‌ها";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="gallery";
$bott_menu['title']="گالری عکس";
array_push($bott_menus, $bott_menu);

/////////////////////////////// New Menu
$GCMSmenu_contact=array();
//
$GCMSmenu_contact['part']="gallery";
$GCMSmenu_contact['title']=" گالری عکس ";
$GCMSmenu_contact['icon']="fa fa-picture-o";
///
$GCMSmenu_contact['child'][0]['action']="new";
$GCMSmenu_contact['child'][0]['link']="gallery/new";
$GCMSmenu_contact['child'][0]['title']="ایجاد گالری عکس جدید ";

///
$GCMSmenu_contact['child'][1]['action']="new";
$GCMSmenu_contact['child'][1]['link']="gallery";
$GCMSmenu_contact['child'][1]['title']=" لیست گالری ها ";


array_push($GLOBALS["backend_menu"], $GCMSmenu_contact);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);