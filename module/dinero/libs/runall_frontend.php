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

//check last update
$lastUpdate = strtotime($GLOBALS['GCMS_SETTING']['dinero']['lastUpdate']);
$date6Ago = strtotime("-6 hours");

if ($lastUpdate < $date6Ago) {
	updateRate();
}

$lastRate = Dinerorate::get(array(
		"type"     => "EU",
		"refrence" => "o-xe.com",
						),false,array("by"=>'id',"sort"=>'DESC'));

$yesterdayRateQuery = "
		SELECT AVG(ratesell) as avg FROM `gcms_dinerorate` WHERE `date` LIKE '%".date('Y-m-d',strtotime("-1 days"))."%'
		";
		
$yesterdayRate = $GLOBALS['GCMS_SAFESQL']->query($yesterdayRateQuery);
$yesterdayRate= $GLOBALS['GCMS_DB']->get_results($yesterdayRate);
$GLOBALS['GCMS']->assign('yesterdayRate', $yesterdayRate);
$GLOBALS['GCMS']->assign('dineroLastRate', $lastRate);




function updateRate(){
	require_once(__COREROOT__."/libs/simple_html_dom/simple_html_dom.php");
	
	$url = 'http://www.o-xe.com/';
	$context = stream_context_create(array('http' => array('header' => 'User-Agent: Mozilla compatible')));
	$response = file_get_contents($url, false, $context);
	$html = str_get_html($response);

	 foreach( $html->find('td[id=CUREUR]') as $MonetaryBuy) {
	 	$buyNode = $MonetaryBuy->next_sibling ();
	 	$sellNode = $buyNode->next_sibling ();
	 	
		$eurBuy =  str_replace(",", "", trim($buyNode->plaintext))  ;
		$eurSell =  str_replace(",", "", trim($sellNode->plaintext))  ;
	}
	$arr_insert=array(
			"ratebuy"  => $eurBuy,
			"ratesell" => $eurSell,
			"type"     => "EU",
			"refrence" => "o-xe.com",
			"date"     => date("Y-m-d H:i:s")
	);
	Dinerorate::insert($arr_insert);
	$lupd = Setting::get(
			array(
					"st_group"     => "dinero",
					"lastUpdate"   => "dinero",
			));
	Setting::update(
			array(
					"id" => $lupd->id,
					"st_value" => date("Y-m-d H:i:s")
			));
	
}
