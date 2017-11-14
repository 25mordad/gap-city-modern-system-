<?php

/**
 * configure.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file defines global variables & configures them.
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

//Global VARs
global $GCMS;
global $GCMS_ROUTER;
global $GCMS_DB;
global $GCMS_SAFESQL;
$GLOBALS["backend_menu"] = array() ;
$GCMS=new Smarty(); //$GLOBALS['GCMS']
$GCMS_ROUTER=new Router(); //$GLOBALS['GCMS_ROUTER']
$GCMS_DB=new ezSQL_mysql(__DB_USER__, __DB_PASSWORD__, __DB_NAME__, __DB_HOST__); //$GLOBALS['GCMS_DB']
$GCMS_SAFESQL=new SafeSQL_MySQL(); //$GLOBALS['GCMS_SAFESQL']
$GLOBALS['GCMS_DB']->escape("test connection");
//i18n
$GLOBALS['GCMS']->registerFilter('output', "i18n_substitute_text");
//default timezone
date_default_timezone_set('Europe/Madrid');
//Smarty
$GLOBALS['GCMS']->template_dir=__ROOT__."/web/".__THEMPLATE__;
$GLOBALS['GCMS']->compile_dir=__COREROOT__."/html/templates_c/";
$GLOBALS['GCMS']->config_dir=__COREROOT__."/html/configs/";
$GLOBALS['GCMS']->cache_dir=__COREROOT__."/html/cache/";
$GLOBALS['GCMS']->assign('temp_root', "/web/".__THEMPLATE__);
$GLOBALS['GCMS']->assign('admin_base', __ADMIN_BASE__);
//SETTING
$settings=Setting::get(NULL, true);
foreach($settings as $setting)
{
	$GCMS_SETTING[$setting->st_group][$setting->st_key]=$setting->st_value;
}
$GLOBALS['GCMS']->assign('GCMS_SETTING', $GCMS_SETTING);
//MODULES
$modules=Module::get(NULL, true);
foreach($modules as $module)
{
	$GCMS_MODULE[$module->module_name]=$module->status;
}
$GLOBALS['GCMS']->assign('GCMS_MODULE', $GCMS_MODULE);

/*
 * 
 * 
 * 
 */

foreach($modules as $module)
{
	if ($module->status == "active")
	{
		$utiliyfile = __COREROOT__."/module/".$module->module_name."/libs/utility.php";
		$modelfile  = __COREROOT__."/module/".$module->module_name."/model/".ucfirst($module->module_name).".php";
		$i18nfile = __COREROOT__."/module/".$module->module_name."/i18n/".$GLOBALS['GCMS_SETTING']['general']['language'].".php";
		//Load /module/libs/utility.php
		if(file_exists($utiliyfile))
			require_once($utiliyfile);
		//Load /module/model/Module.php
		if(file_exists($modelfile))
			require_once($modelfile);
		//Load /module/i18n
		if(file_exists($i18nfile))
			require_once($i18nfile);
	}
}
/*
 *
*
*
*/

if ($GLOBALS['GCMS_SETTING']['general']['intro'] != "false" and $_SERVER['REQUEST_URI'] == "/" )
        header("location: ".$GLOBALS['GCMS_SETTING']['general']['intro']);
