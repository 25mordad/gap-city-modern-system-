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
if($GLOBALS['GCMS_MODULE']['news']=='active')
	$GLOBALS['GCMS']
	->assign('last_news',
			Page::get(array("pg_type" => "news", "pg_status" => "publish"), true,
					array("by" => "date_created", "sort" => "DESC"),
					array("start" => "0", "end" => "20")));
