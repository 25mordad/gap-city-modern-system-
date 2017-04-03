<?php

/**
 * trade.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: trade > dinero
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */


function applyWallet($Adv,$amount,$lastrate,$transferAmount){ 
	$wallet = Wallet::get(array("id_user" => $_SESSION["gak_id"]));
	$totalToman = $amount*$lastrate + $lastrate*$transferAmount;
	if ($wallet->amount < $totalToman){
		$_SESSION['result']=" موجودی کیف پول شما از مبلغ درخواست کمتر است. ";
		$_SESSION['alert']="warning";
		header("location: /dinero/deal?amount=".$_GET['amount']."&id=".$_GET['id']."&balance=low");
	}else{
		//update wallet and add transaction
		//insert
		$insert_wallettransaction=array(
				"id_wallet" => $wallet->id,
				"type"      => "withdraw",
				"amount"    => $totalToman,
				"status"    => "confirm",
				"time"      => date("Y-m-d H:i:s")
		);
		$walletTransaction = Wallettransactions::insert($insert_wallettransaction);
		//update
		$arr_update=array(
				"id"          => $wallet->id,
				"amount"      => $wallet->amount - $totalToman
		);
		Wallet::update($arr_update);
		//log
		Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
				"date" => date("Y-m-d H:i:s"), "title" => "walletWithdraw"));
		//trade
		
		$arr_insert=array(
				"id_buyer"          => $_SESSION["gak_id"],
				"id_seller"         => $Adv->id_user,
				"id_adv"            => $Adv->id,
				"amount"            => $amount,
				"exchange_rate"     => $lastrate,
				"time"              => date("Y-m-d H:i:s"),
				"trade_status"      => "buyerpaid",
				"buyerpay_status"   => "confirm",
				"sellerpay_status"  => "pending",
				"buyerpay_details"  => "id:".$walletTransaction."|Payment:Wallet|refID:".date("YmdHis"),
				"sellerpay_details" => ""
		);
		$Trade = Dinerotrade::insert($arr_insert);
		
		//update text transaction wallet
		Wallettransactions::update(array("id"=>$walletTransaction, "text"=>"Withdraw from wallet, Trade #".$Trade*951753 ));
		
		//update adv
		$updateAmount = $Adv->amount - $amount;
		$arr_update=array(
				"id"         => $Adv->id,
				"amount"     => $updateAmount
		);
		Dineroadv::update($arr_update);
		
		//user logs
		Accountkitlog::insert(array(
				"iduser" => $_SESSION["gak_id"],
				"date" => date("Y-m-d H:i:s"),
				"title" => "tradePaid"));
			
		//send emails and sms
		$checkTrade=Dinerotrade::get(array("id" => $Trade,"id_buyer" => $_SESSION["gak_id"]));
		$seller   = AccountKit::get(array("iduser" => $checkTrade->id_seller));
		$buyer   = AccountKit::get(array("iduser" => $checkTrade->id_buyer));
		$sellerFullname = Acountkitparam::get(array("iduser" => $checkTrade->id_seller, "type" => "fullname"));
		$buyerFullname = Acountkitparam::get(array("iduser" => $checkTrade->id_buyer, "type" => "fullname"));
		$buyerBankname= Acountkitparam::get(array("iduser" => $checkTrade->id_buyer, "type" => "bankname"));
		$buyerIban= Acountkitparam::get(array("iduser" => $checkTrade->id_buyer, "type" => "iban"));
		$transferAmount = findTransferAmount($checkTrade->amount);
		$token = $GLOBALS['GCMS_SETTING']['dinero']['smstoken'];
		$params = array(
				'to' => $seller->number,
				'from' => 'Info',
				'message' => "Trade for ".$checkTrade->amount ."€ "
				."https://24dinero.com/"
				,
		);
		//sms_send($params,$token);
		
		//start send email
		$bodyStatusDineroSeller= '
						<div>
                          <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="$_SERVER[HTTP_HOST]"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								درخواست انتقال یورو، لطفا سریعا اقدام کنید
							  </a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                        </div>
					';
		
		$bodyInfoSeller= "
				  <div>
				
Payment has confirmed for your advertisements on 24dinero.com.
 <br>
Transfer amount:".$checkTrade->amount ."€   <br>
Bank: ".$buyerBankname->text."<br>
Beneficiary Name:  ".$buyerFullname->text."<br>
IBAN: ".$buyerIban->text."<br>
		
You can confirm or cancel the transaction on the following link: <br>
		
