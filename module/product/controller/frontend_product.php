<?php

/**
 * frontend_product.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > product
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/product/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


function index()
{
	
}

function group($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "product_group", "pg_status" => "publish"));


	if(isset($id)&&isset($page))
	{
		if(!isset($_GET['paging']))
			header("location: /product/group/$id/$page->pg_title?paging=1");
			
		
		$GLOBALS['GCMS']->assign('gcms_page_title',$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$page->pg_title);
		
		$max_results=10;
		$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
		);
		$arr_get = array(
											"group_id" => $id,
											"status" => "publish"
								);
		$GLOBALS['GCMS']->assign('products',Products::get($arr_get, true, array("by" => "p_order", "sort" => "DESC") , $limit));
		$GLOBALS['GCMS']->assign('paging', ceil(Products::get_count($arr_get)/$max_results));
        $GLOBALS['GCMS']
            ->assign('child_groups',
                Page::get(
                    array(
                        "parent_id" => $id,
                        "pg_type" => "product_group",
                        "pg_status" => "publish"
                    ), true, array("by" => "date_created", "sort" => "DESC")));
        $GLOBALS['GCMS']
            ->assign('params',
                ProductParam::get(array("id_product_group" => $id, "status" => "publish"),
                    true));
		$GLOBALS['GCMS']->assign('group', $page);
	}
	else
		header("location: /error404?error=product&reason=product_group_not_exist");
}

function show($id)
{
	$page=Products::get(array("id" => $id , "status" => "publish"));
	if(isset($id)&&isset($page))
	{

		$GLOBALS['GCMS']
				->assign('gcms_page_title',
						$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$page->name);
		$GLOBALS['GCMS']
				->assign('allkeywords',
						Keyword::get(NULL, true, array("by" => "rel_id", "sort" => "ASC"), NULL,
								$id));
		$GLOBALS['GCMS']->assign('product', $page);
		$GLOBALS['GCMS']
				->assign('params',
						RelProParam::get(array("id_product" => $id,"id_product_group" =>$page->parent_id), true, null, "param" ));

	}
	else
		header("location: /error404?error=product&reason=product_not_exist");
}

function param($id)
{
    if (!isset($id))
        header("location: /error404?error=product&reason=param_id_not_set");
	$GLOBALS['GCMS']
				->assign('param',
						ProductParam::get(array("id" => $id, "status" => "publish")));
	$GLOBALS['GCMS']
				->assign('paramvaluelist',
						RelProParam::get(array("id_param" => $id), true, array("by" => "value"), null,"value"));
	if (isset($_GET['g']))
	{
		$GLOBALS['GCMS']
				->assign('params',
						ProductParam::get(array("id_product_group" => $_GET['g'], "status" => "publish"),
								true));
	}
	if (isset($_GET['v']))
	{
		$GLOBALS['GCMS']
				->assign('productlist',
						RelProParam::get(array("id_param"=> $id, "value" => $_GET['v']), true, null, null,null));
	}else {
		$GLOBALS['GCMS']
				->assign('productlist',
						RelProParam::get(array("id_param" => $id), true, null, null,null));
	}
}

function search()
{
	if(isset($_GET['q'])&&trim($_GET['q'])!="")
	{
		$search=str_replace(" ", "%", htmlspecialchars(trim($_GET['q']), ENT_QUOTES));
		if(!isset($_GET['paging']))
			header("location: /product/search/?paging=1&q=$_GET[q]");
			
		$max_results=10;
		$arr_get=array(
					"pg_type" => "product",
					"pg_status" => "publish",
					"search" => "%".$search."%"
		);
		$order=array(
					"by" => "date_created",
					"sort" => "DESC"
		);
		$limit=array(
					"start" => (($_GET['paging']*$max_results)-$max_results),
					"end" => $max_results
		);
		$finds=Page::get($arr_get, true, $order, $limit);
		if(count($finds)>0)
		{
			foreach($finds as $find)
			{
				$temp=explode($search, strip_tags($find->pg_content), 2);
				$templen=strlen($temp[0]);
				if($templen>150)
				{
					$templen=$templen-110;
				}
				$temp[0]=substr($temp[0], $templen);
				$temp[0]=substr($temp[0], strpos($temp[0], " "));
				$temp[0]=" ... ".$temp[0];
				$find->pg_content=$temp[0]."<span style=\"color:red;background-color:yellow\" >"
						.$search."</span>"." ... ";
			}
			$GLOBALS['GCMS']->assign('finds', $finds);
			$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));
			return;
		}
	}
	$GLOBALS['GCMS']->assign('finds', "false");
}

function addToBasket($id)
{
    if (isset($id))
    {
        $page=Products::get(array("id" => $id, "status" => "publish"));
        if (!isset($_GET['q']) or $_GET['q']<0)
            $_GET['q']=1;
        if(isset($id)&&isset($page))
        {
            if(is_array($_SESSION['gcmsCart'])){
                $max=count($_SESSION['gcmsCart']);
                $addflag = false;
                for($i=0;$i<$max;$i++){
                    if($id==$_SESSION['gcmsCart'][$i]['productId']){
                        $_SESSION['gcmsCart'][$i]['productId']=$id;
                        $_SESSION['gcmsCart'][$i]['qty']=$_SESSION['gcmsCart'][$i]['qty']+$_GET['q'];
                        $addflag=true;
                    }
                }
                if (!$addflag)
                {
                    $_SESSION['gcmsCart'][$max]['productId']=$id;
                    $_SESSION['gcmsCart'][$max]['qty']=$_GET['q'];
                }

            }
            else{
                $_SESSION['gcmsCart']=array();
                $_SESSION['gcmsCart'][0]['productId']=$id;
                $_SESSION['gcmsCart'][0]['qty']=$_GET['q'];
            }
            header("location: /product/addToBasket/");
        }
        else
            header("location: /error404?error=product&reason=product_not_exist");
    }

}
function removeFromBasket($id){
    $id=intval($id);
    $max=count($_SESSION['gcmsCart']);
    for($i=0;$i<$max;$i++){
        if($id==$_SESSION['gcmsCart'][$i]['productId']){
            unset($_SESSION['gcmsCart'][$i]);
            break;
        }
    }
    $_SESSION['gcmsCart']=array_values($_SESSION['gcmsCart']);
    header("location: /product/addToBasket/");
}
function shop (){
    if(is_array($_SESSION['gcmsCart'])){

    }else
        header("location: /product/addToBasket/");
}