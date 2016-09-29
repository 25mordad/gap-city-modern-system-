<?php

/**
 * backend_sarfejo_dailyfee.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > SAMPLE
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/sarfejo_dailyfee/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{

    if(isset($_GET['edit']))
    {

        if(isset($_POST['submit']))
        {
            $arr_update=array(
                "id" => $_GET['edit'],
                "date" => $_POST['date'],
                "fee" => $_POST['fee']
            );
            SarfejoDfstufffee::update($arr_update);
            $_SESSION['result']="ویرایش انجام شد";
            $_SESSION['alert']="success";
            header("location: /gadmin/sarfejo_dailyfee?paging=".$_GET['paging']."&edit=".$_GET['edit']);
        }
        $arr_get=array(
            "id" => $_GET['edit'],
        );
        $GLOBALS['GCMS']->assign('stufe', SarfejoDfstufffee::get($arr_get,false,null,null,"param"));
    }
    if(!isset($_GET['paging']))
        header( "location: /gadmin/sarfejo_dailyfee/?paging=1");
    //preparing to query
    $max_results=15;
    $arr_get=array(

    );
    $order=array(
        "by" => "id",
        "sort" => "DESC"
    );
    $limit=array(
        "start" => (($_GET['paging']*$max_results)-$max_results),
        "end" => $max_results
    );
    $GLOBALS['GCMS']->assign('dfstuffees', SarfejoDfstufffee::get($arr_get,true,$order,$limit,"param"));
    $GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));
}
function stuffs()
{
    if(isset($_GET['edit']))
    {
        if(isset($_POST['submit']))
        {
            $arr_update=array(
                "id" => $_GET['edit'],
                "name" => $_POST['name']
            );
            SarfejoDfstuff::update($arr_update);
            $_SESSION['result']="ویرایش انجام شد";
            $_SESSION['alert']="success";
            header("location: /gadmin/sarfejo_dailyfee/stuffs?edit=".$_GET['edit']);
        }
        $arr_get=array(
            "id" => $_GET['edit'],
        );
        $GLOBALS['GCMS']->assign('thisstuff', SarfejoDfstuff::get($arr_get));
    }
    $arr_get=array(

    );
    $GLOBALS['GCMS']->assign('stuffs', SarfejoDfstuff::get($arr_get, true));
}
function newstuff()
{
    if(isset($_POST['submit']))
    {
        $arr_insert=array(
            "name" => $_POST['name']
        );
        SarfejoDfstuff::insert($arr_insert);
        $_SESSION['result']="کالا جدید ایجاد شد";
        $_SESSION['alert']="success";
        header("location: /gadmin/sarfejo_dailyfee/stuffs");
    }
}

function newfee()
{
    $stuffs = SarfejoDfstuff::get(array(), true);
    if (count(SarfejoDfstufffee::get(array( "date" => date("y/m/d",strtotime( "now" )) ),true)) > 0)
    {
        $_SESSION['result']= " برای تاریخ "  .jdate("y/m/d",strtotime( "now" )) ." قبلا قیمت را ثبت کرده اید ";
        $_SESSION['alert']="alarm";
        header("location: /gadmin/sarfejo_dailyfee?paging=1");
    }
    if (isset($_GET['s']))
    {
        foreach ($stuffs as $stuff)
        {
            $pf = "fee_".$stuff->id;
            $arr_insert = array(
                "id_stuff" => $stuff->id ,
                "fee"      => $_POST[$pf],
                "date"     => date("y/m/d",strtotime( "now" ))
            );
            SarfejoDfstufffee::insert($arr_insert);
        }
        $_SESSION['result']= " لیست قیمت روز  " .jdate("y/m/d",strtotime( "now" )) . " ثبت شد"  ;
        $_SESSION['alert']="success";
        header("location: /gadmin/sarfejo_dailyfee");
    }
    $GLOBALS['GCMS']->assign('stuffs', $stuffs);
}