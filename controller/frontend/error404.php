<?php

/**
 * error404.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > error404
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function index()
{
	$GLOBALS['GCMS']
			->assign('gcms_page_title',
					$GLOBALS['GCMS_SETTING']['seo']['title']." | @@Error@@");
}
