<?php

/**
 * frontend_dinero.php
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

$utilityfile = __COREROOT__."/module/dinero/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//find advs
	$Advertisements = Dineroadv::get(array("status" => "active"),true);
	$GLOBALS['GCMS']->assign('Advertisements', $Advertisements);
}

function adv()
{
	//advertisment
	if(!isset($_SESSION["gak_email"]))
		exit(header("Location: /accountkit"));
	//check if wallet
	$checkWallet=Wallet::get(array("id_user" => $_SESSION["gak_id"], "currency" => "Toman"));
	if (!isset($checkWallet)){
		if (isset($_GET['update'])){
			//insert wallet toman
			$insert_wallet=array(
					"id_user"        => $_SESSION["gak_id"],
					"amount"         => "0",
					"currency"       => "Toman",
					"iban"           => $_POST['iban'],
					"cardno"         => $_POST['cardno'],
					"accountholder"  => $_POST['accountholder'],
					"bankname"       => $_POST['iban'],
					"expdate"        => date("Y-m-d"),
					"status"         => "active"
			);
			Wallet::insert($insert_wallet);
			$_SESSION['result']=" کیف پول تومان شما با موفقیت ایجاد شد. ";
			$_SESSION['alert']="success";
			header("location: /dinero/adv");
		}
	}else{
		if (isset($_GET['add'])){
			//insert wallet toman
			$insert_wallet=array(
					"id_user"        => $_SESSION["gak_id"],
					"currency"       => "Euro",
					"amount"         => $_POST['amount'],
					"minmax"         => $_POST['mintransaction']."|"
									   .$_POST['maxtransaction']."|"
									   .$_POST['maxanswer']."|"
									   .$_POST['maxtransfer'],
					"locations"      => "es|",
					"method"         => "bank|",
					"status"         => "active",
					"text"           => $_POST['text'],
					"time"           => date("Y-m-d H:i"),
			);
			Dineroadv::insert($insert_wallet);
			$_SESSION['result']=" آگهی شما با موفقیت ثبت شد. ";
			$_SESSION['alert']="success";
			header("location: /dinero/adv");
		}
	}
		
	
}

function documents()
{
	if(!isset($_SESSION["gak_email"]))
		exit(header("Location: /accountkit"));
	
	//check
	$checkAvatar=Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "avatar"));
	if (!isset($checkAvatar)){
		//insert avatar
		$insert_avatar=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "avatar",
				"text"    => "false",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_avatar);
		//insert avatarpath
		$insert_avatarpath=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "avatarpath",
				"text"    => "",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_avatarpath);
		//insert idfoto
		$insert_idfoto=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "idfoto",
				"text"    => "false",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_idfoto);
		//insert idfotopath
		$insert_idfotopath=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "idfotopath",
				"text"    => "",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_idfotopath);
			
	}
	$checkAvatar     = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "avatar"));
	$checkAvatarpath = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "avatarpath"));
	$checkIdfoto     = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "idfoto"));
	$checkIdfotopath = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "idfotopath"));
		
	if (isset($_GET['update']))
	{
		$uploaddir = 'uploads'.DIRECTORY_SEPARATOR.'dinero'.DIRECTORY_SEPARATOR.'avatar'.DIRECTORY_SEPARATOR.$_SESSION["gak_id"].DIRECTORY_SEPARATOR.date("Y-m-d");
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
					Acountkitparam::update(array("id" => $checkAvatar->id,"text" => "pending"));
					Acountkitparam::update(array("id" => $checkAvatarpath->id,"text" => DIRECTORY_SEPARATOR .$uploaddir.DIRECTORY_SEPARATOR.$imName));
					Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], 
							"date" => date("Y-m-d H:i:s"), "title" => "uploadavatar"));
						
					//
					$_SESSION['result']=" با موفقیت آپلود شد.  ";
					$_SESSION['alert']="success";
					header("location: /dinero/documents");
				} else {
					$_SESSION['result']=" خطا، دوباره تلاش کنید ";
					$_SESSION['alert']="danger";
					header("location: /dinero/documents");
				}
			}else{
				$_SESSION['result']=" حجم فایل ارسالی شما بیشتر از ۵۰۰ کیلو است. ";
				$_SESSION['alert']="danger";
				header("location: /dinero/documents");
			}
		} else {
			$_SESSION['result']=" فایل ارسالی شما فرمت تصویر ندارد ";
			$_SESSION['alert']="danger";
			header("location: /dinero/documents");
		}
		
	}
	if (isset($_GET['upload']))
	{
		$uploaddir = 'uploads'.DIRECTORY_SEPARATOR.'dinero'.DIRECTORY_SEPARATOR .$_SESSION["gak_id"].DIRECTORY_SEPARATOR.date("Ymd").DIRECTORY_SEPARATOR.rand(10000,99999);
		if(!is_dir($uploaddir))
			mkdir($uploaddir, 0755, true);
		$check = getimagesize($_FILES["idcard"]["tmp_name"]);
		$tempFile = $_FILES['idcard']['tmp_name'];
		$targetPath = __ROOT__ . DIRECTORY_SEPARATOR .$uploaddir . DIRECTORY_SEPARATOR;
		
		
		if($check !== false) {
			if ($_FILES["idcard"]["size"] < 500000 ) {
				$getMime=explode('.', $_FILES['idcard']['name']);
				$mime=strtolower(end($getMime));
				$imName = rand(10000,99999) .".".$mime;
				$targetFile =  $targetPath.$imName;
				if (move_uploaded_file($tempFile, $targetFile)) {
					//
					Acountkitparam::update(array("id" => $checkIdfoto->id,"text" => "pending"));
					Acountkitparam::update(array("id" => $checkIdfotopath->id,"text" => DIRECTORY_SEPARATOR .$uploaddir.DIRECTORY_SEPARATOR.$imName));
					Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], 
							"date" => date("Y-m-d H:i:s"), "title" => "uploadidfoto"));
						
					//
					$_SESSION['result']=" با موفقیت آپلود شد.  ";
					$_SESSION['alert']="success";
					header("location: /dinero/documents");
				} else {
					$_SESSION['result']=" خطا، دوباره تلاش کنید ";
					$_SESSION['alert']="danger";
					header("location: /dinero/documents");
				}
			}else{
				$_SESSION['result']=" حجم فایل ارسالی شما بیشتر از ۵۰۰ کیلو است. ";
				$_SESSION['alert']="danger";
				header("location: /dinero/documents");
			}
		} else {
			$_SESSION['result']=" فایل ارسالی شما فرمت تصویر ندارد ";
			$_SESSION['alert']="danger";
			header("location: /dinero/documents");
		}
		
	}
	$GLOBALS['GCMS']->assign('DineroAvatar', $checkAvatar);
	$GLOBALS['GCMS']->assign('DineroAvatarpath', $checkAvatarpath);
	$GLOBALS['GCMS']->assign('DineroIdfoto', $checkIdfoto);
	$GLOBALS['GCMS']->assign('DineroIdfotopath', $checkIdfotopath);
}

function bankaccount()
{
	if(!isset($_SESSION["gak_email"]))
		exit(header("Location: /accountkit"));
	//check
	$checkBankaccount=Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "bankaccount"));
	if (!isset($checkBankaccount)){
		//insert bankaccount
		$insert_basicinfo=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "bankaccount",
				"text"    => "false",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_basicinfo);
		//accountholder
		$insert_accountholder=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "accountholder",
				"text"    => "",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_accountholder);
		//iban
		$insert_iban=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "iban",
				"text"    => "",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_iban);
		//bankname
		$insert_bankname=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "bankname",
				"text"    => "",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_bankname);
		//bankcountry
		$insert_bankcountry=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "bankcountry",
				"text"    => "",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_bankcountry);
	}
	//
	$checkbankaccount    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "bankaccount"));
	$checkaccountholder  = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "accountholder"));
	$checkiban           = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "iban"));
	$checkbankname       = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "bankname"));
	$checkbankcountry    = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "bankcountry"));
	
	//update
	if (isset($_GET['update'])) {
	
		$accountholder   = trim($_POST['accountholder']);
		$iban            = trim($_POST['iban']);
		$bankname        = trim($_POST['bankname']);
		$bankcountry     = trim($_POST['bankcountry']);
	
		Acountkitparam::update(array("id" => $checkaccountholder->id,"text" => $accountholder));
		Acountkitparam::update(array("id" => $checkiban->id,"text" => $iban));
		Acountkitparam::update(array("id" => $checkbankname->id,"text" => $bankname));
		Acountkitparam::update(array("id" => $checkbankcountry->id,"text" => $bankcountry));
		Acountkitparam::update(array("id" => $checkbankaccount->id,"text" => "true"));
	
		Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], "date" => date("Y-m-d H:i:s"), "title" => "updatebankaccount"));
		
		$_SESSION['result']=" به‌روزرسانی  حساب بانکی با موفقیت انجام شد ";
		$_SESSION['alert']="success";
		header("location: /dinero/bankaccount");
	}
	
	$GLOBALS['GCMS']->assign('DineroAccountholder', $checkaccountholder);
	$GLOBALS['GCMS']->assign('DineroIban', $checkiban);
	$GLOBALS['GCMS']->assign('DineroBankname', $checkbankname);
	$GLOBALS['GCMS']->assign('DineroBankcountry', $checkbankcountry);
	
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
		//passportno
		$insert_passportno=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "passportno",
				"text"    => "",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_passportno);
		//idnumber
		$insert_idnumber=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "idnumber",
				"text"    => "",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_idnumber);
		//birthday
		$insert_birthday=array(
				"iduser"  => $_SESSION["gak_id"],
				"type"    => "birthday",
				"text"    => "",
				"date"    => date("Y-m-d H:i:s")
		);
		Acountkitparam::insert($insert_birthday);
		//
		
	}
	
	$checkbasicinfo  = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "basicinfo"));
	$checkfullname   = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "fullname"));
	$checkpassportno = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "passportno"));
	$checkidnumber   = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "idnumber"));
	$checkbirthday   = Acountkitparam::get(array("iduser" => $_SESSION["gak_id"], "type" => "birthday"));
	
	//update
	if (isset($_GET['update'])) {
		
		$fullname   = trim($_POST['fullname']);
		$passportno = trim($_POST['passportno']);
		$idnumber   = trim($_POST['idnumber']);
		$birthday   = trim($_POST['birthday']);
		
		Acountkitparam::update(array("id" => $checkfullname->id,"text" => $fullname));
		Acountkitparam::update(array("id" => $checkpassportno->id,"text" => $passportno));
		Acountkitparam::update(array("id" => $checkidnumber->id,"text" => $idnumber));
		Acountkitparam::update(array("id" => $checkbirthday->id,"text" => $birthday));
		Acountkitparam::update(array("id" => $checkbasicinfo->id,"text" => "true"));
		
		Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], "date" => date("Y-m-d H:i:s"), "title" => "updatebasicinfo"));
		
		$_SESSION['result']=" به‌روزرسانی اطلاعات اولیه با موفقیت انجام شد ";
		$_SESSION['alert']="success";
		header("location: /dinero/basicinfo");
	}
	
	$GLOBALS['GCMS']->assign('DineroFullname', $checkfullname);
	$GLOBALS['GCMS']->assign('DineroPassportno', $checkpassportno);
	$GLOBALS['GCMS']->assign('DineroIdnumber', $checkidnumber);
	$GLOBALS['GCMS']->assign('DineroBirthday', $checkbirthday);
	
}
































function offline()
{
	$lastRate = Dinerorate::get(array(
			"type"     => "EU",
			"refrence" => "o-xe.com",
	),false,array("by"=>'id',"sort"=>'DESC'));
	
	$rateEu =  $lastRate->ratesell+ $GLOBALS['GCMS_SETTING']['dinero']['ratediff'];
	$euTransfer = $_POST['moneytransfer'];
	$tmTransfer = $euTransfer*$rateEu;
	$arr_insert=array(
			"id_user" => 0,
			"email" =>  $_POST['email'],
			"name" => $_POST['name'],
			"cell" => $_POST['cell'],
			"idnumber" => $_POST['idnumber'],
			"address" => $_POST['address'],
			"country" => $_POST['country'],
			"bankname" => $_POST['bankname'],
			"iban" => $_POST['iban'],
			"paymethod" => $_POST['paymethod'],
			"moneytransfereu" => $euTransfer,
			"moneytransfertm" => $tmTransfer,
			"paymentstatus" => "pending",
			"status" => "pending",
			"date" => date("Y-m-d H:i:s")
	);
	Dinerorder::insert($arr_insert);
	$lid = mysql_insert_id();
	
	$arr_insert=array(
                "id_user" => 0,
                "amount" => $_POST['amount'],
                "txt" => "offline|".$lid,
                "date" => $_POST['date'],
                "bank_info" => " پرداخت آفلاین | شماره پیگیری" . $_POST['bank_info'],
                "status" => "pending"
            );
			
			//email
			$name = $_POST['name'];
			$cell = $_POST['cell'];
			$idnumber = $_POST['idnumber'];
			$address = $_POST['address'];
			$country = $_POST['country'];
			$bankname = $_POST['bankname'];
			$iban = $_POST['iban'];
			$transferFeeEuro = 40;
			/* if (  $euTransfer < 200){
				$transferFeeEuro = 15 ;
			}
			if ( $euTransfer > 200 and $euTransfer < 501){
				$transferFeeEuro = 25;
			}
			if ( $euTransfer > 500 and $euTransfer < 1001){
				$transferFeeEuro = 40;
			}
			if ( $euTransfer > 1000 and $euTransfer < 1201){
				$transferFeeEuro = 50;
			}
			if ( $euTransfer > 1200 and $euTransfer < 1501){
				$transferFeeEuro = 60;
			}
			if ( $euTransfer > 1500 and $euTransfer < 2000){
				$transferFeeEuro = 70;
			} */
			
			$bodyStatusDinero = '
					<div>
                          <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="http://dinero.ir"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
                        پرداخت آفلاین در سیستم ثبت شد. لطفا سریعا پیگیری کنید
                        </a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                        </div>
					';
	
			$bodyStatus = '
					<div>
                          <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="http://dinero.ir"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
                    اطلاعات شما دریافت و ثبت شد، در صورت تایید اطلاعات توسط مدیر، 
					انتقال یورو شما در کمتر از ۱ روز کاری انجام می‌شود.
					لطفا شکیبا باشید
                        </a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                        </div>
					';
	
			$bodyInfo="
					<div>
                    <b>$name</b><br>
                    ".$_POST['email']."<br>
                    $idnumber<br>
                    $country<br>
                    $address<br>
                    Mobile: $cell<br>
                    <br>
                    Bank information:<br>
                    $bankname<br>
                    $iban<br>
                    <br>
                    Payment information:<br>
                    Date: ".$_POST['date']."<br>
                    Amount: ".number_format($_POST['amount'])." Toman<br>
                    N. Tracking: ".$_POST['bank_info']."<br>
                  </div>
					";
			$bodyTransaction= '
					<table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;">
              <tr>
                <td valign="top" class="mobile-padding" style="padding:20px;">
                  <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                      <td style="padding-right:20px">
                        <b>Euro request</b>
                      </td>
                      <td style="padding-right:20px">
                        <b>Euro Rate</b>
                      </td>
                      <td>
                        <b>Total Toman</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; ">
                       '.number_format($euTransfer).' 
                      </td>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;">
                        '.number_format($tmTransfer/$euTransfer).'
                      </td>
                      <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                        '.number_format($tmTransfer).'
                      </td>
                    </tr>
                  </table>
                  <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                      <td style="padding-top:35px;">
                        <table cellpadding="0" cellspacing="0" width="100%">
                          <tr>
                            
                            <td style="padding:0px 0 15px 30px;" class="mobile-block">
                              <table cellspacing="0" cellpadding="0" width="100%">
                                
                                <tr>
                                  <td>Euro Request: </td>
                                  <td> €'.number_format($euTransfer).'</td>
                                </tr>
                                <tr>
                                  <td>Transfer cost: </td>
                                  <td> -€'.number_format($transferFeeEuro).'</td>
                                </tr>
                                <tr>
                                  <td>Euro collect: </td>
                                  <td> <b>€'.number_format($euTransfer-$transferFeeEuro).'</b></td>
                                </tr>
                                <tr>
                                  <td>Due by: </td>
                                  <td> '.date("Y-m-d ").'</td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="vertical-align:top;" class="desktop-hide">
                              Thank you for your purchase.
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
					';
	
			require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
			//send to dinero
			
			sendEmailWithPhpmailer(
					emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
					" درخواست خرید یورو  ".$_SERVER['HTTP_HOST'],"Dinero",
					$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['hostmail'],
					$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['emailpassword'],
					$GLOBALS['GCMS_SETTING']['dinero']['emaillogin']);
			//send to client
			sendEmailWithPhpmailer(
					emailTemp($bodyStatus,$bodyInfo,$bodyTransaction),
					" درخواست خرید یورو  ".$_SERVER['HTTP_HOST'],"Dinero",
					$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['hostmail'],
					$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['emailpassword'],
					$_POST['email']);
            //
			Pays::insert($arr_insert);
            $_SESSION['result']=" اطلاعات ارسالی شما در سیستم ثبت شد،   و نیاز به تایید مدیر دارد.";
            $_SESSION['alert']="success";
            
            $merchantID=Setting::get(array("st_group" => "dinero", "st_key" => "cash"));
            Setting::update(array("id" => $merchantID->id, "st_value" => $merchantID->st_value - $euTransfer));
            
            header("location: /dinero");
}
function back()
{
	
	$MerchantID = $GLOBALS['GCMS_SETTING']['pays']['merchantID'];
		$Authority = $_GET['Authority'];
		$pay=Pays::get(array("id" => $_GET['oid']));
		if($pay->id_user!=0)
		{
			$_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
			$_SESSION['alert']="error";
			header("location: /dinero");
			exit();
		}
		$Amount = $pay->amount;
		 
		if ($_GET['Status'] == 'OK') {
			 
			$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
			 
			$result = $client->PaymentVerification(
					[
							'MerchantID' => $MerchantID,
							'Authority' => $Authority,
							'Amount' => $Amount,
					]
					);
			 
			if ($result->Status == 100) {
				$arr_update=array(
						"id" => $_GET['oid'],
						"bank_info" => $pay->bank_info." zarin|refID:".$result->RefID ,
						"status" => "confirm"
				);
				Pays::update($arr_update);
				$arr_update=array(
						"id" => $_GET['sfid'],
						"paymentstatus" => "confirm"
				);
				Dinerorder::update($arr_update);
				
				
				//email
				$dinRow = Dinerorder::get(array("id" => $_GET['sfid']));
				
				$name = $dinRow->name;
				$cell = $dinRow->cell;
				$idnumber = $dinRow->idnumber;
				$address = $dinRow->address;
				$country = $dinRow->country;
				$bankname = $dinRow->bankname;
				$iban = $dinRow->iban;
				$transferFeeEuro = 40;
				/* if (  $dinRow->moneytransfereu < 200){
					$transferFeeEuro = 15 ;
				}
				if ( $dinRow->moneytransfereu > 200 and $dinRow->moneytransfereu < 501){
					$transferFeeEuro = 25;
				}
				if ( $dinRow->moneytransfereu > 500 and $dinRow->moneytransfereu < 1001){
					$transferFeeEuro = 40;
				}
				if ( $dinRow->moneytransfereu > 1000 and $dinRow->moneytransfereu < 1201){
					$transferFeeEuro = 50;
				}
				if ( $dinRow->moneytransfereu > 1200 and $dinRow->moneytransfereu < 1501){
					$transferFeeEuro = 60;
				}
				if ( $dinRow->moneytransfereu > 1500 and $dinRow->moneytransfereu < 2000){
					$transferFeeEuro = 70;
				} */
					
				$bodyStatusDinero = '
					<div>
                          <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="http://dinero.ir"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
                        پرداخت آنلاین در سیستم ثبت شد. پیگیری کنید
                        </a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                        </div>
					';
				
				$bodyStatus = '
					<div>
                          <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="http://dinero.ir"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
                    اطلاعات شما دریافت و ثبت شد،
					انتقال یورو شما در کمتر از ۱ روز کاری انجام می‌شود.
					لطفا شکیبا باشید
                        </a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                        </div>
					';
				
				$bodyInfo="
				<div>
				<b>$name</b><br>
				".$dinRow->email."<br>
				$idnumber<br>
				$country<br>
				$address<br>
				Mobile: $cell<br>
				<br>
				Bank information:<br>
				$bankname<br>
				$iban<br>
				<br>
				Payment information:<br>
				Date: ".date("Y-m-d")."<br>
                    Amount: ".number_format($Amount)." Toman<br>
                    N. Tracking: ZarinPal: ".$result->RefID."<br>
                  </div>
					";
				$bodyTransaction= '
					<table border="0" cellpadding="0" cellspacing="0" width="600" class="w320" style="height:100%;">
              <tr>
                <td valign="top" class="mobile-padding" style="padding:20px;">
                  <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                      <td style="padding-right:20px">
                        <b>Euro request</b>
                      </td>
                      <td style="padding-right:20px">
                        <b>Euro Rate</b>
                      </td>
                      <td>
                        <b>Total Toman</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; ">
                       '.number_format($dinRow->moneytransfereu).'
                      </td>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;">
                        '.number_format($dinRow->moneytransfertm/$dinRow->moneytransfereu).'
                      </td>
                      <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                        '.number_format($dinRow->moneytransfertm).'
                      </td>
                    </tr>
                  </table>
                  <table cellspacing="0" cellpadding="0" width="100%">
                    <tr>
                      <td style="padding-top:35px;">
                        <table cellpadding="0" cellspacing="0" width="100%">
                          <tr>
				
                            <td style="padding:0px 0 15px 30px;" class="mobile-block">
                              <table cellspacing="0" cellpadding="0" width="100%">
				
                                <tr>
                                  <td>Euro Request: </td>
                                  <td> €'.number_format($dinRow->moneytransfereu).'</td>
                                </tr>
                                <tr>
                                  <td>Transfer cost: </td>
                                  <td> -€'.number_format($transferFeeEuro).'</td>
                                </tr>
                                <tr>
                                  <td>Euro collect: </td>
                                  <td> <b>€'.number_format($dinRow->moneytransfereu - $transferFeeEuro).'</b></td>
                                </tr>
                                <tr>
                                  <td>Due by: </td>
                                  <td> '.date("Y-m-d ").'</td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td style="vertical-align:top;" class="desktop-hide">
                              Thank you for your purchase.
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
					';
				
				require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
				//send to dinero
				sendEmailWithPhpmailer(
						emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
						" درخواست خرید یورو  ".$_SERVER['HTTP_HOST'],"Dinero",
						$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['hostmail'],
						$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['emailpassword'],
						$GLOBALS['GCMS_SETTING']['dinero']['emaillogin']);
				//send to client
				sendEmailWithPhpmailer(
						emailTemp($bodyStatus,$bodyInfo,$bodyTransaction),
						" درخواست خرید یورو  ".$_SERVER['HTTP_HOST'],"Dinero",
						$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['hostmail'],
						$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['emailpassword'],
						$dinRow->email);
				
				$merchantID=Setting::get(array("st_group" => "dinero", "st_key" => "cash"));
				Setting::update(array("id" => $merchantID->id, "st_value" => $merchantID->st_value - $euTransfer));
				
				$_SESSION['result']="پرداخت شما با موفقیت در سیستم ثبت شد";
				$_SESSION['alert']="success";
				header("location: /dinero/");
			} else {
				$_SESSION['result']="خطا در پرداخت " .$result->Status;
				$_SESSION['alert']="danger";
				header("location: /dinero/");
			}
		} else {
			$_SESSION['result']=" پرداخت لغو شد  " ;
			$_SESSION['alert']="danger";
			header("location: /dinero/");
		}
}
function add()
{
	
	if (isset($_POST['moneytransfer'])){
		
		
		$lastRate = Dinerorate::get(array(
				"type"     => "EU",
				"refrence" => "o-xe.com",
		),false,array("by"=>'id',"sort"=>'DESC'));
		
		$rateEu =  $lastRate->ratesell+ $GLOBALS['GCMS_SETTING']['dinero']['ratediff'];
		$euTransfer = $_POST['moneytransfer'];
		$tmTransfer = $euTransfer*$rateEu;
		if ($_POST['paymethod'] == "online"){
			$arr_insert=array(
					"id_user" => 0,
					"email" =>  $_POST['email'],
					"name" => $_POST['name'],
					"cell" => $_POST['cell'],
					"idnumber" => $_POST['idnumber'],
					"address" => $_POST['address'],
					"country" => $_POST['country'],
					"bankname" => $_POST['bankname'],
					"iban" => $_POST['iban'],
					"paymethod" => $_POST['paymethod'],
					"moneytransfereu" => $euTransfer,
					"moneytransfertm" => $tmTransfer,
					"paymentstatus" => "pending",
					"status" => "pending",
					"date" => date("Y-m-d H:i:s")
			);
			Dinerorder::insert($arr_insert);
			$lid = mysql_insert_id();
			zarinType($tmTransfer,"online|".$lid,$lid,$_POST['email']);
		}else{
			
		}
	}
}




