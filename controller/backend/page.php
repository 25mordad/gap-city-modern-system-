<?php

/**
 * page.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > page
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

require_once(__COREROOT__."/libs/utility/selecting.php");

function index()
{
    if(isset($_GET['pgStatus']))
    {
        $arr_update=array(
            "id" => $_GET['pgId'],
            "pg_status" => $_GET['pgStatus'],
            "date_modified" => date("Y-m-d H:i:s")
        );
        Page::update($arr_update);
    }
    if(isset($_GET['commentStatus']))
    {
        $arr_update=array(
            "id" => $_GET['pgId'],
            "comment_status" => $_GET['commentStatus'],
            "date_modified" => date("Y-m-d H:i:s")
        );
        Page::update($arr_update);
    }
	//setting $_GET if not set
	if(!isset($_GET['f_status']))
		$_GET['f_status']="all";
	if(!isset($_GET['f_parent']))
		$_GET['f_parent']="all";
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /gadmin/page/?paging=1&search=".$_GET['search']."&f_parent=".$_GET['f_parent']."&f_status="
						.$_GET['f_status']);
	//preparing to query
	$max_results=12;
	$arr_get=array(
				"pg_type" => "page",
				"pg_status_not" => "delete"
	);
	$order=array(
				"by" => "date_created",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
	//setting filters
	if($_GET['f_status']!="all")
		$arr_get['pg_status']=$_GET['f_status'];
	if($_GET['f_parent']!="all")
		$arr_get['parent_id']=$_GET['f_parent'];
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$GLOBALS['GCMS']->assign('pages', Page::get($arr_get, true, $order, $limit));
	$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));
	$GLOBALS['GCMS']->assign('boxes', Box::get(array("parent_id" => 0), true));
	$GLOBALS['GCMS']->assign('select_parent', select_page_parental());
	
}

function page_index($id)
{
	if(!isset($id))
	{
		$chk_page=Page::get(array("pg_type" => "index"));
		header("location: /gadmin/page/page_index/".$chk_page->id);
	}
	else
	{
        if (isset($_GET['delImgInx']))
        {
            RelImageOther::del($_GET['delImgInx']);
            header("location: /gadmin/page/page_index/1#PicDisplay");
        }
		$page=Page::get(array("id" => $id, "pg_type" => "index"));
		if(isset($page))
		{
			if(isset($_POST['pg_title']))
			{
				$arr_update=array(
							"id" => $id,
							"pg_title" => $_POST['pg_title'],
							"pg_content" => stripcslashes($_POST['pg_content']),
                            "pg_excerpt" => $_POST['pg_excerpt'],
							"author_id" => $_SESSION["userid"],
							"date_modified" => date("Y-m-d H:i:s")
				);
				Page::update($arr_update);

				$_SESSION['result']="ویرایش انجام شد";
				$_SESSION['alert']="success";
				header("location: /gadmin/page/page_index/".$id);
			}

            //find all img
            $arr_get=array(
                "im_type" => "page_index"
            );
            $order=array(
                "by" => "id",
                "sort" => "DESC"
            );

            $GLOBALS['GCMS']->assign('pageImg', Image::get($arr_get, true, $order, $id));
			$GLOBALS['GCMS']->assign('boxes', Box::get(array("parent_id" => $id), true));
			$GLOBALS['GCMS']->assign('page', $page);
		}
		else
			header("location: /error404?error=page&reason=page_not_exist");
	}
}

function new_page()
{
	if(isset($_POST['pg_title']))
	{
		$arr_insert=array(
					"pg_type" => "page",
					"parent_id" => $_POST['parent_id'],
					"pg_title" => $_POST['pg_title'],
					"pg_content" => null,
					"pg_excerpt" => null,
					"pg_status" => "pending",
					"comment_status" => "close",
					"author_id" => $_SESSION["userid"],
					"date_created" => date("Y-m-d H:i:s"),
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::insert($arr_insert);
		$_SESSION['result']="صفحه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/page/edit/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('select_parent', select_page_parental());
}

function edit($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "page"));
    if (isset($_GET['delImgInx']))
    {
        RelImageOther::del($_GET['delImgInx']);
        header("location: /gadmin/page/edit/".$id."#PicDisplay");
    }
	if(isset($id)&&isset($page))
	{
		if(isset($_POST['pg_title']))
		{

			$arr_update=array(
						"id" => $id,
						"parent_id" => $_POST['parent_id'],
						"pg_title" => $_POST['pg_title'],
						"pg_content" => stripcslashes($_POST['pg_content']),
						"pg_excerpt" => $_POST['pg_excerpt'],
						"pg_status" => $_POST['pg_status'],
						"comment_status" => $_POST['comment_status'],
						"author_id" => $_SESSION["userid"],
						"date_modified" => date("Y-m-d H:i:s")
			);
			Page::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/page/edit/".$id);
		}

        //find all img
        $arr_get=array(
            "im_type" => "page"
        );
        $order=array(
            "by" => "id",
            "sort" => "DESC"
        );

		$GLOBALS['GCMS']->assign('operator', Operator::get(array("id" => $page->author_id)));
		$GLOBALS['GCMS']->assign('page', $page);
		$GLOBALS['GCMS']->assign('pageImg', Image::get($arr_get, true, $order, $id));
		$GLOBALS['GCMS']->assign('boxes', Box::get(array("parent_id" => $id), true));
		$GLOBALS['GCMS']->assign('select_parent', select_page_parental("page", $id));
	}
	else
		header("location: /error404?error=page&reason=page_not_exist");

}

function del($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "page"));
	if(isset($id)&&isset($page))
	{
		$arr_update=array(
					"id" => $id,
					"pg_status" => "delete",
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="صفحه حذف شد";
		$_SESSION['alert']="success";

		//setting $_GET if not set
		if(!isset($_GET['f_status']))
			$_GET['f_status']="all";
		if(!isset($_GET['f_parent']))
			$_GET['f_parent']="all";
		if(!isset($_GET['search']))
			$_GET['search']="NULL";
		if(!isset($_GET['paging']))
			$_GET['paging']="1";
		header(
				"location: /gadmin/page/?paging=".$_GET['paging']."&search=".$_GET['search']."&f_parent="
						.$_GET['f_parent']."&f_status=".$_GET['f_status']);
	}
	else
		header("location: /error404?error=page&reason=page_not_exist");
}

function undel($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "page"));
	if(isset($id)&&isset($page))
	{
		$arr_update=array(
					"id" => $id,
					"pg_status" => "pending",
					"author_id" => $_SESSION["userid"],
					"date_modified" => date("Y-m-d H:i:s")
		);
		Page::update($arr_update);

		$_SESSION['result']="صفحه بازیابی شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/page/edit/".$id);
	}
	else
		header("location: /error404?error=page&reason=page_not_exist");
}
