<?php

/**
 * frontend_message.php
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

$utilityfile = __COREROOT__."/module/message/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


if(!isset($_SESSION["glogin_username"]))
	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);


function index()
{

	if(!isset($_GET['paging']))
		header(
				"location: /message/?paging=1");
	//preparing to query
	$max_results=10;

	$arr_get=array(
			"id_user" => $_SESSION["glogin_user_id"] ,
	);
	$order=array(
			"by"   => "id",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);

	$GLOBALS['GCMS']->assign('messageList',Messages::get($arr_get, true, $order,$limit));
	$GLOBALS['GCMS']->assign('messageCount',Messages::get_count($arr_get));
	$GLOBALS['GCMS']->assign('paging', ceil(Messages::get_count($arr_get)/$max_results));

}

function new_message()
{
    if(isset($_POST['newMessage']) )
    {
        if ($_POST['text'] != "")
        {
            $arr_insert=array(
                "id_user"        => $_SESSION["glogin_user_id"],
                "title"          => $_POST['title'],
                "status"         => "send",
                "create_date"    => date("Y-m-d H:i:s"),
            );
            Messages::insert($arr_insert);
            $id_message = mysql_insert_id();
            $arr_insert=array(
                "id_message"        => $id_message,
                "id_user"           => $_SESSION["glogin_user_id"],
                "text"              => stripcslashes($_POST['text']),
                "date"              => date("Y-m-d H:i:s"),
            );
            Messagetext::insert($arr_insert);

            $_SESSION['result']= " پیام شما ارسال شد ";
            $_SESSION['alert']="success";
            header("location: /message/show/".$id_message);

        }else {
            $_SESSION['result']= " خطا ";
            $_SESSION['alert']="warning";
            header("location: /message/new/");
        }

    }

}

function show($id)
{
    $sup = Messages::get(array( "id"=> $id , "id_user" => $_SESSION["glogin_user_id"] ), false );

    if(isset($_GET['send']) )
    {
        if ($_POST['text'] != "")
        {

            $arr_insert=array(
                "id_message"        => $id,
                "id_user"           => $_SESSION["glogin_user_id"],
                "text"              => stripcslashes($_POST['text']),
                "date"              => date("Y-m-d H:i:s"),
            );
            Messagetext::insert($arr_insert);

            $arrUpd = array("id" => $id,"status" => "send");
            Messages::update($arrUpd);

            $_SESSION['result']= " پاسخ شما ارسال شد ";
            $_SESSION['alert']="success";
            header("location: /message/show/".$id);

        }else {
            $_SESSION['result']= "خطا در ارسال";
            $_SESSION['alert']="warning";
            header("location: /message/show/".$id);
        }

    }


    if ($sup->id)
    {
        $GLOBALS['GCMS']->assign('message',$sup);
        $GLOBALS['GCMS']->assign('messageText',Messagetext::get(array( "id_message"=> $id ), true , array("by"=>"date","sort"=>"DESC") ));
    }else
        header("location: /error404?error=support&reason=messageNotFound");
}
