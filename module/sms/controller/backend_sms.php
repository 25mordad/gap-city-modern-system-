<?php
/**
 * backend_sms.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > sms
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/utility/sms.php");

if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	if(isset($_GET['single'])&&$_GET['single']=="true")
	{

	}
	else if(isset($_GET['interval'])&&$_GET['interval']=="true")
	{
		if(isset($_POST['submit']))
		{
			//TODO validatation
			$cells=array();
			for($i=$_POST['from_no']; $i<=$_POST['to_no']; $i++)
			{
				$cells[]=$_POST['base'].$i;
			}
			$GLOBALS['GCMS']->assign('cells', $cells);
		}
		else
			header("location: /gadmin/sms/interval");

	}
	else if(isset($_GET['user'])&&$_GET['user']=="true")
	{
		if(isset($_POST['submit']))
		{
			//TODO validatation
			$arr_get=array(
						"status_not" => "delete",
						"user_level" => $_POST['level']
			);
			$GLOBALS['GCMS']
					->assign('users',
							User::get($arr_get, true, NULL, NULL, "param_".$_POST['cell']));
		}
		else
			header("location: /gadmin/sms/user");
	}
	else
	{
		$groups=GroupContact::get(array("status" => "active"), true);
		$contacts=array();
		foreach($groups as $group)
		{
			$contacts[$group->id]=Contact::get(
					array("id_group" => $group->id, "status" => "active"), true);
		}
		$GLOBALS['GCMS']->assign('groups', $groups);
		$GLOBALS['GCMS']->assign('contacts', $contacts);
	}
}



function sendbox()
{
	//setting $_GET if not set
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/sms/sendbox/?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=10;
	$arr_get=array();
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
	$GLOBALS['GCMS']->assign('sms_send_box', SmsSendbox::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(SmsSendbox::get_count($arr_get)/$max_results));
}

function get_status($id)
{
	$sms=SmsSendbox::get(array("id" => $id));
	if(isset($id)&&isset($sms))
	{
		if($sms->final_result!="SentToMobile")
		{
			$status=get_sms_status($sms->id_afe);
			if($status['GetMessageStatusResult']!="Wrong messageSentID")
			{
				$arr_update=array(
							"id" => $id,
							"final_result" => $status['GetMessageStatusResult']
				);
				SmsSendbox::update($arr_update);
				$_SESSION['result']="پیام‌کوتاه پیگیری وضعیت شد";
				$_SESSION['alert']="success";
			}
			else
			{
				$_SESSION['result']="مهلت پیگیری تمام شده، لطفا دیگر تلاش نکنید";
				$_SESSION['alert']="error";
			}
		}

		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/sms/sendbox/?paging=".$_GET['paging']."&search=".$_GET['search']);
	}
	else
		header("location: /error404?error=sms&reason=sms_not_exist");

}

function del($id)
{
	$sms=SmsSendbox::get(array("id" => $id));
	if(isset($id)&&isset($sms))
	{
		SmsSendbox::del($id);

		$_SESSION['result']="پیام‌کوتاه حذف شد";
		$_SESSION['alert']="success";

		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/sms/sendbox/?paging=".$_GET['paging']."&search=".$_GET['search']);
	}
	else
		header("location: /error404?error=sms&reason=sms_not_exist");

}

function inbox()
{
    if($GLOBALS['GCMS_SETTING']['sms']['inbox']=='true')
    {
        if(isset($_GET['connect']))
        {
            $last=get_last_sms();
            if($last==""||$last->ID==$GLOBALS['GCMS_SETTING']['sms']['last'])
            {
                $_SESSION['result']="هیچ پیام جدیدی پیدا نشد";
                $_SESSION['alert']="warning";
            }
            else
            {
                $perior_id=$GLOBALS['GCMS_SETTING']['sms']['last'];
                $GLOBALS['GCMS_SETTING']['sms']['last']=$last->ID;
                $sms_last=Setting::get(array("st_group" => "sms", "st_key" => "last"));
                Setting::update(array("id" => $sms_last->id, "st_value" => $last->ID));
                while($last!=""&&$last->ID!=$perior_id)
                {
                    $arr_insert=array(
                                "id_afe" => $last->ID,
                                "text" => $last->Body,
                                "cell_no" => $last->From,
                                "date" => $last->Date
                    );
                    SmsInbox::insert($arr_insert);
                    $last=get_perior_sms($last->ID);
                }
                $_SESSION['result']="پیام‌های جدید دریافت شد";
                $_SESSION['alert']="success";
            }
            header("location: /gadmin/sms/inbox/?paging=1&search=NULL");
            return;
        }
        //setting $_GET if not set
        if(!isset($_GET['search']))
            $_GET['search']="NULL";
        if(!isset($_GET['paging']))
            header("location: /gadmin/sms/inbox/?paging=1&search=".$_GET['search']);
        //preparing to query
        $max_results=10;
        $arr_get=array();
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
        $GLOBALS['GCMS']->assign('sms_inbox', SmsInbox::get($arr_get, true, $order, $limit));
        $GLOBALS['GCMS']->assign('paging', ceil(SmsInbox::get_count($arr_get)/$max_results));
    }else
        header("location: /error404?error=sms&reason=inbox");
}

function delinbox($id)
{
	$sms=SmsInbox::get(array("id" => $id));
	if(isset($id)&&isset($sms))
	{
		SmsInbox::del($id);

		$_SESSION['result']="پیام‌کوتاه حذف شد";
		$_SESSION['alert']="success";

		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header("location: /gadmin/sms/inbox/?paging=".$_GET['paging']."&search=".$_GET['search']);
	}
	else
		header("location: /error404?error=sms&reason=sms_not_exist");

}

function interval()
{

}

function user()
{

}

function send()
{
    if(isset($_POST['cells']) and $_POST['sms_text'] != "")
    {
        $cells = $_POST['cells'];
        $counter=0;
        foreach($cells as $cell)
        {
            $arr_send=array(
                "cell" => $cell,
                "sms_text" => $_POST['sms_text']
            );
            if(send_sms($arr_send))
                $counter++;
        }
        if($counter==count($cells))
        {
            $_SESSION['result']=$counter." پیام با موفقیت ارسال شد. | اعتبار شما : "
                .$GLOBALS['GCMS_SETTING']['sms']['credit']." تومان ";
            $_SESSION['alert']="success";
        }
        else if($counter==0)
        {
            $_SESSION['result']="اعتبار شما کمتر از هزینه ارسال پیام کوتاه است";
            $_SESSION['alert']="danger";
        }
        else
        {
            $_SESSION['result']=(count($cells)-$counter)
                ." پیام شما به دلیل تمام شدن اعتبار ارسال نشد.";
            $_SESSION['alert']="warning";
        }
        header("location: /gadmin/sms/sendbox/?paging=1&search=NULL");
    }else{
        $_SESSION['result']=" لطفا اطلاعات را کامل وارد کنید ";
        $_SESSION['alert']="warning";
        header("location: /gadmin/sms");
    }
}
