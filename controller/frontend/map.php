<?php

/**
 * map.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > map
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function index()
{
	//TODO include other pg_types?
	$GLOBALS['GCMS']
			->assign('site_map',
					Page::get(
							array("parent_id" => "0", "pg_type" => "page", "pg_status" => "publish"),
							true, array("by" => "date_created", "sort" => "ASC")));
}
