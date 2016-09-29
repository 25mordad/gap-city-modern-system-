<?php

/**
 * runall_frontend.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file will be excuted before other controllers in frontend section.
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */
//Seo vars
$GLOBALS['GCMS']->assign('gcms_page_title', $GLOBALS['GCMS_SETTING']['seo']['title']);
$GLOBALS['GCMS']->assign('gcms_site_description', $GLOBALS['GCMS_SETTING']['seo']['description']);
$GLOBALS['GCMS']->assign('gcms_site_keyword', $GLOBALS['GCMS_SETTING']['seo']['keyword']);
//General boxes
$GLOBALS['GCMS']
		->assign('general_boxes',
				Box::get(array("parent_id" => 0, "box_status" => "publish"), true,
						array("by" => "id")));
//index_boxs for old templates (old version used boxes with parent_id 1 as general boxes)
$GLOBALS['GCMS']->assign('index_boxs', Box::get(array("parent_id" => 1), true));
//Menus
$GLOBALS['GCMS']
		->assign('gcms_menus', Menu::get(array("parent" => "0"), true, array("by" => "order")));

foreach($modules as $module)
{
	if ($module->status == "active")
	{
		$runallfrontfile = __COREROOT__."/module/".$module->module_name."/libs/runall_frontend.php";
		//Load /module/libs/runall_frontend.php
		if(file_exists($runallfrontfile))
			require_once($runallfrontfile);
	}
}
if (!($_SERVER['SERVER_NAME'] == "127.0.0.1" or $_SERVER['SERVER_NAME'] == "localhost" or $_SERVER['SERVER_NAME'] == "gcms.dev" ))
{
    //analyse
    require_once(__COREROOT__."/libs/gapi/gapi.class.php");
    define('ga_profile_id', $GLOBALS['GCMS_SETTING']['statistic']['ga_profile_id']);
    define('start_date', '2005-01-01');
    $static_date=new gapi("603421547350-rguql62dtqv5eibakc1ue73k7mspc32p@developer.gserviceaccount.com", __COREROOT__."/libs/gapi/gcmsKey.p12");
    $GLOBALS['GCMS']->assign('static_error', false);

//find date
    $today=date("Y-m-d");
    if($static_date
        ->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits'),
            array('-visits'), null, start_date, $today, 1, 1))
    {
        $GLOBALS['GCMS']->assign('static_key_getPageviews', $static_date->getPageviews());
        $GLOBALS['GCMS']->assign('static_key_getVisits', $static_date->getVisits());
    }
    else
    {
        $GLOBALS['GCMS']->assign('static_error', true);
    }
}
