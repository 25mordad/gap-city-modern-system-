<?php

/**
 * frontend_ticket.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > Profile
 *
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/ticket/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function Admin()
{
	///CHECK SESSION
	if(!isset($_SESSION["gak_email"]))
		exit(header("Location: /accountkit"));
	else 
		if(!strpos($_SESSION["gak_level"], ":ticket"))
			exit(header("Location: /accountkit"));
	
	///ADD
	if (isset($_GET['add'])){
		$insertTicket=array(
				"country"           => $_POST['country'],
				"state"             => $_POST['state'],
				"city"              => $_POST['city'],
				"title"             => $_POST['title'],
				"url"               => $_POST['title'],
				"googlemap"         => "",
				"meetingpoint"      => "",
				"description"       => "",
				"status"            => "pending",
				"bookstatus"        => "pending",
				"ticketorder"       => 0,
				"facilities"        => "|Skip the Line|Mobile Voucher Accepted|Printed Voucher Accepted|Instant Confirmation|Easy Cancellation|Licensed Guides|Guarantee Entrance|Last Minute Ticket",
				"duration"          => "",
				"author_id"         => $_SESSION["gak_id"],
				"created_date"      => date("Y-m-d H:i:s"),
				"modified_date"     => date("Y-m-d H:i:s")
		);
		$lastId = Ticket::insert($insertTicket);
		//log
		Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
				"date" => date("Y-m-d H:i:s"), "title" => "AddTicket:".$lastId));
		//OK
		$_SESSION['result']="Ticket successfully added ";
		$_SESSION['alert']="success";
		exit(header("Location: /ticket/AdminEditTicket/".$lastId));
		
	}
	
	///get ticket list
	$Ticketlist = Ticket::get(array(),true);
	$GLOBALS['GCMS']->assign('Ticketlist', $Ticketlist);
			
			
}
function AdminEditTicket($id)
{
	///CHECK SESSION
	if(!isset($_SESSION["gak_email"]))
		exit(header("Location: /accountkit"));
		else
			if(!strpos($_SESSION["gak_level"], ":ticket"))
				exit(header("Location: /accountkit"));
			
	///get ticket
	$Ticket = Ticket::get(array("id" => $id));
	if (!$Ticket)
		exit(header("Location: /dashboard"));
	$GLOBALS['GCMS']->assign('Ticket', $Ticket);
				
	///get type
	$ticketType = Type::get(array("name" => "tickettype"),true);
	$GLOBALS['GCMS']->assign('ticketType', $ticketType);
	///get feature
	$tickettypeFeature = Type::get(array("name" => "ticketfeature"),true);
	$GLOBALS['GCMS']->assign('tickettypeFeature', $tickettypeFeature);
	
	///if prices set?
	$ticketPrice = Ticketprice::get(array("id_ticket" => $id),true);
	$GLOBALS['GCMS']->assign('ticketPrice', $ticketPrice);
	if(!$ticketPrice){
		foreach ($ticketType as $tt){
			$insertTicketprice=array(
					"id_ticket"      => $id,
					"name"           => $tt->value,
					"price"          => 0,
					"bookingfee"     => 0,
					"offer"          => 0
			);
			Ticketprice::insert($insertTicketprice);
		}
		$ticketPrice = Ticketprice::get(array("id_ticket" => $id),true);
		$GLOBALS['GCMS']->assign('ticketPrice', $ticketPrice);
	}
	///if features set?
	$ticketFeature= Ticketfeature::get(array("id_ticket" => $id),true);
	$GLOBALS['GCMS']->assign('ticketFeature', $ticketFeature);
	if(!$ticketFeature){
		foreach ($tickettypeFeature as $tf){
			$insertTicketfeature=array(
					"id_ticket" => $id,
					"name"      => $tf->value,
					"value"     => ""
			);
			Ticketfeature::insert($insertTicketfeature);
		}
		$ticketFeature= Ticketfeature::get(array("id_ticket" => $id),true);
		$GLOBALS['GCMS']->assign('ticketFeature', $ticketFeature);
	}
	///EDIT
	if (isset($_GET['edit'])){
		//posision
		$facilities= "";
		foreach($_POST['facilities'] as $p) {
			$facilities= $facilities."|".$p;
		}
		
		$editTicket=array(
				"id"                => $id,
				"country"           => $_POST['country'],
				"state"             => $_POST['state'],
				"city"              => $_POST['city'],
				"title"             => $_POST['title'],
				"url"               => $_POST['url'],
				"googlemap"         => $_POST['latitude'].":".$_POST['longitude'],
				"meetingpoint"      => $_POST['meetingpoint'],
				"description"       => $_POST['description'],
				"status"            => $_POST['status'],
				"bookstatus"        => $_POST['bookstatus'],
				"facilities"        => $facilities,
				"duration"          => $_POST['duration'],
				"modified_date"     => date("Y-m-d H:i:s")
		);
		Ticket::update($editTicket);
		//log
		Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
				"date" => date("Y-m-d H:i:s"), "title" => "AditTicket:".$id));
		//OK
		$_SESSION['result']="Ticket successfully editted ";
		$_SESSION['alert']="success";
		exit(header("Location: /ticket/AdminEditTicket/".$id));
	}
	
	
}




