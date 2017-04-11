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

function prototype()
{
	//boy
	if ($_GET['gender'] == "boy"){
		for ($i=1;$i < 700;$i++){
			//rand name
			$names = array(
					'Christopher',
					'Ryan',
					'Ethan',
					'John',
					'Jackson',
					'Aiden',
					'Michelle',
					'Lucas',
			);
			$surnames = array(
					'Walker',
					'Thompson',
					'Anderson',
					'Johnson',
					'Tremblay',
					'Peltier',
					'Cunningham',
					'Simpson',
					'Mercado',
					'Sellers'
			);
			$random_name = $names[mt_rand(0, sizeof($names) - 1)];
			$random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];
			//rand birthday
			$arrayBirthday= array("2007","2006","2005","2005","2004","2004","2003");
			$birth = array_rand($arrayBirthday);
			//rand height
			$arrayHeight= array(
					"130","131","132","133","134","135","136","137","138","139","140",
					"139","140","141","142","143","144","145","146","147","148","149",
					"140","141","142","143","144","145","146","147","148","149","150",
					"151","152","153","154","155","156","157","158","159","160","161",
					"159","160","161","162","163","164","165","166","167","168","169"
			);
			$height= array_rand($arrayHeight);
			//rand weight
			$arrayWeight= array(
					"29","30","31","32","33","34","35",
					"33","34","35","36","37","38","39",
					"37","38","39","40","41","42","43",
					"43","44","45","46","47","48","49",
					"48","49","50","51","52","53","54"
			);
			$weight= array_rand($arrayWeight);
			//rand foot
			$arrayMainfoot = array("right","right","right","right","left","left","both");
			$mainfoot = array_rand($arrayMainfoot);
			//rand nationanily
			$arrayNationanily= array("Spain","Germany","Netherlands");
			$nationanily= array_rand($arrayNationanily);
			//rand ethnicity
			$arrayEthnicity= array("european","european","european","european","european","european","asian","african","southamerican","northamerican");
			$ethnicity= array_rand($arrayEthnicity);
			//rand current team
			$arrayCurrent= array("school team","","","","local team","fc","ac","city","profesional","national team");
			$current= array_rand($arrayCurrent);
			//rand position
			$arrayPosition= array("goalkeeper","defender","midfielder","forward","winger","defensivemidfield","wingback","","","","","","",);
			$position= array_rand($arrayPosition);
			//insert
			$insert=array(
					"fullname"  => $random_name . ' ' . $random_surname,
					"gender"    => "boy",
					"birthday"    => $arrayBirthday[$birth]."-04-18",
					"height"    => $arrayHeight[$height],
					"weight"    => $arrayWeight[$weight],
					"mainfoot"    => $arrayMainfoot[$mainfoot],
					"nationality"    => $arrayNationanily[$nationanily],
					"ethnicity"    => $arrayEthnicity[$ethnicity],
					"currentteam"    => $arrayCurrent[$current],
					"posisions"    => $arrayPosition[$position]
			);
			Talentofake::insert($insert);
		}
	
	}
	
	//girl
	if ($_GET['gender'] == "girl"){
		for ($i=1;$i < 300;$i++){
			//rand name
			$names = array(
					'Sophia',
					'Emma',
					'Maria',
					'Olivia',
					'Ava',
					'Sarah',
					'Mia',
					'Isabella',
			);
			$surnames = array(
					'Walker',
					'Thompson',
					'Anderson',
					'Johnson',
					'Tremblay',
					'Peltier',
					'Cunningham',
					'Simpson',
					'Mercado',
					'Sellers'
			);
			$random_name = $names[mt_rand(0, sizeof($names) - 1)];
			$random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];
			//rand birthday
			$arrayBirthday= array("2007","2006","2005","2005","2004","2004","2003");
			$birth = array_rand($arrayBirthday);
			//rand height
			$arrayHeight= array(
					"130","131","132","133","134","135","136","137","138","139","140",
					"139","140","141","142","143","144","145","146","147","148","149",
					"140","141","142","143","144","145","146","147","148","149","150",
					"151","152","153","154","155","156","157","158","159","160","161",
					"159","160","161","162","163","164","165","166","167","168","169"
			);
			$height= array_rand($arrayHeight);
			//rand weight
			$arrayWeight= array(
					"29","30","31","32","33","34","35",
					"33","34","35","36","37","38","39",
					"37","38","39","40","41","42","43",
					"43","44","45","46","47","48","49",
					"48","49","50","51","52","53","54"
			);
			$weight= array_rand($arrayWeight);
			//rand foot
			$arrayMainfoot = array("right","right","right","right","left","left","both");
			$mainfoot = array_rand($arrayMainfoot);
			//rand nationanily
			$arrayNationanily= array("Spain","Germany","Netherlands");
			$nationanily= array_rand($arrayNationanily);
			//rand ethnicity
			$arrayEthnicity= array("european","european","european","european","european","european","asian","african","southamerican","northamerican");
			$ethnicity= array_rand($arrayEthnicity);
			//rand current team
			$arrayCurrent= array("school team","","","","local team","fc","ac","city","profesional","national team");
			$current= array_rand($arrayCurrent);
			//rand position
			$arrayPosition= array("goalkeeper","defender","midfielder","forward","winger","defensivemidfield","wingback","","","","","","",);
			$position= array_rand($arrayPosition);
			//insert
			$insert=array(
					"fullname"  => $random_name . ' ' . $random_surname,
					"gender"    => "girl",
					"birthday"    => $arrayBirthday[$birth]."-04-18",
					"height"    => $arrayHeight[$height],
					"weight"    => $arrayWeight[$weight],
					"mainfoot"    => $arrayMainfoot[$mainfoot],
					"nationality"    => $arrayNationanily[$nationanily],
					"ethnicity"    => $arrayEthnicity[$ethnicity],
					"currentteam"    => $arrayCurrent[$current],
					"posisions"    => $arrayPosition[$position]
			);
			Talentofake::insert($insert);
		}
	}
	
	//list
	if ($_GET['step'] == "1"){
		
		$arr_get=array(
				
		);
		$order=array(
				"rand" => "RAND()",
		);
		$limit=array(
				"start" => 1,
				"end" => 100
		);
		$list = Talentofake::get($arr_get, true, $order, $limit);
		$GLOBALS['GCMS']->assign('list', $list);
	}
	//boy - girl
	if ($_GET['step'] == "2"){
		$arr_get=array(
				"gender" => "boy",
		);
		$arr_get_girl=array(
				"gender" => "girl",
		);
		$order=array(
				"rand" => "RAND()",
		);
		$limit=array(
				"start" => 1,
				"end" => 10
		);
		$GLOBALS['GCMS']->assign('boy', Talentofake::get($arr_get, true, $order, $limit));
		$GLOBALS['GCMS']->assign('girl', Talentofake::get($arr_get_girl, true, $order, $limit));
	}
	
	//3
	if ($_GET['step'] == "3"){
		$arr_get=array(
				"gender" => "boy",
		);
		$order=array(
				"rand" => "RAND()",
		);
		$limit=array(
				"start" => 1,
				"end" => 200
		);
		$GLOBALS['GCMS']->assign('boy', Talentofake::get($arr_get, true, $order, $limit));
	}
	//4
	if ($_GET['step'] == "4"){
		$arr_get=array(
				"gender" => "boy",
		);
		$order=array(
				"rand" => "RAND()",
		);
		$limit=array(
				"start" => 1,
				"end" => 200
		);
		$GLOBALS['GCMS']->assign('boy', Talentofake::get($arr_get, true, $order, $limit));
	}
	
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
