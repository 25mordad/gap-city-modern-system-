<?php

/**
 * admin.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: admin > dinero
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */


//admin trade list
function tradeList()
{
	if(!isset($_SESSION["username"]))
		exit(header("Location: /accountkit"));
	
	//find trades
	$Trades = dinerotrade::get(array( "not_trade_status" => "deleted"),true,
			array("by" => "time","sort" => "DESC")
			);
	$GLOBALS['GCMS']->assign('Trades', $Trades);
}
//admin trade 
function purchase($id)
{
	if(!isset($_SESSION["username"]))
		exit(header("Location: /accountkit"));
	
	//check
	$checkTrade=Dinerotrade::get(array("id" => $id));
	if(!isset($checkTrade) or !isset($id) ){
		$_SESSION['result']=" چنین مبادله‌ای وجود ندارد. ";
		$_SESSION['alert']="warning";
		exit(header("Location: /dinero/trades"));
	}
	//more than 20 mins
	$from = new DateTime($checkTrade->time);
	$diff = $from->diff(new DateTime('now'));
	$lastChance = $diff->y * 100 + $diff->m * 100 + $diff->d * 100 + $diff->h * 100 + $diff->i ;
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
			exit(header("Location: /dinero/trades"));
		}
	}
	if (isset($_GET['act'])){
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
		//
		//start send email
		//find seller
		$seller= AccountKit::get(array("iduser" => $checkTrade->id_seller));
		$bodyStatusDinero= '
						<div>
                          <!--[if mso]>
                          <v:rect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="#" style="height:33px;v-text-anchor:middle;width:100px;" stroke="f" fillcolor="#D84A38">
                            <w:anchorlock/>
                            <center>
                          <![endif]-->
                              <a href="$_SERVER[HTTP_HOST]"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								مبادله توسط سیستم تکمیل و بسته شد
							  </a>
                          <!--[if mso]>
                            </center>
                          </v:rect>
                          <![endif]-->
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
		exit(header("Location: /dinero/purchase/".$id));
	}

	//
	$transferAmount = findTransferAmount($checkTrade->amount);
	$GLOBALS['GCMS']->assign('TradeTimeLeft', $lastChance);
	$GLOBALS['GCMS']->assign('Trade', $checkTrade);
	$GLOBALS['GCMS']->assign('TransferAmount', $transferAmount);

}

function userInfo($id)
{
	if(!isset($_SESSION["username"]))
		exit(header("Location: /accountkit"));
	
	if (isset($_GET['avatar'])){
		$checkAvatar=Acountkitparam::get(array("iduser" => $id, "type" => "avatar"));
		$checkAvatarpath=Acountkitparam::get(array("iduser" => $id, "type" => "avatarpath"));
		switch ($_GET['avatar']) {
			case "confirm" :
				Acountkitparam::update(array("id" => $checkAvatar->id,"text" => "confirm"));
				// TODO send email
				$_SESSION['result']=" به‌روز رسانی انجام شد ";
				$_SESSION['alert']="success";
				exit(header("Location: /dinero/userInfo/".$id));
			break;
			case "cancel" :
				Acountkitparam::del($checkAvatar->id);
				Acountkitparam::del($checkAvatarpath->id);
				// TODO send email
				$_SESSION['result']=" به‌روز رسانی انجام شد ";
				$_SESSION['alert']="success";
				exit(header("Location: /dinero/userInfo/".$id));
			break;
		}
	}
	if (isset($_GET['idfoto'])){
		$idfoto=Acountkitparam::get(array("iduser" => $id, "type" => "idfoto"));
		$idfotopath=Acountkitparam::get(array("iduser" => $id, "type" => "idfotopath"));
		switch ($_GET['idfoto']) {
			case "confirm" :
				Acountkitparam::update(array("id" => $idfoto->id,"text" => "confirm"));
				// TODO send email
				$_SESSION['result']=" به‌روز رسانی انجام شد ";
				$_SESSION['alert']="success";
				exit(header("Location: /dinero/userInfo/".$id));
			break;
			case "cancel" :
				Acountkitparam::del($idfoto->id);
				Acountkitparam::del($idfotopath->id);
				// TODO send email
				$_SESSION['result']=" به‌روز رسانی انجام شد ";
				$_SESSION['alert']="success";
				exit(header("Location: /dinero/userInfo/".$id));
			break;
		}
	}
	$GLOBALS['GCMS']->assign('id', $id);
}


