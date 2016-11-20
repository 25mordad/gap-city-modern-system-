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

/////////////////////////////// New Menu
$GCMSmenu_users=array();
//
$GCMSmenu_users['part']="pays";
$GCMSmenu_users['title']=" مدیریت پرداخت ها ";
$GCMSmenu_users['icon']="fa  fa-user ";

///
$GCMSmenu_users['child'][1]['action']="list";
$GCMSmenu_users['child'][1]['link']="pays";
$GCMSmenu_users['child'][1]['title']=" لیست پرداخت ها  ";
///
$GCMSmenu_users['child'][2]['action']="setting";
$GCMSmenu_users['child'][2]['link']="pays/setting";
$GCMSmenu_users['child'][2]['title']=" تنظیمات   ";

array_push($GLOBALS["backend_menu"], $GCMSmenu_users);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);