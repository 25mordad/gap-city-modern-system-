<?php

/**
 * frontend_dotravel.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > Profile
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/dotravel/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//index
}


function profile()
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
			//first name
			$insert_fullname=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "firstname",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_fullname);
			//last name
			$insert_fullname=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "lastname",
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
			//country
			$insert_height=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "country",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_height);
			//city
			$insert_mainfoot=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "city",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_mainfoot);
			//address
			$insert_weight=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "address",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_weight);
			//zip
			$insert_nationality=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "zip",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_nationality);
			//occupation
			$insert_ethnicity=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "occupation",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_ethnicity);
			//visitedcountries
			$insert_currentteam=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "visitedcountries",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_currentteam);
			//wishlist
			$insert_posisions=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "wishlist",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_posisions);
			//
			//whytravel
			$insert_posisions=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "whytravel",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_posisions);
			//socialmedial
			$insert_posisions=array(
					"iduser"  => $_SESSION["gak_id"],
					"type"    => "socialmedial",
					"text"    => "",
					"date"    => date("Y-m-d H:i:s")
			);
			Acountkitparam::insert($insert_posisions);
			//
			
		}
		
		$checkbasicinfo   = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "basicinfo"));
		$checkavatar      = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "avatar"));
		$checkfirstname   = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "firstname"));
		$checklastname    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "lastname"));
		$checkgender      = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "gender"));
		$checkbirthday    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "birthday"));
		$checkcountry    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "country"));
		$checkcity    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "city"));
		$checkzip    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "zip"));
		$checkaddress    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "address"));
		
		//update
		if (isset($_GET['update'])) {
			
			
			
			$firstname    = trim($_POST['firstname']);
			$lastname     = trim($_POST['lastname']);
			$gender       = trim($_POST['gender']);
			$birthday     = trim($_POST['birthday']);
			$country      = trim($_POST['country']);
			$city         = trim($_POST['city']);
			$zip          = trim($_POST['zip']);
			$address      = trim($_POST['address']);
			
			
			Acountkitparam::update(array("id" => $checkfirstname->id,"text" => $firstname));
			Acountkitparam::update(array("id" => $checklastname->id,"text" => $lastname));
			Acountkitparam::update(array("id" => $checkgender->id,"text" => $gender));
			Acountkitparam::update(array("id" => $checkbirthday->id,"text" => $birthday));
			Acountkitparam::update(array("id" => $checkbasicinfo->id,"text" => "true"));
			
			Acountkitparam::update(array("id" => $checkcountry->id,"text" => $country));
			Acountkitparam::update(array("id" => $checkcity->id,"text" => $city));
			Acountkitparam::update(array("id" => $checkzip->id,"text" => $zip));
			Acountkitparam::update(array("id" => $checkaddress->id,"text" => $address));
			
			Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
					"date" => date("Y-m-d H:i:s"), "title" => "updateBasicinfo"));
			
			//avatar
			$uploaddir = 'uploads'.DIRECTORY_SEPARATOR.'dotravel'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR.$_SESSION["gak_id"].DIRECTORY_SEPARATOR.date("Y-m-d");
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
						header("location: /dotravel/profile");
					}
					
				}else{
					$_SESSION['result']="File size should be less than 500k";
					$_SESSION['alert']="danger";
					exit(header("location: /dotravel/profile"));
				}
			}else{
				$_SESSION['result']="Successfully updated";
				$_SESSION['alert']="success";
				header("location: /dotravel/profile");
			}
			
			
		}
		
		$GLOBALS['GCMS']->assign('ProfileFirstname', $checkfirstname);
		$GLOBALS['GCMS']->assign('ProfileLastname', $checklastname);
		$GLOBALS['GCMS']->assign('ProfileGender', $checkgender);
		$GLOBALS['GCMS']->assign('ProfileBirthday', $checkbirthday);
		$GLOBALS['GCMS']->assign('ProfileAvatar', $checkavatar);
		$GLOBALS['GCMS']->assign('ProfileCountry', $checkcountry);
		$GLOBALS['GCMS']->assign('ProfileCity', $checkcity);
		$GLOBALS['GCMS']->assign('ProfileZip', $checkzip);
		$GLOBALS['GCMS']->assign('ProfileAddress', $checkaddress);
		
}
