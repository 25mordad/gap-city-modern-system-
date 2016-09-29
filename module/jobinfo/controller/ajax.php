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

function ChngVal()
{
    SarfejoServiceRelParam::update(array(
        "id"   => $_POST['thisId'] ,
        "value"   => $_POST['newvalue'],
    ));
}


function uploadImg()
{
    $getMime=explode('.', $_FILES['userImage']['name']);
    $mime=strtolower(end($getMime));
    if ($mime != "jpg")
        die("<div class='alert alert-danger'  >خطا</div>");
    $uploaddir='uploads/jobinfo/'.$_SESSION["glogin_user_id"].'/'.$_GET['part'].'/'.$_GET['id'].'/';
    $uploaddir=$uploaddir.date("Ymd").'/'.date("His").'/';
    if(!is_dir($uploaddir))
    {
        mkdir($uploaddir, 0755, true);
    }

    if(is_array($_FILES)) {
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            $sourcePath = $_FILES['userImage']['tmp_name'];
            $targetPath = $uploaddir.$_FILES['userImage']['name'];
            if(move_uploaded_file($sourcePath,$targetPath)) {
                SarfejoImg::insert(array(
                    "id_parent"    => $_GET['id'] ,
                    "type"         => $_GET['type'] ,
                    "path"         => $uploaddir ,
                    "name"         => $_FILES['userImage']['name']
                ));
                //echo "<img src='/$targetPath' width='100'  >";
            }
        }
    }



}

function getImg()
{
    $jobinfoimg = SarfejoImg::get(array(
        "id_parent" => $_POST['id'] ,
        "type" => $_POST['type'] ,
    ),true);
    foreach ($jobinfoimg as $jii)
    {
        echo "
    <div class='thumbnail col-md-2 '>
      <img src='/$jii->path$jii->name'  >
      <div class='caption'>
        <p>$jii->name <a href='' class='btn btn-danger' role='button' onclick='delImg($jii->id)'><span class='glyphicon glyphicon-remove' ></span>  </a> </p>
    </div>
    </div>
        ";
    }
    echo "<div class='clearfix' ></div>";
}

