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

require_once(__COREROOT__."/module/ticket/controller/admin.php");
$utilityfile = __COREROOT__."/module/ticket/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//index
}
function show($id)
{
	///get ticket
	$Ticket = Ticket::get(array("id" => $id));
	if (!$Ticket)
		exit(header("Location: /"));
		$GLOBALS['GCMS']->assign('Ticket', $Ticket);
		
	//showtime
	$tickettimes = Tickettime::get(array("id_ticket" => $id), true,$order=array("by" => "hour", "sort" => " ASC" ));
	$GLOBALS['GCMS']->assign('Tickettimes', $tickettimes);
	
	//ticketprice
	$ticketprices = Ticketprice::get(array("id_ticket" => $id), true);
	$GLOBALS['GCMS']->assign('Ticketprices', $ticketprices);
}




