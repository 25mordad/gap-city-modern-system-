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
$top_menu['part']="jobinfo";
$top_menu['title']="واحدهای صنفی";
$top_menu['img']="/core/module/jobinfo/backend/images/jobinfo.png";
$top_menu['r1']['a']="jobinfo/index";
$top_menu['r1']['t']="لیست واحدهای صنفی";
$top_menu['r2']['a']="jobinfo/newgroup";
$top_menu['r2']['t']="گروه جدید";
$top_menu['r3']['a']="jobinfo/listgroup";
$top_menu['r3']['t']="لیست گروه‌ها";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="jobinfo";
$bott_menu['title']="واحدهای صنفی";
array_push($bott_menus, $bott_menu);
