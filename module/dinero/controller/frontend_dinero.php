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
	//index
}
function offline()
{
	$lastRate = Dinerorate::get(array(
			"type"     => "EU",
			"refrence" => "o-xe.com",
	),false,array("by"=>'id',"sort"=>'DESC'));
	
	$rateEu =  $lastRate->ratesell;
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
			if (  $euTransfer < 200){
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
			}
			
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
                        '.number_format($rateEu).'
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
				if (  $dinRow->moneytransfereu < 200){
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
				}
					
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
                        '.number_format($dinRow->moneytransfertm).'
                      </td>
                      <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                        '.number_format($dinRow->moneytransfertm*$dinRow->moneytransfertm).'
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
                                  <td> <b>€'.number_format($dinRow->moneytransfere - $transferFeeEuro).'</b></td>
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
		
		$rateEu =  $lastRate->ratesell;
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
