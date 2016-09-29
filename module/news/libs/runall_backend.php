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
$top_menu['part']="news";
$top_menu['title']="مدیریت اخبار";
$top_menu['img']="/core/module/news/backend/images/news.png";
$top_menu['r1']['a']="news/newgroup";
$top_menu['r1']['t']="گروه خبری جدید";
$top_menu['r2']['a']="news/listgroup";
$top_menu['r2']['t']="لیست گروه‌های خبری";
$top_menu['l1']['a']="news/new";
$top_menu['l1']['t']="خبر جدید";
$top_menu['l2']['a']="news/index";
$top_menu['l2']['t']="لیست اخبار";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="news";
$bott_menu['title']="اخبار";
array_push($bott_menus, $bott_menu);
/////////////////////////////// New Menu
$GCMSmenu_contact=array();
//
$GCMSmenu_contact['part']="news";
$GCMSmenu_contact['title']=" مدیریت اخبار ";
$GCMSmenu_contact['icon']="fa fa-newspaper-o";
///
$GCMSmenu_contact['child'][0]['action']="new";
$GCMSmenu_contact['child'][0]['link']="news/newgroup";
$GCMSmenu_contact['child'][0]['title']=" ایجاد گروه خبری جدید ";

///
$GCMSmenu_contact['child'][1]['action']="new";
$GCMSmenu_contact['child'][1]['link']="news/listgroup";
$GCMSmenu_contact['child'][1]['title']=" لیست گروه های خبری ";

///
$GCMSmenu_contact['child'][2]['action']="new";
$GCMSmenu_contact['child'][2]['link']="news/new";
$GCMSmenu_contact['child'][2]['title']=" ایجاد خبر جدید ";

///
$GCMSmenu_contact['child'][3]['action']="new";
$GCMSmenu_contact['child'][3]['link']="news/";
$GCMSmenu_contact['child'][3]['title']=" لیست اخبار ";


array_push($GLOBALS["backend_menu"], $GCMSmenu_contact);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);