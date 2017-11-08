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
				"googlemap"         => "",
				"meetingpoint"      => "",
				"description"       => "",
				"status"            => "pending",
				"bookstatus"        => "pending",
				"ticketorder"       => 0,
				//"tickettype"        => "",
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
			
	///get type
	$ticketType = Type::get(array("name" => "tickettype"),true);
	$GLOBALS['GCMS']->assign('ticketType', $ticketType);
	///EDIT
	if (isset($_GET['edit'])){
		
		/* //tickettype
		$tickettype= "";
		foreach($_POST['tickettype'] as $p) {
			$tickettype= $tickettype."|".$p;
		} */
		
		foreach ($ticketType as $tt){
			if ($_POST['price'.$tt->value] != "" && $_POST['bookingfee'.$tt->value] != ""){
				$insertTicketprice=array(
						"id_ticket"      => $id,
						"name"           => $tt->value,
						"price"          => $_POST['price'.$tt->value],
						"bookingfee"     => $_POST['bookingfee'.$tt->value]
				);
				Ticketprice::insert($insertTicketprice); 
			}
			
		}
		
		$editTicket=array(
				"id"                => $id,
				"country"           => $_POST['country'],
				"state"             => $_POST['state'],
				"city"              => $_POST['city'],
				"title"             => $_POST['title'],
				"googlemap"         => $_POST['latitude'].":".$_POST['longitude'],
				"meetingpoint"      => $_POST['meetingpoint'],
				"description"       => $_POST['description'],
				"status"            => $_POST['status'],
				"bookstatus"        => $_POST['bookstatus'],
				//"tickettype"        => $tickettype,
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
	///get ticket		
	$Ticket = Ticket::get(array("id" => $id));
	$GLOBALS['GCMS']->assign('Ticket', $Ticket);
	
}