function delImg()
{
    SarfejoImg::del($_POST['imid']);
    $jobinfoimg = SarfejoImg::get(array(
        "id_parent" => $jobinfo->id ,
    ),true);
    foreach ($jobinfoimg as $jii)
    {
        echo "
    <div class='thumbnail col-md-2'>
      <img src='/$jii->path$jii->name'  >
      <div class='caption'>
        <p>$jii->name <a href='#' class='btn btn-danger' role='button' onclick='delImg($jii->id)'><span class='glyphicon glyphicon-remove' ></span> حذف عکس</a> </p>
    </div>
    </div>
        ";
    }
    echo "<div class='clearfix' ></div>";
}
function plusDec()
{
    SarfejoCommentRelUser::insert(array(
        "id_user"     =>  $_SESSION["glogin_user_id"],
        "id_comment"  =>  $_POST['ic'],
        "user_action" =>  $_POST['type'],
    ));
}
function revoComp()
{
    //unset($_SESSION['gcms_sarfejo_Camp1']);
    //unset($_SESSION['gcms_sarfejo_Camp2']);
    /*unset($_SESSION['gcmssarfejoCamp3']);
    unset($_SESSION['gcmssarfejoCamp4']);*/
    $_SESSION['gcms_sarfejo_Camp'.$_POST['id']] = "";
    showCopm();
}
function addToComp()
{
    if(!isset($_SESSION['gcms_sarfejo_Camp1']) )
    {
        $_SESSION['gcms_sarfejo_Camp1'] = "";
        $_SESSION['gcms_sarfejo_Camp2'] = "";
    }

    if($_SESSION['gcms_sarfejo_Camp1'] == "")
    {
        $_SESSION['gcms_sarfejo_Camp1']=$_POST['id'];
    }
    if($_SESSION['gcms_sarfejo_Camp2'] == "")
    {
        $_SESSION['gcms_sarfejo_Camp2']=$_POST['id'];
    }

    if($_SESSION['gcms_sarfejo_Camp3'] == "")
    {
        $_SESSION['gcms_sarfejo_Camp3']=$_POST['id'];
    }

    if ($_SESSION[gcms_sarfejo_Camp2] == $_SESSION[gcms_sarfejo_Camp1])
        $_SESSION['gcms_sarfejo_Camp2'] = "";

    if ( $_SESSION[gcms_sarfejo_Camp2] == $_SESSION[gcms_sarfejo_Camp3] or $_SESSION[gcms_sarfejo_Camp1] == $_SESSION[gcms_sarfejo_Camp3])
        $_SESSION['gcms_sarfejo_Camp3'] = "";

    /*if(!isset($_SESSION['gcmssarfejoCamp1']) )
    {
        $_SESSION['gcmssarfejoCamp1'] = "";
    }
    else{
        if($_SESSION['gcmssarfejoCamp1'] == "")
        {
            $_SESSION['gcmssarfejoCamp1']=$_POST['id'];
        }else{
            if(!isset($_SESSION['gcmssarfejoCamp2']) )
            {
                $_SESSION['gcmssarfejoCamp2']=$_POST['id'];
            }else{
                if(!isset($_SESSION['gcmssarfejoCamp3']) )
                {
                    $_SESSION['gcmssarfejoCamp3']=$_POST['id'];
                }else{
                    $_SESSION['gcmssarfejoCamp4'] = "";
                }

            }

        }

    }*/

    /*if(!isset($_SESSION['gcmssarfejoCamp1']) )
    {
        $_SESSION['gcmssarfejoCamp1'] = "";
        $_SESSION['gcmssarfejoCamp2'] = "";
        $_SESSION['gcmssarfejoCamp3'] = "";
        $_SESSION['gcmssarfejoCamp4'] = "";
    }
    else
    {

        if ($_SESSION['gcmssarfejoCamp4'] == "")
        {
            if ($_SESSION['gcmssarfejoCamp3'] == "")
            {
                if ($_SESSION['gcmssarfejoCamp2'] == "")
                {
                    if ($_SESSION['gcmssarfejoCamp1'] == "")
                    {
                        $_SESSION['gcmssarfejoCamp1'] = $_POST['id'];
                    }else
                        $_SESSION['gcmssarfejoCamp2'] = $_POST['id'];
                }else
                    $_SESSION['gcmssarfejoCamp3'] = "comp";
            }else
                $_SESSION['gcmssarfejoCamp4'] = $_POST['id'];
        }else
            $_SESSION['gcmssarfejoCamp4'] = $_POST['id'];

    }*/

    showCopm();

}
function showCopm()
{
    if ($_SESSION[gcms_sarfejo_Camp1] != "")
    {
        $comp1 = SarfejoImg::get(array(
            "id_parent" => $_SESSION[gcms_sarfejo_Camp1] ,
            "type"      => "service" ,
        ));
        if ( isset($comp1->name) )
            echo "<img src='/$comp1->path$comp1->name' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(1)'></span>

        ";
        else
            echo "<img src='/web/sarfejoo/img/noImg.jpg' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(1)'></span>
        ";
    }
    if ($_SESSION[gcms_sarfejo_Camp2] != "")
    {
        $comp2 = SarfejoImg::get(array(
            "id_parent" => $_SESSION[gcms_sarfejo_Camp2] ,
            "type"      => "service" ,
        ));
        if ( isset($comp2->name) )
        echo "<img src='/$comp2->path$comp2->name' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(2)'></span>
        ";
    else
        echo "<img src='/web/sarfejoo/img/noImg.jpg' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(2)'></span>
        ";
    }

    if ($_SESSION[gcms_sarfejo_Camp3] != "")
    {
        $comp3 = SarfejoImg::get(array(
            "id_parent" => $_SESSION[gcms_sarfejo_Camp3] ,
            "type"      => "service" ,
        ));
        if ( isset($comp3->name) )
        echo "<img src='/$comp3->path$comp3->name' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(3)'></span>
        ";
    else
        echo "<img src='/web/sarfejoo/img/noImg.jpg' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(3)'></span>
        ";
    }


    /*if ($_SESSION[gcmssarfejoCamp4] != "")
    {
        $comp4 = SarfejoImg::get(array(
            "id_parent" => $_SESSION[gcmssarfejoCamp4] ,
            "type"      => "service" ,
        ));

        if ( isset($comp4->name) )
            echo "<img src='/$comp4->path$comp4->name' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(4)'></span>
        ";
        else
            echo "<img src='/web/sarfejoo/img/noImg.jpg' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(4)'></span>
        ";
    }

    if ($_SESSION[gcmssarfejoCamp5] != "")
    {
        $comp5 = SarfejoImg::get(array(
            "id_parent" => $_SESSION[gcmssarfejoCamp5] ,
            "type"      => "service" ,
        ));
        if ( isset($comp5->name) )
            echo "<img src='/$comp3->path$comp5->name' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(5)'></span>
        ";
        else
            echo "<img src='/web/sarfejoo/img/noImg.jpg' width='50' style='margin: 1px;float: right;' >
        <span class='glyphicon glyphicon-remove' style='float: right;color: red;margin-right: -15px;cursor: pointer' onclick='revoComp(5)'></span>
        ";
    }*/


}
//require_once(__COREROOT__."/file/ajax_backend.php");