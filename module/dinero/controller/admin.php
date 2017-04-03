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
		// TODO send email and sms
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
		// TODO send email and sms
		$_SESSION['result']=" تغییرات با موفقیت انجام شد ";
		$_SESSION['alert']="success";
		exit(header("Location: /dinero/settlements"));
	}
	if (isset($_GET['del'])){
		Pays::del($_GET['del']);
		// TODO send email and sms
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

