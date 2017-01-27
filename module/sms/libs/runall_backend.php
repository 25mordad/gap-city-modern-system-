<?php

/**
 * runall_backend.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file will be excuted before other controllers in backend section.
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

//top_menu
$top_menu=array();
$top_menu['part']="sms";
$top_menu['title']="پیامک";
$top_menu['img']="/core/module/sms/backend/images/sms.png";
$top_menu['r1']['a']="sms/?single=true";
$top_menu['r1']['t']="ارسال پیام تکی";
$top_menu['r2']['a']="sms/interval";
$top_menu['r2']['t']="ارسال پیام بازه‌ای";
$top_menu['r3']['a']="sms";
$top_menu['r3']['t']="ارسال پیام گروهی";
if($GLOBALS['GCMS_MODULE']['user']=='active')
{
	$top_menu['l1']['a']="sms/user";
	$top_menu['l1']['t']="ارسال پیام به اعضا";
}
$top_menu['l2']['a']="sms/sendbox/?paging=1&search=NULL";
$top_menu['l2']['t']="پیام‌های ارسالی";
if($GLOBALS['GCMS_SETTING']['sms']['inbox']=='true')
{
	$top_menu['l1']['a']="sms/inbox";
	$top_menu['l1']['t']="پیام‌های دریافتی";
}
array_push($top_menus, $top_menu);

//bott_menus
$bott_menu=array();
$bott_menu['part']="sms";
$bott_menu['title']="پیامک";
array_push($bott_menus, $bott_menu);

/////////////////////////////// New Menu
$GCMSmenu_contact=array();
//
$GCMSmenu_contact['part']="sms";
$GCMSmenu_contact['title']="@@SMS@@";
$GCMSmenu_contact['icon']="fa fa-mobile-phone";
///
$GCMSmenu_contact['child'][0]['action']="index";
$GCMSmenu_contact['child'][0]['link']="sms/?single=true";
$GCMSmenu_contact['child'][0]['title']=" ارسال پیامک تکی  ";

///
$GCMSmenu_contact['child'][1]['action']="index";
$GCMSmenu_contact['child'][1]['link']="sms";
$GCMSmenu_contact['child'][1]['title']=" ارسال پیامک گروهی  ";

///
$GCMSmenu_contact['child'][2]['action']="sendbox";
$GCMSmenu_contact['child'][2]['link']="sms/sendbox";
$GCMSmenu_contact['child'][2]['title']="  پیام های ارسالی  ";

///
if($GLOBALS['GCMS_SETTING']['sms']['inbox']=='true')
{
    $GCMSmenu_contact['child'][3]['action']="inbox";
    $GCMSmenu_contact['child'][3]['link']="sms/inbox?connect=true";
    $GCMSmenu_contact['child'][3]['title']="  پیام های دریافتی  ";
}

array_push($GLOBALS["backend_menu"], $GCMSmenu_contact);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);