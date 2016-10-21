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
$GCMSmenu_contact['part']="dinero";
$GCMSmenu_contact['title']=" دینرو ";
$GCMSmenu_contact['icon']="fa fa-suitcase ";
///
$GCMSmenu_contact['child'][0]['action']="index";
$GCMSmenu_contact['child'][0]['link']="dinero";
$GCMSmenu_contact['child'][0]['title']=" لیست تراکنش‌ها ";



array_push($GLOBALS["backend_menu"], $GCMSmenu_contact);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);