<a href=\"".$_SERVER['HTTP_HOST']."/dinero/transact/".$checkTrade->id."\">
						".$_SERVER['HTTP_HOST']."/dinero/transact/".$checkTrade->id."
						</a>
								
                  </div>
					";
		$bodyTransactionSeller= '
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
                       '.number_format($checkTrade->amount).'
                      </td>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;">
                        '.number_format($checkTrade->exchange_rate).'
                      </td>
                      <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                        '.number_format($checkTrade->exchange_rate*$checkTrade->amount).'
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; ">
						'.number_format(floor($checkTrade->amount*2.5/100)).' <br>
                        ٪2.5 Commission
                      </td>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;">
                         '.number_format($checkTrade->exchange_rate).'
                      </td>
                      <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                        '.number_format((floor($checkTrade->amount*2.5/100)) * $checkTrade->exchange_rate).'
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; ">
                        		
                      </td>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;">
                         Total amount:
                      </td>
                      <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                        <b>'.number_format($checkTrade->exchange_rate*$checkTrade->amount+ (floor($checkTrade->amount*2.5/100)) * $checkTrade->exchange_rate).'</b>
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
                                  <td> €'.number_format($checkTrade->amount).'</td>
                                </tr>
                                  		
                                <tr>
                                  <td>Due by: </td>
                                  <td> '.date("Y-m-d").'</td>
                                </tr>
                              </table>
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
		$bodyStatusDineroBuyer= '
						<div>
                          <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="$_SERVER[HTTP_HOST]"
                        style="background-color:#016910;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								درخواست انتقال یورو
							  </a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                        </div>
					';
		
		$bodyInfoBuyer= "
				  <div>
				
Payment has confirmed for your trade on 24dinero.com.
 <br>
Transfer amount:".$checkTrade->amount ."€   <br>
Bank: ".$buyerBankname->text."<br>
Beneficiary Name:  ".$buyerFullname->text."<br>
IBAN: ".$buyerIban->text."<br>
		
You can follow the transaction on the following link: <br>
		
<a href=\"".$_SERVER['HTTP_HOST']."/dinero/trade/".$checkTrade->id."\">
						".$_SERVER['HTTP_HOST']."/dinero/trade/".$checkTrade->id."
						</a>
								
                  </div>
					";
		$bodyTransactionBuyer= '
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
                       '.number_format($checkTrade->amount).'
                      </td>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;">
                        '.number_format($checkTrade->exchange_rate).'
                      </td>
                      <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                        '.number_format($checkTrade->exchange_rate*$checkTrade->amount).'
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; ">
						'.number_format($transferAmount).' <br>
                        Transfer Amount
                      </td>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;">
                         '.number_format($checkTrade->exchange_rate).'
                      </td>
                      <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                        '.number_format($transferAmount* $checkTrade->exchange_rate).'
                      </td>
                    </tr>
                    <tr>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7; ">
                        		
                      </td>
                      <td style="padding-top:5px;padding-right:20px; border-top:1px solid #E7E7E7;">
                         Total amount:
                      </td>
                      <td style="padding-top:5px; border-top:1px solid #E7E7E7;" class="mobile">
                        <b>'.number_format($checkTrade->exchange_rate*$checkTrade->amount+ $transferAmount* $checkTrade->exchange_rate).'</b>
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
                                  <td> €'.number_format($checkTrade->amount).'</td>
                                </tr>
                                  		
                                <tr>
                                  <td>Due by: </td>
                                  <td> '.date("Y-m-d").'</td>
                                </tr>
                              </table>
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
		//sendingblue email
		require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
		require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
		$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
		//seller
		$maildata = array( "to" => array($seller->email=> $sellerFullname->text),
				"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
				"subject" => "Trade Paid ".$_SERVER['HTTP_HOST'],
				"html" => emailTemp($bodyStatusDineroSeller,$bodyInfoSeller,$bodyTransactionSeller),
				"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
		);
		$mailin->send_email($maildata);
		//buyer
		$maildata = array( "to" => array($buyer->email=> $buyerFullname->text),
				"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
				"subject" => "Trade Paid ".$_SERVER['HTTP_HOST'],
				"html" => emailTemp($bodyStatusDineroBuyer,$bodyInfoBuyer,$bodyTransactionBuyer),
				"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
		);
		$mailin->send_email($maildata);
		//\\\\\end send email
		
		$_SESSION['result']="پرداخت شما با موفقیت انجام شد";
		$_SESSION['alert']="success";
		header("location: /dinero/trade/".$Trade);
		
	}
	
}

function applyOnline($Adv,$amount,$lastrate,$transferAmount){ 
	$totalToman = $amount*$lastrate + $lastrate*$transferAmount;
	$arr_insert=array(
			"id_buyer"          => $_SESSION["gak_id"],
			"id_seller"         => $Adv->id_user,
			"id_adv"            => $Adv->id,
			"amount"            => $amount,
			"exchange_rate"     => $lastrate,
			"time"              => date("Y-m-d H:i:s"),
			"trade_status"      => "buyerstarts",
			"buyerpay_status"   => "pending",
			"sellerpay_status"  => "waitingforbuyer",
			"buyerpay_details"  => "",
			"sellerpay_details" => ""
	);
	return Dinerotrade::insert($arr_insert);
	
}

