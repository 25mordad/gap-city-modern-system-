<?php

/**
 * runall_backend.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file will be excuted before other controllers in backend section.
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

//Smarty
$GLOBALS['GCMS']->template_dir=__COREROOT__."/backend";
$GLOBALS['GCMS']->assign('loct', "/core/backend");
$not_modules=array(
		"error404",
		"auth",
		"admin",
		"routing",
		"operator",
		"page",
		"box",
		"comment",
		"file",
		"menu",
		"setting",
		"statistic",
		"map",
		"search"
);
if(!in_array($part, $not_modules))
{
	$GLOBALS['GCMS']->assign('ismodule', "true");
	$GLOBALS['GCMS']->addTemplateDir(__COREROOT__."/module/$part/backend");
	$td = $GLOBALS['GCMS']->getTemplateDir();
	$GLOBALS['GCMS']->assign('coretemplatedirectory', $td[0]);
	$GLOBALS['GCMS']->assign('GcmsSmarty', $GLOBALS['GCMS']);
	$GLOBALS['GCMS']->assign('ModuleTemplateDirectory', "/core/module/$part/backend");
}

//top_menus
$top_menus=array();
$top_menu_page=array();
$top_menu_page['part']="page";
$top_menu_page['title']="مدیریت صفحات";
$top_menu_page['img']="/core/backend/images/icon/page.png";
$top_menu_page['r1']['a']="page/new";
$top_menu_page['r1']['t']="صفحه جدید";
$top_menu_page['r2']['a']="page/index";
$top_menu_page['r2']['t']="لیست صفحات";
$top_menu_page['l1']['a']="page/page_index";
$top_menu_page['l1']['t']="ویرایش صفحه نخست";
$top_menu_page['l2']['a']="box/new";
$top_menu_page['l2']['t']="باکس جدید";
array_push($top_menus, $top_menu_page);

//bott_menus
$bott_menus=array();
$bott_menu=array();
$bott_menu['part']="admin";
$bott_menu['title']="میزکار";
array_push($bott_menus, $bott_menu);
$bott_menu['part']="operator";
$bott_menu['title']="کاربران";
array_push($bott_menus, $bott_menu);
$bott_menu['part']="file";
$bott_menu['title']="فایل‌ها";
array_push($bott_menus, $bott_menu);
$bott_menu['part']="menu";
$bott_menu['title']="منوها";
array_push($bott_menus, $bott_menu);
$bott_menu['part']="page";
$bott_menu['title']="صفحات";
array_push($bott_menus, $bott_menu);
$bott_menu['part']="comment";
$bott_menu['title']="نظرات";
array_push($bott_menus, $bott_menu);


//assigning menus

$GLOBALS['GCMS']->assign('gcms_top_menus', $top_menus);
$GLOBALS['GCMS']->assign('gcms_bott_menus', $bott_menus);

///////////////////////////////////////////////
//new_backend menu
$GCMSmenu_page=array();
$GCMSmenu_box=array();
//
$GCMSmenu_page['part']="page";
$GCMSmenu_page['title']="مدیریت صفحات";
$GCMSmenu_page['icon']="fa fa-file-text";
//$GCMSmenu_page['badge']="sampleBadge";
//$GCMSmenu_page['badgeColor']="bg-green";
///
$GCMSmenu_page['child'][0]['action']="index";
$GCMSmenu_page['child'][0]['link']="page";
$GCMSmenu_page['child'][0]['title']=" لیست صفحات";
//$GCMSmenu_page['child'][0]['badge']="sampleBadge";
//$GCMSmenu_page['child'][0]['badgeColor']="bg-green";
///
$GCMSmenu_page['child'][1]['action']="new";
$GCMSmenu_page['child'][1]['link']="page/new";
$GCMSmenu_page['child'][1]['title']="ایجاد صفحه جدید";
///
$GCMSmenu_page['child'][2]['action']="page_index";
$GCMSmenu_page['child'][2]['link']="page/page_index";
$GCMSmenu_page['child'][2]['title']=" ویرایش صفحه نخست ";
//
$GCMSmenu_box['part']="box";
$GCMSmenu_box['title']=" مدیریت بلوک‌ها ";
$GCMSmenu_box['icon']="fa fa-th-large";
///
$GCMSmenu_box['child'][0]['action']="new";
$GCMSmenu_box['child'][0]['link']="box/new";
$GCMSmenu_box['child'][0]['title']="ایجاد  بلوک جدید ";
///
$GCMSmenu_box['child'][1]['action']="list";
$GCMSmenu_box['child'][1]['link']="box";
$GCMSmenu_box['child'][1]['title']=" لیست بلوک ها ";

array_push($GLOBALS["backend_menu"], $GCMSmenu_page);
array_push($GLOBALS["backend_menu"], $GCMSmenu_box);
$GLOBALS['GCMS']->assign('GCMSmenus', $GLOBALS["backend_menu"]);

//find pending comments
$GLOBALS['GCMS']->assign('allPendingComments', Comment::get(array("cm_status" => "pending"),true));


//include modules runall
foreach($modules as $module)
{
    if ($module->status == "active")
    {
        $runallbackfile = __COREROOT__."/module/".$module->module_name."/libs/runall_backend.php";
        //Load /module/libs/runall_backend.php
        if(file_exists($runallbackfile))
            require_once($runallbackfile);
    }
}