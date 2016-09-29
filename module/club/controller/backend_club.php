<?php

/**
 * backend_club.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > club
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/club/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);
require_once(__COREROOT__."/libs/utility/hashing.php");

function index()
{
	//setting $_GET if not set
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/club/?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=10;
	$arr_get=array(
				"status_not" => "delete"
	);
	$order=array(
				"by" => "date_created",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//setting search
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('users', ItakUser::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(ItakUser::get_count($arr_get)/$max_results));
}

function newuser()
{
	if(isset($_POST['submit']))
	{
		//checking duplicates
		if(ItakUser::get_count(array("username" => $_POST['username']))>0)
		{
			$_SESSION['result']="نام کاربری قبلا گرفته شده، لطفا نام کاربری دیگری انتخاب کنید";
			$_SESSION['alert']="alarm";
			header("location: /gadmin/club/newuser");
		}
		else if($_POST['email']!=""&&ItakUser::get_count(array("email" => $_POST['email']))>0)
		{
			$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
			$_SESSION['alert']="alarm";
			header("location: /gadmin/club/newuser");
		}
		else if($_POST['cell']!=""&&ItakUser::get_count(array("cell" => $_POST['cell']))>0)
		{
			$_SESSION['result']="شماره موبایل قبلا استفاده شده، لطفا شماره دیگری مشخص کنید";
			$_SESSION['alert']="alarm";
			header("location: /gadmin/club/newuser");
		}
		else
		{
			//adding user to db
			$password_salt=saltit($_POST['username']);
			$password=hashit($_POST['password'], $password_salt);
			$arr_insert=array(
						"username" => $_POST['username'],
						"email" => $_POST['email'],
						"email_temp_code" => "NULL",
						"password" => $password,
						"password_salt" => $password_salt,
						"password_attempts_failed" => 0,
						"password_temp_code" => "NULL",
						"status" => "invalid",
						"user_level" => $_POST['user_level'],
						"date_created" => date("Y-m-d H:i:s"),
						"name" => $_POST['name'],
						"cell" => $_POST['cell'],
						"cell_temp_code" => "NULL",
						"birth_date" => "NULL",
						"gender" => "NULL",
						"marital" => "NULL",
						"address" => "NULL",
						"avatar" => "NULL",
						"nickname" => "NULL",
						"type" => "public"
			);
			ItakUser::insert($arr_insert);
			$new_id=mysql_insert_id();
			$_SESSION['result']="عضو جدید ایجاد شد";
			$_SESSION['alert']="success";

			if(isset($_POST['email'])&&$_POST['email']!="")
			{
				if(email_confirm_code($new_id))
					$_SESSION['result']=$_SESSION['result']." و کد تایید آدرس ایمیل ارسال شد";
				else
					$_SESSION['result']=$_SESSION['result']." اما کد تایید آدرس ایمیل ارسال نشد";
			}
			if(isset($_POST['cell'])&&$_POST['cell']!="")
			{
				if(sms_confirm_code($new_id))
				{
					$_SESSION['result']=$_SESSION['result']
							." و همچنین کد تایید شماره همراه با پیام کوتاه ارسال شد";
				}
				else
					$_SESSION['result']=$_SESSION['result']." اما کد تایید شماره همراه ارسال نشد";
			}
			header("location: /gadmin/club/edituser/".$new_id);
		}

	}
}

function edituser($id)
{
	$user=ItakUser::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		if(isset($_POST['submit']))
		{
			if($_POST['email']!=$user->email&&$_POST['email']!=""
					&&ItakUser::get_count(array("email" => $_POST['email']))>0)
			{
				$_SESSION['result']="آدرس ایمیل قبلا استفاده شده، لطفا ایمیل دیگری مشخص کنید";
				$_SESSION['alert']="alarm";
			}
			else if($_POST['cell']!=$user->cell&&$_POST['cell']!=""
					&&ItakUser::get_count(array("cell" => $_POST['cell']))>0)
			{
				$_SESSION['result']="شماره موبایل قبلا استفاده شده، لطفا شماره دیگری مشخص کنید";
				$_SESSION['alert']="alarm";
			}
			else
			{
				if($_POST['birth_date']!="")
					$birth_date=shamsi_to_miladi($_POST['birth_date']);
				else
					$birth_date="NULL";
				$arr_update=array(
							"id" => $id,
							"name" => $_POST['name'],
							"email" => $_POST['email'],
							"cell" => $_POST['cell'],
							"user_level" => $_POST['user_level'],
							"birth_date" => $birth_date,
							"gender" => $_POST['gender'],
							"marital" => $_POST['marital'],
							"address" => $_POST['address'],
							"avatar" => $_POST['avatar'],
							"nickname" => $_POST['nickname'],
							"type" => $_POST['type']
				);
				ItakUser::update($arr_update);
				$_SESSION['result']="ویرایش انجام شد";
				$_SESSION['alert']="success";
				if($_POST['email']!=$user->email&&$_POST['email']!="")
				{
					if(email_confirm_code($id))
						$_SESSION['result']=$_SESSION['result']." و کد تایید آدرس ایمیل ارسال شد";
					else
						$_SESSION['result']=$_SESSION['result']
								." اما کد تایید آدرس ایمیل ارسال نشد";
				}
				if($_POST['cell']!=$user->cell&&$_POST['cell']!="")
				{
					if(sms_confirm_code($id))
					{
						$_SESSION['result']=$_SESSION['result']
								." و همچنین کد تایید شماره همراه با پیام کوتاه ارسال شد";
					}
					else
						$_SESSION['result']=$_SESSION['result']
								." اما کد تایید شماره همراه ارسال نشد";
				}
			}
			header("location: /gadmin/club/edituser/".$id);
		}

		$cards=ItakCard::get(array("id_user" => $id), true,
				array("by" => "reg_date", "sort" => "DESC"));
		foreach($cards as $card)
			if($card->status=="both"||$card->status=="product")
			{
				$products=ItakRelCardProduct::get(array("id_card" => $card->id), true, NULL,
						"product");
				$card->products=array();
				$card->products=$products;
			}
		$GLOBALS['GCMS']->assign('cards', $cards);
		$GLOBALS['GCMS']
				->assign('scores',
						ItakUserScore::get(array("id_user" => $id), true,
								array("by" => "date", "sort" => "DESC"), "point"));
		$GLOBALS['GCMS']->assign('user', $user);
		$GLOBALS['GCMS']
		->assign('group',
				ItakRelGroupUser::get(
						array(
								"id_user" => $user->id,
								"status" => "member"
						), false, NULL, "group"));
	}
	else
		header("location: /error404?error=club&reason=user_not_exist");
}

function chngpass($id)
{
	$user=ItakUser::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		if(isset($_POST['submit']))
		{
			$password_salt=saltit($_POST['username']);
			$password=hashit($_POST['password'], $password_salt);
			//updating db...
			$arr_update=array(
						"id" => $id,
						"password" => $password,
						"password_salt" => $password_salt,
			);
			ItakUser::update($arr_update);
			//sending email...
			if($user->email!="")
			{
				$email_text="
                کاربر گرامی ".$user->username." <br />
                کلمه عبور شما در سایت  ".$_SERVER['HTTP_HOST']
						."  تغییر کرد.<br />
                کلمه عبور جدید شما : ".$_POST['password'];
				$arr_email=array(
							"from" => "noreply@".$_SERVER['HTTP_HOST'],
							"to" => $user->email,
							"subject" => "New Password From ".$_SERVER['HTTP_HOST'],
							"text" => $email_text,
							"sign" => ":: این ایمیل به صورت خودکار برای شما ارسال شده است ::",
							"URL" => $_SERVER['HTTP_HOST'],
				);
				$sendmail=new Email();
				$sendmail->set("html", true);
				$sendmail->getParams($arr_email);
				$sendmail->parseBody();
				$sendmail->setHeaders();
				$sendmail->send();
			}
			$_SESSION['result']="کلمه عبور تغییر کرد";
			$_SESSION['alert']="success";
			header("location: /gadmin/club/chngpass/".$id);
		}
		$GLOBALS['GCMS']->assign('user', $user);
	}
	else
		header("location: /error404?error=club&reason=user_not_exist");
}

function deluser($id)
{
	$user=ItakUser::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "delete"
		);
		ItakUser::update($arr_update);
		$_SESSION['result']="عضو حذف شد";
		$_SESSION['alert']="success";
		//setting $_GET if not set
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/club/?paging=".$_GET['paging']."&search=".$_GET['search']);
	}
	else
		header("location: /error404?error=club&reason=user_not_exist");
}

function undeluser($id)
{
	$user=ItakUser::get(array("id" => $id));
	if(isset($id)&&isset($user))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "pending"
		);
		ItakUser::update($arr_update);
		$_SESSION['result']="عضو بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/club/edituser/".$id);
	}
	else
		header("location: /error404?error=club&reason=user_not_exist");
}

function groups()
{
	//setting $_GET if not set
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/club/groups/?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=10;
	$arr_get=array(
				"status_not" => "delete"
	);
	$order=array(
				"by" => "date",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//setting search
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('groups', ItakGroup::get($arr_get, true, $order, $limit, "manager"));
	$GLOBALS['GCMS']->assign('paging', ceil(ItakGroup::get_count($arr_get)/$max_results));
}

function group($id)
{
	$group=ItakGroup::get(array("id" => $id));
	if(isset($id)&&isset($group))
	{
		$mmbrs = ItakRelGroupUser::get(array("id_group" => $id, "status" => "member"), true,NULL, "user");
		$GLOBALS['GCMS']->assign('members',$mmbrs);
		$max_results=10;
		$arr_get=array();
		$order=array(
					"by" => "date",
					"sort" => "DESC"
		);
		if(!isset($_GET['paging']))
			$paging=1;
		else
			$paging=$_GET['paging'];
		$limit=array(
					"start" => (($paging*$max_results)-$max_results),
					"end" => $max_results
		);
		$boards=ItakGroupBoard::get(array("id_group" => $id), true, $order, $limit);
		foreach($boards as $board)
		{
			if($board->id_user==0)
				$board->name="مدیر سایت";
			else
			{
				$user=ItakUser::get(array("id" => $board->id_user));
				$board->name=$user->name;
			}
		}
		$GLOBALS['GCMS']->assign('boards', $boards);
		$GLOBALS['GCMS']
				->assign('paging',
						ceil(
								ItakGroupBoard::get_count(array("id_group" => $id))/$max_results));
		$GLOBALS['GCMS']
				->assign('scores',
						ItakGroupScore::get(array("id_group" => $id), true,
								array("by" => "date", "sort" => "DESC"), "point"));
		$GLOBALS['GCMS']->assign('group', $group);
		
		$userscormrg = array();
		foreach ($mmbrs as $mmbr)
		{
			$userscor =  ItakUserScore::get(array("id_user" => $mmbr->id_user), true,array("by" => "date", "sort" => "DESC"), "point");
			$userscormrg = array_merge($userscor, $userscormrg);
		}
		$GLOBALS['GCMS']->assign('userscores',$userscormrg);
		
	}
	else
		header("location: /error404?error=club&reason=group_not_exist");
}

function suspendgroup($id)
{
	$group=ItakGroup::get(array("id" => $id));
	if(isset($id)&&isset($group))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "suspend"
		);
		ItakGroup::update($arr_update);
		$_SESSION['result']="گروه معلق شد";
		$_SESSION['alert']="success";
		//setting $_GET if not set
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/club/groups/?paging=".$_GET['paging']."&search=".$_GET['search']);
	}
	else
		header("location: /error404?error=club&reason=group_not_exist");
}

function unsuspendgroup($id)
{
	$group=ItakUser::get(array("id" => $id));
	if(isset($id)&&isset($group))
	{
		$arr_update=array(
					"id" => $id,
					"status" => "active"
		);
		if(ItakRelGroupUser::get_count(array("id_group" => $id, "status" => "member"))>3)
			$arr_update['status']="full";
		ItakGroup::update($arr_update);
		$_SESSION['result']="گروه فعال شد";
		$_SESSION['alert']="success";
		//setting $_GET if not set
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/club/groups/?paging=".$_GET['paging']."&search=".$_GET['search']);
	}
	else
		header("location: /error404?error=club&reason=group_not_exist");
}

function cards()
{
	//setting $_GET if not set
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/club/cards/?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=20;
	$arr_get=array();
	$order=array(
				"by" => "serial",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//setting search
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$cards=ItakCard::get($arr_get, true, $order, $limit);
	foreach($cards as $card)
	{
		if($card->id_user!=0)
		{
			$user=ItakUser::get(array("id" => $card->id_user));
			$card->user_name=$user->name;
		}
	}
	$GLOBALS['GCMS']->assign('cards', $cards);
	$GLOBALS['GCMS']->assign('paging', ceil(ItakCard::get_count($arr_get)/$max_results));
}

function newcard()
{
	if(isset($_POST['submit']))
	{
		$serial=$_POST['serial'];
		for($i=0; $i<$_POST['number']; $i++)
		{
			do
				$code=uniqid();
			while(ItakCard::get_count(array("code" => $code))!=0);
			$arr_insert=array(
						"id_user" => "0",
						"type" => $_POST['type'],
						"serial" => $serial,
						"code" => $code,
						"status" => "none",
						"rate" => $_POST['rate'],
						"info" => $_POST['info'],
						"reg_date" => "NULL",
						"poll_behavior" => "NULL",
						"poll_txt" => "NULL",
						"poll_buy_date" => "NULL"
			);
			if(ItakCard::insert($arr_insert))
			{
				$serial++;
				$to_update=Setting::get(array("st_group" => "club", "st_key" => "serial"));
				Setting::update(array("id" => $to_update->id, "st_value" => $serial));
			}
		}
		$_SESSION['result']="کارت‌(های) جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/club/cards/?paging=1&search=NULL");
	}
}

function points()
{
	if(isset($_GET['edit']))
	{
		$point=ItakPoint::get(array("id" => $_GET['edit']));
		if(isset($point))
			$GLOBALS['GCMS']->assign('point', $point);
	}
	$GLOBALS['GCMS']->assign('points', ItakPoint::get(NULL, true, array("by" => "type")));
}

function newpoint()
{
	if(isset($_POST['submit']))
	{
		ItakPoint::insert(
				array(
							"name" => $_POST['name'],
							"type" => $_POST['type'],
							"title" => $_POST['title'],
							"user_rate" => $_POST['user_rate'],
							"group_rate" => $_POST['group_rate']
				));
		$_SESSION['result']="مورد امتیازی جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/club/points");
	}
}

function editpoint($id)
{
	$point=ItakPoint::get(array("id" => $id));
	if(isset($id)&&isset($point))
	{
		if(isset($_POST['submit']))
		{
			ItakPoint::update(
					array(
								"id" => $id,
								"title" => $_POST['title'],
								"user_rate" => $_POST['user_rate'],
								"group_rate" => $_POST['group_rate']
					));
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/club/points");
		}
	}
	else
		header("location: /error404?error=club&reason=point_not_exist");
}

function sendboard()
{
	if(isset($_POST['submit']))
	{
		$groups=ItakGroup::get(array("status_not" => "delete"), true);
		foreach($groups as $group)
		{
			$arr_insert=array(
						"id_group" => $group->id,
						"id_user" => "0",
						"txt" => $_POST['txt'],
						"date" => date("Y-m-d H:i:s")
			);
			ItakGroupBoard::insert($arr_insert);
			$_SESSION['result']="پیام ارسال شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/club/sendboard");
		}
	}
}

function giveprize()
{
	$all_users=ItakUser::get(array("status_not" => "delete"), true);
	foreach($all_users as $user)
	{
		$users[$user->id]=$user->name;
	}
	$all_groups=ItakGroup::get(array("status_not" => "delete"), true);
	foreach($all_groups as $group)
	{
		$groups[$group->id]=$group->name;
	}
	$all_prizes=ItakPoint::get(array("type" => "prize"), true);
	foreach($all_prizes as $prize)
	{
		$prizes[$prize->id]=$prize->title;
	}
	if(isset($_POST['submit']))
	{
		$point=ItakPoint::get(array("id" => $_POST['id_point']));
		if($_POST['type']=="user")
		{
			$arr_insert=array(
						"id_user" => $_POST['id_user'],
						"score" => "-".$point->user_rate,
						"id_point" => $_POST['id_point'],
						"date" => date("Y-m-d H:i:s")
			);
			ItakUserScore::insert($arr_insert);
		}
		else if($_POST['type']=="group")
		{
			$arr_insert=array(
						"id_group" => $_POST['id_group'],
						"score" => "-".$point->group_rate,
						"id_point" => $_POST['id_point'],
						"date" => date("Y-m-d H:i:s")
			);
			ItakGroupScore::insert($arr_insert);
		}
		$_SESSION['result']="جایزه اعطا شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/club/giveprize");
	}
	$GLOBALS['GCMS']->assign('users', $users);
	$GLOBALS['GCMS']->assign('groups', $groups);
	$GLOBALS['GCMS']->assign('prizes', $prizes);
}
