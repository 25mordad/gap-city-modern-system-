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

//require_once(__COREROOT__."/libs/utility/hashing.php");
$utilityfile = __COREROOT__."/module/user/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


function index()
{

    //setting $_GET if not set
	if(!isset($_GET['brand']))
		$_GET['brand']="all";

	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /gadmin/khodro/?paging=1&search=".$_GET['search']."&brand=".$_GET['brand']);
    //preparing to query
	$max_results=15;
	$arr_get=array();
	$order=array(
				"by" => "id",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
    $arr_get = array();
	//setting filters
	if($_GET['brand']!="all")
		$arr_get['id_brand']=$_GET['brand'];

	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";

    $order   = array("by"=>"id" , "sort"=>"DESC");
    $GLOBALS['GCMS']->assign('models', KhodroModel::get($arr_get, true,$order,$limit));

    $GLOBALS['GCMS']->assign('paging', ceil( KhodroModel::get_count($arr_get)/$max_results ) );

    $GLOBALS['GCMS']->assign('brands', KhodroBrand::get(array(), true , array("by" => "name" )));


}
function tips()
{
	//setting $_GET if not set
	if(!isset($_GET['brand']))
		$_GET['brand']="all";
	if(!isset($_GET['model']))
		$_GET['model']="all";
	if(!isset($_GET['search']))
		$_GET['search']="NULL";
	if(!isset($_GET['paging']))
		header(
				"location: /gadmin/khodro/tips?paging=1&search=".$_GET['search']."&brand="
						.$_GET['brand']."&model=".$_GET['model']);
    //preparing to query
	$max_results=20;
	$arr_get=array();
	$order=array(
				"by" => "id",
				"sort" => "DESC"
	);
	$limit=array(
				"start" => (($_GET['paging']*$max_results)-$max_results),
				"end" => $max_results
	);
    $arr_get = array();
	//setting filters
	if($_GET['brand']!="all")
		$arr_get['id_brand']=$_GET['brand'];
	if($_GET['model']!="all")
		$arr_get['id_model']=$_GET['model'];
	if($_GET['search']!="NULL")
		$arr_get['search']="%".$_GET['search']."%";

    $order   = array("by"=>"id" , "sort"=>"DESC");
    $GLOBALS['GCMS']->assign('tips', KhodroTip::get($arr_get, true,$order,$limit));

    $GLOBALS['GCMS']->assign('paging', ceil( KhodroTip::get_count($arr_get)/$max_results ) );

    $GLOBALS['GCMS']->assign('brands', KhodroBrand::get(array(), true , array("by" => "name" )));
    $arrmodel = array();
    if ($_GET['brand'] != "all")
        $arrmodel = array("id_brand"=>$_GET['brand']);
    $GLOBALS['GCMS']->assign('models', KhodroModel::get($arrmodel, true , array("by" => "model_name" )));
}

function brand()
{
    if (isset($_GET['new']))
    {
        $arr_insert = array(
                            "name" => $_POST['name']
                                );
        KhodroBrand::insert($arr_insert);
        $_SESSION['result']="سطر اضافه شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/khodro/brand");
    }

    if (isset($_GET['edit']))
    {

        if (isset($_GET['form']))
        {
            $arr_update = array(
                            "id"   => $_GET['edit'] ,
                            "name" => $_POST['name']
                                );
            KhodroBrand::update($arr_update);
            $_SESSION['result']="ویرایش انجام شد";
    		$_SESSION['alert']="success";
    		header("location: /gadmin/khodro/brand");
        }else{
            $arr_get=array("id"=>$_GET['edit']);
            $GLOBALS['GCMS']->assign('brand', KhodroBrand::get($arr_get, false));
        }
    }


    $arr_get=array();
    $GLOBALS['GCMS']->assign('brands', KhodroBrand::get($arr_get, true));

}

function newmodel()
{
    if (isset($_GET['new']))
    {
        $arr_insert = array(
                            "id_brand"     => $_POST['id_brand'] ,
                            "model_name"   => $_POST['model_name'] ,
                            "min_year"     => $_POST['min_year'] ,
                            "max_year"     => $_POST['max_year'] ,
                            "year_type"    => $_POST['year_type'] ,
                            "auto_gear"    => $_POST['auto_gear'] ,
                            "two_some"     => $_POST['two_some'] ,
                            "min_fee"      => $_POST['min_fee'] ,
                            "max_fee"      => $_POST['max_fee'] ,
                            "model_status" => $_POST['model_status']
                                );
        KhodroModel::insert($arr_insert);
        $_SESSION['result']="سطر اضافه شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/khodro");
    }

    $arr_get=array();
    $GLOBALS['GCMS']->assign('brands', KhodroBrand::get($arr_get, true));


}

function editmodel($id)
{
    if (isset($_GET['edit']))
    {
        $arr_insert = array(
                            "id"           => $id ,
                            "id_brand"     => $_POST['id_brand'] ,
                            "model_name"   => $_POST['model_name'] ,
                            "min_year"     => $_POST['min_year'] ,
                            "max_year"     => $_POST['max_year'] ,
                            "year_type"    => $_POST['year_type'] ,
                            "auto_gear"    => $_POST['auto_gear'] ,
                            "two_some"     => $_POST['two_some'] ,
                            "min_fee"      => $_POST['min_fee'] ,
                            "max_fee"      => $_POST['max_fee'] ,
                            "model_status" => $_POST['model_status']
                                );
        KhodroModel::update($arr_insert);
        $_SESSION['result']="به روز رسانی با موفقیت انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/khodro/editmodel/".$id);
    }

    $arr_get=array("id"=>$id);
    $GLOBALS['GCMS']->assign('model', KhodroModel::get($arr_get, false));


    $arr_get=array();
    $GLOBALS['GCMS']->assign('brands', KhodroBrand::get($arr_get, true));


}

