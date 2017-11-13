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

function uploadFile()
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
		Image::insert($arr_insert);
		$arr_insert2=array(
				"image_id" => mysql_insert_id(),
				"other_id" => $_GET['id'],
				"rel_type" => $_GET['type']
		);
		RelImageOther::insert($arr_insert2);
	}
	
}

function showTicketImages()
{
	$images = Image::get(array("im_type" => "ticket" ), true, $order=array("by" => "id", "sort" => "DESC" ), $_GET['id']);
	echo '

	<div class="row">
	  

	';
	
	foreach ($images as $image){
		echo '
<div class="col-md-2">
	    <div class="thumbnail">
	      <a href="$image->im_path$image->im_name">
	        <img src="'.$image->im_path.'thumb/'.$image->im_name.'"  style="width:100%">
	        <div class="caption">
	          <a href="#showTicketImages" onclick="removeTicketImages('.$image->id.');" style="color:red">Remove</a>
	        </div>
	      </a>
	    </div>
</div>
';
	}
	
	echo '

	  
	  </div>
	';
	
	
	
}

function removeTicketImages()
{
	Image::del($_GET['id']);
}

function addTicketTime()
{
	$insertTickettime=array(
			"id_ticket"        => $_GET['id'],
			"hour"             => $_GET['timehour'].":".$_GET['timemin'],
			"available"        => $_GET['timeavailable']
	);
	Tickettime::insert($insertTickettime);
}

function showTicketTime()
{
	$tickettimes = Tickettime::get(array("id_ticket" => $_GET['id']), true,$order=array("by" => "hour", "sort" => " ASC" ));
	foreach ($tickettimes as $tickettime){
		echo '
			 <button type="button" onclick="removeTicketTime('.$tickettime->id.');" class="btn btn-dark" style="margin:5px">
			'.$tickettime->hour.' <span class="badge badge-light">'.$tickettime->available.'</span>
			
			</button> 
';
	}
	
}

function removeTicketTime()
{
	Tickettime::del($_GET['id']);
}

function addBlockdate()
{
	$insertBlockeddate=array(
			"id_ticket"        => $_GET['id'],
			"type"             => $_GET['type'],
			"blocktype"        => $_GET['blocktype'],
			"date"             => $_GET['bdate']
	);
	Blockeddate::insert($insertBlockeddate);
}
function showBlockeddate()
{
	$blockeddates = Blockeddate::get(array("id_ticket" => $_GET['id'],"type" => $_GET['type']), true,$order=array("by" => "date", "sort" => " ASC" ));
	foreach ($blockeddates as $blockeddates){
		echo '
			 <button type="button" onclick="removeBlockeddate('.$blockeddates->id.');" class="btn btn-dark" style="margin:5px">
			'.$blockeddates->date.' <span class="badge badge-light">'.$blockeddates->blocktype.'</span>
					
			</button>
';
	}
}

function removeBlockeddate()
{
	Blockeddate::del($_GET['id']);
}

function changeprice()
{
	$updatTicketprice=array(
			"id"          => $_GET['id'] ,
			$_GET['type'] => $_GET['value']
	);
	Ticketprice::update($updatTicketprice); 
}

function changefeature()
{
	$updatTicketfeature=array(
			"id"       => $_GET['id'] ,
			"value"    => $_GET['value']
	);
	Ticketfeature::update($updatTicketfeature);
}
