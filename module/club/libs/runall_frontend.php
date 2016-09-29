<?php

/**
 * runall_frontend.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file will be excuted before other controllers in frontend section.
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$limit=array("start" => 0,"end"   => 20);
$order=array("by" => "id","sort" => "DESC");
$GLOBALS['GCMS']->assign('last_itak_cardproduct', ItakRelCardProduct::get($get, true, $order, $join_param,$limit));

if (isset($_SESSION["glogin_user_id"]))
	$GLOBALS['GCMS']->assign('groupitak', ItakRelGroupUser::get(array(  "id_user" => $_SESSION["glogin_user_id"], "status" => "member" ),false,$order,"group"));