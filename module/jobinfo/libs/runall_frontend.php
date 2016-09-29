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

$GLOBALS['GCMS']->assign('sarfejo_all_kala_groups', SarfejoJobgroup::get(array("parent"=>0,"type"=>"kala", "status"=>"active"), true));
$GLOBALS['GCMS']->assign('sarfejo_all_khadamat_groups', SarfejoJobgroup::get(array("parent"=>0,"type"=>"khadamat", "status"=>"active"), true));