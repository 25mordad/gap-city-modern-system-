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
$GCMSmenu_users['part']="message";
$GCMSmenu_users['title']=" مدیریت پیام ها ";
$GCMSmenu_users['icon']="fa  fa-envelope ";
///
$GCMSmenu_users['child'][0]['action']="index";
$GCMSmenu_users['child'][0]['link']="message";
$GCMSmenu_users['child'][0]['title']=" لیست پیام ها ";
///
$GCMSmenu_users['child'][1]['action']="new";
$GCMSmenu_users['child'][1]['link']="message/new";
$GCMSmenu_users['child'][1]['title']=" ارسال پیام ";

array_push($GLOBALS["backend_menu"], $GCMSmenu_users);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);