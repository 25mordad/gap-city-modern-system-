<?php

/**
 * statistic.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > statistic
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/gapi/gapi.class.php");
//TODO reform

function index()
{
	define('ga_profile_id', $GLOBALS['GCMS_SETTING']['statistic']['ga_profile_id']);
	define('start_date', '2005-01-01');
	$static_date=new gapi("603421547350-rguql62dtqv5eibakc1ue73k7mspc32p@developer.gserviceaccount.com", __COREROOT__."/libs/gapi/gcmsKey.p12");
	$GLOBALS['GCMS']->assign('static_error', false);

	//find date
	$today=date("Y-m-d");
	$lastWeek=date('Y-m-d', time()-(6*24*60*60));
	if($static_date
			->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits'),
					array('date'), null, $lastWeek, $today))
	{
		$GLOBALS['GCMS']->assign('static_date', $static_date->getResults());
		$GLOBALS['GCMS']->assign('static_date_getPageviews', $static_date->getPageviews());
		$GLOBALS['GCMS']->assign('static_date_getVisits', $static_date->getVisits());
		$GLOBALS['GCMS']->assign('static_date_from', $today);
		$GLOBALS['GCMS']->assign('static_date_to', $lastWeek);
		//
		$static_date
				->requestReportData(ga_profile_id, array('date'), array('pageviews', 'visits'),
						array('-visits'), null, start_date, $today, 1, 1);
		$GLOBALS['GCMS']->assign('static_key_getPageviews', $static_date->getPageviews());
		$GLOBALS['GCMS']->assign('static_key_getVisits', $static_date->getVisits());
	}
	else
	{
		$GLOBALS['GCMS']->assign('static_error', true);
	}
}

function visit()
{
    define('ga_profile_id', $GLOBALS['GCMS_SETTING']['statistic']['ga_profile_id']);
    define('start_date', '2005-01-01');
    $static_date=new gapi("603421547350-rguql62dtqv5eibakc1ue73k7mspc32p@developer.gserviceaccount.com", __COREROOT__."/libs/gapi/gcmsKey.p12");
	$GLOBALS['GCMS']->assign('static_error', false);
	//find date
	$today=date("Y-m-d");
	if($static_date
			->requestReportData(ga_profile_id,
					array('hostname','pagePath','pageTitle'),
					array('visits'), array('-visits'), null, start_date, $today, 1,
					10))
	{
		$GLOBALS['GCMS']->assign('static_key', $static_date->getResults());

	}
	else
	{
		$GLOBALS['GCMS']->assign('static_error', true);
	}
	
	

   
	
}

function keyword()
{
    define('ga_profile_id', $GLOBALS['GCMS_SETTING']['statistic']['ga_profile_id']);
    define('start_date', '2005-01-01');
    $static_date=new gapi("603421547350-rguql62dtqv5eibakc1ue73k7mspc32p@developer.gserviceaccount.com", __COREROOT__."/libs/gapi/gcmsKey.p12");
	$GLOBALS['GCMS']->assign('static_error', false);
	//find date
	$today=date("Y-m-d");
	if($static_date
			->requestReportData(ga_profile_id,
					array('keyword'),
					array('visits'), array('-visits'), null, start_date, $today, 1,
					20))
	{
		$GLOBALS['GCMS']->assign('static_key', $static_date->getResults());

	}
	else
	{
		$GLOBALS['GCMS']->assign('static_error', true);
	}
	



}

function city()
{
    define('ga_profile_id', $GLOBALS['GCMS_SETTING']['statistic']['ga_profile_id']);
    define('start_date', '2005-01-01');
    $static_date=new gapi("603421547350-rguql62dtqv5eibakc1ue73k7mspc32p@developer.gserviceaccount.com", __COREROOT__."/libs/gapi/gcmsKey.p12");
	$GLOBALS['GCMS']->assign('static_error', false);
	//find date
	$today=date("Y-m-d");
	if($static_date
			->requestReportData(ga_profile_id, array('city'), array('visits'), array('-visits'),
					null, start_date, $today, 1, 10))
	{
		$GLOBALS['GCMS']->assign('static_city', $static_date->getResults());

	}
	else
	{
		$GLOBALS['GCMS']->assign('static_error', true);
	}

}

function country()
{
    define('ga_profile_id', $GLOBALS['GCMS_SETTING']['statistic']['ga_profile_id']);
    define('start_date', '2005-01-01');
    $static_date=new gapi("603421547350-rguql62dtqv5eibakc1ue73k7mspc32p@developer.gserviceaccount.com", __COREROOT__."/libs/gapi/gcmsKey.p12");
	$GLOBALS['GCMS']->assign('static_error', false);
	//find date
	$today=date("Y-m-d");
	if($static_date
			->requestReportData(ga_profile_id, array('country'), array('visits'), array('-visits'),
					null, start_date, $today, 1, 10))
	{
		$GLOBALS['GCMS']->assign('static_country', $static_date->getResults());

	}
	else
	{
		$GLOBALS['GCMS']->assign('static_error', true);
	}

}

function browser()
{
    define('ga_profile_id', $GLOBALS['GCMS_SETTING']['statistic']['ga_profile_id']);
    define('start_date', '2005-01-01');
    $static_date=new gapi("603421547350-rguql62dtqv5eibakc1ue73k7mspc32p@developer.gserviceaccount.com", __COREROOT__."/libs/gapi/gcmsKey.p12");
	$GLOBALS['GCMS']->assign('static_error', false);
	//find date
	$today=date("Y-m-d");
	if($static_date
			->requestReportData(ga_profile_id, array('browser'), array('visits'), array('-visits'),
					null, start_date, $today, 1, 10))
	{
		$GLOBALS['GCMS']->assign('static_browser', $static_date->getResults());

	}
	else
	{
		$GLOBALS['GCMS']->assign('static_error', true);
	}

}
