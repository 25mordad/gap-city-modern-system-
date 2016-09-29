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

$GLOBALS['GCMS']
->assign('advancemenu_maingroup',AdvanceMenu::get(array("group" => "maingroup", "parent" => "0"), true, array("by" => "order")));
$GLOBALS['GCMS']
->assign('advancemenu_fgroup1',AdvanceMenu::get(array("group" => "fgroup1", "parent" => "0"), true, array("by" => "order")));
$GLOBALS['GCMS']
->assign('advancemenu_fgroup2',AdvanceMenu::get(array("group" => "fgroup2", "parent" => "0"), true, array("by" => "order")));
$GLOBALS['GCMS']
->assign('advancemenu_fgroup3',AdvanceMenu::get(array("group" => "fgroup3", "parent" => "0"), true, array("by" => "order")));
