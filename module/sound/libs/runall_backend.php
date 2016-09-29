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
$top_menu['part']="sound";
$top_menu['title']="گالری صوت";
$top_menu['img']="/core/module/sound/backend/images/sound.png";
$top_menu['r1']['a']="sound/new";
$top_menu['r1']['t']="گالری جدید";
$top_menu['r2']['a']="sound";
$top_menu['r2']['t']="لیست گالری‌ها";
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="sound";
$bott_menu['title']="گالری صوت";
array_push($bott_menus, $bott_menu);