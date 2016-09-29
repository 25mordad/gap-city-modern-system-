<?php

/**
 * frontend_support.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > support
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/support/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


if(!isset($_SESSION["glogin_username"]))
	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);


function index()
{

	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /support/?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=10;

	$arr_get=array(
			"author_id" => $_SESSION["glogin_user_id"] ,
			"pg_type" => "support"
	);
	$order=array(
			"by" => "date_modified",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	$join_param=array(
			"meta_key" => "display4reseller"
	);
	if($_GET['search']!="NULL")
	{
		$arr_get['pg_content']=$_GET['search'];
	}
	$GLOBALS['GCMS']->assign('list_support_user',Page::get($arr_get, true, $order,$limit));
	$GLOBALS['GCMS']->assign('count_support_user',Page::get_count($arr_get));
	$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));

}
function adminlist()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /support");
	 
	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /support/adminlist?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=50;

	$arr_get=array(
			"pg_status_not" => "closed" ,
			"pg_type" => "support"
	);
	$order=array(
			"by" => "pg_status",
			"sort" => "ASC" ,
			"by2" => "date_modified",
			"sort2" => "ASC",


	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	if($_GET['search']!="NULL")
	{
		$arr_get['search']="%".$_GET['search']."%";
	}
	$GLOBALS['GCMS']->assign('list_support_user',Page::get($arr_get, true, $order,$limit));
	$GLOBALS['GCMS']->assign('count_support_user',Page::get_count($arr_get));
	$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));

}
function new_support()
{
	if(isset($_POST['submit']) )
	{
		if ($_POST['pg_content'] != "")
		{
			$arr_insert=array(
					"pg_type"        => "support",
					"parent_id"      => $_POST['parent_id'],
					"pg_title"       => $_POST['pg_title'],
					"pg_content"     => stripcslashes($_POST['pg_content']),
					"pg_excerpt"     => "NULL",
					"pg_status"      => "send",
					"comment_status" => $_POST['comment_status'],
					"author_id"      => $_SESSION["glogin_user_id"],
					"date_created"   => date("Y-m-d H:i:s"),
					"date_modified"  => date("Y-m-d H:i:s")
			);
			Page::insert($arr_insert);


			$_SESSION['result']="پشتیبانی جدید ایجاد شد ، شما می توانید فایل های مربوطه را نیز آپلود کنید";
			$_SESSION['alert']="success";
			header("location: /support/ch2waiting/".mysql_insert_id());

		}else {
			$_SESSION['result']="محتوای پشتیبانی را وارد نکرده اید";
			$_SESSION['alert']="alarm";
			header("location: /support/new/");
		}

	}

	$arr_get = array(
			"id_user" => $_SESSION["glogin_user_id"]
	);
	$order=array(
			"by" => "id",
			"sort" => "DESC"
	);
	$GLOBALS['GCMS']->assign('contracts',Contract::get($arr_get, true,$order));
}



function ch2waiting($id)
{
	$arr_get = array(
			"id"         => $id ,
			"pg_type"    => "support" ,
			"author_id"  => $_SESSION["glogin_user_id"],
	);
	$supportch = Page::get($arr_get, false );
	if (!$supportch->id)
	{
		$_SESSION['result']="شما اجازه دسترسی به این بخش را ندارید";
		$_SESSION['alert']="alarm";
		header("location: /support/?paging=1&search=NULL");
	}
	$GLOBALS['GCMS']->assign('supportch',$supportch);

	if(isset($_POST['submit']))
	{

		if ($_POST['pg_content'] != "")
		{
			$new_pg_content = $supportch->pg_content."<div class=\"send\">".
					"<div class=\"post\">".stripcslashes($_POST['pg_content'])."</div>".
					"<div class=\"date\">".jdate(" l j F Y ساعت H:i ",strtotime(date("Y-m-d H:i:s")))."</div>".
					"<div class=\"author\">".$_SESSION["glogin_username"]."</div>".
					"</div>";
			$arr_edit=array(
					"id"  			=> $id,
					"pg_content"     => $new_pg_content,
					"pg_status"      => "send",
					"date_modified"  => date("Y-m-d H:i:s")

			);

			Page::update($arr_edit);
			$_SESSION['result']="پاسخ شما ارسال شد";
			$_SESSION['alert']="success";
			header("location: /support/ch2waiting/".$id);

		}else {
			$_SESSION['result']="محتوای پشتیبانی را وارد نکرده اید";
			$_SESSION['alert']="alarm";
			header("location: /support/ch2waiting/".$id);
		}
	}



}

function ch2send($id)
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /support");
	 
	$arr_get = array(
			"id"         => $id ,
			"pg_type"    => "support" ,
	);
	$supportch = Page::get($arr_get, false );

	$GLOBALS['GCMS']->assign('supportch',$supportch);

	if(isset($_POST['submit']))
	{

		if ($_POST['pg_content'] != "")
		{
			$new_pg_content = $supportch->pg_content."<div class=\"waiting\">".
					"<div class=\"post\">".stripcslashes($_POST['pg_content'])."</div>".
					"<div class=\"date\">".jdate(" l j F Y ساعت H:i ",strtotime(date("Y-m-d H:i:s")))."</div>".
					"<div class=\"author\">".$_SESSION["glogin_username"]."</div>".
					"</div>";
			$arr_edit=array(
					"id"  			=> $id,
					"pg_content"     => $new_pg_content,
					"pg_status"      => "waiting",
					"date_modified"  => date("Y-m-d H:i:s")

			);

			Page::update($arr_edit);

			//sms send
			if (isset($_POST['sms']))
			{
				require_once(__COREROOT__."/libs/utility/sms.php");
				$arr_send=array(
						"cell" => $_POST['sms'],
						"sms_text" => "پاسخ پشتیبانی شما ارسال شد. http://gatriya.com/support"
				);
				send_sms($arr_send);
			}

			//send email
				
			$email_text="
					<p style=\"direction:rtl;font-family:tahoma;\">
				 کاربر گرامی ".$_POST['un']." <br />
				 		به پشتیبانی شما پاسخ داده شد <br />
				 		<strong>".$supportch->pg_title."</strong> <br />
				 				</p>
				 				<p style=\"direction:rtl;font-family:tahoma;font-size:x-small;background-color:#CCCCCC;\">".html_entity_decode($supportch->pg_content)."</p>
				 						<hr/>
				 						<p style=\"direction:rtl;font-family:tahoma;\">".html_entity_decode($_POST['pg_content'])."</p>
				 								<p style=\"direction:rtl;font-family:tahoma;\">مشاهده پشتیبانی و فایل های پیوست : <br />
				 								".$_SERVER['HTTP_HOST']."/support/ch2waiting/$id </p>
				 								";
			if (false)
			{
				$arr_email=array(
						"from" => "noreply@".$_SERVER['HTTP_HOST'],
						"to" => $_POST['um'],
						"subject" => "پاسخ پشتیبانی : ".$supportch->pg_title." ".$_SERVER['HTTP_HOST'],
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
			}else{
				$name="noreply-gatriya";
				$from="noreply@gatriya.com";
				$mail= new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth=true;
				$mail->Host       = "mail.gatriya.com";
				$mail->Username= "noreply@gatriya.com";
				$mail->Password= "+,FDJ?#Gm*qE";
				$mail->AddAddress($_POST['um'], $_POST['un']);
				$mail->SetFrom($from, $name);
				$mail->AddReplyTo($from, $name);
				$mail->Subject    = "پاسخ پشتیبانی :".$supportch->pg_title;
				$mail->IsHTML(true);
				$body = '<html><body>';
				$body .= '<p style="direction:rtl;font-family:tahoma;">'.$email_text.'</p>';
				$body .= '<p style="direction:rtl;font-family:tahoma;">:: این ایمیل به صورت خودکار برای شما ارسال شده است ::</p>';
				$body .= "</body></html>";
				$mail->MsgHTML($body);
				$mail->AltBody= $email_text;
				$mail->Send();
			}
				


			//end send mail


			$_SESSION['result']="پاسخ شما ارسال شد";
			$_SESSION['alert']="success";
			header("location: /support/ch2send/".$id);

		}else {
			$_SESSION['result']="محتوای پشتیبانی را وارد نکرده اید";
			$_SESSION['alert']="alarm";
			header("location: /support/ch2send/".$id);
		}
	}



}

function ch2closed($id)
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /support");
	$arr_edit=array(
			"id"  			=> $id,
			"pg_status"      => "closed"

	);

	Page::update($arr_edit);

	$arr_get = array(
			"id"         => $id ,
	);
	$supportch = Page::get($arr_get, false );

	$arr_get_user = array(
			"id"         => $supportch->author_id ,
	);
	$userget = User::get($arr_get_user, false );


	//send email

	$email_text="
			کاربر گرامی ".$userget->username."<br />
					این نامه جهت اطلاع شما از تغییر وضعیت درخواست پشتیبانی شما به وضعیت بسته شد بدلیل عدم ارسال پاسخ از جانب شما طی 72 ساعت گذشته بوده است.
					در صورت بروز هرگونه سوال یا مشکل لطفا از همین طریق ما را مطلع بفرمایید.  <br />

					";

	$arr_email=array(
			"from" => "noreply@".$_SERVER['HTTP_HOST'],
			"to" => $userget->email,
			"subject" => "Re:: Support | پاسخ پشتیبانی ".$supportch->pg_title." ".$_SERVER['HTTP_HOST'],
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

	$_SESSION['result'] = "پشتیبانی با موفقیت بسته شد";
	$_SESSION['alert'] = "success";
	header("location: /support/adminlist?paging=1&search=NULL");

}


function adminlistarchives()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /support");
	 
	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['user']))
		$_GET['user']="all";
	if(!isset($_GET['paging']))
		header(
				"location: /support/adminlistarchives?paging=1&search=".$_GET['search']."&user=".$_GET['user']);
	//preparing to query
	$max_results=20;

	$arr_get=array(
			"pg_type" => "support"
	);
	$order=array(
			"by" => "date_modified",
			"sort" => "DESC"


	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	if($_GET['search']!="NULL")
	{
		$arr_get['search']="%".$_GET['search']."%";
	}
	if($_GET['user']!="all")
		$arr_get['author_id']=$_GET['user'];

	$GLOBALS['GCMS']->assign('list_support_user',Page::get($arr_get, true, $order,$limit));
	$GLOBALS['GCMS']->assign('count_support_user',Page::get_count($arr_get));
	$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));

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

function newadmin()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /support");
	 
	if(isset($_POST['submit']) )
	{
		if ($_POST['pg_content'] != "")
		{
				
			$arr_insert=array(
					"pg_type"        => "support",
					"parent_id"      => $_POST['parent_id'],
					"pg_title"       => $_POST['pg_title'],
					"pg_content"     => stripcslashes($_POST['pg_content']),
					"pg_excerpt"     => "NULL",
					"pg_status"      => "waiting",
					"comment_status" => $_POST['comment_status'],
					"author_id"      => $_POST['author_id'],
					"date_created"   => date("Y-m-d H:i:s"),
					"date_modified"  => date("Y-m-d H:i:s")
			);
			Page::insert($arr_insert);

			//sms send
			if (isset($_POST['sms']))
			{
				require_once(__COREROOT__."/libs/utility/sms.php");
				$arr_send=array(
						"cell" => $_POST['sms'],
						"sms_text" => "پیغامی از طرف گاتریا در پشتیبانی ثبت شد لطفا مراجعه فرمایید. http://gatriya.com/support"
				);
				send_sms($arr_send);
			}

			//send email

			$userget = User::get(array("id"=> $_POST['author_id']), false );
			$email_text="
				 کاربر گرامی <br />
					پیغامی از طرف گاتریا برای شما در پشتیبانی ارسال شد <br />
					<strong>".$_POST['pg_title']."</strong> <br />
							<p style=\"direction:rtl;font-family:tahoma;\">".$_POST['pg_content']." <br />
									مشاهده پشتیبانی و فایل های پیوست : <br />
									".$_SERVER['HTTP_HOST']." </p>
											";
			if (false)
			{
				$arr_email=array(
						"from" => "noreply@".$_SERVER['HTTP_HOST'],
						"to" => $_POST['um'],
						"subject" => "Support | پشتیبانی ".$_POST['pg_title']." ".$_SERVER['HTTP_HOST'],
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
			}else {
				$name="noreply-gatriya";
				$from="noreply@gatriya.com";
				$mail= new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth=true;
				$mail->Host       = "mail.gatriya.com";
				$mail->Username= "noreply@gatriya.com";
				$mail->Password= "+,FDJ?#Gm*qE";
				$mail->AddAddress($userget->email,$userget->username);
				$mail->SetFrom($from, $name);
				$mail->AddReplyTo($from, $name);
				$mail->Subject    = " گاتریا پشتیبانی : ".$_POST['pg_title'];
				$mail->IsHTML(true);
				$body = '<html><body>';
				$body .= '<p style="direction:rtl;font-family:tahoma;">'.$email_text.'</p>';
				$body .= '<p style="direction:rtl;font-family:tahoma;">:: این ایمیل به صورت خودکار برای شما ارسال شده است ::</p>';
				$body .= "</body></html>";
				$mail->MsgHTML($body);
				$mail->AltBody= $email_text;
				$mail->Send();
			}
				


			//end send mail



			$_SESSION['result']="پشتیبانی جدید ایجاد شد ، شما می توانید فایل های مربوطه را نیز آپلود کنید";
			$_SESSION['alert']="success";
			header("location: /support/ch2send/".mysql_insert_id());

		}else {
			$_SESSION['result']="محتوای پشتیبانی را وارد نکرده اید";
			$_SESSION['alert']="alarm";
			header("location: /support/new/");
		}

	}

	$arr_get = array(
			"id_user" => $_GET['id']
	);
	$order=array(
			"by" => "id",
			"sort" => "DESC"
	);
	$GLOBALS['GCMS']->assign('contracts',Contract::get($arr_get, true,$order));
	$arr_get_user=array(
			//"user_level" => "12" ,
			"status" => "active"
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

function display4reseller($id)
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /support");
	if(isset($_GET['deldisplay']))
	{
		MetaPage::del($_GET['deldisplay']);
		$_SESSION['result']="حذف نمایش  انجام شد";
		$_SESSION['alert']="success";
		header("location: /support/display4reseller/$id");
	}


	if(isset($_POST['submit']) )
	{
		$arr_insert=array(
				"page_id"       => $id,
				"meta_key"      => "display4reseller",
				"meta_value"    => $_POST['uid']
		);
		MetaPage::insert($arr_insert);


		$_SESSION['result']="نمایش پشتیبانی به کاربر مربوطه با موفقیت انجام شد";
		$_SESSION['alert']="success";
		header("location: /support/display4reseller/$id");
		 
	}
	$arr_get_mp = array(
			"page_id"    => $id ,
			"meta_key"    => "display4reseller" ,
				
	);
	$GLOBALS['GCMS']->assign('resellers', MetaPage::get($arr_get_mp,true ));

	$arr_get = array(
			"id"         => $id ,
			"pg_type"    => "support" ,
	);
	$GLOBALS['GCMS']->assign('supportch', Page::get($arr_get, false ));

	$arr_get = array(
			"id_user" => $_GET['id']
	);
	$order=array(
			"by" => "id",
			"sort" => "DESC"
	);
	$GLOBALS['GCMS']->assign('contracts',Contract::get($arr_get, true,$order));
	$arr_get_user=array(
			"user_level" => "41" ,
			"status" => "active"
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

function display()
{
	if($_SESSION["glogin_user_level"] != 41)
		header("location: /support");
	 
	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /support/display?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=20;

	$arr_get=array(
			"pg_type" => "support"
	);
	$order=array(
			"by" => "pg_status",
			"sort" => "ASC" ,
			"by2" => "date_modified",
			"sort2" => "ASC",


	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	if($_GET['search']!="NULL")
	{
		$arr_get['search']="%".$_GET['search']."%";
	}
	$list_support_user = Page::get($arr_get, true, $order,$limit,array("key" => "display4reseller" , "value" => $_SESSION["glogin_user_id"] ) );
	$GLOBALS['GCMS']->assign('list_support_user',$list_support_user);
	$cnt = Page::get($arr_get, true, $order,$limit="",array("key" => "display4reseller" , "value" => $_SESSION["glogin_user_id"] ));
	$GLOBALS['GCMS']->assign('count_support_user',count($cnt));
	$GLOBALS['GCMS']->assign('paging', ceil(count($cnt)/$max_results));

}

function show($id)
{
	if($_SESSION["glogin_user_level"] != 41)
		header("location: /support");
	 
	$arr_get = array(
			"id"         => $id ,
			"pg_type"    => "support" ,
	);
	$supportch = Page::get($arr_get, false );

	$GLOBALS['GCMS']->assign('supportch',$supportch);


}



