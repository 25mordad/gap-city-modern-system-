<?php

/**
 * require.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file includes libraries & classes for the project.
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/smarty/Smarty.class.php");
require_once(__COREROOT__."/libs/jdate/jdf.php");
require_once(__COREROOT__."/libs/i18n/i18n.php");
require_once(__COREROOT__."/libs/email/Email.php");
require_once(__COREROOT__."/libs/email/class.phpmailer.php");
require_once(__COREROOT__."/libs/email/class.smtp.php");
require_once(__COREROOT__."/libs/routing/routing.php");
require_once(__COREROOT__."/libs/ez_sql/ez_sql_core.php");
require_once(__COREROOT__."/libs/ez_sql/ez_sql_mysql.php");
require_once(__COREROOT__."/libs/safesql/SafeSQL.class.php");
//including /libs/smarty/utility/*
foreach(glob(__COREROOT__."/libs/smarty/utility/*.php") as $filename)
{
	include $filename;
}
require_once(__COREROOT__."/libs/smarty/plugins/utility_functions.php");

//AUTO LOAD

function autoload_model($class_name)
{
	$file='core/model/'.$class_name.'.php';
	if(file_exists($file))
	{
		require_once($file);
	}
}
spl_autoload_register('autoload_model');
