<?php

/**
 * backend_jobinfo.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: backend > jobinfo
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile=__COREROOT__."/module/jobinfo/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
	//setting $_GET if not set
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header("location: /gadmin/jobinfo/?paging=1&search=".$_GET['search']);
	//preparing to query
	$max_results=10;
	$arr_get=array();
	$order=array(
			"by" => "created_date",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
	//setting search
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";
	//assigning variables
	$jobinfos=SarfejoJobinfo::get($arr_get, true, $order, $limit, "sarfejo_user");
	$GLOBALS['GCMS']->assign('jobinfos', $jobinfos);
	$GLOBALS['GCMS']->assign('paging', ceil(SarfejoJobinfo::get_count($arr_get)/$max_results));
}

function listgroup()
{
	$GLOBALS['GCMS']->assign('groups', SarfejoJobgroup::get(array(), true));
}

function newgroup()
{
	if(isset($_POST['submit']))
	{
		$arr_insert=array(
					"type" => $_POST['type'],
					"name" => $_POST['name'],
					"parent" => $_POST['parent'],
					"status" => $_POST['status']
		);
		SarfejoJobgroup::insert($arr_insert);
		$_SESSION['result']="گروه جدید ایجاد شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/jobinfo/editgroup/".mysql_insert_id());
	}
	$GLOBALS['GCMS']->assign('groups', SarfejoJobgroup::get(array(), true));
}

function editgroup($id)
{
	$group=SarfejoJobgroup::get(array("id" => $id));
	if(isset($id)&&isset($group))
	{
		if(isset($_POST['submit']))
		{
			$arr_update=array(
						"id" => $id,
						"type" => $_POST['type'],
						"name" => $_POST['name'],
						"parent" => $_POST['parent'],
						"status" => $_POST['status']
			);
			SarfejoJobgroup::update($arr_update);
			$_SESSION['result']="ویرایش انجام شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/jobinfo/editgroup/".$id);
		}

		$GLOBALS['GCMS']->assign('group', $group);
		$GLOBALS['GCMS']->assign('groups', SarfejoJobgroup::get(array("id_not" => $id), true));
	}
	else
		header("location: /error404?error=jobinfo&reason=group_not_exist");
}

function addparam($id)
{
	$group=SarfejoJobgroup::get(array("id" => $id));
	if(isset($id)&&isset($group))
	{
		// add param
		if(isset($_POST['submit'])&&!isset($_GET['edit'])&&!isset($_GET['addvalue'])&&!isset($_GET['delvalue']))
		{
			$arr_insert=array( 
						"id_group" => $id,
						"en_name" => $_POST['en_name'],
						"fa_name" => $_POST['fa_name'],
						"type" =>  $_POST['type'],
						"status" =>  $_POST['status']
			);
			SarfejoJobparam::insert($arr_insert);
			$_SESSION['result']="پارامتر جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /gadmin/jobinfo/addparam/".$id);
		}
		// edit param
		if(isset($_GET['edit']))
		{
			$GLOBALS['GCMS']->assign('get_param', SarfejoJobparam::get(array("id" => $_GET['edit'], "id_group" => $id)));
			//update
			if(isset($_POST['submit']))
			{
				$arr_update=array(
							"id" => $_GET['edit'],
							"en_name" => $_POST['en_name'],
							"fa_name" => $_POST['fa_name'],
							"type" =>  $_POST['type'],
							"status" =>  $_POST['status']
				);
				SarfejoJobparam::update($arr_update);
				$_SESSION['result']="تغییرات با موفقیت انجام شد";
				$_SESSION['alert']="success";
				header("location: /gadmin/jobinfo/addparam/".$id);
			}
		}
		// add value
		if(isset($_GET['addvalue']))
		{
			$get_param_addvalue=SarfejoJobparam::get(array("id" => $_GET['addvalue'], "id_group" => $id));
			$GLOBALS['GCMS']->assign('get_param_addvalue', $get_param_addvalue);
			//addvalue
			if(isset($_POST['submit']))
			{
				$value_count=SarfejoJobparamextra::get_count(array("id_jobparam" => $get_param_addvalue->id));
				if(($get_param_addvalue->type=="matn"||$get_param_addvalue->type=="tozihat")&&$value_count==1)
				{
					$_SESSION['result']="پارامتر متنی و توضیحات فقط می‌توانند یک مقدار داشته باشند";
					$_SESSION['alert']="error";
					header("location: /gadmin/jobinfo/addparam/".$id);
				}
				else
				{
					$arr_update=array(
								"id_jobparam" => $get_param_addvalue->id,
								"fa_name" => $_POST['fa_name'],
								"en_name" => $_POST['en_name']
					);
					SarfejoJobparamextra::insert($arr_update);
					$_SESSION['result']="مقدار جدید ایجاد شد";
					$_SESSION['alert']="success";
					header("location: /gadmin/jobinfo/addparam/".$id);
				}
			}
		}
		if(isset($_GET['delvalue']))
		{
			$param_count=SarfejoJobparam::get(array("id" => $_GET['delvalue'], "id_group" => $id));
			$value_count=SarfejoJobparamextra::get_count(array("id" => $_GET['delvalueid'], "id_jobparam" => $_GET['delvalue']));
			if($param_count==1&&$value_count==1)
			{
				SarfejoJobparamextra::del($_GET['delvalueid']);
				$_SESSION['result']="مقدار مورد نظر حذف شد";
				$_SESSION['alert']="success";
				header("location: /gadmin/jobinfo/addparam/".$id);
			}
			else
				header("location: /error404?error=jobinfo&reason=value_not_exist");
			
		}
		// list param
		$param_lists=SarfejoJobparam::get(array("id_group" => $id), true);
		foreach($param_lists as $param)
		{
			$param_values=SarfejoJobparamextra::get(array("id_jobparam" => $param->id), true);
			$param->param_values=$param_values;
		}
		$GLOBALS['GCMS']->assign('param_lists', $param_lists);

		$GLOBALS['GCMS']->assign('group', $group);
	}
	else
		header("location: /error404?error=jobinfo&reason=group_not_exist");
}

function service($id)
{
	$jobinfo=SarfejoJobinfo::get(array("id" => $id));
	if(isset($id)&&isset($jobinfo))
	{
		$GLOBALS['GCMS']->assign('services', SarfejoService::get(array("id_jobinfo"=>$id), true, "", "", "user_group"));
		$GLOBALS['GCMS']->assign('jobinfo', $jobinfo);
	}
	else
		header("location: /error404?error=jobinfo&reason=jobinfo_not_exist");
}

function edit_admin_rank()
{
	if(isset($_POST['submit']))
	{
		SarfejoService::update(array("id" => $_POST['id_service'], "admin_rank" => $_POST['admin_rank']));
		$_SESSION['result']="ویرایش انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/jobinfo/service/".$_POST['id_service']);
	}
}