<?php

/**
 * backend_shop.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > product
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/shop/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


require_once(__COREROOT__."/libs/utility/selecting.php");

function index()
{
	//setting $_GET if not set
	if(!isset($_GET['f_status']))
		$_GET['f_status']="all";
	if(!isset($_GET['f_parent']))
		$_GET['f_parent']="all";
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /gadmin/shop/?paging=1&search=".$_GET['search']."&f_parent="
						.$_GET['f_parent']."&f_status=".$_GET['f_status']);
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
	//setting filters
	if($_GET['f_status']!="all")
		$arr_get['status']=$_GET['f_status'];
	if($_GET['f_parent']!="all")
		$arr_get['group_id']=$_GET['f_parent'];
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('products', Products::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(Products::get_count($arr_get)/$max_results));
	
	$arr_get=array(
			"pg_type" => "product_group",
			"pg_status" => "publish"
	);
	
	$GLOBALS['GCMS']->assign('select_parent', Page::get($arr_get, true,array("by"=>'pg_order',"sort"=>'ASC')));
}

function brand()
{
	
	if(isset($_GET['status']))
	{
		if($_GET['status']=="publish")
			$new_status="pending";
		else
			$new_status="publish";

		$arr_update=array(
					"id" => $_GET['id'],
					"pg_status" => $new_status
		);
		Page::update($arr_update);
		$_SESSION['result']="وضعیت برند تغییر کرد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/brand");
	}

	if(isset($_GET['edit']))
	{
		if(isset($_POST['pg_title']))
		{
			$arr_update=array(
						"id" => $_GET['edit'],
						"pg_title" => $_POST['pg_title'],
						"parent_id" => $_POST['parent_id'],
						"pg_content" => $_POST['pg_content'],
						"pg_excerpt" => $_POST['pg_excerpt'],
						"pg_order" => $_POST['pg_order'],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/brand/?edit=".$_GET['edit']);
		}
		$arr_get=array(
					"id" => $_GET['edit'],
		);
		$GLOBALS['GCMS']->assign('group_product', Page::get($arr_get));
	}
	$arr_get=array(
				"pg_type" => "brand"
	);
	
	$GLOBALS['GCMS']->assign('groups', Page::get($arr_get, true,array("by"=>'pg_order',"sort"=>'ASC')));
	
	
}
function color()
{
	
	if(isset($_GET['status']))
	{
		if($_GET['status']=="publish")
			$new_status="pending";
		else
			$new_status="publish";

		$arr_update=array(
					"id" => $_GET['id'],
					"pg_status" => $new_status
		);
		Page::update($arr_update);
		$_SESSION['result']="وضعیت رنگ تغییر کرد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/color");
	}

	if(isset($_GET['edit']))
	{
		if(isset($_POST['pg_title']))
		{
			$arr_update=array(
						"id" => $_GET['edit'],
						"pg_title" => $_POST['pg_title'],
						"parent_id" => $_POST['parent_id'],
						"pg_content" => $_POST['pg_content'],
						"pg_excerpt" => $_POST['pg_excerpt'],
						"pg_order" => $_POST['pg_order'],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/color/?edit=".$_GET['edit']);
		}
		$arr_get=array(
					"id" => $_GET['edit'],
		);
		$GLOBALS['GCMS']->assign('group_product', Page::get($arr_get));
	}
	$arr_get=array(
				"pg_type" => "color"
	);
	
	$GLOBALS['GCMS']->assign('groups', Page::get($arr_get, true,array("by"=>'pg_order',"sort"=>'ASC')));
	
	
}

function grouping()
{
	if(!isset($_GET['pid']))
		header("location: /gadmin/shop/grouping?pid=0");
	
	
	if(isset($_GET['status']))
	{
		if($_GET['status']=="publish")
			$new_status="pending";
		else
			$new_status="publish";

		$arr_update=array(
					"id" => $_GET['id'],
					"pg_status" => $new_status
		);
		Page::update($arr_update);
		$_SESSION['result']="وضعیت گروه تغییر کرد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/grouping");
	}

	if(isset($_GET['edit']))
	{
		if(isset($_POST['pg_title']))
		{
			$arr_update=array(
						"id" => $_GET['edit'],
						"pg_title" => $_POST['pg_title'],
						"parent_id" => $_POST['parent_id'],
						"pg_content" => $_POST['pg_content'],
						"pg_excerpt" => $_POST['pg_excerpt'],
						"pg_order" => $_POST['pg_order'],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/grouping/?pid=".$_GET['pid']."&edit=".$_GET['edit']);
		}
		$arr_get=array(
					"id" => $_GET['edit'],
		);
		$GLOBALS['GCMS']->assign('group_product', Page::get($arr_get));
	}
	$arr_get=array(
				"pg_type" => "product_group",
				"parent_id" => $_GET['pid'],
	);
	
	$GLOBALS['GCMS']->assign('groupsList', Page::get(array("pg_type" => "product_group"), true,array("by"=>'pg_order',"sort"=>'ASC')));
	$GLOBALS['GCMS']->assign('groups', Page::get($arr_get, true,array("by"=>'pg_order',"sort"=>'ASC')));
	
	
}

function size()
{	
	
	if(isset($_GET['status']))
	{
		if($_GET['status']=="publish")
			$new_status="pending";
		else
			$new_status="publish";

		$arr_update=array(
					"id" => $_GET['id'],
					"pg_status" => $new_status
		);
		Page::update($arr_update);
		$_SESSION['result']="وضعیت سایز تغییر کرد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/size");
	}

	if(isset($_GET['edit']))
	{
		if(isset($_POST['pg_title']))
		{
			$arr_update=array(
						"id" => $_GET['edit'],
						"pg_title" => $_POST['pg_title'],
						"pg_content" => $_POST['pg_content'],
						"pg_excerpt" => $_POST['pg_excerpt'],
						"pg_order" => $_POST['pg_order'],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/size/?edit=".$_GET['edit']);
		}
		$arr_get=array(
					"id" => $_GET['edit'],
		);
		$GLOBALS['GCMS']->assign('group_product', Page::get($arr_get));
	}
	$arr_get=array(
				"pg_type" => "size"
	);
	
	$GLOBALS['GCMS']->assign('groups', Page::get($arr_get, true,array("by"=>'pg_order',"sort"=>'ASC')));
	
	
}

function newbrand()
{
	if(isset($_POST['pg_title']) && $_POST['pg_title'] != "" )
	{
		$arr_insert=array(
					"pg_type" => "brand",
					"parent_id" => 0,
					"pg_title" => $_POST['pg_title'],
					"pg_content" => $_POST['pg_content'],
					"pg_excerpt" => null,
					"pg_status" => "publish",
					"comment_status" => NULL,
				    "pg_order" => $_POST['pg_order'],
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="گروه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/brand/");
	}else {
		header("location: /gadmin/shop/brand/");
	}
}
function newcolor()
{
	if(isset($_POST['pg_title']) && $_POST['pg_title'] != "" )
	{
		$arr_insert=array(
					"pg_type" => "color",
					"parent_id" => 0,
					"pg_title" => $_POST['pg_title'],
					"pg_content" => $_POST['pg_content'],
					"pg_excerpt" => null,
					"pg_status" => "publish",
					"comment_status" => NULL,
				    "pg_order" => $_POST['pg_order'],
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="رنگ جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/color/");
	}else {
		header("location: /gadmin/shop/color/");
	}
}
function newgroup()
{
	if(isset($_POST['pg_title']) && $_POST['pg_title'] != "" )
	{
		$arr_insert=array(
					"pg_type" => "product_group",
					"parent_id" => $_POST['parent_id'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => $_POST['pg_content'],
					"pg_excerpt" => $_POST['pg_excerpt'],
					"pg_status" => "publish",
					"comment_status" => NULL,
				    "pg_order" => $_POST['pg_order'],
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="گروه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/grouping/");
	}else {
		header("location: /gadmin/shop/grouping/");
	}
}
function newsize()
{
	if(isset($_POST['pg_title']) && $_POST['pg_title'] != "" )
	{
		$arr_insert=array(
					"pg_type" => "size",
					"parent_id" => 0,
					"pg_title" => $_POST['pg_title'],
					"pg_content" => $_POST['pg_content'],
					"pg_excerpt" => $_POST['pg_excerpt'],
					"pg_status" => "publish",
					"comment_status" => NULL,
				    "pg_order" => $_POST['pg_order'],
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="سایز جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/size/");
	}else {
		header("location: /gadmin/shop/size/");
	}
}

function add_param($id)
{
	// add param
	if($_POST['param_name'] != "" and $_POST['param_tag'] != "" and !isset($_GET['edit']))
	{
		$arr_insert=array(
					"id_product_group" => $id,
					"param_name" => $_POST['param_name'],
					"param_tag" => $_POST['param_tag'],
					"status" => "publish"
		);
		ProductParam::insert($arr_insert);
		$_SESSION['result']="پارامتر جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/add_param/".$id);
	}

	// change status
	if(isset($_GET['status']))
	{
		if($_GET['status']=="publish")
			$new_status="pending";
		else
			$new_status="publish";

		$arr_update=array(
					"id" => $_GET['id'],
					"status" => $new_status
		);
		ProductParam::update($arr_update);
		$_SESSION['result']="وضعیت پارامتر تغییر کرد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/add_param/".$id);
	}
	// edit param
	if(isset($_GET['edit']))
	{
		// fetch 
		$arr_get=array(
					"id" => $_GET['edit'],
		);
		$GLOBALS['GCMS']->assign('get_param', ProductParam::get($arr_get));
		//update
		if(isset($_POST['param_name']))
		{
			$arr_update=array(
						"id" => $_GET['edit'],
						"param_name" => $_POST['param_name'],
						"param_tag" => $_POST['param_tag']
			);
			ProductParam::update($arr_update);
			$_SESSION['result']="تغییرات با موفقیت انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/add_param/$id?edit=".$_GET['edit']);
		}
	}
	// list param
	$arr_get=array(
				"id_product_group" => $id
	);
	$GLOBALS['GCMS']->assign('param_lists', ProductParam::get($arr_get, true));

	// fetch group_product
	$arr_get=array(
				"id" => $id,
	);
	$GLOBALS['GCMS']->assign('g_product', Page::get($arr_get));
}
function importFromBershka($id){
	require_once("importFromBershka.php");
}
function importFromMango($id){
	require_once("importFromMango.php");
}
function importFromStradivarius($id){
	require_once("importFromStradivarius.php");
}
function importFromSportsdirect($id){
	require_once("importFromSportsdirect.php");
}
function importFromMangooutlet($id){
	require_once("importFromMangooutlet.php");
}

function importFromZara($id){
	require_once("importFromZara.php");
}

function importFromMroozi($id){
	require_once("importFromMroozi.php");
}

function new_shop()
{
	if (isset($_GET['import']))
	{
		if ($_POST['type'] == "mroozi")
		{
			$arr_insert=array(
					"group_id" => $_POST['group_id'],
					"delivery_time"   => "21",
					"p_order"   => "0",
					"visitor"   => "0",
					"quantity"   => "1",
					"show_real_price"   => "false",
					"show_sales_price"   => "none",
					"price"   => "0",
					"salse1_price"   => "0",
					"salse2_price"   => "0",
					"min_price"   => "0",
					"update_check"   => "false",
					"link"   => $_POST['link'],
					"default_photo"   => "0",
					"status"   => "pending"
			);
			$lastId = Products::insert($arr_insert);
			$pbar =$lastId + 10000;
			$arr_update=array(
					"id" => $lastId,
					"barcode" => $_POST['barcode']."/".$pbar,
			);
			Products::update($arr_update);
			$_SESSION['result']="محصول جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/importFromMroozi/".$lastId."?step=images");
		}
		if ($_POST['type'] == "zara")
		{
			$arr_insert=array(
					"group_id" => $_POST['group_id'],
					"brand"   => "303",
					"delivery_time"   => "21",
					"p_order"   => "0",
					"visitor"   => "0",
					"quantity"   => "1",
					"show_real_price"   => "false",
					"show_sales_price"   => "none",
					"price"   => "0",
					"salse1_price"   => "0",
					"salse2_price"   => "0",
					"min_price"   => "0",
					"update_check"   => "false",
					"link"   => trim($_POST['link']),
					"default_photo"   => "0",
					"status"   => "pending"
			);
			$lastId = Products::insert($arr_insert);
			$pbar =$lastId + 10000;
			$arr_update=array(
					"id" => $lastId,
					"barcode" => $_POST['barcode']."/".$pbar,
			);
			Products::update($arr_update);
			$_SESSION['result']="محصول جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/importFromZara/".$lastId."?step=images");
		}
		if ($_POST['type'] == "mango")
		{
			$arr_insert=array(
					"group_id" => $_POST['group_id'],
					"brand"   => "305",
					"delivery_time"   => "21",
					"p_order"   => "0",
					"visitor"   => "0",
					"quantity"   => "1",
					"show_real_price"   => "false",
					"show_sales_price"   => "none",
					"price"   => "0",
					"salse1_price"   => "0",
					"salse2_price"   => "0",
					"min_price"   => "0",
					"update_check"   => "false",
					"link"   => trim($_POST['link']),
					"default_photo"   => "0",
					"status"   => "pending"
			);
			$lastId = Products::insert($arr_insert);
			$pbar =$lastId + 10000;
			$arr_update=array(
					"id" => $lastId,
					"barcode" => $_POST['barcode']."/".$pbar,
			);
			Products::update($arr_update);
			$_SESSION['result']="محصول جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/importFromMango/".$lastId."?step=images");
		}
		if ($_POST['type'] == "mangooutlet")
		{
			$arr_insert=array(
					"group_id" => $_POST['group_id'],
					"brand"   => "305",
					"delivery_time"   => "21",
					"p_order"   => "0",
					"visitor"   => "0",
					"quantity"   => "1",
					"show_real_price"   => "false",
					"show_sales_price"   => "none",
					"price"   => "0",
					"salse1_price"   => "0",
					"salse2_price"   => "0",
					"min_price"   => "0",
					"update_check"   => "false",
					"link"   => trim($_POST['link']),
					"default_photo"   => "0",
					"status"   => "pending"
			);
			$lastId = Products::insert($arr_insert);
			$pbar =$lastId + 10000;
			$arr_update=array(
					"id" => $lastId,
					"barcode" => $_POST['barcode']."/".$pbar,
			);
			Products::update($arr_update);
			$_SESSION['result']="محصول جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/importFromMangooutlet/".$lastId."?step=images");
		}
		
		if ($_POST['type'] == "bershka")
		{
			$arr_insert=array(
					"group_id" => $_POST['group_id'],
					"brand"   => "302",
					"delivery_time"   => "21",
					"p_order"   => "0",
					"visitor"   => "0",
					"quantity"   => "1",
					"show_real_price"   => "false",
					"show_sales_price"   => "none",
					"price"   => "0",
					"salse1_price"   => "0",
					"salse2_price"   => "0",
					"min_price"   => "0",
					"update_check"   => "false",
					"link"   => trim($_POST['link']),
					"default_photo"   => "0",
					"status"   => "pending"
			);
			$lastId = Products::insert($arr_insert);
			$pbar =$lastId + 10000;
			$arr_update=array(
					"id" => $lastId,
					"barcode" => $_POST['barcode']."/".$pbar,
			);
			Products::update($arr_update);
			$_SESSION['result']="محصول جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/importFromBershka/".$lastId."?step=images");
		}
		if ($_POST['type'] == "stradivarius")
		{
			$arr_insert=array(
					"group_id" => $_POST['group_id'],
					"brand"   => "300",
					"delivery_time"   => "21",
					"p_order"   => "0",
					"visitor"   => "0",
					"quantity"   => "1",
					"show_real_price"   => "false",
					"show_sales_price"   => "none",
					"price"   => "0",
					"salse1_price"   => "0",
					"salse2_price"   => "0",
					"min_price"   => "0",
					"update_check"   => "false",
					"link"   => trim($_POST['link']),
					"default_photo"   => "0",
					"status"   => "pending"
			);
			$lastId = Products::insert($arr_insert);
			$pbar =$lastId + 10000;
			$arr_update=array(
					"id" => $lastId,
					"barcode" => $_POST['barcode']."/".$pbar,
			);
			Products::update($arr_update);
			$_SESSION['result']="محصول جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/importFromStradivarius/".$lastId."?step=images");
		}
		if ($_POST['type'] == "sportsdirect")
		{
			$arr_insert=array(
					"group_id" => $_POST['group_id'],
					"brand"   => "0",
					"delivery_time"   => "21",
					"p_order"   => "0",
					"visitor"   => "0",
					"quantity"   => "5",
					"show_real_price"   => "true",
					"show_sales_price"   => "none",
					"price"   => "0",
					"salse1_price"   => "0",
					"salse2_price"   => "0",
					"min_price"   => "0",
					"update_check"   => "false",
					"link"   => trim($_POST['link']),
					"default_photo"   => "0",
					"status"   => "pending"
			);
			$lastId = Products::insert($arr_insert);
			$pbar =$lastId + 10000;
			$arr_update=array(
					"id" => $lastId,
					"barcode" => $_POST['barcode']."/".$pbar,
			);
			Products::update($arr_update);
			$_SESSION['result']="محصول جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/importFromSportsdirect/".$lastId."?step=images");
		}
		
	}
	if(isset($_POST['name']))
	{
		$arr_insert=array(
					"fa_title"     => $_POST['name'],
					"group_id" => $_POST['group_id'],
					"delivery_time"   => "30",
					"p_order"   => "0",
					"visitor"   => "0",
					"quantity"   => "1",
					"show_real_price"   => "false",
					"show_sales_price"   => "none",
					"price"   => "0",
					"salse1_price"   => "0",
					"salse2_price"   => "0",
					"min_price"   => "0",
					"update_check"   => "false",
					"default_photo"   => "0",
					"status"   => "pending"
		);
		$lastId = Products::insert($arr_insert);
		$pbar =$lastId + 10000; 
		$arr_update=array(
				"id" => $lastId,
				"barcode" => $_POST['barcode']."/".$pbar,
		);
		Products::update($arr_update);
		$_SESSION['result']="محصول جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/edit/".$lastId);
	}
}


function edit($id)
{
	$product=Products::get(array("id" => $id));
    if (isset($_GET['delcolor']))
    {
    	$arr_update=array(
    			"id" => $id,
    			"color" => str_replace($_GET['delcolor']."|", "", $product->color),
    	);
    	Products::update($arr_update);
        header("location: /gadmin/shop/edit/$id");
    }
    if (isset($_GET['delsize']))
    {
    	$arr_update=array(
    			"id" => $id,
    			"size" => str_replace($_GET['delsize']."|", "", $product->size),
    	);
    	Products::update($arr_update);
        header("location: /gadmin/shop/edit/$id");
    }
    if (isset($_GET['delImgInx']))
    {
    	
        RelImageOther::del($_GET['relId']);
        Image::del($_GET['delImgInx']);
        header("location: /gadmin/shop/edit/$id#PicDisplay");
    }
    if (isset($_GET['defaultPhoto']))
    {
    	
        $arr_update=array(
						"id" => $id,
						"default_photo" => $_GET['defaultPhoto'],
			);
			Products::update($arr_update);
        header("location: /gadmin/shop/edit/$id");
    }
	if(isset($id)&&isset($product))
	{
		if(isset($_POST['fa_title']))
		{
			$updColor = "";
		 	foreach ($_POST['color']  as $color){
		 		
		 		$updColor = $updColor . $color."|";
		 	}
 	
			$updSize = "";
		 	foreach ($_POST['size']  as $size){
		 		
		 		$updSize = $updSize . $size."|";
		 	}
 	
			$arr_update=array(
						"id" => $id,
						"brand" => $_POST['brand'],
						"fa_title" => stripcslashes($_POST['fa_title']),
						"en_title" => stripcslashes($_POST['en_title']),
						"en_txt" => stripcslashes($_POST['en_txt']),
						"fa_txt" => stripcslashes($_POST['fa_txt']),
						"delivery_time" => $_POST['delivery_time'],
						"link" => $_POST['link'],
						"buy_price" => $_POST['buy_price'],
						"real_price" => $_POST['real_price'],
						"price" => $_POST['price'],
						"salse1_price" => $_POST['salse1_price'],
						"sales2_price" => $_POST['sales2_price'],
						"min_price" => $_POST['min_price'],
						"quantity" => $_POST['quantity'],
						"p_order" => $_POST['p_order'],
						"show_real_price" => $_POST['show_real_price'],
						"show_sales_price" => $_POST['show_sales_price'],
						"status" => $_POST['status'],
						"barcode" => $_POST['barcode'],
						"refrence" => $_POST['refrence'],
						"default_photo" => $_POST['default_photo'],
						"size" => $updSize,
						"color" => $updColor,
			);
			Products::update($arr_update);
            
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/shop/edit/".$id);
		}


        $GLOBALS['GCMS']->assign('pageImg', Image::get( array("im_type" => "shop"), true, array("by" => "id", "sort" => "DESC" ), $id));
		$GLOBALS['GCMS']->assign('product', $product);
		$GLOBALS['GCMS']->assign('group_name', Page::get(array("id" => $product->group_id, "pg_type" => "product_group", "pg_status" => "publish")));
		$GLOBALS['GCMS']->assign('brands', Page::get(array("pg_type" => "brand", "pg_status" => "publish"),true));
		$GLOBALS['GCMS']->assign('colorList', Page::get(array("pg_type" => "color", "pg_status" => "publish"),true));
		$GLOBALS['GCMS']->assign('sizeList', Page::get(array("pg_type" => "size", "pg_status" => "publish"),true,array("by"=>'pg_order',"sort"=>'ASC')));
		
		$GLOBALS['GCMS']->assign('sizes', explode("|",$product->size));
		$GLOBALS['GCMS']->assign('colors', explode("|",$product->color));

	}
	else
		header("location: /error404?error=shop&reason=product_not_exist");
}



function instagram($id)
{
	$product=Products::get(array("id" => $id));
	
	if(isset($id)&&isset($product))
	{
		


		$GLOBALS['GCMS']->assign('pageImg', Image::get( array("im_type" => "shop"), true, array("by" => "id", "sort" => "DESC" ), $id));
		$GLOBALS['GCMS']->assign('product', $product);
		$GLOBALS['GCMS']->assign('group_name', Page::get(array("id" => $product->group_id, "pg_type" => "product_group", "pg_status" => "publish")));
		$GLOBALS['GCMS']->assign('brands', Page::get(array("pg_type" => "brand", "pg_status" => "publish"),true));
		$GLOBALS['GCMS']->assign('colorList', Page::get(array("pg_type" => "color", "pg_status" => "publish"),true));
		$GLOBALS['GCMS']->assign('sizeList', Page::get(array("pg_type" => "size", "pg_status" => "publish"),true,array("by"=>'pg_order',"sort"=>'ASC')));

		$GLOBALS['GCMS']->assign('sizes', explode("|",$product->size));
		$GLOBALS['GCMS']->assign('colors', explode("|",$product->color));

	}
	else
		header("location: /error404?error=shop&reason=product_not_exist");
}


function setting()
{

	if(isset($_POST['nextdelivery']))
	{
		$merchantID=Setting::get(array("st_group" => "shop", "st_key" => "nextdelivery"));
		Setting::update(array("id" => $merchantID->id, "st_value" => $_POST['nextdelivery']));
		
		$eurorate=Setting::get(array("st_group" => "shop", "st_key" => "eurorate"));
		Setting::update(array("id" => $eurorate->id, "st_value" => $_POST['eurorate']));
		
		$_SESSION['result']="ویرایش انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/setting/");
	}
}


function prices()
{
	
	if(isset($_GET['update']))
	{
		if ($_GET['type'] == "real"){
			$upSql =
			" UPDATE gcms_products
		SET `price` = CEIL((((`real_price` + 25 ) + (`real_price` + 25 )*20/100 ) * ".$GLOBALS['GCMS_SETTING']['shop']['eurorate'] .")/10000)*10000-1000 ";
		}
		if ($_GET['type'] == "min"){
			$upSql =
			" UPDATE gcms_products
		SET `min_price` = CEIL((((`buy_price` + 10 ) + (`buy_price` + 10 )*20/100 ) * ".$GLOBALS['GCMS_SETTING']['shop']['eurorate'] .")/10000)*10000-1000 ";
		}
		
		if ($_GET['type'] == "s2"){
			$upSql =
			" UPDATE gcms_products
		SET `sales2_price` = CEIL(((`price` + `min_price` )/2)/10000)*10000-1000 ";
		}
		
		if ($_GET['type'] == "s1"){
			$upSql =
			" UPDATE gcms_products
		SET `salse1_price` = CEIL(((`price` + `sales2_price` )/2)/10000)*10000-1000 ";
		}
		
		
		$q = $GLOBALS['GCMS_SAFESQL']->query($upSql);
		$GLOBALS['GCMS_DB']->get_results($q);
		
		$_SESSION['result']="ویرایش انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/shop/prices/?type=".$_GET['type']);
	}
	$order=array(
			"by" => "id",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => 1,
			"end"   => 10
	);
	$GLOBALS['GCMS']->assign('products', Products::get(array(), true, $order, $limit));
	
}


