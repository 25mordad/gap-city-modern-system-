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
$top_menu['part']="sarfejo_user";
$top_menu['title']="مدیریت اعضا";
$top_menu['img']="/core/module/sarfejo_user/backend/images/user.png";
$top_menu['r2']['a']="sarfejo_user";
$top_menu['r2']['t']="لیست اعضا";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="sarfejo_user";
$bott_menu['title']="اعضا";
array_push($bott_menus, $bott_menu);
