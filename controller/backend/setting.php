<?php

/**
 * setting.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > setting
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */
//TODO Enhance Setting

function index()
{

}

function update()
{
	$st_group=$_REQUEST['stng'];
	$to_updates=Setting::get(array("st_group" => $st_group), true);
	foreach($to_updates as $to_update)
	{
		if(isset($_REQUEST[$st_group."|".$to_update->st_key]))
			Setting::update(
					array(
								"id" => $to_update->id,
								"st_value" => $_REQUEST[$st_group."|".$to_update->st_key]
					));
	}
	$_SESSION['result']="تنظیمات به‌روز شد";
	$_SESSION['alert']="success";
	header("location: /gadmin/setting/#".$_REQUEST['tabs']);
}
