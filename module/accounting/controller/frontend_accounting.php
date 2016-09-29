<?php

/**
 * frontend_accounting.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > accounting
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/accounting/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


if(!isset($_SESSION["glogin_username"]))
	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);

function index()
{
    $arr_get=array(
        "user_id" => $_SESSION["glogin_user_id"] ,

    );
    $order=array(
        "by" => "date",
        "sort" => "DESC"
    );
    $group=array(
        "by" => "date"
    );
    $GLOBALS['GCMS']->assign('list_account_user',Account::get($arr_get, true, $group, $order));
}

function adminList()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");
	//setting $_GET if not set
	if(isset($_GET['datefrom']))
		$stringFrom = "&datefrom=".$_GET['datefrom'];
	
	if(isset($_GET['dateto']))
		$stringTo = "&dateto=".$_GET['dateto'];
	
	if(!isset($_GET['user_id']))
		$_GET['user_id']="all";
	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /accounting/adminList?paging=1&search=".$_GET['search']."&user_id=".$_GET['user_id'].$stringFrom.$stringTo);
	//preparing to query
	$max_results=20;
	$arr_get=array(


	);
	if($_GET['user_id']!="all")
		$arr_get['user_id']=$_GET['user_id'];
	if($_GET['search']!="NULL")
	{
		$srch = explode("/", $_GET['search']);
		$arr_get['user_id']=$srch[1];
		$d = $srch[0];
		$arr_get['date']= "20".$d[0].$d[1]."-".$d[2].$d[3]."-".$d[4].$d[5];
	}
	$order=array(
			"by" => "date",
			"sort" => "DESC"
	);
	$group=array(
			"by" => "date" ,
			"andby" => "user_id"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	if(isset($_GET['datefrom']))
	{
		$arr_get['datefrom']=$_GET['datefrom'];
		$arr_get['dateto']=$_GET['dateto'];
	}
		
	$GLOBALS['GCMS']->assign('list_account_user',Account::get($arr_get, true, $group, $order,$limit));
	$cnt = count(Account::get($arr_get, true, $group, $order));
	$GLOBALS['GCMS']->assign('count_account_user',$cnt);
	$GLOBALS['GCMS']->assign('paging', ceil($cnt/$max_results));

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

function invoice($id)
{
	if($_SESSION["glogin_user_level"] != 42)
	{
		if ($id != $_SESSION['glogin_user_id'] )
			header("location: /accounting/");
	}

	$arr_get = array("user_id"=>$id , "date" => $_GET['date']);
	$order=array(
			"by" => "fee",
			"sort" => "DESC"
	);
	$i = Account::get($arr_get,true,$group,$order);
	if (!$i)
		header("location: /accounting/");
	$GLOBALS['GCMS']->assign('invoice',$i);
	$GLOBALS['GCMS']->assign('id',$id);
	if (isset($_GET['notify']))
	{
		//sms send
		require_once(__COREROOT__."/libs/utility/sms.php");
		$uid= User::get($arr_get, false);
		$row=MetaUser::get(array("id_user" => $id, "name" => "param_15"));
		$arr_send=array(
				"cell" => $row->value,
				"sms_text" => "فاکتور شما در بخش حسابداری ایجاد شد http://gatriya.com/accounting"
		);
		send_sms($arr_send);
		//send email
		$email_text="
				کاربر گرامی <br />
				فاکتور شما در سیستم ثبت شد <br />
				لطفا برای مشاهده فاکتور به وب سایت مراجعه فرمایید. <br />
				".$_SERVER['HTTP_HOST']." <br />
						";
		$arr_email=array(
				"from" => "noreply@".$_SERVER['HTTP_HOST'],
				"to" => $uid->email,
				"subject" => "Accounting فاکتور جدید ".$_SERVER['HTTP_HOST'],
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
		$_SESSION['result']="ایمیل و پیامک ارسال شد";
		$_SESSION['alert']="success";
		header("location: /accounting/invoice/".$id);
	}
}

function newService()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");

	if(isset($_GET['add']))
	{

		$arr_insert=array(
				"user_id"         => $_POST['user_id'],
				"title"           => $_POST['title'],
				"fee"             => $_POST['fee']*10,
				"date"            => shamsi_to_miladi($_POST['date']),
				"register_date"   => date("Y-m-d H:i:s"),
				"txt"             => $_POST['txt'],
				"id_author"       => $_SESSION["glogin_user_id"]
		);
		Account::insert($arr_insert);

		$_SESSION['result']="خدمات جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /accounting/newService?user_id=".$_POST['user_id']);
	}


}

function newcost()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");

	if(isset($_POST['submit']))
	{

		$arr_insert = array(
				"title"	       => $_POST['title'],
				"type"		   => $_POST['type'],
				"fee"          => $_POST['fee']*10,
				"txt"     	   => $_POST['txt'],
				"date"     	   => shamsi_to_miladi($_POST['date']),
				"regdate"	   => date("Y-m-d H:i:s"),
				"id_author"    => $_SESSION["glogin_user_id"]

		);
		Costs::insert($arr_insert);

		$_SESSION['result']="ثبت هزینه ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /accounting/newcost");
	}

	$arr_get=array(
			"user_level" => $_GET['user_level']
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

function newPay()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");

	if(isset($_GET['add']))
	{

		$arr_insert=array(
				"id_user"   => $_POST['user_id'],
				"amount"    => $_POST['amount']*10,
				"txt"       => $_POST['txt'],
				"date"      => shamsi_to_miladi($_POST['date']),
				"bank_info" => "پرداخت آفلاین",
				"status"    => "confirm"
		);
		Pays::insert($arr_insert);

		$_SESSION['result']="ثبت پرداخت انجام شد";
		$_SESSION['alert']="success";
		header("location: /accounting/newpay?user_id=".$_POST['user_id']);
	}


}

function costs()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");
	//setting $_GET if not set
	if(!isset($_GET['type']) or $_GET['type']=="")
		$_GET['type']="all";
	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /accounting/costs?paging=1&type=".$_GET['type']."&search=".$_GET['search']);
	//preparing to query
	$max_results=20;
	$arr_get=array(


	);
	if($_GET['type']!="all")
		$arr_get['type']=$_GET['type'];
	if($_GET['search']!="NULL")
	{
		$arr_get['search']="%".$_GET['search']."%";
	}
	$order=array(
			"by" => "date",
			"sort" => "DESC"
	);

	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	$GLOBALS['GCMS']->assign('costs',costs::get($arr_get, true, $order,$limit));
	$cnt = count(costs::get($arr_get, true, $order));
	$GLOBALS['GCMS']->assign('count_costs',$cnt);
	$GLOBALS['GCMS']->assign('paging', ceil($cnt/$max_results));

}
function pays()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");
	//setting $_GET if not set
	if(!isset($_GET['id_user']) or $_GET['id_user']=="")
		$_GET['id_user']="all";
	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /accounting/pays?paging=1&id_user=".$_GET['id_user']);
	//preparing to query
	$max_results=20;
	$arr_get=array(


	);
	if($_GET['id_user']!="all")
		$arr_get['id_user']=$_GET['id_user'];

	$order=array(
			"by" => "date",
			"sort" => "DESC"
	);

	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	$GLOBALS['GCMS']->assign('pays',Pays::get($arr_get, true, $order,$limit));
	$GLOBALS['GCMS']->assign('count_pays',Pays::get_count($arr_get));
	$GLOBALS['GCMS']->assign('paging', ceil(Pays::get_count($arr_get)/$max_results));
}
function editcost($id)
{

	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");

	if (isset($_GET['del']))
	{
		Costs::del($id);
		$_SESSION['result']="عملیات با موفقیت انجام شد";
		$_SESSION['alert']="success";
		header("location: /accounting/costs");
	}

	if(isset($_POST['submit']))
	{
		$arr_edit=array(
				"id"          => $id ,
				"type"        => $_POST['type'],
				"title"       => $_POST['title'],
				"fee"         => $_POST['fee'],
				"date"        => shamsi_to_miladi($_POST['date']),
				"txt"         => $_POST['txt'],

		);
		Costs::update($arr_edit);
		$_SESSION['result']="تغییرات انجام شد";
		$_SESSION['alert']="success";
		header("location: /accounting/editcost/".$id);
	}

	$arr_get=array(
			"id" => $id
	);

	$GLOBALS['GCMS']->assign('cost',costs::get($arr_get));

}

function editService($id)
{

	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");

	if (isset($_GET['del']))
	{
		Account::del($id);
		$_SESSION['result']=" حذف شد ";
		$_SESSION['alert']="success";
		header("location: /accounting/services?paging=1&user_id=".$_GET['user_id']);
	}

	if(isset($_GET['edit']))
	{
		$arr_edit=array(
				"id"          => $id ,
				"user_id"     => $_POST['user_id'],
				"title"       => $_POST['title'],
				"fee"         => $_POST['fee'],
				"date"        => shamsi_to_miladi($_POST['date']),
				"txt"         => $_POST['txt'],

		);
		Account::update($arr_edit);
		$_SESSION['result']="تغییرات انجام شد";
		$_SESSION['alert']="success";
		header("location: /accounting/editService/".$id);
	}

	$arr_get=array(
			"id" => $id
	);

	$GLOBALS['GCMS']->assign('service',Account::get($arr_get));

}

function editpay($id)
{

	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");

	if (isset($_GET['del']))
	{
		Pays::del($id);
		$_SESSION['result']="عملیات با موفقیت انجام شد";
		$_SESSION['alert']="success";
		header("location: /accounting/pays?paging=1&id_user=".$_GET['id_user']);
	}

	if(isset($_GET['edit']))
	{
		$arr_edit=array(
				"id"          => $id ,
				"amount"      => $_POST['amount'],
				"date"        => shamsi_to_miladi($_POST['date']),
				"status"      => "confirm",
				"txt"         => $_POST['txt']

		);
		Pays::update($arr_edit);
		$_SESSION['result']="تغییرات انجام شد";
		$_SESSION['alert']="success";
		header("location: /accounting/editpay/".$id);
	}

	$arr_get=array(
			"id" => $id
	);

	$GLOBALS['GCMS']->assign('pay',Pays::get($arr_get));

}

function services()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");
	//setting $_GET if not set
	if(!isset($_GET['user_id']) or $_GET['user_id']=="")
		$_GET['user_id']="all";

	if(!isset($_GET['paging']))
		header(
				"location: /accounting/services?paging=1&user_id=".$_GET['user_id']);
	//preparing to query
	$max_results=20;
	$arr_get=array(


	);
	if($_GET['user_id']!="all")
		$arr_get['user_id']=$_GET['user_id'];

	$order=array(
			"by" => "date",
			"sort" => "DESC"
	);

	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	$GLOBALS['GCMS']->assign('services',Account::get($arr_get, true, null , $order,$limit));
	$GLOBALS['GCMS']->assign('count_service',Account::get_count($arr_get));
	$GLOBALS['GCMS']->assign('paging', ceil(Account::get_count($arr_get)/$max_results));

}

function reportbedbes()
{

	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");
	$arr_get_user=array(
			"user_level" => $_GET['user_level']
	);
	$users= User::get($arr_get_user, true);
	$GLOBALS['GCMS']->assign('users', $users);

	/*
	 $fruits = array("d"=>"lemon", "a"=>"orange", "b"=>"banana", "c"=>"apple");
	$fruits = array_merge($fruits, array("j"=>"shop"));

	//$fruits = ;
	ksort($fruits);
	foreach ($fruits as $key => $val) {
	echo "$key = $val\n";
	} */
	//var_dump($fruits);

	$array_sum    = array(0=>0);
	$array_amount = array(0=>0);
	$array_fee    = array(0=>0);
	foreach ($users as $row)
	{

		$user_sum_amount     = Pays::get_sum_amount($row->id);

		$user_sum_servicefee = Account::get_sum_service_fee($row->id);
		if (isset($user_sum_servicefee ) or isset($user_sum_amount) )
		{

			$array_amount = array_merge($array_amount, array( $row->id."a" => $user_sum_amount ));
			$array_fee    = array_merge($array_fee   , array( $row->id."a" => $user_sum_servicefee ));
			$array_sum    = array_merge($array_sum   , array( $row->id."a" => $user_sum_amount-$user_sum_servicefee ));
		}


	}
	arsort($array_sum);
	$GLOBALS['GCMS']->assign('array_sum'   , $array_sum);
	$GLOBALS['GCMS']->assign('array_amount', $array_amount);
	$GLOBALS['GCMS']->assign('array_fee'   , $array_fee);
}

