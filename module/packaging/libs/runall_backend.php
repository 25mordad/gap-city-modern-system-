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
$GCMSmenu_contact=array();
//
$GCMSmenu_contact['part']="packaging";
$GCMSmenu_contact['title']=" بسته‌بندی ";
$GCMSmenu_contact['icon']="fa fa-suitcase ";
///
$GCMSmenu_contact['child'][0]['action']="index";
$GCMSmenu_contact['child'][0]['link']="packaging";
$GCMSmenu_contact['child'][0]['title']="  لیست بسته‌ها  ";



array_push($GLOBALS["backend_menu"], $GCMSmenu_contact);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);