function newtip()
{
    if (isset($_GET['new']))
    {
        $arr_insert = array(
                            "id_brand"     => $_POST['id_brand'] ,
                            "id_model"     => $_POST['id_model'] ,
                            "tip_name"     => $_POST['tip_name'] ,
                            "tip_form"     => $_POST['tip_form'] ,
                            "tip_status"   => $_POST['tip_status']
                                );
        KhodroTip::insert($arr_insert);
        $_SESSION['result']="سطر اضافه شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/khodro");
    }
    if (isset($_GET['brand']))
    {
        $arr_get=array("id_brand"=>$_GET['brand'],"model_status"=>"active");
        $GLOBALS['GCMS']->assign('models', KhodroModel::get($arr_get,true));


    }

    $arr_get=array();
    $GLOBALS['GCMS']->assign('brands', KhodroBrand::get($arr_get, true));


}
function edittip($id)
{
    if (isset($_GET['edit']))
    {
        $arr_insert = array(
                            "id"     => $id ,
                            "id_brand"     => $_POST['id_brand'] ,
                            "id_model"     => $_POST['id_model'] ,
                            "tip_name"     => $_POST['tip_name'] ,
                            "tip_form"     => $_POST['tip_form'] ,
                            "tip_status"   => $_POST['tip_status']
                                );
        KhodroTip::update($arr_insert);
        $_SESSION['result']="به روز رسانی انجام شد";
		$_SESSION['alert']="success";
		header("location: /gadmin/khodro/edittip/$id?brand=".$_GET['brand']);
    }

    $arr_get=array("id"=>$id);
    $tip = KhodroTip::get($arr_get, false) ;
    $GLOBALS['GCMS']->assign('tip', $tip);

    if (isset($_GET['brand']))
    {
        $arr_get=array("id_brand"=>$_GET['brand'],"model_status"=>"active");
        $GLOBALS['GCMS']->assign('models', KhodroModel::get($arr_get,true));


    }else {
        header("location: /gadmin/khodro/edittip/$id?brand=".$tip->id_brand);
    }



    $arr_get=array();
    $GLOBALS['GCMS']->assign('brands', KhodroBrand::get($arr_get, true));


}

function sms()
{
	if(isset($_GET['date']) && $_GET['date']!="")
	{
		$register_date_between_1=$_GET['date']." 00:00:00";
		$register_date_between_2=$_GET['date']." 23:59:59";
		$arr_get=array("register_date_between_1"=>$register_date_between_1, "register_date_between_2"=>$register_date_between_2, "adv_status"=>"confirm", "groupby"=>"cell");
		$GLOBALS['GCMS']->assign('advers', KhodroAdver::get($arr_get,true));
	}
	else
	{
		$_SESSION['result']="لطفا تاریخ مورد نظر را در url مشخص نمایید";
		$_SESSION['alert']="error";
		header("location: /gadmin/khodro/?paging=1&search=NULL&brand=all");
	}
}

function sendsms()
{

}

function confirmsend()
{
	if(isset($_POST['submit']))
	{
		require_once(__COREROOT__."/libs/utility/sms.php");
		$cells=array_filter(explode(' ', $_POST['cells']));
		$counter=0;
		foreach($cells as $cell)
		{
			$arr_send=array(
					"cell" => $cell,
					"sms_text" => $_POST['sms_text']
			);
			if(send_sms($arr_send))
				$counter++;
		}
		if($counter==count($cells))
		{
			$_SESSION['result']=$counter." پیام با موفقیت ارسال شد. | اعتبار شما : "
					.$GLOBALS['GCMS_SETTING']['sms']['credit']." تومان ";
			$_SESSION['alert']="success";
		}
		else if($counter==0)
		{
			$_SESSION['result']="اعتبار شما کمتر از هزینه ارسال پیام کوتاه است";
			$_SESSION['alert']="error";
		}
		else
		{
			$_SESSION['result']=(count($cells)-$counter)
			." پیام شما به دلیل تمام شدن اعتبار ارسال نشد.";
			$_SESSION['alert']="alarm";
		}
		header("location: /gadmin/khodro/sms?date=".date("Y-m-d",strtotime("-1 days")));
	}
}
function update_gheimat()
{
    if (isset($_GET['update']))
    {
        $updList = Page::get(
            array(
                "parent_id" => 10,
                "pg_type" => "page",
                "pg_status" => "publish"
            ), true, array("by" => "date_created", "sort" => "DESC"));
        foreach ( $updList as $row)
        {
            $finallist = Page::get(
                array(
                    "parent_id" => $row->id,
                    "pg_type" => "page",
                    "pg_status" => "publish"
                ), true, array("by" => "date_created", "sort" => "DESC"));
            foreach ($finallist as $pg)
            {
                $arr_update=array(
                    "id" => $pg->id,
                    "date_modified" => date("Y-m-d H:i:s")
                );
                Page::update($arr_update);
            }
        }

        $_SESSION['result']= " عملیات با موفقیت انجام شد ";
        $_SESSION['alert']="success";
        header("location: /gadmin/khodro/update_gheimat");
    }

}
