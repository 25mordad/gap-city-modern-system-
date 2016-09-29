<?php

/**
 * ajax_frontend.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Use: frontend > AJAX Functions
 *
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

$controller=$_GET['controller'];
if(function_exists($controller))
{
	$controller();
}

function upload_file()
{

	$uploaddir='uploads/'.$_POST['part'].'/'.$_POST['id'].'/';
	$i=2;
	while(is_dir($uploaddir)&&!chmod($uploaddir, 0755))
	{
		$uploaddir='uploads/'.$_POST['part'].'/'.$_POST['id'].'_'.$i.'/';
		$i++;
	}
	$uploaddir=$uploaddir.date("Y-m-d").'/'.date("His").'/';
	if(!is_dir($uploaddir))
	{
		mkdir($uploaddir, 0755, true);
	}


	// The posted data, for reference
	$file=$_POST['value'];
	$name=$_POST['name'];
     if (isset($_POST['sz']))
    {
        $data = file_get_contents($file);
        $size = strlen($data);
        if ($size > $_POST['sz'])
            die("سایز فایل ". round($size/1000) ."K و  بیش از 155K");
    }
     if (isset($_POST['mx']))
    {
       $arr_get=array(
				"rel_type" => $_POST['part'],
                "other_id" => $_POST['id']
	   );

        $getfiles=RelImageOther::get_count($arr_get);
        if ($getfiles > $_POST['mx'] )
        {
          die ("<script type=\"text/javascript\">location.reload();</script>");
        }

    }


	// Get the mime & original
	$getMime=explode('.', $name);
	$mime=strtolower(end($getMime));
	$original=substr($name, 0, -1-strlen($mime));
	// Separate out the data
	$data=explode(',', $file);

	// Encode it correctly
	$encodedData=str_replace(' ', '+', $data[1]);
	$decodedData=base64_decode($encodedData);


	//if file_exists
	$i=2;
	$chk_file=$uploaddir.$name;
	while(file_exists($chk_file))
	{
		$name=$original."_".$i.".".$mime;
		$chk_file=$uploaddir.$name;
		$i++;
	}

	if( file_put_contents($uploaddir.$name, $decodedData) )
	{

		$arr_insert=array(
				"im_name" => $name,
				"im_path" => '/'.$uploaddir,
				"im_type" => $_POST['part']
		);
		Image::insert($arr_insert);
		$arr_insert2=array(
				"image_id" => mysql_insert_id(),
				"other_id" => $_POST['id'],
				"rel_type" => $_POST['part']
		);
		RelImageOther::insert($arr_insert2);


		// 		echo "با موفقیت آپلود شد";
	}
	else
	{
		// Show an error message should something go wrong.
		echo "متاسفانه عملیات آپلود با مشکل مواجه شد";
	}
}


function get_file()
{
    //$_POST['show'] {file=default | image} $_POST['maxwidth']


	$arr_get=array(
				"im_type" => $_POST['part']
	);
	$order=array(
				"by" => "id",
				"sort" => "DESC"
	);


	$images=Image::get($arr_get, true, $order, $_POST['id']); //$_POST['id'] is the join parameter (other_id)
	$imgstring="";
	if($images)
	{
	   if (isset($_POST['show']) and $_POST['show'] == "image")
       {
            foreach($images as $image)
    		{
    			$imgstring=$imgstring
    					."<a href=\"$image->im_path$image->im_name\" target=\"_blank\" ><div class=\"sh_thmb\" ><img src=\"$image->im_path$image->im_name\" width=\"$_POST[maxwidth]\"  > </div></a>";
    		}
       }else{
            foreach($images as $image)
    		{
    			$imgstring=$imgstring
    					."<a href=\"$image->im_path$image->im_name\" target=\"_blank\" ><div class=\"sh_thmb\" >$image->im_name</div></a>";
    		}
       }


	}
	else
	{
		$imgstring="هیچ فایلی آپلود نشده است";
	}
	echo "
	$imgstring
    <div class=\"clear\" ></div>";
}