function zarinType($amount,$txt,$id_shop_factor,$email)
{

	$MerchantID = $GLOBALS['GCMS_SETTING']['pays']['merchantID'];

	$arr_insert=array(
			"id_user" => 0,
			"amount" => $amount,
			"txt" => $txt,
			"date" => date("Y-m-d H:i:s"),
			"bank_info" => "پرداخت با زرین پال",
			"status" => "pending"
	);

	Pays::insert($arr_insert);
	$orderId=mysql_insert_id();
	$site_url= "http://".$_SERVER['SERVER_NAME'];
	require_once(__COREROOT__."/libs/utility/hashing.php");

	$Amount = $amount;
	$Description = $txt;
	$CallbackURL = $site_url."/dinero/back?oid=".$orderId."&type=zarin&id=".rndstring(90)."&sfid=".$id_shop_factor."&id_user=".$email."&amount=".$amount;
	$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
	$result = $client->PaymentRequest(
			[
					'MerchantID' => $MerchantID,
					'Amount' => $Amount,
					'Description' => $Description,
					'Email' => $email,
					'Mobile' => "",
					'CallbackURL' => $CallbackURL,
			]
			);
	if ($result->Status == 100) {
		Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
	} else {
		$_SESSION['result']=" یک چیزی یه‌جایی اشتباه شده.  ". 'ERR: '.$result->Status;
		$_SESSION['alert']="danger";
		header("location: /dinero/add/");
	}

}

function sendEmailWithPhpmailer($body,$subject,$title,$from,$host,$userName,$password,$toEmail)
{
	$to= $title;
	$from= $from;
	$mail= new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth=true;
	$mail->Host       = $host;
	$mail->Username= $userName;
	$mail->Password= $password;
	$mail->AddAddress($toEmail,$toEmail );
	$mail->SetFrom($from, $name);
	$mail->AddReplyTo($from, $name);
	$mail->Subject    = $subject;
	$mail->IsHTML(true);
	$mail->MsgHTML($body);
	$mail->AltBody= $text_form;
	$mail->Send();
}
