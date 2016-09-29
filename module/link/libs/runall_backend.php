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
$top_menu['part']="link";
$top_menu['title']="مدیریت پیوندها";
$top_menu['img']="/core/module/link/backend/images/link.png";
$top_menu['r1']['a']="link/listgroup";
$top_menu['r1']['t']="گروه‌پیوندها";
$top_menu['r2']['a']="link/new";
$top_menu['r2']['t']="پیوند جدید";
$top_menu['r3']['a']="link/index";
$top_menu['r3']['t']="لیست پیوندها";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="link";
$bott_menu['title']="پیوندها";
array_push($bott_menus, $bott_menu);