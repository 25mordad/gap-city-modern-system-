<?php

/**
 * frontend_talent.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > talent
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/talent/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//index
}

function basicinfo()
{
	if(!isset($_SESSION["gak_email"]))
		exit(header("Location: /accountkit"));
		
		//check
		$checkBasicinfo=Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "basicinfo"));
		if (!isset($checkBasicinfo)){
			
			//insert basicinfo
			$insert_basicinfo=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "basicinfo",
					"text"    => "false",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_basicinfo);
			//fullname
			$insert_fullname=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "fullname",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_fullname);
			//avatar
			$insert_avatar=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "avatar",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_avatar);
			//gender
			$insert_gender=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "gender",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_gender);
			//birthday
			$insert_birthday=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "birthday",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_birthday);
			//height
			$insert_height=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "height",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_height);
			//mainfoot
			$insert_mainfoot=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "mainfoot",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_mainfoot);
			//weight
			$insert_weight=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "weight",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_weight);
			//nationality
			$insert_nationality=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "nationality",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_nationality);
			//ethnicity
			$insert_ethnicity=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "ethnicity",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_ethnicity);
			//currentteam
			$insert_currentteam=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "currentteam",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_currentteam);
			//posisions
			$insert_posisions=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "posisions",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_posisions);
			//
			
		}
		
		$checkbasicinfo   = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "basicinfo"));
		$checkavatar      = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "avatar"));
		$checkfullname    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "fullname"));
		$checkgender      = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "gender"));
		$checkheight      = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "height"));
		$checkbirthday    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "birthday"));
		$checkmainfoot    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "mainfoot"));
		$checkweight      = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "weight"));
		$checknationality = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "nationality"));
		$checkethnicity   = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "ethnicity"));
		$checkcurrentteam = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "currentteam"));
		$checkposisions   = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "posisions"));
		
		//update
		if (isset($_GET['update'])) {
			
			
			
			$fullname     = trim($_POST['fullname']);
			$gender       = trim($_POST['gender']);
			$height       = trim($_POST['height']);
			$birthday     = trim($_POST['birthday']);
			$mainfoot     = trim($_POST['mainfoot']);
			$weight       = trim($_POST['weight']);
			$nationality  = trim($_POST['nationality']);
			$ethnicity    = trim($_POST['ethnicity']);
			$currentteam  = trim($_POST['currentteam']);
			
			//posision
			$$posisions = "";
			foreach($_POST['posisions'] as $p) {
				$posisions = $posisions."|".$p;
			}
			
			Acountkitparam::update(array("id" => $checkfullname->id,"text" => $fullname));
			Acountkitparam::update(array("id" => $checkgender->id,"text" => $gender));
			Acountkitparam::update(array("id" => $checkheight->id,"text" => $height));
			Acountkitparam::update(array("id" => $checkbirthday->id,"text" => $birthday));
			Acountkitparam::update(array("id" => $checkmainfoot->id,"text" => $mainfoot));
			Acountkitparam::update(array("id" => $checkweight->id,"text" => $weight));
			Acountkitparam::update(array("id" => $checknationality->id,"text" => $nationality));
			Acountkitparam::update(array("id" => $checkethnicity->id,"text" => $ethnicity));
			Acountkitparam::update(array("id" => $checkcurrentteam->id,"text" => $currentteam));
			Acountkitparam::update(array("id" => $checkposisions->id,"text" => $posisions));
			Acountkitparam::update(array("id" => $checkbasicinfo->id,"text" => "true"));
			
			Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
					"date" => date("Y-m-d H:i:s"), "title" => "updateBasicinfo"));
			
			//avatar
			$uploaddir = 'uploads'.DIRECTORY_SEPARATOR.'talentoday'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR.$_SESSION["gak_id"].DIRECTORY_SEPARATOR.date("Y-m-d");
			if(!is_dir($uploaddir))
				mkdir($uploaddir, 0755, true);
			$check = getimagesize($_FILES["avatar"]["tmp_name"]);
			$tempFile = $_FILES['avatar']['tmp_name'];
			$targetPath = __ROOT__ . DIRECTORY_SEPARATOR . $uploaddir . DIRECTORY_SEPARATOR;
			
			if($check !== false) {
				if ($_FILES["avatar"]["size"] < 500000 ) {
					
					$getMime=explode('.', $_FILES['avatar']['name']);
					$mime=strtolower(end($getMime));
					$imName = rand(10000,99999) .".".$mime;
					$targetFile =  $targetPath.$imName;
					if (move_uploaded_file($tempFile, $targetFile)) {
						//
						Acountkitparam::update(array("id" => $checkavatar->id,"text" => DIRECTORY_SEPARATOR.$uploaddir.DIRECTORY_SEPARATOR.$imName));
						Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
								"date" => date("Y-m-d H:i:s"), "title" => "uploadAvatar"));
						
						$_SESSION['result']="Successfully updated";
						$_SESSION['alert']="success";
						header("location: /talent/basicinfo");
					}
					
				}else{
					$_SESSION['result']="File size should be less than 500k";
					$_SESSION['alert']="danger";
					exit(header("location: /talent/basicinfo"));
				}
			}else {
				$_SESSION['result']=" You should upload an image";
				$_SESSION['alert']="danger";
				exit(header("location: /talent/basicinfo"));
			}
			
			
		}
		
		$GLOBALS['GCMS']->assign('TalentFullname', $checkfullname);
		$GLOBALS['GCMS']->assign('TalentGender', $checkgender);
		$GLOBALS['GCMS']->assign('TalentMainfoot', $checkmainfoot);
		$GLOBALS['GCMS']->assign('TalentHeight', $checkheight);
		$GLOBALS['GCMS']->assign('TalentWeight', $checkweight);
		$GLOBALS['GCMS']->assign('TalentBirthday', $checkbirthday);
		$GLOBALS['GCMS']->assign('TalentNationality', $checknationality);
		$GLOBALS['GCMS']->assign('TalentEthnicity', $checkethnicity);
		$GLOBALS['GCMS']->assign('TalentCurrentteam', $checkcurrentteam);
		$GLOBALS['GCMS']->assign('TalentPosisions', $checkposisions);
		$GLOBALS['GCMS']->assign('TalentAvatar', $checkavatar);
		
}
