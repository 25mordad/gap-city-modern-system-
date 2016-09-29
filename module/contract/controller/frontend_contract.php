<?php

/**
 * frontend_contract.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > contract
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/contract/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


if(!isset($_SESSION["glogin_username"]))
	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);

function index()
{
	if (isset($_GET['cc']))
	{
		$arr_get = array(
				"id" => $_POST['id_contract']
		);

		$cntrct = Contract::get($arr_get, false);
		if ($cntrct->contract_status == "confirm")
		{
			$_SESSION['result']="شما مجاز به انجام تغییرات نیستید";
			$_SESSION['alert']="alarm";
			header("location: /contract/");

		}else{
			$arr_edit=array(
					"id"              => $_POST['id_contract'] ,
					"contract_status" => "confirm"

			);
			Contract::update($arr_edit);
			$_SESSION['result']="تغییرات انجام شد";
			$_SESSION['alert']="success";
			header("location: /contract/");
		}
	}
	$arr_get=array(
			"id_user" => $_SESSION["glogin_user_id"]
	);
	$order=array(
			"by" => "date",
			"sort" => "DESC"
	);
	$GLOBALS['GCMS']->assign('list_contract_user',Contract::get($arr_get, true, $order,$limit));

}


function adminlist()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /contract");

	if (isset($_GET['addomain']))
	{
		$arr_insert=array(
				"id_contract"     => $_POST['id_contract'],
				"domain_name"     => $_POST['domain_name'],
				"domain_exp"      => $_POST['domain_exp']
		);
		Domains::insert($arr_insert);
		$_SESSION['result']="دامنه به قرارداد اضافه شد";
		$_SESSION['alert']="success";
	}

	//setting $_GET if not set
	if(!isset($_GET['id_user']))
		$_GET['id_user']="all";
	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /contract/adminlist?paging=1&search=".$_GET['search']."&id_user=".$_GET['id_user']);
	//preparing to query
	$max_results=20;
	$arr_get=array(

	);
	$order=array(
			"by" => "date",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);


	if($_GET['id_user']!="all")
		$arr_get['id_user']=$_GET['id_user'];

	if($_GET['search']!="NULL")
	{
		$srch = explode("/", $_GET['search']);
		$arr_get['id']=$srch[1]/1234;
	}


	$GLOBALS['GCMS']->assign('list_contract_user',Contract::get($arr_get, true, $order,$limit));
	$GLOBALS['GCMS']->assign('count_contract_user',Contract::get_count($arr_get));
	$GLOBALS['GCMS']->assign('paging', ceil(Contract::get_count($arr_get)/$max_results));

	$arr_get_user=array(
			"user_level" => "12"
	);
	$order_user=array(
			"by" => "username",

	);
	$users= User::get($arr_get_user, true, $order_user);
	foreach($users as $user)
	{
		$par1=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		next($GLOBALS['GCMS_USER_PARAM']);

		prev($GLOBALS['GCMS_USER_PARAM']);
		$user->params="";
		if(isset($par1))
			$user->params=$user->params.$par1->value;


	}
	$GLOBALS['GCMS']->assign('users', $users);


}

function new_contract()
{

	if($_SESSION["glogin_user_level"] != 42)
		header("location: /contract");



	if(isset($_POST['submit']))
	{

		$arr_insert=array(
				"id_user"         => $_POST['id_user'],
				"title"           => $_POST['title'],
				"content"         => stripcslashes($_POST['content']),
				"date"            => shamsi_to_miladi($_POST['date']),
				"support_status"  => $_POST['support_status'],
				"support_type"    => $_POST['support_type'],
				"host_title"      => $_POST['host_title'],
				"host_text"       => $_POST['host_text'],
				"host_exp_date"   => shamsi_to_miladi($_POST['host_exp_date']),
				"contract_status" => $_POST['contract_status'],
				"contract_type"     => $_POST['contract_type'],
				"contract_duration" => $_POST['contract_duration'],
				"contract_fee"      => $_POST['contract_fee'],
				"contract_pay_type" => $_POST['contract_pay_type']
		);
		Contract::insert($arr_insert);

		$arr_get=array(
				"id" => $_POST['id_user']
		);

		$uid= User::get($arr_get, false);
		$row=MetaUser::get(array("id_user" => $_POST['id_user'], "name" => "param_15"));

		//sms send
		require_once(__COREROOT__."/libs/utility/sms.php");
		$arr_send=array(
				"cell" => $row->value,
				"sms_text" => "یک قرارداد برای شما در سیستم ثبت شد http://gatriya.com/contract"
		);
		send_sms($arr_send);


		//send email

		$email_text="
				کاربر گرامی <br />
				قرارداد شما در سیستم ثبت شد <br />
				<strong>".$_POST['title']."</strong> <br />
						".html_entity_decode($_POST['content'])." <br />
								لطفا برای مشاهده و تایید قرارداد به وب سایت مراجعه فرمایید. <br />
								".$_SERVER['HTTP_HOST']." <br />
										";

		$arr_email=array(
				"from" => "noreply@".$_SERVER['HTTP_HOST'],
				"to" =>  $uid->email,
				"subject" => "Contract | قرارداد ".$_POST['title']." ".$_SERVER['HTTP_HOST'],
				"text" => "<div style=\"direction:rtl;text-align=justify;font-family: \"tahoma\";\" >".$email_text."</div>",
				"sign" => ":: این ایمیل به صورت خودکار برای شما ارسال شده است ::",
				"URL" => $_SERVER['HTTP_HOST'],
		);
		$sendmail=new Email();
		$sendmail->set("html", true);
		$sendmail->getParams($arr_email);
		$sendmail->parseBody();
		$sendmail->setHeaders();
		$sendmail->send();


		//end send mail
		 

		$_SESSION['result']="قرارداد جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /contract/new/".mysql_insert_id());
	}

	$arr_get=array(
			"user_level" => "12"
	);
	$order=array(
			"by" => "username",
			"sort" => "ASC"
	);
	$users= User::get($arr_get, true, $order);
	foreach($users as $user)
	{
		$par1=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		next($GLOBALS['GCMS_USER_PARAM']);

		prev($GLOBALS['GCMS_USER_PARAM']);
		$user->params="";
		if(isset($par1))
			$user->params=$user->params.$par1->value;


	}
	$GLOBALS['GCMS']->assign('users', $users);
}

function show($id)
{
	if($_SESSION["glogin_user_level"] == 42)
		$arr_get = array("id" => $id);
	else
		$arr_get = array("id" => $id , "id_user"=>$_SESSION["glogin_user_id"]);

	$c = Contract::get($arr_get);
	if (!$c)
		header("location: /contract/");
	$GLOBALS['GCMS']->assign('contract',$c);
}

function edit($id)
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /contract");

	if(isset($_GET['removedomain']))
	{
		Domains::del($_GET['removedomain']);
		$_SESSION['result']="تغییرات انجام شد";
		$_SESSION['alert']="success";
		header("location: /contract/edit/".$id);
	}
	if(isset($_POST['submit']))
	{
		$arr_edit=array(
				"id"              => $id ,
				"id_user"         => $_POST['id_user'],
				"title"           => $_POST['title'],
				"content"         => stripcslashes($_POST['content']),
				"date"            => shamsi_to_miladi($_POST['date']),
				"support_status"  => $_POST['support_status'],
				"support_type"    => $_POST['support_type'],
				"host_title"      => $_POST['host_title'],
				"host_text"       => $_POST['host_text'],
				"host_exp_date"   => shamsi_to_miladi($_POST['host_exp_date']),
				"contract_status" => $_POST['contract_status'],
				"contract_type"     => $_POST['contract_type'],
				"contract_duration" => $_POST['contract_duration'],
				"contract_fee"      => $_POST['contract_fee'],
				"contract_pay_type" => $_POST['contract_pay_type']

		);
		Contract::update($arr_edit);
		$_SESSION['result']="تغییرات انجام شد";
		$_SESSION['alert']="success";
		header("location: /contract/edit/".$id);
	}

	$arr_get = array(
			"id" => $id
	);

	$GLOBALS['GCMS']->assign('contract',Contract::get($arr_get, false, $order,$limit));
	$arr_get=array(
			"user_level" => "12"
	);
	$order=array(
			"by" => "username",
			"sort" => "ASC"
	);
	$users= User::get($arr_get, true, $order);
	foreach($users as $user)
	{
		$par1=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		next($GLOBALS['GCMS_USER_PARAM']);

		prev($GLOBALS['GCMS_USER_PARAM']);
		$user->params="";
		if(isset($par1))
			$user->params=$user->params.$par1->value;


	}
	$GLOBALS['GCMS']->assign('users', $users);


}

