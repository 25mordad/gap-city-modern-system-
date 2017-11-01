<?php

/**
 * frontend_dinero.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > dinero
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/module/dinero/controller/admin.php");
$utilityfile = __COREROOT__."/module/dinero/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	
	//find advs
	$Advertisements = Dineroadv::get(array("status" => "active"),true);
	$GLOBALS['GCMS']->assign('Advertisements', $Advertisements);
}

function advs($id)
{
	if(!isset($_SESSION["gak_email"])){
		$_SESSION['result']="لطفا وارد سایت شوید.";
		$_SESSION['alert']="warning";
		exit(header("Location: /accountkit"));
	}
	//find advs
	$Advertisements = Dineroadv::get(array("id_user" => $_SESSION["gak_id"]),true);
	if (isset($id)){
		$Adv = Dineroadv::get(array("id" => $id,"id_user" => $_SESSION["gak_id"]));
		if (isset($_GET['edit'])){
			//update
			$arr_update=array(
					"id"             => $id,
					"amount"         => $_POST['amount'],
					"minmax"         => $_POST['mintransaction']."|"
					.$_POST['maxtransaction']."|"
					.$_POST['maxanswer']."|"
					.$_POST['maxtransfer'],
					"status"         => $_POST['status'],
					"text"           => $_POST['text'],
			);
			Dineroadv::update($arr_update);
			$_SESSION['result']=" تغییرات با موفقیت انجام شد ";
			$_SESSION['alert']="success";
			exit(header("Location: /dinero/advs/"));
		}
	}
	
	$GLOBALS['GCMS']->assign('Advertisements', $Advertisements);
	$GLOBALS['GCMS']->assign('Adv', $Adv);
}
function transacts()
{
	if(!isset($_SESSION["gak_email"])){
		$_SESSION['result']="لطفا وارد سایت شوید.";
		$_SESSION['alert']="warning";
		exit(header("Location: /accountkit"));
	}
	//find trades
	$Trades = dinerotrade::get(array("id_seller" => $_SESSION["gak_id"], "not_trade_status" => "deleted"),true,
			array("by" => "time","sort" => "DESC")
			);
	$GLOBALS['GCMS']->assign('Trades', $Trades);
}
function trades()
{
	if(!isset($_SESSION["gak_email"])){
		$_SESSION['result']="لطفا وارد سایت شوید.";
		$_SESSION['alert']="warning";
		exit(header("Location: /accountkit"));
	}
	//find trades
	$Trades = dinerotrade::get(array("id_buyer" => $_SESSION["gak_id"], "not_trade_status" => "deleted"),true,
			array("by" => "time","sort" => "DESC")
			);
	$GLOBALS['GCMS']->assign('Trades', $Trades);
}

function wallet()
{
	//wallet
	if(!isset($_SESSION["gak_email"])){
		$_SESSION['result']="لطفا وارد سایت شوید.";
		$_SESSION['alert']="warning";
		exit(header("Location: /accountkit"));
	}
	if ($_GET['pay']){
		$arr_insert=array(
				"id_user"   => $_SESSION["gak_id"],
				"amount"    => $_POST['amount'],
				"txt"       => "",
				"date"      => date("Y-m-d H:i:s"),
				"bank_info" => "Payment:Offline|Tracking:".$_POST['tracking']."|Bank:".$_POST['bank']."|date:".$_POST['time'],
				"status"    => "pending"
		);
	
		Pays::insert($arr_insert);
		//start send email
		$bodyStatusDinero= '
						<div>
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								واریز به کیف پول متظر تایید شما است
							  </a>
                        </div>
					';
		
		$bodyInfo= "
					  <div>
				
						<br>
						<a href=\"https://".$_SERVER['HTTP_HOST']."/dinero/settlements\">
						https://".$_SERVER['HTTP_HOST']."/dinero/settlements
						</a>
								
	                  </div>
					";
		$bodyTransaction= '
				
					';
		//sendingblue email
		require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
		require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
		$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
		$maildata = array( "to" => array($GLOBALS['GCMS_SETTING']['dinero']['dineroAdminEmail']=>"Dinero Admin"),
				"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
				"subject" => "Wallet Payment alarm ".$_SERVER['HTTP_HOST'],
				"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
				"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
		);
		$mailin->send_email($maildata);
		///end send mail
		$_SESSION['result']=" پرداخت شما ثبت شد، منتظر تایید سیستم باشید. ";
		$_SESSION['alert']="success";
		exit(header("Location: /dinero/wallet"));
	}
	//find wallettransactions
	//check if wallet
	$checkWallet=Wallet::get(array("id_user" => $_SESSION["gak_id"], "currency" => "Toman"));
	if ($_GET['withdraw'] and $_POST['toman']){
		if ($_POST['toman'] <= $checkWallet->amount){
			if ($_POST['time'] == "week"){
				$insert_wallettransaction=array(
						"id_wallet" => $checkWallet->id,
						"type"      => "request-withdraw",
						"amount"    => $_POST['toman'],
						"status"    => "pending",
						"text"      => "Withdraw Request - 1 week",
						"time"      => date("Y-m-d H:i:s" ,strtotime("+7 day", strtotime('now')))
				);
				$walletTransaction = Wallettransactions::insert($insert_wallettransaction);
				
			}else{
				$onePercent = ceil($_POST['toman']*1/100);
				$insert_wallettransaction=array(
						"id_wallet" => $checkWallet->id,
						"type"      => "request-withdraw",
						"amount"    => $_POST['toman']-$onePercent,
						"status"    => "pending",
						"text"      => "Withdraw Request - 1 day",
						"time"      => date("Y-m-d H:i:s" ,strtotime("+1 day", strtotime('now')))
				);
				$walletTransaction = Wallettransactions::insert($insert_wallettransaction);
				//
				$insert_wallettransaction=array(
						"id_wallet" => $checkWallet->id,
						"type"      => "withdraw",
						"amount"    => $onePercent,
						"status"    => "confirm",
						"text"      => "withdraw 1% of ".$_POST['toman']. " for 1 day withdraw method",
						"time"      => date("Y-m-d H:i:s")
				);
				$walletTransaction = Wallettransactions::insert($insert_wallettransaction);
				
			}
			
			//update
			$arr_update=array(
					"id"          => $checkWallet->id,
					"amount"      => $checkWallet->amount - $_POST['toman']
			);
			Wallet::update($arr_update);
			//log
			Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
					"date" => date("Y-m-d H:i:s"), "title" => "walletRequestWithdraw"));
			//start send email
			$bodyStatusDinero= '
						<div>
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								یک درخواست تسویه  ، ایجاد شد
							  </a>
                        </div>
					';
			
			$bodyInfo= "
					  <div>
					
						<br>
						<a href=\"https://".$_SERVER['HTTP_HOST']."/dinero/settlements/\">
						https://".$_SERVER['HTTP_HOST']."/dinero/settlements/
						</a>
								
	                  </div>
					";
			$bodyTransaction= '
					
					';
			//sendingblue email
			require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
			require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
			$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
			$maildata = array( "to" => array($GLOBALS['GCMS_SETTING']['dinero']['dineroAdminEmail']=>"Dinero Admin"),
					"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
					"subject" => "Withdraw Request alarm ".$_SERVER['HTTP_HOST'],
					"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
					"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
			);
			$mailin->send_email($maildata);
			///end send mail
			$_SESSION['result']=" درخواست تسویه شما ثبت شد. ";
			$_SESSION['alert']="success";
			exit(header("Location: /dinero/wallet"));
		}else{
			$_SESSION['result']=" نمی‌توانید بیشتر از مبلغ موجودی، درخواست تسویه حساب داشته باشید ";
			$_SESSION['alert']="danger";
			exit(header("Location: /dinero/wallet?withdraw=true"));
		}
	}
	$transactions = Wallettransactions::get(array("id_wallet" => $checkWallet->id),true,
			array("by" => "time","sort" => "DESC")
			);
	$GLOBALS['GCMS']->assign('transactions', $transactions);
}

function transact($id)
{
	//transact
	if(!isset($_SESSION["gak_email"])){
		$_SESSION['result']="لطفا وارد سایت شوید.";
		$_SESSION['alert']="warning";
		exit(header("Location: /accountkit"));
	}
	//check
	$checkTrade=Dinerotrade::get(array("id" => $id,"id_seller" => $_SESSION["gak_id"]));
	if(!isset($checkTrade) or !isset($id)){
		$_SESSION['result']=" چنین مبادله‌ای وجود ندارد. ";
		$_SESSION['alert']="warning";
		exit(header("Location: /dinero/transacts"));
	}
	$from = new DateTime($checkTrade->time);
	$diff = $from->diff(new DateTime('now'));
	$lastChance = $diff->y * 100 + $diff->m * 100 + $diff->d * 100 + $diff->h * 100 + $diff->i ;
	//more than 20 mins
	if ($checkTrade->buyerpay_status == "pending"){
		if ($lastChance > 20){
			//update trade - delete
			$arr_update=array(
					"id"                => $checkTrade->id,
					"trade_status"      => "deleted",
			);
			Dinerotrade::update($arr_update);
			$_SESSION['result']=" زمان پرداخت تومان برای مبادله تمام شده. مبادله جدید ایجاد کنید ";
			$_SESSION['alert']="warning";
			exit(header("Location: /dinero/transacts"));
		}
	}
	//
	if (isset($_GET['act'])){
		require_once(__COREROOT__."/module/dinero/controller/trade.php");
		switch ($_GET['do']) {
			case "send" :
				transferBySeller($_FILES["dox"],$_POST['text'],$checkTrade);
				break;
			case "cancel" :
				$transferAmount = findTransferAmount($checkTrade->amount);
				cancelBySeller($_POST['reason'],$_POST['text'],$checkTrade,$transferAmount);
				break;
		}
	}
	
	$GLOBALS['GCMS']->assign('TradeTimeLeft', $lastChance);
	$GLOBALS['GCMS']->assign('Trade', $checkTrade);
		
}

function trade($id)
{
	//trade
	if(!isset($_SESSION["gak_email"])){
		$_SESSION['result']="لطفا وارد سایت شوید.";
		$_SESSION['alert']="warning";
		exit(header("Location: /accountkit"));
	}
	//check
	$checkTrade=Dinerotrade::get(array("id" => $id,"id_buyer" => $_SESSION["gak_id"]));
	if(!isset($checkTrade) or !isset($id) ){
		$_SESSION['result']=" چنین مبادله‌ای وجود ندارد. ";
		$_SESSION['alert']="warning";
		exit(header("Location: /dinero/trades"));
	}
	//more than 20 mins
	if ($checkTrade->buyerpay_status == "pending"){
		$from = new DateTime($checkTrade->time);
		$diff = $from->diff(new DateTime('now'));
		$lastChance = $diff->y * 100 + $diff->m * 100 + $diff->d * 100 + $diff->h * 100 + $diff->i ;
		if ($lastChance > 20){
			//update trade - delete
			$arr_update=array(
					"id"                => $checkTrade->id,
					"trade_status"      => "deleted",
			);
			Dinerotrade::update($arr_update);
			$_SESSION['result']=" زمان پرداخت تومان برای مبادله تمام شده. مبادله جدید ایجاد کنید ";
			$_SESSION['alert']="warning";
			exit(header("Location: /dinero/trades"));
		}
	}
	
	// 
	$transferAmount = findTransferAmount($checkTrade->amount);
	if (isset($_GET['payment'])){

		switch ($_GET['payment']) {
			case "wallet" :
				
				break;
			case "online" :
				$totalToman = $checkTrade->amount*$checkTrade->exchange_rate + $checkTrade->exchange_rate * $transferAmount;
				zarinType($totalToman,"Trade Reference: ".$checkTrade->id*951753,$checkTrade->id,$_SESSION["gak_email"]);
				break;
		}
	}
	if (isset($_GET['act'])){
		switch ($_GET['do']) {
			case "confirm" :
				// TODO add user comment
				
				//update trade
				$arr_update=array(
						"id"                => $checkTrade->id,
						"trade_status"      => "complete",
				);
				Dinerotrade::update($arr_update);
				//return amount to seller wallet
				$sellerAmount = $checkTrade->exchange_rate*$checkTrade->amount + (floor($checkTrade->amount*2.5/100)) * $checkTrade->exchange_rate;
				//find seller wallet
				$sellerWallet   = Wallet::get(array("id_user" => $checkTrade->id_seller));
				//update wallet and add transaction
				//insert
				$insert_wallettransaction=array(
						"id_wallet" => $sellerWallet->id,
						"type"      => "deposit",
						"amount"    => $sellerAmount,
						"status"    => "confirm",
						"text"      => "Automaticly release by system. Trade #".$checkTrade->id*951753 ." complete",
						"time"      => date("Y-m-d H:i:s")
				);
				Wallettransactions::insert($insert_wallettransaction);
				//update
				$arr_update=array(
						"id"          => $sellerWallet->id,
						"amount"      => $sellerWallet->amount + $sellerAmount
				);
				Wallet::update($arr_update);
				//log
				Accountkitlog::insert(array("iduser" => $checkTrade->id_seller,
						"date" => date("Y-m-d H:i:s"), "title" => "systemWalletdeposit"));
				Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
						"date" => date("Y-m-d H:i:s"), "title" => "completeTrade"));
				//
				//start send email
				//find seller
				$seller= AccountKit::get(array("id" => $checkTrade->id_seller));
				$bodyStatusDinero= '
						<div>
                          
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								خریدار دریافت مبلغ یورو را تایید کرد
							  </a>
                         
                        </div>
					';
				
				$bodyInfo= "
					  <div>
						Trade has complated on 24dinero.com
 <br>
						
You can follow the trade on the following link. The amount is available on your dinero wallet.
 <br>
						
<a href=\"https://".$_SERVER['HTTP_HOST']."/dinero/transact/".$checkTrade->id."\">
						https://".$_SERVER['HTTP_HOST']."/dinero/transact/".$checkTrade->id."
						</a>
	                  </div>
					";
				$bodyTransaction= '
						
					';
				
				require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
				//send to seller
				$sellerFullname = Acountkitparam::get(array("iduser" => $checkTrade->id_seller, "type" => "fullname"));
				$token = $GLOBALS['GCMS_SETTING']['dinero']['smstoken'];
				$params = array(
						'to' => $seller->number,
						'from' => 'Info',
						'message' => "Trade has complated"
						."https://24dinero.com/"
						,
				);
				//sms_send($params,$token);
				
				//sendingblue email
				require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
				require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
				$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
				//
				$maildata = array( "to" => array($seller->email=> $sellerFullname->text),
						"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
						"subject" => "Trade has complated ".$_SERVER['HTTP_HOST'],
						"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
						"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
				);
				$mailin->send_email($maildata);
				
				//\\\\\end send email
				//
				$_SESSION['result']=" با سپاس ";
				$_SESSION['alert']="success";
				exit(header("Location: /dinero/trade/".$id));
				break;
			case "complain" :
					if ($_POST['dinero'] == "accept"){
						//update trade
						$arr_update=array(
								"id"                => $checkTrade->id,
								"trade_status"      => "complain",
						);
						Dinerotrade::update($arr_update);
						//log
						Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
								"date" => date("Y-m-d H:i:s"), "title" => "complainTrade"));
						//start send email
						//find seller
						$seller= AccountKit::get(array("id" => $checkTrade->id_seller));
						$bodyStatusDinero= '
						<div>
                          
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								شکایت خریدار از شما، مبلغ یورو به حساب خریدار نرسیده است
							  </a>
                          
                        </div>
					';
						
						$bodyInfo= "
					  <div>
					Trade has suspended because we have received a complaint about your trade on 24dinero.com 
 <br>
								
You can follow the trade on the following link. 
 <br>
								
<a href=\"https://".$_SERVER['HTTP_HOST']."/dinero/transact/".$checkTrade->id."\">
						https://".$_SERVER['HTTP_HOST']."/dinero/transact/".$checkTrade->id."
						</a>
	                  </div>
					";
						$bodyTransaction= '
								
					';
						
						require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
						//send to seller
						$sellerFullname = Acountkitparam::get(array("iduser" => $checkTrade->id_seller, "type" => "fullname"));
						$token = $GLOBALS['GCMS_SETTING']['dinero']['smstoken'];
						$params = array(
								'to' => $seller->number,
								'from' => 'Info',
								'message' => "Trade has suspended "
								."https://24dinero.com/"
								,
						);
						//sms_send($params,$token);
						
						//sendingblue email
						require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
						require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
						$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
						//
						$maildata = array( "to" => array($seller->email=> $sellerFullname->text),
								"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
								"subject" => "Trade has suspended ".$_SERVER['HTTP_HOST'],
								"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
								"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
						);
						$mailin->send_email($maildata);
						
						//\\\\\end send email
						$_SESSION['result']=" درخواست شما ثبت شد. ";
						$_SESSION['alert']="success";
						exit(header("Location: /dinero/trade/".$id));
					}else{
						$_SESSION['result']=" برای اینکه درخواست شما مورد بررسی قرار گیرد، «داوری توسط دینرو» را تایید کنید. ";
						$_SESSION['alert']="warning";
						exit(header("Location: /dinero/trade/".$id));
					}
				break;
		}
	}
	$GLOBALS['GCMS']->assign('Trade', $checkTrade);
	$GLOBALS['GCMS']->assign('TransferAmount', $transferAmount);
	
}

function tradeback()
{
	//advertisment
	if(!isset($_SESSION["gak_email"])){
		$_SESSION['result']="لطفا وارد سایت شوید.";
		$_SESSION['alert']="warning";
		exit(header("Location: /accountkit"));
	}
	$MerchantID = $GLOBALS['GCMS_SETTING']['pays']['merchantID'];
	$Authority = $_GET['Authority'];
	$pay=Pays::get(array("id" => $_GET['oid']));
	if($pay->id_user!= $_SESSION["gak_id"])
	{
		$_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
		$_SESSION['alert']="danger";
		header("location: /dashboard");
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
			//check
			$checkTrade=Dinerotrade::get(array("id" => $_GET['sfid'],"id_buyer" => $_SESSION["gak_id"]));
			if (!isset($checkTrade)){
				$_SESSION['result']="پرداخت شما تایید نشد.";
				$_SESSION['alert']="danger";
				exit(header("Location: /dashboard"));
			}
			//update pays
			$arr_update=array(
					"id" => $_GET['oid'],
					"bank_info" => $pay->bank_info."refID:".$result->RefID ,
					"status" => "confirm"
			);
			Pays::update($arr_update);
			//update trade
			$arr_update=array(
					"id"               => $_GET['sfid'],
					"trade_status"     => "buyerpaid",
					"buyerpay_status"  => "confirm",
					"sellerpay_status" => "pending",
					"buyerpay_details" => "id:".$_GET['oid']."|".$pay->bank_info."refID:".$result->RefID
			);
			Dinerotrade::update($arr_update);
			//update adv
			//check adv
			$checkAdv=Dineroadv::get(array("id" => $checkTrade->id_adv));
			$updateAmount = $checkAdv->amount - $checkTrade->amount;
			$arr_update=array(
					"id"         => $checkTrade->id_adv,
					"amount"     => $updateAmount
			);
			Dineroadv::update($arr_update);
			//user logs
			Accountkitlog::insert(array(
					"iduser" => $_SESSION["gak_id"], 
					"date" => date("Y-m-d H:i:s"), 
					"title" => "tradePaid"));
			
			//send emails and sms
			//todo shortlink
			// AIzaSyAoiuf_ls2yJa9AeKYFNiebhKSTDNhywnA goo.gl
			$seller   = AccountKit::get(array("id" => $checkTrade->id_seller));
			$buyer   = AccountKit::get(array("id" => $checkTrade->id_buyer));
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
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								درخواست انتقال یورو، لطفا سریعا اقدام کنید
							  </a>
                        </div>
					';
				
			$bodyInfoSeller= "
				  <div>

Payment has confirmed for your advertisements on 24dinero.com
 <br>
Transfer amount:".$checkTrade->amount ."€   <br>
Bank: ".$buyerBankname->text."<br>
Beneficiary Name:  ".$buyerFullname->text."<br>
IBAN: ".$buyerIban->text."<br>

You can confirm or cancel the transaction on the following link: <br>

<a href=\"https://".$_SERVER['HTTP_HOST']."/dinero/transact/".$checkTrade->id."\">
						https://".$_SERVER['HTTP_HOST']."/dinero/transact/".$checkTrade->id."
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
                              <a href="#"
                        style="background-color:#016910;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								درخواست انتقال یورو
							  </a>
                        </div>
					';
				
			$bodyInfoBuyer= "
				  <div>

Payment has confirmed for your trade on 24dinero.com
 <br>
Transfer amount:".$checkTrade->amount ."€   <br>
Bank: ".$buyerBankname->text."<br>
Beneficiary Name:  ".$buyerFullname->text."<br>
IBAN: ".$buyerIban->text."<br>

You can follow the transaction on the following link: <br>

<a href=\"https://".$_SERVER['HTTP_HOST']."/dinero/trade/".$checkTrade->id."\">
						https://".$_SERVER['HTTP_HOST']."/dinero/trade/".$checkTrade->id."
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
			header("location: /dinero/trade/".$_GET['sfid']);
		}
	}else{
		$_SESSION['result']="پرداخت شما تایید نشد.";
		$_SESSION['alert']="danger";
		header("location: /dinero/trade/".$_GET['sfid']);
	}

	
}

function deal()
{
	//advertisment
	if(!isset($_SESSION["gak_email"])){
		$_SESSION['result']=" برای درخواست خرید یورو، وارد سایت شوید. ";
		$_SESSION['alert']="warning";
		exit(header("Location: /accountkit"));
	}
	//check id
	if(!isset($_GET['id']) or $_GET['id'] == "" )
		exit(header("Location: /dashboard"));
	//
	$Adv = Dineroadv::get(array("id" => $_GET['id'] ,"status" => "active"));
	$GLOBALS['GCMS']->assign('Adv', $Adv);
	if(!isset($Adv) ){
		$_SESSION['result']=" چنین آگهی وجود ندارد. ";
		$_SESSION['alert']="warning";
		exit(header("Location: /dashboard"));
	}
	$minmax = explode("|", $Adv->minmax);
	if ( $_GET['amount'] < $minmax[0] )
		exit(header("Location: ?id=".$_GET['id']."&amount=$minmax[0]"));
	if (  $minmax[1] < $_GET['amount'] )
		exit(header("Location: ?id=".$_GET['id']."&amount=$minmax[1]"));
	//
	$GLOBALS['GCMS']->assign('Adv', $Adv);
	$transferAmount = findTransferAmount($_GET['amount']);
	$GLOBALS['GCMS']->assign('TransferAmount', $transferAmount);
	if (isset($_GET['update'])){
		//insert wallet toman
		$insert_wallet=array(
				"id_user"        => $_SESSION["gak_id"],
				"amount"         => "0",
				"currency"       => "Toman",
				"iban"           => $_POST['iban'],
				"cardno"         => $_POST['cardno'],
				"accountholder"  => $_POST['accountholder'],
				"bankname"       => $_POST['bankname'],
				"expdate"        => date("Y-m-d"),
				"status"         => "active"
		);
		Wallet::insert($insert_wallet);
		Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
				"date" => date("Y-m-d H:i:s"), "title" => "createWallet"));
		$_SESSION['result']=" کیف پول تومان شما با موفقیت ایجاد شد. ";
		$_SESSION['alert']="success";
		header("location: /dinero/deal?id=".$_GET['id']."&amount=".$_GET['amount']);
	}
	if (isset($_GET['do'])){
		require_once(__COREROOT__."/module/dinero/controller/trade.php");
		if (isset($_GET['payment'])){
			if($Adv->id_user == $_SESSION["gak_id"] ){
				$_SESSION['result']=" شما نمی‌توانید از خودتان خرید کنید. ";
				$_SESSION['alert']="warning";
				exit(header("Location: /dashboard"));
			}
			$lastRate = Dinerorate::get(array(
					"type"     => "EU",
					"refrence" => "o-xe.com",
			),false,array("by"=>'id',"sort"=>'DESC'));
			$dineroLastRate = $lastRate->ratesell+ $GLOBALS['GCMS_SETTING']['dinero']['ratediff'];
			if (isset($_GET['discount'])){
				if ($_GET['discount'] == "abril-25-0"){
					$dineroLastRate = $dineroLastRate -25;
				}
			}
			switch ($_GET['payment']) {
				case "wallet" :
					applyWallet($Adv,$_GET['amount'],$dineroLastRate,$transferAmount);
					break;
				case "online" :
					$totalToman = $_GET['amount']*$dineroLastRate + $dineroLastRate*$transferAmount;
					$Trade =  applyOnline($Adv,$_GET['amount'],$dineroLastRate,$transferAmount);
					zarinType($totalToman,"Trade Reference: ".$Trade*951753,$Trade,$_SESSION["gak_email"]);
					break;
			}
		}
	}
		
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
					"bankname"       => $_POST['bankname'],
					"expdate"        => date("Y-m-d"),
					"status"         => "active"
			);
			Wallet::insert($insert_wallet);
			Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
					"date" => date("Y-m-d H:i:s"), "title" => "createWallet"));
			$_SESSION['result']=" کیف پول تومان شما با موفقیت ایجاد شد. ";
			$_SESSION['alert']="success";
			header("location: /dinero/adv");
		}
	}else{
		//check if wallet
		$dt = date("Y-m-d");
		$checAdv=Dineroadv::get(array("id_user" => $_SESSION["gak_id"], "time" => "%$dt%"));
		if ($checAdv){
			$_SESSION['result']=" حداکثر ۱ آگهی فروش یورو در هرروز می‌توانید ثبت کنید. ";
			$_SESSION['alert']="warning";
			exit(header("Location: /dashboard"));
		}
			
		if (isset($_GET['add'])){
			//insert wallet toman
			$insert_wallet=array(
					"id_user"        => $_SESSION["gak_id"],
					"currency"       => "Euro",
					"amount"         => $_POST['amount'],
					"minmax"         => $_POST['amount']."|"
									   .$_POST['amount']."|"
									   .$_POST['maxanswer']."|"
									   .$_POST['maxtransfer'],
					"locations"      => "es|",
					"method"         => "bank|",
					"status"         => "active",
					"text"           => $_POST['text'],
					"time"           => date("Y-m-d H:i"),
			);
			$lastInsertId = Dineroadv::insert($insert_wallet);
			Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"],
					"date" => date("Y-m-d H:i:s"), "title" => "createAdv|".$lastInsertId));
			
			//start send email
			$bodyStatusDinero= '
						<div>
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								یک آگهی فروش یورو، ایجاد شد
							  </a>
                        </div>
					';
			
			$bodyInfo= "
					  <div>
					
						<br>
						<a href=\"https://".$_SERVER['HTTP_HOST']."/dinero/advertisement/".$lastInsertId."\">
						https://".$_SERVER['HTTP_HOST']."/dinero/advertisement/".$lastInsertId."
						</a>
								
	                  </div>
					";
			$bodyTransaction= '
					
					';
			//sendingblue email
			require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
			require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
			$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
			$maildata = array( "to" => array($GLOBALS['GCMS_SETTING']['dinero']['dineroAdminEmail']=>"Dinero Admin"),
					"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
					"subject" => "Adv Created Alarm ".$_SERVER['HTTP_HOST'],
					"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
					"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
			);
			$mailin->send_email($maildata);
			////end send mail
			$_SESSION['result']=" آگهی شما با موفقیت ثبت شد. ";
			$_SESSION['alert']="success";
			header("location: /dashboard");
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
					Acountkitparam::update(array("id" => $checkAvatarpath->id,"text" => DIRECTORY_SEPARATOR.$uploaddir.DIRECTORY_SEPARATOR.$imName));
					Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], 
							"date" => date("Y-m-d H:i:s"), "title" => "uploadAvatar"));
						
					//start send email
					$bodyStatusDinero= '
						<div>
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								برای تایید آواتار اقدام کنید
							  </a>
                        </div>
					';
					
					$bodyInfo= "
					  <div>
					  
					  <img src=\"".$_SERVER['HTTP_HOST'].DIRECTORY_SEPARATOR.$uploaddir.DIRECTORY_SEPARATOR.$imName."\" >
						
						<br>
						<a href=\"https://".$_SERVER['HTTP_HOST']."/dinero/userInfo/".$_SESSION["gak_id"]."\">
						https://".$_SERVER['HTTP_HOST']."/dinero/userInfo/".$_SESSION["gak_id"]."
						</a>
	                   
	                  </div>
					";
					$bodyTransaction= '
					
					';
					//sendingblue email
					require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
					require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
					$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
					$maildata = array( "to" => array($GLOBALS['GCMS_SETTING']['dinero']['dineroAdminEmail']=>"Dinero Admin"),
							"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
							"subject" => "Avatar-Confirmation Alarm ".$_SERVER['HTTP_HOST'],
							"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
							"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
					);
					$mailin->send_email($maildata);
					
					//\\\\\end send email
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
							"date" => date("Y-m-d H:i:s"), "title" => "uploadIdfoto"));
					//start send email
					$bodyStatusDinero= '
						<div>
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								برای تایید تصویر کارت شناسایی اقدام کنید
							  </a>
                        </div>
					';
						
					$bodyInfo= "
					  <div>
				
					  <img src=\"".$_SERVER['HTTP_HOST'].DIRECTORY_SEPARATOR .$uploaddir.DIRECTORY_SEPARATOR.$imName."\" >
					  <br>
						<a href=\"https://".$_SERVER['HTTP_HOST']."/dinero/userInfo/".$_SESSION["gak_id"]."\">
						https://".$_SERVER['HTTP_HOST']."/dinero/userInfo/".$_SESSION["gak_id"]."
						</a>
	                  </div>
					";
					$bodyTransaction= '
			
					';
					
					//sendingblue email
					require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
					require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
					$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
					$maildata = array( "to" => array($GLOBALS['GCMS_SETTING']['dinero']['dineroAdminEmail']=>"Dinero Admin"),
							"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
							"subject" => "ID-Confirmation Alarm ".$_SERVER['HTTP_HOST'],
							"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
							"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
					);
					$mailin->send_email($maildata);
					
					
					//\\\\\end send email
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
	
		Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], 
				"date" => date("Y-m-d H:i:s"), "title" => "updateBankaccount"));
		
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
		
		Accountkitlog::insert(array("iduser" => $_SESSION["gak_id"], 
				"date" => date("Y-m-d H:i:s"), "title" => "updateBasicinfo"));
		
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
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
                        پرداخت آفلاین در سیستم ثبت شد. لطفا سریعا پیگیری کنید
                        </a>
                        </div>
					';
	
			$bodyStatus = '
					<div>
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
                    اطلاعات شما دریافت و ثبت شد، در صورت تایید اطلاعات توسط مدیر، 
					انتقال یورو شما در کمتر از ۱ روز کاری انجام می‌شود.
					لطفا شکیبا باشید
                        </a>
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
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
                        پرداخت آنلاین در سیستم ثبت شد. پیگیری کنید
                        </a>
                        </div>
					';
				
				$bodyStatus = '
					<div>
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
                    اطلاعات شما دریافت و ثبت شد،
					انتقال یورو شما در کمتر از ۱ روز کاری انجام می‌شود.
					لطفا شکیبا باشید
                        </a>
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
			"id_user"   => $_SESSION["gak_id"],
			"amount"    => $amount,
			"txt"       => $txt,
			"date"      => date("Y-m-d H:i:s"),
			"bank_info" => "Payment:Zarin|",
			"status"    => "pending"
	);

	Pays::insert($arr_insert);
	$orderId=mysql_insert_id();
	//protol
	if ($_SERVER['HTTPS'] == "on")
		$protocol = "https://";
	else 
		$protocol = "http://";
	//
	$site_url= $protocol.$_SERVER['SERVER_NAME'];
	require_once(__COREROOT__."/libs/utility/hashing.php");

	$Amount = $amount;
	$Description = $txt;
	$CallbackURL = $site_url."/dinero/tradeback?oid=".$orderId."&type=zarin&id=".rndstring(90)."&sfid=".$id_shop_factor."&id_user=".$email."&amount=".$amount;
	$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
	$result = $client->PaymentRequest(
			[
					'MerchantID'    => $MerchantID,
					'Amount'        => $Amount,
					'Description'   => $Description,
					'Email'         => $email,
					'Mobile'        => "",
					'CallbackURL'   => $CallbackURL,
			]
			);
	if ($result->Status == 100) {
		Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority);
	} else {
		$_SESSION['result']=" یک چیزی یه‌جایی اشتباه شده.  ". 'ERR: '.$result->Status;
		$_SESSION['alert']="danger";
		header("location: /dashboard");
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
function findTransferAmount($amount) {
	switch ($amount) {
	    case $amount < 850:
	    	$TransferAmount = $amount*4.5/100;
	        break;
	    case $amount <= 2300 and $amount >= 850:
	        $TransferAmount = $amount*4/100;
	        break;
	    case $amount > 2300:
	        $TransferAmount = $amount*3.5/100;
	        break;
	}
	return ceil($TransferAmount);
}

function sms_send($params, $token, $backup = false ) {

	static $content;

	if($backup == true){
		$url = 'https://api2.smsapi.com/sms.do';
	}else{
		$url = 'https://api.smsapi.com/sms.do';
	}

	$c = curl_init();
	curl_setopt( $c, CURLOPT_URL, $url );
	curl_setopt( $c, CURLOPT_POST, true );
	curl_setopt( $c, CURLOPT_POSTFIELDS, $params );
	curl_setopt( $c, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $c, CURLOPT_HTTPHEADER, array(
			"Authorization: Bearer $token"
	));

	$content = curl_exec( $c );
	$http_status = curl_getinfo($c, CURLINFO_HTTP_CODE);

	if($http_status != 200 && $backup == false){
		$backup = true;
		sms_send($params, $token, $backup);
	}

	curl_close( $c );
	return $content;
}



