<?php

/**
 * backend_SAMPLE.php
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

$utilityfile = __COREROOT__."/module/SAMPLE/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
    //setting $_GET if not set
    if(!isset($_GET['status']))
        $_GET['status']="all";
    if(!isset($_GET['status_pay']))
        $_GET['status_pay']="all";
    if(!isset($_GET['user']))
        $_GET['user']="all";
    if(!isset($_GET['search']))
        $_GET['search']="NULL";
    if(!isset($_GET['paging']))
        header(
            "location: /gadmin/shop_factor/?paging=1&search=".$_GET['search']."&user=".$_GET['user']."&status_pay=".$_GET['status_pay']."&status=".$_GET['status'] );

    $max_results=10;
    $arr_get=array(

    );
    if($_GET['search']!="NULL")
        $arr_get['search']="%".$_GET['search']."%";
    if($_GET['status_pay']!="all")
        $arr_get['status_pay']=$_GET['status_pay'];
    if($_GET['status']!="all")
        $arr_get['status']=$_GET['status'];
    if($_GET['user']!="all")
        $arr_get['id_user']=$_GET['user'];
    $order=array(
        "by" => "id",
        "sort" => "DESC"
    );
    $limit=array(
        "start" => (($_GET['paging']*$max_results)-$max_results),
        "end" => $max_results
    );

    $GLOBALS['GCMS']->assign('factors', ShopFactor::get($arr_get,true,$order,$limit));
    $GLOBALS['GCMS']->assign('paging', ceil(ShopFactor::get_count($arr_get)/$max_results));
    $GLOBALS['GCMS']->assign('users', User::get(null, true, null, null));
}
function show ($id)
{
    if (isset($_GET['status']))
    {
        $arr_update=array(
            "id" => $id,
            "status" => "send",
        );
        ShopFactor::update($arr_update);
        $_SESSION['result']=" تغییر وضعیت انجام شد ";
        $_SESSION['alert']="success";
        header("location: /gadmin/shop_factor/show/".$id);
    }
    $array_get = array(
        "id"      => $id
    );
    $GLOBALS['GCMS']->assign('factor', ShopFactor::get($array_get));
}