<?php

/**
 * backend_contact.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > contact
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */
require_once(__COREROOT__."/libs/utility/selecting.php");
$utilityfile = __COREROOT__."/module/contact/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{

	//setting $_GET if not set
	if(!isset($_GET['id_group']))
		$_GET['id_group']="all";
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /gadmin/contact/?paging=1&search=".$_GET['search']."&id_group="
						.$_GET['id_group']);
	//preparing to query
	$max_results=15;
	$arr_get=array(
				"status" => "active"
	);
	$order=array(
				"by" => "id",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//setting filters
	if($_GET['id_group']!="all")
		$arr_get['id_group']=$_GET['id_group'];
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('contacts', Contact::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(Contact::get_count($arr_get)/$max_results));
	$GLOBALS['GCMS']->assign('group_contacts', select_group_contact());
}

function grouping()
{
	if(isset($_GET['edit']))
	{
		$group_contact=GroupContact::get(array("id" => $_GET['edit']));
		if(isset($group_contact))
			$GLOBALS['GCMS']->assign('group_contact', $group_contact);
	}
	$GLOBALS['GCMS']->assign('groups', GroupContact::get(array("status" => "active"), true));
}

function newgroup()
{
	if(isset($_POST['name']))
	{
		$arr_insert=array(
					"name" => $_POST['name'],
					"status" => "active"
		);
		GroupContact::insert($arr_insert);
		$_SESSION['result']="گروه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/contact/grouping");
	}
}

function editgroup($id)
{
	$group_contact=GroupContact::get(array("id" => $id));
	if(isset($id)&&isset($group_contact))
	{
		if(isset($_POST['name']))
		{
			$arr_update=array(
						"id" => $id,
						"name" => $_POST['name']
			);
			GroupContact::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/contact/grouping");
		}
	}
	else
		header("location: /error404?error=contact&reason=group_not_exist");
}

function delgroup($id)
{
	$group_contact=GroupContact::get(array("id" => $id));
	if(isset($id)&&isset($group_contact))
	{
		if(Contact::get_count(array("id_group" => $id, "status_not" => "delete"))==0)
		{
			$arr_update=array(
						"id" => $id,
						"status" => "delete"
			);
			GroupContact::update($arr_update);
			$_SESSION['result']="گروه حذف شد";
			$_SESSION['alert']="success";
		}
		else
		{
			$_SESSION['result']="گروه به دلیل تماس‌های موجود در آن حذف نشد";
			$_SESSION['alert']="error";
		}
		header("location: /gadmin/contact/grouping");

	}
	else
		header("location: /error404?error=contact&reason=group_not_exist");
}

function undelgroup($id)
{
	$group_contact=GroupContact::get(array("id" => $id));
	if(isset($id)&&isset($group_contact))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "active"
		);
		GroupContact::update($arr_update);
		$_SESSION['result']="گروه بازیابی شد";

		header("location: /gadmin/contact/grouping");

	}
	else
		header("location: /error404?error=contact&reason=group_not_exist");
}

function new_contact()
{
	if(isset($_POST['cell']))
	{
		$arr_insert=array(
					"id_group" => $_POST['id_group'],
					"name" => $_POST['name'],
					"cell" => $_POST['cell'],
					"email" => $_POST['email'],
					"status" => "active"
		);
		Contact::insert($arr_insert);
		$_SESSION['result']="تماس جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/contact/edit/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('group_contacts', select_group_contact());
}

function edit($id)
{
	$contact=Contact::get(array("id" => $id));
	if(isset($id)&&isset($contact))
	{
		if(isset($_POST['cell']))
		{
			$arr_update=array(
						"id" => $id,
						"id_group" => $_POST['id_group'],
						"name" => $_POST['name'],
						"cell" => $_POST['cell'],
						"email" => $_POST['email']
			);
			Contact::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/contact/edit/".$id);
		}
		$GLOBALS['GCMS']->assign('group_contacts', select_group_contact());
		$GLOBALS['GCMS']->assign('contact', $contact);
	}
	else
		header("location: /error404?error=contact&reason=contact_not_exist");
}

function del($id)
{
	$contact=Contact::get(array("id" => $id));
	if(isset($id)&&isset($contact))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "delete"
		);
		Contact::update($arr_update);

		$_SESSION['result']="تماس حذف شد";
		$_SESSION['alert']="success";


		//setting $_GET if not set
		if(!isset($_GET['id_group']))
			$_GET['id_group']="all";
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header(
				"location: /gadmin/contact/?paging=".$_GET['paging']."&search=".$_GET['search']
						."&id_group=".$_GET['id_group']);
	}
	else
		header("location: /error404?error=contact&reason=contact_not_exist");
}

function undel($id)
{
	$contact=Contact::get(array("id" => $id));
	if(isset($id)&&isset($contact))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "active"
		);
		$group_contact=GroupContact::get(array("id" => $contact->id_group));
		if($group_contact->status=="delete")
			$arr_update['id_group']="0";
		Contact::update($arr_update);
		$_SESSION['result']="تماس بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/contact/edit/".$id);
	}
	else
		header("location: /error404?error=contact&reason=contact_not_exist");
}

function sendnewsletter()
{
	if (isset($_GET['send']))
	{
		$msg = "";
		$arr_get=array("status" => "active");
		$contacts = Contact::get($arr_get,true,$order,99);
		foreach ($contacts as $value) {
			sleep(10);
			//send email
			$name="noreply-khodro711";
			$from="noreply@khodro711.com";
			$mail= new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth=true;
			$mail->Host       = "mail.khodro711.com";
			$mail->Username= "noreply@khodro711.com";
			$mail->Password= "ef^u9~7Axypm";
			$mail->AddAddress($value->email, $value->name);
			$mail->SetFrom($from, $name);
			$mail->AddReplyTo($from, $name);
			$mail->Subject    = $_POST['title'];
			$mail->IsHTML(true);
			$body = '<html><body>';
			$body .= '<p style="direction:rtl;font-family:tahoma;">'.$_POST['text'].'</p>';
			$body .= '<p style="direction:rtl;font-family:tahoma;">:: ارسال شده توسط خبرنامه گاتریا ::</p>';
			$body .= "</body></html>";
			$mail->MsgHTML($body);
			$mail->AltBody= $_POST['text'];
			$mail->Send();
			//end send email
			$msg .= "خبرنامه برای <b>". $value->name . "</b> -  { ".$value->email." } ارسال شد ".date('h:i:s')." <br/>";
		}
		
		$GLOBALS['GCMS']->assign('msg', $msg);
	}else{
		$arr_get=array("status" => "active");
		$contactcount = Contact::get_count($arr_get);
		if ($contactcount > 100)
			$contactcount = 100;
		$GLOBALS['GCMS']->assign('contactcount', $contactcount);	
	}
	

}