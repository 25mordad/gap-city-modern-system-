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
if(isset($_SESSION["gak_email"])) {
	//check basicinfo
	$checkBasicinfo=Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "basicinfo"));
	if (!isset($checkBasicinfo)){
		$GLOBALS['GCMS']->assign('DineroAlarmBasicinfo', "true");
	}else{
		$GLOBALS['GCMS']->assign('DineroAlarmBasicinfo', "false");
	}
	//check bankaccount
	$checkBankaccount=Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "bankaccount"));
	if (!isset($checkBankaccount)){
		$GLOBALS['GCMS']->assign('DineroAlarmBankaccount', "true");
	}else{
		$GLOBALS['GCMS']->assign('DineroAlarmBankaccount', "false");
	}
	//check avatar
	$checkAvatar=Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "avatar"));
	if ($checkAvatar->text == "confirm" ){
		$GLOBALS['GCMS']->assign('DineroAlarmAvatar', "false");
		$checkAvatarPath=Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "avatarpath"));
		$GLOBALS['GCMS']->assign('DineroAvatarPath', $checkAvatarPath);
	}else{
		$GLOBALS['GCMS']->assign('DineroAlarmAvatar', "true");
	}
	//check idfoto
	$checkIdfoto=Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "idfoto"));
	if ($checkIdfoto->text == "confirm" ){
		$GLOBALS['GCMS']->assign('DineroAlarmIdfoto', "false");
	}else{
		$GLOBALS['GCMS']->assign('DineroAlarmIdfoto', "true");
	}
	//check if wallet
	$checkWallet=Wallet::get(array("id_user" => $_SESSION["gak_id"], "currency" => "Toman"));
	if (!isset($checkWallet)){
		$GLOBALS['GCMS']->assign('DineroCheckWallet', false);
	}else{
		$GLOBALS['GCMS']->assign('DineroWallet', $checkWallet);
		$GLOBALS['GCMS']->assign('DineroCheckWallet', true);
	}
}













//check last update
$lastUpdate = strtotime($GLOBALS['GCMS_SETTING']['dinero']['lastUpdate']);
$date6Ago = strtotime("-30 minutes");
if ($lastUpdate < $date6Ago) {
	updateRate();
}

$lastRate = Dinerorate::get(array(
		"type"     => "EU",
		"refrence" => "o-xe.com",
						),false,array("by"=>'id',"sort"=>'DESC'));
//
$yesterdayRateQuery = "
		SELECT AVG(ratesell) as avg FROM `gcms_dinerorate` WHERE `date` LIKE '%".date('Y-m-d',strtotime("-1 days"))."%'
		";
$yesterdayRate = $GLOBALS['GCMS_SAFESQL']->query($yesterdayRateQuery);
$GLOBALS['GCMS']->assign('yesterdayRate', $GLOBALS['GCMS_DB']->get_results($yesterdayRate));
//
$weekRateQuery = "
		SELECT date(date) as ddate,ratesell FROM `gcms_dinerorate` WHERE date > DATE_SUB(NOW(), INTERVAL 7 DAY) 
		";
$weekRate = $GLOBALS['GCMS_SAFESQL']->query($weekRateQuery);
$GLOBALS['GCMS']->assign('weekRate', $GLOBALS['GCMS_DB']->get_results($weekRate));



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






