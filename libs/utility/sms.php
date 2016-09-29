<?php

/**
 * sms.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Utility Component.
 * Main use: send & recieve sms
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/nusoap/nusoap_client.php");

function get_client()
{
	$wsdl="http://www.afe.ir/WebService/V5/BoxService.asmx?wsdl";
	$client=new nusoap_client($wsdl, 'wsdl');
	$client->soap_defencoding='UTF-8';
	$client->decode_utf8=false;
	return $client;
}

function get_userpass()
{
	return array(
				'Username' => 'rsis',
				'Password' => '1440189'
	);
}

function send_sms($arr_send)
{
	//find messageCount ?
	$analys_sms=analys_sms($arr_send['sms_text']);
	//find toman ?
	$toman=find_toman($analys_sms['message_count'], $analys_sms['language']);
	//decr credit
	if(de_credit($toman))
	{
		$client=get_client();
		$params=get_userpass();
		$params['Number']=$GLOBALS['GCMS_SETTING']['sms']['number'];
		$params['Mobile']=array(
					'string' => $arr_send['cell']
		);
		$params['Message']=$arr_send['sms_text'];
		$params['Type']='1';
		//send mss
		$rslt=$client->call('SendMessage', $params);
		$rslt=$rslt['SendMessageResult'];
		$arr_insert=array(
					"id_afe" => $rslt['string'],
					"text" => $arr_send['sms_text'],
					"cell_no" => $arr_send['cell'],
					"date" => date("Y-m-d H:i:s"),
					"flag_compar" => "false",
					"final_result" => "unknown"
		);
		SmsSendbox::insert($arr_insert);
		return true;
	}
	else
		return false;
}

function de_credit($amount)
{
	$GLOBALS['GCMS_SETTING']['sms']['credit']=$GLOBALS['GCMS_SETTING']['sms']['credit']-$amount;
	if($GLOBALS['GCMS_SETTING']['sms']['credit']>25)
	{
		$credit=Setting::get(array("st_group" => "sms", "st_key" => "credit"));
		Setting::update(
				array("id" => $credit->id, "st_value" => $GLOBALS['GCMS_SETTING']['sms']['credit']));
		$rtrn=true;
	}
	else
	{
		$GLOBALS['GCMS_SETTING']['sms']['credit']=$GLOBALS['GCMS_SETTING']['sms']['credit']+$amount;
		$rtrn=false;
	}
	return $rtrn;
}

function analys_sms($text)
{
	//var
	$maxEnglishLength=160;
	$maxPersianLength=70;
	$maxLongEnglishLength=153;
	$maxLongPersianLength=67;
	$messageCount=1;
	//find lang
	$lang=preg_match("#[ابگچپژز]#", $text); // 0->EN | 1->Fa
	// find char
	$lang_arr=array(
				"0" => "en",
				"1" => "fa",
	);
	$messageLength=mb_strlen($text);
	if($lang=="1"and$messageLength>$maxPersianLength)
	{
		//farsi
		$n_m_l=$messageLength-$maxPersianLength;
		$messageCount=floor($n_m_l/$maxLongPersianLength)+1;
		if($n_m_l%$maxLongPersianLength!=0)
			$messageCount++;
	}
	if($lang=="0"and$messageLength>$maxEnglishLength)
	{
		//english
		$n_m_l=$messageLength-$maxEnglishLength;
		$messageCount=floor($n_m_l/$maxLongEnglishLength)+1;
		if($n_m_l%$maxLongEnglishLength!=0)
			$messageCount++;
	}
	$return_arr=array(
				"message_count" => $messageCount,
				"language" => $lang_arr[$lang],
	);
	return $return_arr;
}

function find_toman($message_count, $language)
{
	if($language=="fa")
	{
		$toman=$GLOBALS['GCMS_SETTING']['sms']['fa_fee'];
	}
	else
	{
		$toman=$GLOBALS['GCMS_SETTING']['sms']['en_fee'];
	}
	$new_toman=$toman*$message_count;
	return $new_toman;
}

function get_sms_status($id_afe)
{
	$client=get_client();
	$params=get_userpass();
	$params['SmsID']=$id_afe;
	return $client->call('GetMessageStatus', $params);
}

function get_last_sms()
{ 
	$param=get_userpass();
	$param['To']=$GLOBALS['GCMS_SETTING']['sms']['number'];
	ini_set("soap.wsdl_cache_enabled", "0");
	$client=new SoapClient('http://www.afe.ir/WebService/Inboxservice.asmx?wsdl');
	$result=get_object_vars($client->__SoapCall('GetLast', array($param)));
	return $result['GetLastResult'];
}

function get_perior_sms($id)
{
	$param=get_userpass();
	$param['To']=$GLOBALS['GCMS_SETTING']['sms']['number'];
	$param['ID']=$id;
	ini_set("soap.wsdl_cache_enabled", "0");
	$client=new SoapClient('http://www.afe.ir/WebService/Inboxservice.asmx?wsdl');
	$result=get_object_vars($client->__SoapCall('GetPerior', array($param)));
	return $result['GetPeriorResult'];
}