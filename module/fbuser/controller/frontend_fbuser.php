<?php

/**
 * frontend_fbuser.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > SAMPLE
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/fbuser/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	if (isset($_GET['login'])){
		
		$_SESSION["code"] = $_POST["code"];
		$_SESSION["csrf_nonce"] = $_POST["csrf_nonce"];
		$ch = curl_init();
		// Set url elements
		$fb_app_id = '1316947845046260';
		$ak_secret = '17c99d791b5238b1946f080b7142c9d8';
		$token = 'AA|'.$fb_app_id.'|'.$ak_secret;
		
		// Get access token
		$url = 'https://graph.accountkit.com/v1.0/access_token?grant_type=authorization_code&code='.$_POST["code"].'&access_token='.$token;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		$info = json_decode($result);
		
		// Get account information
		$appsecret_proof = hash_hmac('sha256', $info->access_token, $ak_secret);
		
		$url = 'https://graph.accountkit.com/v1.0/me/?access_token='.$info->access_token . '&appsecret_proof='.$appsecret_proof;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL,$url);
		$result=curl_exec($ch);
		curl_close($ch);
		$final = json_decode($result);
		die($result);
	}
}