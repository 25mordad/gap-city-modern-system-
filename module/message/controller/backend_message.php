<?php

/**
 * backend_message.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > support
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/message/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
    if(!isset($_GET['paging']))
        header(
            "location: /gadmin/message/?paging=1&status=send");
    if(!isset($_GET['status']))
        $_GET['status']="all";

    //preparing to query
    $max_results=10;
    $arr_get=array();

    if($_GET['status']!="all")
        $arr_get['status']=$_GET['status'];

    if (isset($_GET["user"]))
        $arr_get['id_user']=$_GET['user'];

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

function show($id)
{
    $sup = Messages::get(array( "id"=> $id ), false );

    if(isset($_GET['send']) )
    {
        if ($_POST['text'] != "")
        {

            $arr_insert=array(
                "id_message"        => $id,
                "id_user"           => 0,
                "text"              => stripcslashes($_POST['text']),
                "date"              => date("Y-m-d H:i:s"),
            );
            Messagetext::insert($arr_insert);

            $arrUpd = array("id" => $id,"status" => "waiting");
            Messages::update($arrUpd);

            $_SESSION['result']= " پاسخ شما ارسال شد ";
            $_SESSION['alert']="success";
            header("location: /gadmin/message/?paging=1&status=send");

        }else {
            $_SESSION['result']= "خطا در ارسال";
            $_SESSION['alert']="warning";
            header("location: /gadmin/message/show/".$id);
        }

    }


    if ($sup->id)
    {
        $GLOBALS['GCMS']->assign('message',$sup);
        $GLOBALS['GCMS']->assign('messageTexts',Messagetext::get(array( "id_message"=> $id ), true , array("by"=>"date","sort"=>"DESC") ));
    }else
        header("location: /error404?error=support&reason=messageNotFound");
}
function new_message()
{
    $GLOBALS['GCMS']->assign('users',User::get(array("status_not" => "delete"), true, array("by" => "date_created","sort" => "DESC")));
    if(isset($_GET['send']) )
    {
        if ($_POST['text'] != "" and $_POST['id_user'] > 0 )
        {
            $arr_insert=array(
                "id_user"        => $_POST['id_user'],
                "title"          => $_POST['title'],
                "status"         => "waiting",
                "create_date"    => date("Y-m-d H:i:s"),
            );
            Messages::insert($arr_insert);
            $id_message = mysql_insert_id();
            $arr_insert=array(
                "id_message"        => $id_message,
                "id_user"           => 0,
                "text"              => stripcslashes($_POST['text']),
                "date"              => date("Y-m-d H:i:s"),
            );
            Messagetext::insert($arr_insert);

            $_SESSION['result']= " پیام شما ارسال شد ";
            $_SESSION['alert']="success";
            header("location: /gadmin/message/new/");

        }else {
            $_SESSION['result']= " خطا ";
            $_SESSION['alert']="warning";
            header("location: /gadmin/message/new/");
        }

    }
}