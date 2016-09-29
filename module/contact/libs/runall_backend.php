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
$top_menu['part']="contact";
$top_menu['title']="دفترچه تلفن";
$top_menu['img']="/core/module/contact/backend/images/contact.png";
$top_menu['r1']['a']="contact/new";
$top_menu['r1']['t']="تماس جدید";
$top_menu['r2']['a']="contact";
$top_menu['r2']['t']="لیست تماس‌ها";
$top_menu['r3']['a']="contact/grouping";
$top_menu['r3']['t']="گروه‌بندی";
array_push($top_menus, $top_menu);

/////////////////////////////// New Menu
$GCMSmenu_contact=array();
//
$GCMSmenu_contact['part']="contact";
$GCMSmenu_contact['title']=" مدیریت تماس ها ";
$GCMSmenu_contact['icon']="fa fa-phone-square";
///
$GCMSmenu_contact['child'][0]['action']="new";
$GCMSmenu_contact['child'][0]['link']="contact/new";
$GCMSmenu_contact['child'][0]['title']=" تماس جدید ";
///
$GCMSmenu_contact['child'][1]['action']="list";
$GCMSmenu_contact['child'][1]['link']="contact";
$GCMSmenu_contact['child'][1]['title']=" لیست تماس ها  ";
///
$GCMSmenu_contact['child'][2]['action']="list";
$GCMSmenu_contact['child'][2]['link']="contact/grouping";
$GCMSmenu_contact['child'][2]['title']=" گروه بندی  ";

array_push($GLOBALS["backend_menu"], $GCMSmenu_contact);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);