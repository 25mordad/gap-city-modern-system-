<?php
/**
 * ajax_backend.php
 *
 * This file is part of GCMS > CONTROLLER
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

function testAjax()
{
    echo "testAJAX";
}
function dropZone($files,$uploads)
{
    $tempFile = $files['file']['tmp_name'];
    $targetPath = __ROOT__ . DIRECTORY_SEPARATOR. $uploads . DIRECTORY_SEPARATOR;
    $targetFile =  $targetPath. $files['file']['name'];
    return move_uploaded_file($tempFile,$targetFile);
}


function createThumb($files,$uploads)
{
	
    // Get the mime & original
    $getMime=explode('.', $files['file']['name']);
    $mime=strtolower(end($getMime));
    $original=substr($files['file']['name'], 0, -1-strlen($mime));
    
    switch($mime)
    {
        case "jpg":
        case "jpeg":
            $img=imagecreatefromjpeg($uploads.DIRECTORY_SEPARATOR.$original.".".$mime);
            break;
        case "png":
            $img=imagecreatefrompng($uploads.DIRECTORY_SEPARATOR.$original.".".$mime);
            break;
        case "gif":
            $img=imagecreatefromgif($uploads.DIRECTORY_SEPARATOR.$original.".".$mime);
            break;
    }
    
    $width=imagesx($img);
    $height=imagesy($img);
    $thumbWidth="115";
    $new_width=$thumbWidth;
    $new_height=floor($height*($thumbWidth/$width));
    $tmp_img=imagecreatetruecolor($new_width, $new_height);
    imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    
    $newUploadPath= $uploads.DIRECTORY_SEPARATOR."thumb".DIRECTORY_SEPARATOR.$original.".".$mime;
    
    switch($mime)
    {
        case "jpg":
        case "jpeg":
            imagejpeg($tmp_img,$newUploadPath );
            break;
        case "png":
            imagepng($tmp_img,$newUploadPath);
            break;
        case "gif":
            imagegif($tmp_img, $newUploadPath);
            break;
    }

}

function UplImgInx()
{
	
    $uploaddir = 'uploads'.DIRECTORY_SEPARATOR.$_GET['part'].DIRECTORY_SEPARATOR.$_GET['id'].DIRECTORY_SEPARATOR.date("Y-m-d");

    if(!is_dir($uploaddir))
    {
        mkdir($uploaddir, 0755, true);
    }
    if(!is_dir($uploaddir.DIRECTORY_SEPARATOR."thumb"))
    {
        mkdir($uploaddir.DIRECTORY_SEPARATOR."thumb", 0755, true);
    }
    
    if (!empty($_FILES))
    {
        $retfilUpl = dropZone($_FILES,$uploaddir);
        createThumb($_FILES,$uploaddir);
    }
    
    if ($retfilUpl)
    {
    	
        $arr_insert=array(
            "im_name" => $_FILES['file']['name'],
            "im_path" => '/uploads/'.$_GET['part'].'/'.$_GET['id'].'/'.date("Y-m-d").'/',
            "im_type" => $_GET['type']
        );
        $lastId = Image::insert($arr_insert);
        $arr_insert2=array(
            "image_id" => $lastId,
            "other_id" => $_GET['id'],
            "rel_type" => $_GET['type']
        );
        RelImageOther::insert($arr_insert2);
    }

}
function get_keywords()
{
    //getting keywords
    $order=array(
        "by" => "rel_id",
        "sort" => "ASC"
    );
    $keywords=Keyword::get(NULL, true, $order, NULL, $_GET['id']);
    //preparing for ajax returning
    $json_response=json_encode($keywords);
    if($_GET["callback"])
    {
        $json_response=$_GET["callback"]."(".$json_response.")";
    }
    echo $json_response;
}

function new_keyword()
{
    $chk_keyword=Keyword::get(array("kw_title" => $_POST['kw_title']));
    if(isset($chk_keyword))
    {
        $key_id=$chk_keyword->id;
    }
    else
    {
        Keyword::insert(array("kw_title" => $_POST['kw_title']));
        $key_id=mysql_insert_id();
    }
    echo "({id: ".$key_id.", kw_title: \"".$_POST['kw_title']."\"})";
}

function add_keyword()
{

    $chk_rel=RelKeywordPage::get(
        array("key_id" => $_POST['key_id'], "page_id" => $_POST['page_id']));
    if(isset($chk_rel))
    {
        $rel_id=$chk_rel->id;
    }
    else
    {
        RelKeywordPage::insert(array("key_id" => $_POST['key_id'], "page_id" => $_POST['page_id']));
        $rel_id=mysql_insert_id();
    }
    echo $rel_id;
}

function del_keyword()
{
    RelKeywordPage::del($_POST['id']);
}
function get_suggestions()
{
    //getting keywords
    $arr_get=array(
        "search" => $_GET['search']."%"
    );
    $order=array(
        "by" => "id",
        "sort" => "DESC"
    );
    $limit=array(
        "start" => 6
    );
    $keywords=Keyword::get($arr_get, true, $order, $limit, $_GET['id']);
    //preparing for ajax returning
    $json_response=json_encode($keywords);
    if($_GET["callback"])
    {
        $json_response=$_GET["callback"]."(".$json_response.")";
    }
    echo $json_response;
}
