<?php

/**
 * frontend_jobinfo.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > jobinfo
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
	//index
}

function new_jobinfo()
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		if(isset($_GET['JobInfo']))
		{
			$arr_insert=array(
						"id_user" => $_SESSION["glogin_user_id"],
						"co_name" => $_POST['co_name'],
						"name" => $_POST['name'],
						"state" => $_POST['state'],
						"city" => $_POST['city'],
						"address" => $_POST['address'],
						"latitude" => $_POST['latitude'],
						"longitude" => $_POST['longitude'],
						"tell" => $_POST['tell'],
						"cell" => $_POST['cell'],
						"email" => $_POST['email'],
						"url" => $_POST['url'],
						"created_date" => date("Y-m-d H:i:s"),
						"modify_date" => date("Y-m-d H:i:s"),
						"status" => "active"
			);
			SarfejoJobinfo::insert($arr_insert);
			$_SESSION['result']="واحد صنفی جدید ایجاد شد";
			$_SESSION['alert']="success";
			header("location: /jobinfo/edit/".mysql_insert_id());
		}
	}
	else
		header("location: /sarfejo_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function edit($id)
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		$jobinfo=SarfejoJobinfo::get(array("id" => $id, "id_user" => $_SESSION["glogin_user_id"]));
        $GLOBALS['GCMS']->assign('jobinfoimg', SarfejoImg::get(array(
            "id_parent" => $jobinfo->id ,
        ),true));
		if(isset($id)&&isset($jobinfo))
		{
			if(isset($_GET['JobInfo']))
			{
				$arr_update=array(
							"id" => $id,
							"co_name" => $_POST['co_name'],
							"name" => $_POST['name'],
							"state" => $_POST['state'],
							"city" => $_POST['city'],
							"address" => $_POST['address'],
							"latitude" => $_POST['latitude'],
							"longitude" => $_POST['longitude'],
							"tell" => $_POST['tell'],
							"cell" => $_POST['cell'],
							"email" => $_POST['email'],
							"url" => $_POST['url'],
							"modify_date" => date("Y-m-d H:i:s")
				);
				SarfejoJobinfo::update($arr_update);
				$_SESSION['result']="ویرایش انجام شد";
				$_SESSION['alert']="success";
				header("location: /jobinfo/edit/".$id);
			}
			$GLOBALS['GCMS']->assign('jobinfo', $jobinfo);
		}
		else
			header("location: /error404?error=jobinfo&reason=jobinfo_not_exist");
	}
	else
		header("location: /sarfejo_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function myjobinfolist()
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		$GLOBALS['GCMS']
				->assign('jobinfos',
						SarfejoJobinfo::get(array("id_user" => $_SESSION["glogin_user_id"]), true,
								array("by" => "created_date", "sort" => "DESC")));
	}
	else
		header("location: /sarfejo_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function addservice($id) //Here $id is for jobinfo
{
	if(isset($_SESSION["glogin_user_id"]))
	{
        if(!isset($_GET['type']) )
            header("location: ?type=khadamat");
        $GLOBALS['GCMS']->assign('groups', SarfejoJobgroup::get(array(
            "type"   => $_GET['type'] ,
            "status" => "active" ,
            "parent" => "0"
        ), true));
		$jobinfo=SarfejoJobinfo::get(array("id" => $id, "id_user" => $_SESSION["glogin_user_id"]));
		if(isset($id)&&isset($jobinfo))
		{
			if(isset($_GET['addservice']))
			{
				$arr_insert=array(
							"type" => $_POST['type'],
							"id_group" => $_POST['id_group'],
							"id_user" => $_SESSION["glogin_user_id"],
							"id_jobinfo" => $id,
							"title" => $_POST['title'],
							"text" => $_POST['text'],
							"fee" => $_POST['fee'],
							"status" => "active",
							"admin_rank" => "0",
							"user_rank" => "0",
							"visitor" => "0",
							"created_date" => date("Y-m-d H:i:s"),
							"modify_date" => date("Y-m-d H:i:s")
				);
				SarfejoService::insert($arr_insert);
				$_SESSION['result']="خدمات یا محصولات به واحد صنفی اضافه شد";
				$_SESSION['alert']="success";
				header("location: /jobinfo/editservice/".mysql_insert_id());
			}

			$GLOBALS['GCMS']->assign('jobinfo', $jobinfo);
		}
		else
			header("location: /error404?error=jobinfo&reason=jobinfo_not_exist");
	}
	else
		header("location: /sarfejo_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function editservice($id) // But here $id is for service
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		$service=SarfejoService::get(array("id" => $id, "id_user" => $_SESSION["glogin_user_id"]));
		if(isset($id)&&isset($service))
		{
			if(isset($_GET['editservice']))
			{
				$arr_update=array(
							"id" => $id,
							"title" => $_POST['title'],
							"text" => $_POST['text'],
							"fee" => $_POST['fee'],
							"modify_date" => date("Y-m-d H:i:s")
				);
				SarfejoService::update($arr_update);
				$_SESSION['result']="ویرایش انجام شد";
				$_SESSION['alert']="success";
				header("location: /jobinfo/editservice/".$id);
			}
            //
			$GLOBALS['GCMS']->assign('jobinfo', SarfejoJobinfo::get(array("id" => $service->id_jobinfo)));
            //
            $param_lists=SarfejoJobparam::get(array("id_group" => $service->id_group), true);
            foreach($param_lists as $param)
            {
                $param_values=SarfejoJobparamextra::get(array("id_jobparam" => $param->id),
                    true);
                $param->param_values=$param_values;
            }
            $GLOBALS['GCMS']->assign('param_lists', $param_lists);

            //
			$GLOBALS['GCMS']->assign('service', $service);
		}
		else
			header("location: /error404?error=jobinfo&reason=service_not_exist");
	}
	else
		header("location: /sarfejo_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function myservicelist($id) //Here $id is for jobinfo
{
	if(isset($_SESSION["glogin_user_id"]))
	{
		$jobinfo=SarfejoJobinfo::get(array("id" => $id, "id_user" => $_SESSION["glogin_user_id"]));
		if(isset($id)&&isset($jobinfo))
		{
			$GLOBALS['GCMS']
					->assign('services', SarfejoService::get(array("id_jobinfo" => $id), true, "", "", "user_group"));
			$GLOBALS['GCMS']->assign('jobinfo', $jobinfo);
		}
		else
			header("location: /error404?error=jobinfo&reason=jobinfo_not_exist");
	}
	else
		header("location: /sarfejo_user?redirect=".$_SERVER["REQUEST_URI"]);
}

function show($id)
{
	$jobinfo=SarfejoJobinfo::get(array("id" => $id));
	if(isset($id)&&isset($jobinfo))
	{
        $GLOBALS['GCMS']->assign('jobinfoimg', SarfejoImg::get(array(
            "id_parent" => $jobinfo->id ,
        ),true));
		$GLOBALS['GCMS']->assign('services', SarfejoService::get(array(
            "id_jobinfo" => $id ,
            "status"     => "active" ,
        ), true));
		$GLOBALS['GCMS']->assign('jobinfo', $jobinfo);
	}
	else
		header("location: /error404?error=jobinfo&reason=jobinfo_not_exist");
}

function showservice($id)
{
	$service=SarfejoService::get(array("id" => $id));
	if(isset($id)&&isset($service))
	{
        if (isset ($_GET['comment']) )
        {
            if (isset($_SESSION["glogin_user_id"]))
            {
                $arr_insert = array(
                    "id_user"       => $_SESSION["glogin_user_id"],
                    "id_service"    => $id,
                    "text"          => $_POST['text'],
                    "status"        => "active",
                    "plus"          => "0",
                    "minus"         => "0",
                    "score"         => $_POST['score'],
                    "created_date"  => date("Y-m-d H:i:s")
                );
                SarfejoComment::insert($arr_insert);
                $_SESSION['result']=" با تشکر از نظر شما  ";
                $_SESSION['alert']="success";
                header("location: /jobinfo/showservice/".$id);
            }
            else
                header("location: /error404?error=jobinfo&reason=showservice_comment");
        }
		$visitor=$service->visitor;
		$visitor++;
		SarfejoService::update(array("id" => $id, "visitor" => $visitor));
		$GLOBALS['GCMS']->assign('jobinfo', SarfejoJobinfo::get(array("id" => $service->id_jobinfo)));
		$GLOBALS['GCMS']->assign('group', SarfejoJobgroup::get(array("id" => $service->id_group)));
		$GLOBALS['GCMS']->assign('user', Sarfejo_user::get(array("id" => $service->id_user)));

		$GLOBALS['GCMS']->assign('comments', SarfejoComment::get(array(
            "id_service" => $id ,
            "status"     => "active",
        ),true,array("by"=>"created_date" , "sort" => "DESC")));

        $param_lists=SarfejoJobparam::get(array("id_group" => $service->id_group), true);
        foreach($param_lists as $param)
        {
            $param_values=SarfejoJobparamextra::get(array("id_jobparam" => $param->id),
                true);
            $param->param_values=$param_values;
        }
        $GLOBALS['GCMS']->assign('param_lists', $param_lists);

		$GLOBALS['GCMS']->assign('service', $service);
        $GLOBALS['GCMS']->assign('serviceimg', SarfejoImg::get(array(
            "id_parent" => $service->id ,
            "type"      => "service"
        ),true));
	}
	else
		header("location: /error404?error=jobinfo&reason=service_not_exist");
}
function search()
{
    $search=str_replace(" ", "%", htmlspecialchars(trim($_GET['search']), ENT_QUOTES));

    if(!isset($_GET['sort']))
        $_GET['sort']="DESC";
    if(!isset($_GET['group']))
        $_GET['group']="all";
    if(!isset($_GET['order']))
        $_GET['order']="admin_rank";
    if(!isset($_GET['feefrom']))
        $_GET['feefrom']="null";
    if(!isset($_GET['feeto']))
        $_GET['feeto']="null";
    if(!isset($_GET['state']))
        $_GET['state']="all";
    if(!isset($_GET['city']))
        $_GET['city']="all";
    if(!isset($_GET['paging']))
        header("location: /jobinfo/search/?paging=1&search=".$_GET['search']."&sort=".$_GET['sort']
            ."&order=".$_GET['order']
            ."&group=".$_GET['group']
            ."&feefrom=".$_GET['feefrom']
            ."&feeto=".$_GET['feeto']
            ."&state=".$_GET['state']
            ."&city=".$_GET['city']
        );
    $max_results=10;
    $arr_search = array(
        "search" => "%".$search."%"
    );
    if ($_GET['group'] != "all")
    {
        $arr_search = $arr_search + array(
                "id_group" => $_GET['group'],
            );
    }

   if ($_GET['state'] != "all")
    {
        $arr_search = $arr_search + array(
                "state" => $_GET['state'],
            );
    }

   if ($_GET['city'] != "all")
    {
        $arr_search = $arr_search + array(
                "city" => $_GET['city'],
            );
    }

   if ($_GET['feefrom'] != "null")
    {
        $arr_search = $arr_search + array(
                "feefrom" => $_GET['feefrom'],
            );
    }

   if ($_GET['feeto'] != "null")
    {
        $arr_search = $arr_search + array(
                "feeto" => $_GET['feeto'],
            );
    }

    $order=array(
        "by"   => $_GET['order'],
        "sort" => $_GET['sort']
    );
    $limit=array(
        "start" => (($_GET['paging']*$max_results)-$max_results),
        "end" => $max_results
    );
    $services=SarfejoService::get($arr_search,true,$order,$limit , "sarfejo_group");
    $thisCount = count(SarfejoService::get($arr_search,true,$order));
    $GLOBALS['GCMS']->assign('paging', ceil($thisCount/$max_results));

    $GLOBALS['GCMS']->assign('services', $services);
    $GLOBALS['GCMS']->assign('services_count',$thisCount );
    $GLOBALS['GCMS']->assign('services_group',SarfejoService::get($arr_search,true,$order,null , "sarfejo_group","id_group") );
    $GLOBALS['GCMS']->assign('services_state',SarfejoService::get($arr_search,true,$order,null , "jobinfo","state") );
    $GLOBALS['GCMS']->assign('services_city',SarfejoService::get($arr_search,true,$order,null , "jobinfo","city") );
}

function compare()
{
    if($_SESSION['gcms_sarfejo_Camp1'] != "" or  $_SESSION['gcms_sarfejo_Camp2'] != "" or  isset($_GET['ic1']))
    {
        if (isset($_GET['ic1']))
        {
            $service1=SarfejoService::get(array("id" => $_GET['ic1']));
            $service2=SarfejoService::get(array("id" => $_GET['ic2']));
            $service3=SarfejoService::get(array("id" => $_GET['ic3']));
            if(isset($service1))
            {
                $GLOBALS['GCMS']->assign('jobinfo1', SarfejoJobinfo::get(array("id" => $service1->id_jobinfo)));
                $GLOBALS['GCMS']->assign('group1', SarfejoJobgroup::get(array("id" => $service1->id_group)));

                $param_lists1=SarfejoJobparam::get(array("id_group" => $service1->id_group), true);
                foreach($param_lists1 as $param)
                {
                    $param_values=SarfejoJobparamextra::get(array("id_jobparam" => $param->id),
                        true);
                    $param->param_values=$param_values;
                }
                $GLOBALS['GCMS']->assign('param_lists1', $param_lists1);

                $GLOBALS['GCMS']->assign('service1', $service1);

                //
                if(isset($service2))
                {
                    $GLOBALS['GCMS']->assign('jobinfo2', SarfejoJobinfo::get(array("id" => $service2->id_jobinfo)));
                    $GLOBALS['GCMS']->assign('group2', SarfejoJobgroup::get(array("id" => $service2->id_group)));

                    $param_lists2=SarfejoJobparam::get(array("id_group" => $service2->id_group), true);
                    foreach($param_lists2 as $param)
                    {
                        $param_values=SarfejoJobparamextra::get(array("id_jobparam" => $param->id),
                            true);
                        $param->param_values=$param_values;
                    }
                    $GLOBALS['GCMS']->assign('param_lists2', $param_lists2);

                    $GLOBALS['GCMS']->assign('service2', $service2);
                }

                if(isset($service3))
                {
                    $GLOBALS['GCMS']->assign('jobinfo3', SarfejoJobinfo::get(array("id" => $service3->id_jobinfo)));
                    $GLOBALS['GCMS']->assign('group3', SarfejoJobgroup::get(array("id" => $service3->id_group)));

                    $param_lists3=SarfejoJobparam::get(array("id_group" => $service3->id_group), true);
                    foreach($param_lists3 as $param)
                    {
                        $param_values=SarfejoJobparamextra::get(array("id_jobparam" => $param->id),
                            true);
                        $param->param_values=$param_values;
                    }
                    $GLOBALS['GCMS']->assign('param_lists3', $param_lists3);

                    $GLOBALS['GCMS']->assign('service3', $service3);
                }

            }
        }else{
            if ($_SESSION['gcms_sarfejo_Camp2'] == "")
            {
                $_SESSION['gcms_sarfejo_Camp2'] = $_SESSION['gcms_sarfejo_Camp3'];
                $_SESSION['gcms_sarfejo_Camp3'] = "";
            }

            header("location: /jobinfo/compare/?ic1=".$_SESSION['gcms_sarfejo_Camp1']."&ic2=".$_SESSION['gcms_sarfejo_Camp2']."&ic3=".$_SESSION['gcms_sarfejo_Camp3'] );
            unset($_SESSION['gcms_sarfejo_Camp1']);
            unset($_SESSION['gcms_sarfejo_Camp2']);
            unset($_SESSION['gcms_sarfejo_Camp3']);
        }
    }else{
        header("location: /jobinfo/");
    }

}
function group($id)
{
    $GLOBALS['GCMS']->assign('group', SarfejoJobgroup::get(array("id" => $id,"status"=>"active")));
    $GLOBALS['GCMS']->assign('group_childs', SarfejoJobgroup::get(array("parent"=>$id , "status"=>"active"), true));
    $GLOBALS['GCMS']->assign('products', SarfejoService::get(array("id_group" => $id , "status"=>"active" ) ,true
        , array("sort"=>"DESC","by"=>"admin_rank",array("start"=>0,"end"=>10))  ));



}