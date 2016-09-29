<?php

/**
 * image.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Utility Component.
 * Main use: working with images
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function upload($part, $id, $field_name, $max_size)
{
	$size=filesize($_FILES[$field_name]['tmp_name']);
	if($size>$max_size*1024)
	{
		//echo '<h1>You have exceeded the size limit!</h1>';
		return false;
	}
	$name=$_FILES[$field_name]['name'];
	// Get the mime & original
	$getMime=explode('.', $name);
	$mime=strtolower(end($getMime));
	$original=substr($name, 0, -1-strlen($mime));
	if(($mime!="jpg")&&($mime!="jpeg")&&($mime!="png")&&($mime!="gif"))
	{
		//echo '<h1>Unknown extension!</h1>';
		return false;
	}

	$uploaddir='uploads/'.$part.'/'.$id.'/';
	$i=2;
	while(is_dir($uploaddir)&&!chmod($uploaddir, 0755))
	{
		$uploaddir='uploads/'.$part.'/'.$id.'_'.$i.'/';
		$i++;
	}
	$uploaddir=$uploaddir.date("Y-m-d").'/';
	if(!is_dir($uploaddir))
	{
		mkdir($uploaddir, 0755, true);
	}
	if(!is_dir($uploaddir."thumb/"))
	{
		mkdir($uploaddir."thumb/", 0755, true);
	}

	//if file_exists
	$i=2;
	$chk_file=$uploaddir.$name;
	while(file_exists($chk_file))
	{
		$name=$original."_".$i.".".$mime;
		$chk_file=$uploaddir.$name;
		$i++;
	}

	if(copy($_FILES[$field_name]['tmp_name'], $uploaddir.$name))
	{
		$arr_insert=array(
					"im_name" => $name,
					"im_path" => '/'.$uploaddir,
					"im_type" => $part
		);
		Image::insert($arr_insert);
		$arr_insert2=array(
					"image_id" => mysql_insert_id(),
					"other_id" => $id,
					"rel_type" => $part
		);
		RelImageOther::insert($arr_insert2);

		//create thumb
		switch($mime)
		{
			case "jpg":
			case "jpeg":
				$img=imagecreatefromjpeg("{$uploaddir}{$name}");
				break;
			case "png":
				$img=imagecreatefrompng("{$uploaddir}{$name}");
				break;
			case "gif":
				$img=imagecreatefromgif("{$uploaddir}{$name}");
				break;
		}
		$width=imagesx($img);
		$height=imagesy($img);
		$thumbWidth="115";
		$new_width=$thumbWidth;
		$new_height=floor($height*($thumbWidth/$width));
		$tmp_img=imagecreatetruecolor($new_width, $new_height);
		imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		switch($mime)
		{
			case "jpg":
			case "jpeg":
				imagejpeg($tmp_img, $uploaddir."thumb/".$name);
				break;
			case "png":
				imagepng($tmp_img, $uploaddir."thumb/".$name);
				break;
			case "gif":
				imagegif($tmp_img, $uploaddir."thumb/".$name);
				break;
		}
		// 		echo "با موفقیت آپلود شد";
		return true;
	}
	else
	{
		// Show an error message should something go wrong.
		//echo "متاسفانه عملیات آپلود با مشکل مواجه شد";
		return false;
	}
}
