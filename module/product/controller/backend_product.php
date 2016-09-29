<?php

/**
 * backend_product.php
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

$utilityfile = __COREROOT__."/module/product/libs/utility.php";
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
				"location: /gadmin/product/?paging=1&search=".$_GET['search']."&f_parent="
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
	$GLOBALS['GCMS']->assign('select_parent', select_product_parental("product_group"));
}

function grouping()
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
		$_SESSION['result']="وضعیت گروه تغییر کرد";
		$_SESSION['alert']="success";
		header("location: /gadmin/product/grouping");
	}

	if(isset($_GET['edit']))
	{
		if(isset($_POST['pg_title']))
		{
			$arr_update=array(
						"id" => $_GET['edit'],
						"pg_title" => $_POST['pg_title'],
						"parent_id" => $_POST['parent_id'],
						"pg_content" => stripcslashes($_POST['pg_content']),
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/product/grouping/?edit=".$_GET['edit']);
		}
		$arr_get=array(
					"id" => $_GET['edit'],
		);
		$GLOBALS['GCMS']->assign('group_product', Page::get($arr_get));
	}
	$arr_get=array(
				"pg_type" => "product_group"
	);
	$GLOBALS['GCMS']->assign('groups', Page::get($arr_get, true));
}

function newgroup()
{
	if(isset($_POST['pg_title']))
	{
		$arr_insert=array(
					"pg_type" => "product_group",
					"parent_id" => $_POST['parent_id'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => stripcslashes($_POST['pg_content']),
					"pg_excerpt" => NULL,
					"pg_status" => "publish",
					"comment_status" => NULL,
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="گروه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/product/grouping");
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
		header("location: /gadmin/product/add_param/".$id);
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
		header("location: /gadmin/product/add_param/".$id);
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
			header("location: /gadmin/product/add_param/$id?edit=".$_GET['edit']);
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

function new_product()
{
	if(isset($_POST['name']))
	{
		$arr_insert=array(
					"name"     => $_POST['name'],
					"group_id" => $_POST['group_id'],
					"p_order"  => "0",
					"transport"  => "no",
					"status"   => "pending"
		);
		Products::insert($arr_insert);
		$_SESSION['result']="محصول جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/product/edit/".mysql_insert_id());
	}
}


function edit($id)
{
	$product=Products::get(array("id" => $id));
    if (isset($_GET['delImgInx']))
    {
        RelImageOther::del($_GET['delImgInx']);
        header("location: /gadmin/product/edit/$id#PicDisplay");
    }
	if(isset($id)&&isset($product))
	{
		if(isset($_POST['name']))
		{
			$arr_update=array(
						"id" => $id,
						"name" => $_POST['name'],
						"text" => stripcslashes($_POST['text']),
						"status" => $_POST['status'],
						"model" => $_POST['model'],
						"barcode" => $_POST['barcode'],
						"price" => $_POST['price'],
						"quantity" => $_POST['quantity'],
						"weight" => $_POST['weight'],
						"dimension" => $_POST['dimension'],
						"p_order" => $_POST['p_order'],
						"transport" => $_POST['transport'],
			);
			Products::update($arr_update);
            if(isset($_POST['update_params']))
            {
                foreach($_POST as $key => $value)
                {
                    if(substr($key, 0, 6)=='value_')
                    {
                        $arr_update_2=array(
                            "id" => substr($key, 6, strlen($key)),
                            "value" => $value
                        );
                        RelProParam::update($arr_update_2);
                    }
                }
            }
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/product/edit/".$id);
		}


        $GLOBALS['GCMS']->assign('pageImg', Image::get( array("im_type" => "product"), true, array("by" => "id", "sort" => "DESC" ), $id));
		$GLOBALS['GCMS']->assign('product', $product);
		$GLOBALS['GCMS']->assign('select_parent', select_product_parental("product_group", $id));
		$params=ProductParam::get(
				array("id_product_group" => $product->group_id, "status_not" => "del"), true);
		$rel_params=RelProParam::get(array("id_product" => $id), true);

		$param_vals=array();
		foreach($rel_params as $rel_param)
		{
			$param_vals[$rel_param->id_param]["value"]=$rel_param->value;
			$param_vals[$rel_param->id_param]["rel_id"]=$rel_param->id;
		}
		foreach($params as $param)
			if(!isset($param_vals[$param->id]))
			{
				$arr_insert=array(
							"id_product" => $product->id,
							"id_param" => $param->id,
							"value" => NULL
				);
				RelProParam::insert($arr_insert);
				$param_vals[$param->id]["value"]="";
				$param_vals[$param->id]["rel_id"]=mysql_insert_id();
			}

        $GLOBALS['GCMS']->assign('params', $params);
		$GLOBALS['GCMS']->assign('param_vals', $param_vals);
	}
	else
		header("location: /error404?error=product&reason=product_not_exist");
}