function advertisements()
{
	if(!isset($_SESSION["username"]))
		exit(header("Location: /accountkit"));
	//find advs
	$Advertisements = Dineroadv::get(array(),true);
	$GLOBALS['GCMS']->assign('Advertisements', $Advertisements);
}

function settlements()
{
	if(!isset($_SESSION["username"]))
		exit(header("Location: /accountkit"));
	
	if (isset($_GET['confirm'])){
		$update_wallettransaction=array(
				"id"        => $_GET['confirm'],
				"type"      => "withdraw",
				"status"    => "confirm",
				"text"      => "Withdraw Request - 1 day - Paid",
				"time"      => date("Y-m-d H:i:s")
		);
		Wallettransactions::update($update_wallettransaction);
		
		$customer   = AccountKit::get(array("id" => $_GET['u']));
		$customerFullname = Acountkitparam::get(array("iduser" => $checkPay->id_user, "type" => "fullname"));
		// TODO send email and sms
		//start send email
		$bodyStatusDinero= '
						<div>
                              <a href="#"
                        style="background-color:#2BB51C;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								انتقال از کیف‌پول دینرو به بانک شما انجام شد
							  </a>
                        </div>
					';
		$bodyInfo= "
		<div style='direction:rtl;text-align:right;'>
		درخواست تسویه حساب از کیف پول دینرو تایید و انجام شد.

		حداکثر در ساعات کاری پیش‌رو به وقت ایران، مبلغ درخواستی شما، به بانک واریز می‌شود.
		</div>
					";
		
		$bodyTransaction= '
				
		';
		//sendingblue email
		require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
		require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
		$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
		//seller
		$maildata = array( "to" => array($customer->email => $customerFullname->text),
				"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
				"subject" => "Bank transfer done ".$_SERVER['HTTP_HOST'],
				"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
				"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
		);
		$mailin->send_email($maildata);
		//\\\\\end send email
		$_SESSION['result']=" تغییرات با موفقیت انجام شد ";
		$_SESSION['alert']="success";
		exit(header("Location: /dinero/settlements"));
	}
	if (isset($_GET['add'])){
		$checkWallet=Wallet::get(array("id_user" => $_GET['id_user'], "currency" => "Toman"));
		$insert_wallettransaction=array(
				"id_wallet" => $checkWallet->id,
				"type"      => "deposit",
				"amount"    => $_GET['amount'],
				"status"    => "confirm",
				"text"      => $_GET['text'],
				"time"      => date("Y-m-d H:i:s")
		);
		$wt = Wallettransactions::insert($insert_wallettransaction);
		//update
		$arr_update=array(
				"id"          => $checkWallet->id,
				"amount"      => $checkWallet->amount + $_GET['amount']
		);
		Wallet::update($arr_update);
		//update pays
		$arr_update=array(
				"id"          => $_GET['add'],
				"txt"      => "walletTransaction: " . $wt,
				"status"      => "confirm"
		);
		Pays::update($arr_update);
		
		$checkPay   = Pays::get(array("id" => $_GET['add']));
		$customer   = AccountKit::get(array("id" => $checkPay->id_user));
		$customerFullname = Acountkitparam::get(array("iduser" => $checkPay->id_user, "type" => "fullname"));
		// TODO send email and sms
		//start send email
		$bodyStatusDinero= '
						<div>
                              <a href="#"
                        style="background-color:#2BB51C;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								درخواست  افزایش موجودی شما تایید شد
							  </a>
                        </div>
					';
		$bodyInfo= "
		<div>
		The amount added to your wallet.
		</div>
					";
		
		$bodyTransaction= '
				
		';
		//sendingblue email
		require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
		require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
		$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
		//seller
		$maildata = array( "to" => array($customer->email => $customerFullname->text),
				"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
				"subject" => "Deposit Confirmed ".$_SERVER['HTTP_HOST'],
				"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
				"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
		);
		$mailin->send_email($maildata);
		//\\\\\end send email
		$_SESSION['result']=" تغییرات با موفقیت انجام شد ";
		$_SESSION['alert']="success";
		exit(header("Location: /dinero/settlements"));
	}
	if (isset($_GET['del'])){
		
		$checkPay   = Pays::get(array("id" => $_GET['del']));
		$customer   = AccountKit::get(array("id" => $checkPay->id_user));
		$customerFullname = Acountkitparam::get(array("iduser" => $checkPay->id_user, "type" => "fullname"));
		Pays::del($_GET['del']);
		// TODO  sms
		//start send email
		$bodyStatusDinero= '
						<div>
                              <a href="#"
                        style="background-color:#D84A38;padding:10px;color:#ffffff;display:inline-block;font-family:tahoma;font-size:13px;font-weight:bold;line-height:33px;text-align:center;text-decoration:none;-webkit-text-size-adjust:none;">
								درخواست  افزایش موجودی شما لغو شد
							  </a>
                        </div>
					';
		$bodyInfo= "
		<div>
		The deposit canceled. 
		</div>
					";
		
		$bodyTransaction= '

		';
		//sendingblue email
		require_once(__COREROOT__."/module/dinero/libs/Mailin.php");
		require_once(__COREROOT__."/module/dinero/controller/emailTemplate.php");
		$mailin = new Mailin('https://api.sendinblue.com/v2.0',$GLOBALS['GCMS_SETTING']['dinero']['sendinblueAPIKey']);
		//seller
		$maildata = array( "to" => array($customer->email => $customerFullname->text),
				"from" => array($GLOBALS['GCMS_SETTING']['dinero']['sendinblueSenderEmail']),
				"subject" => "Deposit Canceled ".$_SERVER['HTTP_HOST'],
				"html" => emailTemp($bodyStatusDinero,$bodyInfo,$bodyTransaction),
				"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag")
		);
		$mailin->send_email($maildata);
		//\\\\\end send email
		
		$_SESSION['result']=" تغییرات با موفقیت انجام شد ";
		$_SESSION['alert']="success";
		exit(header("Location: /dinero/settlements"));
	}
	//find transactions
	$transactions = Wallettransactions::get(array("type" => "request-withdraw"),true,
			array("by" => "time","sort" => "DESC")
			);
	$GLOBALS['GCMS']->assign('transactions', $transactions);
	//find payments
	$payments= Pays::get(array("status" => "pending"),true,
			array("by" => "id","sort" => "DESC")
			);
	$GLOBALS['GCMS']->assign('payments', $payments);
}

function advertisement($id)
{
	//advertisment
	if(!isset($_SESSION["username"]))
		exit(header("Location: /accountkit"));

	//
	$Adv = Dineroadv::get(array("id" => $id));
	if(!isset($Adv) ){
		$_SESSION['result']=" چنین آگهی وجود ندارد. ";
		$_SESSION['alert']="warning";
		exit(header("Location: /dashboard"));
	}
	if (isset($_GET['edit'])){
		//update
		$arr_update=array(
				"id"             => $id,
				"amount"         => $_POST['amount'],
				"minmax"         => $_POST['mintransaction']."|"
				.$_POST['maxtransaction']."|"
				.$_POST['maxanswer']."|"
				.$_POST['maxtransfer'],
				"method"         => $_POST['themethod'],
				"locations"      => $_POST['locations'],
				"status"         => $_POST['status'],
				"text"           => $_POST['text'],
		);
		Dineroadv::update($arr_update);
		$_SESSION['result']=" تغییرات با موفقیت انجام شد ";
		$_SESSION['alert']="success";
		exit(header("Location: /dinero/advertisement/".$id));
	}
	//
	$GLOBALS['GCMS']->assign('Adv', $Adv);
				
}

