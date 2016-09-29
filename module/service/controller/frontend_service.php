<?php

/**
 * frontend_service.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > service
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/service/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

if(!isset($_SESSION["glogin_username"]))
	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);

function index()
{

}

function admindomainlist()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /service");
	else
	{
		//setting $_GET if not set
		if(!isset($_GET['id_user']))
			$_GET['id_user']="all";
		if(!isset($_GET['status']))
			$_GET['status']="all";
		if(!isset($_GET['search']) or $_GET['search']=="")
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			header(
					"location: /service/admindomainlist?paging=1&search=".$_GET['search']."&id_user=".$_GET['id_user']."&status=".$_GET['status']);
		//preparing to query
		$max_results=10;
		$arr_get=array(

		);
		$order=array(
				"by" => "expire_date",
				"sort" => "ASC"
		);
		$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
		);


		if($_GET['id_user']!="all")
			$arr_get['id_user']=$_GET['id_user'];
		if($_GET['status']!="all")
			$arr_get['status']=$_GET['status'];
		if($_GET['search']!="NULL")
			$arr_get['search']="%".$_GET['search']."%";

		$GLOBALS['GCMS']->assign('domains',ServiceDomain::get($arr_get, true, $order,$limit));
		$GLOBALS['GCMS']->assign('domain_count',ServiceDomain::get_count($arr_get));
		$GLOBALS['GCMS']->assign('paging', ceil(ServiceDomain::get_count($arr_get)/$max_results));

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
}

function domains()
{
	if($_SESSION["glogin_user_level"] != 12)
		header("location: /service");
	else
	{
		$arr_get=array(
				"id_user" => $_SESSION["glogin_user_id"]
		);
		$order=array(
				"by" => "expire_date",
				"sort" => "ASC"
		);

		$GLOBALS['GCMS']->assign('domains',ServiceDomain::get($arr_get, true, $order));
		$GLOBALS['GCMS']->assign('domain_count',ServiceDomain::get_count($arr_get));
	}
}

function adddomain()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /service");
	else
	{
		if(isset($_POST['submit']))
		{

			$arr_insert=array(
					"id_user"      => $_POST['id_user'],
					"title"           => $_POST['title'],
					"register_date" => $_POST['register_date'],
					"expire_date"   => $_POST['expire_date'],
					"status" 		=> $_POST['status']
			);
			ServiceDomain::insert($arr_insert);

			$arr_get=array(
					"id" => $_POST['id_user']
			);

			$uid= User::get($arr_get, false);
			$row=MetaUser::get(array("id_user" => $_POST['id_user'], "name" => "param_15"));

			//sms send
			require_once(__COREROOT__."/libs/utility/sms.php");
			$arr_send=array(
					"cell" => $row->value,
					"sms_text" => "یک دامنه برای شما در سیستم ثبت شد http://gatriya.com/service/domains"
			);
			send_sms($arr_send);


			//send email

			$email_text="
					کاربر گرامی <br />
					دامنه شما در سیستم ثبت شد <br />
					<strong>".$_POST['title']."</strong> <br />
							لطفا برای مشاهده آن به وب سایت مراجعه فرمایید. <br />
							".$_SERVER['HTTP_HOST']." <br />
									";

			$arr_email=array(
					"from" => "noreply@".$_SERVER['HTTP_HOST'],
					"to" =>  $uid->email,
					"subject" => "Domaion | دامنه ".$_POST['title']." ".$_SERVER['HTTP_HOST'],
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

			$_SESSION['result']="دامنه جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /service/adddomain");
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
}

function editdomain($id)
{

	if($_SESSION["glogin_user_level"] != 42)
		header("location: /service");
	else
	{

		if(isset($_POST['submit']))
		{
			$arr_edit=array(
					"id"              => $id ,
					"id_user"      => $_POST['id_user'],
					"title"           => $_POST['title'],
					"register_date" => $_POST['register_date'],
					"expire_date"   => $_POST['expire_date'],
					"status" 		=> $_POST['status']

			);
			ServiceDomain::update($arr_edit);
			$_SESSION['result']="تغییرات انجام شد";
			$_SESSION['alert']="success";
			header("location: /service/editdomain/".$id);
		}

		$arr_get = array(
				"id" => $id
		);

		$GLOBALS['GCMS']->assign('domain',ServiceDomain::get($arr_get));
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

}