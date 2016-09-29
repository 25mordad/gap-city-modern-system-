<?php

/**
 * backend-module.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > module
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */
if($_SESSION["level"]!="10")

	header("location: /error404?error=module&reason=NoAccess");

function index()
{

	$modules=Module::get(NULL, true);
	$GLOBALS['GCMS']->assign('modules', $modules);
}

function new_module()
{
	if(isset($_POST['module_name']))
	{
		$arr_insert=array(
				"module_name" => $_POST['module_name'],
				"status"      => "active"
		);
		Module::insert($arr_insert);
		$id = mysqli_insert_id() ;
		

		//SQL INSERT :: Load module/sql/module.php
		$sqlfile= __COREROOT__."/module/".$_POST['module_name']."/sql/".$_POST['module_name'].".php";
		if(file_exists($sqlfile))
			require_once($sqlfile);
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					Sql File Not Found
					</div>";
		//Check tpl file
		if(file_exists(__COREROOT__."/module/".$_POST['module_name']."/backend/tpl/".$_POST['module_name']."/index.tpl"))
			echo "
					<div style=\"border:1px solid green;color:green; padding:10px; width: 700px; margin:10px auto;\" >
					TPL File OK
					</div>";
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					TPL File Not Found
					</div>";
		//Check Controller file
		if(file_exists(__COREROOT__."/module/".$_POST['module_name']."/controller/backend_".$_POST['module_name'].".php"))
			echo "
					<div style=\"border:1px solid green;color:green; padding:10px; width: 700px; margin:10px auto;\" >
					Backend Controller File OK
					</div>";
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					Backend Controller File Not Found
					</div>";
		
		//Check Controller file
		if(file_exists(__COREROOT__."/module/".$_POST['module_name']."/controller/frontend_".$_POST['module_name'].".php"))
			echo "
					<div style=\"border:1px solid green;color:green; padding:10px; width: 700px; margin:10px auto;\" >
					Frontend Controller File OK
					</div>";
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					Frontend Controller File Not Found
					</div>";
		
		//Check Controller file
		if(file_exists(__COREROOT__."/module/".$_POST['module_name']."/controller/ajax.php"))
			echo "
					<div style=\"border:1px solid green;color:green; padding:10px; width: 700px; margin:10px auto;\" >
					Ajax Controller File OK
					</div>";
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					Ajax Controller File Not Found
					</div>";
		
		
		//Check Libs file
		if(file_exists(__COREROOT__."/module/".$_POST['module_name']."/libs/utility.php"))
			echo "
					<div style=\"border:1px solid green;color:green; padding:10px; width: 700px; margin:10px auto;\" >
					Utility Libs File OK
					</div>";
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					Utility Libs File Not Found
					</div>";
		
		//Check Libs file
		/* if(file_exists(__COREROOT__."/module/".$_POST['module_name']."/libs/menu.php"))
			echo "
					<div style=\"border:1px solid green;color:green; padding:10px; width: 700px; margin:10px auto;\" >
					Backend Menu File OK
					</div>";
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					Backend Menu File Not Found
					</div>"; */
		
		//Check Libs file
		/* if(file_exists(__COREROOT__."/module/".$_POST['module_name']."/libs/help.php"))
			echo "
					<div style=\"border:1px solid green;color:green; padding:10px; width: 700px; margin:10px auto;\" >
					Backend Help File OK
					</div>";
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					Backend Menu File Not Found
					</div>"; */
		
		//Check Libs file
		if(file_exists(__COREROOT__."/module/".$_POST['module_name']."/libs/runall_frontend.php"))
			echo "
					<div style=\"border:1px solid green;color:green; padding:10px; width: 700px; margin:10px auto;\" >
					Runall frontend File OK
					</div>";
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					Runall frontend File Not Found
					</div>";
		
		//Check Libs file
		if(file_exists(__COREROOT__."/module/".$_POST['module_name']."/libs/runall_backend.php"))
			echo "
					<div style=\"border:1px solid green;color:green; padding:10px; width: 700px; margin:10px auto;\" >
					Runall backend  File OK
					</div>";
		else
			echo "
					<div style=\"border:1px solid red;color:red; padding:10px; width: 700px; margin:10px auto;\" >
					Runall backend  File Not Found
					</div>";
				
		
		exit();
		
	}
	
	
}
function change_status($id)
{
	
	if ($_GET['status']=="active")
		$status = "pending";
	else
		$status = "active";
	$arr_update=array(
			"id"     => $id,
			"status" => $status
	);
	Module::update($arr_update);
	$_SESSION['result']="ویرایش انجام شد";
	$_SESSION['alert']="success";
	header("location: /gadmin/module/");
	
}