function transferBySeller($file,$txt,$trade){
	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$uploaddir = 'uploads'.DIRECTORY_SEPARATOR.'dinero'.DIRECTORY_SEPARATOR.'transfer'.DIRECTORY_SEPARATOR.$trade->id*951753;
	if(!is_dir($uploaddir))
		mkdir($uploaddir, 0755, true);
		$check = getimagesize($fileTmpName);
		$tempFile = $fileTmpName;
		$targetPath = __ROOT__ . DIRECTORY_SEPARATOR . $uploaddir . DIRECTORY_SEPARATOR;
	
		
		if($check !== false) {
			if ($fileSize < 900000 ) {
				
				$getMime=explode('.', $fileName);
				$mime=strtolower(end($getMime));
				$imName = rand(10000,99999) .".".$mime;
				$targetFile =  $targetPath.$imName;
				if (move_uploaded_file($tempFile, $targetFile)) {
					//update trade
					$arr_update=array(
							"id"                => $trade->id,
							"trade_status"      => "sellersent",
							"sellerpay_status"  => "sent",
							"sellerpay_details" => date("Y-m-d H:i")."|".$imName."|".$txt
					);
					Dinerotrade::update($arr_update);
					//log
					Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
							"date" => date("Y-m-d H:i:s"), "title" => "confirmTransfer"));
					//find buyer
					$buyer   = AccountKit::get(array("iduser" => $trade->id_buyer));
					//start send email
					$bodyStatusDinero= '
						<div>
                          <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="$_SERVER[HTTP_HOST]"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								مبلغ انتقال، از طرف فروشنده واریز شد.
							  </a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                        </div>
					';
						
					$bodyInfo= "
					  <div>
						
	                  </div>
					";
					$bodyTransaction= '
			
					';
						
					require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
					//send to dinero
					sendEmailWithPhpmailer(
							emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
							"Transfer announcement ".$_SERVER['HTTP_HOST'],"Dinero",
							$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['hostmail'],
							$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['emailpassword'],
							$buyer->email);
					//\\\\\end send email
					$_SESSION['result']=" با موفقیت آپلود شد.  ";
					$_SESSION['alert']="success";
					header("location: /dinero/transact/".$trade->id);
				} else {
					$_SESSION['result']=" خطا، دوباره تلاش کنید ";
					$_SESSION['alert']="danger";
					header("location: /dinero/transact/".$trade->id."?act=send");
				}
			}else{
				$_SESSION['result']=" حجم فایل ارسالی شما بیشتر از ۵۰۰ کیلو است. ";
				$_SESSION['alert']="danger";
				header("location: /dinero/transact/".$trade->id."?act=send");
			}
		} else {
			$_SESSION['result']=" فایل ارسالی شما فرمت تصویر ندارد ";
			$_SESSION['alert']="danger";
			header("location: /dinero/transact/".$trade->id."?act=send");
		}
}

function cancelBySeller($reason,$trade,$trade,$transferAmount){
				
	//update trade
	$arr_update=array(
			"id"                => $trade->id,
			"trade_status"      => "sellercanceled",
			"sellerpay_status"  => "canceled",
			"sellerpay_details" => date("Y-m-d H:i")."|".$reason."|".$txt
	);
	Dinerotrade::update($arr_update);
	
	//update adv
	$arr_update=array(
			"id"          => $trade->id_adv,
			"status"      => "canceled"
	);
	Dineroadv::update($arr_update);
	//return amount to buyer wallet
	$refundAmount = ($trade->amount+ $transferAmount) * $trade->exchange_rate ;
	//find buyer wallet
	$buyerWallet   = Wallet::get(array("id_user" => $trade->id_buyer));
	//update wallet and add transaction
	//insert
	$insert_wallettransaction=array(
			"id_wallet" => $buyerWallet->id,
			"type"      => "deposit",
			"amount"    => $refundAmount,
			"status"    => "confirm",
			"text"      => "Automaticly refund by system. Trade #".$trade->id*951753 ." canceled",
			"time"      => date("Y-m-d H:i:s")
	);
	Wallettransactions::insert($insert_wallettransaction);
	//update
	$arr_update=array(
			"id"          => $buyerWallet->id,
			"amount"      => $buyerWallet->amount + $refundAmount
	);
	Wallet::update($arr_update);
	//log
	Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
			"date" => date("Y-m-d H:i:s"), "title" => "cancelTransfer"));
	Accountkitlog::insert(array("iduser" => $trade->id_buyer,
			"date" => date("Y-m-d H:i:s"), "title" => "systemWalletdeposit"));
	//find buyer
	$buyer   = AccountKit::get(array("iduser" => $trade->id_buyer));
	//start send email
	$bodyStatusDinero= '
						<div>
                          <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="$_SERVER[HTTP_HOST]"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								مبلغ انتقال، از طرف فروشنده کنسل شد.
							  </a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
                        </div>
					';
	
	$bodyInfo= "
					  <div>
	
	                  </div>
					";
	$bodyTransaction= '
		
					';
	
	require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
	//send to dinero
	sendEmailWithPhpmailer(
			emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
			"Transfer announcement ".$_SERVER['HTTP_HOST'],"Dinero",
			$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['hostmail'],
			$GLOBALS['GCMS_SETTING']['dinero']['emaillogin'],$GLOBALS['GCMS_SETTING']['dinero']['emailpassword'],
			$buyer->email);
	//\\\\\end send email
	$_SESSION['result']=" لغو انتقال تایید شد. ";
	$_SESSION['alert']="success";
	header("location: /dinero/transact/".$trade->id);	
		
}

