<?php

/**
 * ajax.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Use: backend > AJAX Functions
 *
 * @author 25mordad <25mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

$controller=$_GET['controller'];
if(function_exists($controller))
{
	$controller();
}
/*
function test_ajax()
{
	echo "TestAjax";
}
*/
	
function get_products()
{
	$products=Page::get(
			array("pg_type" => "product", "pg_status" => "publish", "parent_id" => $_POST['id']),
			true);
	$product_group=Page::get(
			array("pg_type" => "product_group", "pg_status" => "publish", "id" => $_POST['id']));
	$result='<div class="row_t" style="background: black; color: white;" >
                                        <div class="right" >
                                        <strong>لیست محصولات گروه '.$product_group->pg_title.'</strong>
                                        </div>
								        <div class="clear"></div>
								    </div>
								    <div class="clear"></div>';
	if($products)
	{
		foreach($products as $product)
		{
			$arr_get=array(
					"im_type" => "product"
			);
			$order=array(
					"by" => "id",
					"sort" => "DESC"
			);
			
			$pr_img=Image::get($arr_get, false, $order, $product->id);
			$result.='
								    <a href="javascript:add_product('.$product->id.', \''.$product->pg_title.'\')" ><div class="prdctpls right" >
                                        <div  style="font-family:BKoodakBold;font-size:14px;text-align:center" >'.$product->pg_title.'
                                        <br/><img style="border-radius:5px" class="imgplus"  src="'.$pr_img->im_path.$pr_img->im_name.'">
                                        		<span></span>
								       </div>
								    </div></a>
								   ';
		}
		 $result.='<div class="clear"></div>';
	}
	else
	{
		$result="هیچ محصولی در این گروه وجود ندارد";
	}
	echo $result;
}
//require_once(__COREROOT__."/file/ajax_backend.php");