function users()
{
	if($_SESSION["glogin_user_level"] != 42)
		header("location: /accounting");
	if(!isset($_GET['user_level']) or $_GET['user_level']=="")
		$_GET['user_level']="all";
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /accounting/users?paging=1&user_level=".$_GET['user_level']."&search=".$_GET['search']);


	//preparing to query
	$max_results=10;
	$arr_get=array(
			"status" => "active"
	);
	if ($_GET['user_level']!="all")
		$arr_get['user_level']=$_GET['user_level'];
	//setting search
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	$order=array(
			"by" => "date_created",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	$users=User::get($arr_get, true, $order, $limit);
	foreach($users as $user)
	{
		$par1=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		next($GLOBALS['GCMS_USER_PARAM']);
		$par2=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		prev($GLOBALS['GCMS_USER_PARAM']);
		$user->params="";
		if(isset($par1))
			$user->params=$user->params.$par1->value;
		if(isset($par2))
			$user->params=$user->params." ".$par2->value;
		$credit=MetaUser::get(array("id_user" => $user->id, "name" => "credit"));
		if(isset($credit))
			$user->credit=$credit->value;
		else
			$user->credit=0;
	}
	$GLOBALS['GCMS']->assign('users', $users);
	$GLOBALS['GCMS']->assign('countusers', User::get_count($arr_get));
	$GLOBALS['GCMS']->assign('paging', ceil(User::get_count($arr_get)/$max_results));


}


