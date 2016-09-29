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

function get_images()
{
	$arr_get=array(
				"im_type" => $_POST['part']
	);
	$order=array(
				"by" => "id",
				"sort" => "DESC"
	);

	/**
	 * This If below is for an old bug in last version...
	 * Type of images in page madule was saved index_page. 
	 */
	if($_POST['part']=="page")
		$arr_get['im_type_or']="index_page";

	$images=Image::get($arr_get, true, $order, $_POST['id']); //$_POST['id'] is the join parameter (other_id)
	$imgstring="";
	if($images)
	{
		foreach($images as $image)
		{
			if($_POST['part']=="sound")
				$imgstring=$imgstring
				."<div class=\"right \" style=\"margin:5px;border:1px solid #ffffff\">
							<object width=\"200\" height=\"20\" data=\"http://".$_SERVER['HTTP_HOST']."/uploads/player.swf?mp3=http://".$_SERVER['HTTP_HOST']."$image->im_path/$image->im_name\" type=\"application/x-shockwave-flash\"></object>
										<param value=\"http://".$_SERVER['HTTP_HOST']."/uploads/player.swf?mp3=http://".$_SERVER['HTTP_HOST']."$image->im_path/$image->im_name\" name=\"movie\">
										<br/>$image->im_name <div class=\"del_img\" onclick=\"del_image($image->rel_id);show_images();\">X</div></div>";
			else
				$imgstring=$imgstring
					."<div class=\"sh_thmb\" ><a href=\"$image->im_path$image->im_name\" ><img src=\"$image->im_path/thumb/$image->im_name\" class=\"sh_thmb_img\" ></a><br/>$image->im_name <div class=\"del_img\" onclick=\"del_image($image->rel_id);show_images();\">X</div></div>";
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

function upload_image()
{
	$uploaddir='uploads/'.$_POST['part'].'/'.$_POST['id'].'/';
	$i=2;
	while(is_dir($uploaddir)&&!chmod($uploaddir, 0755))
	{
		$uploaddir='uploads/'.$_POST['part'].'/'.$_POST['id'].'_'.$i.'/';
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

	// The posted data, for reference
	$file=$_POST['value'];
	$name=$_POST['name'];

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

	if(file_put_contents($uploaddir.$name, $decodedData))
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
	}
	else
	{
		// Show an error message should something go wrong.
		echo "متاسفانه عملیات آپلود با مشکل مواجه شد";
	}
}

function del_image()
{
	RelImageOther::del($_POST['id']);
}

function add_folder()
{
	$name=$_POST['name'];
	$path=$_POST['path'];
	mkdir(str_replace('//', '/', $path."/$name"), 0755, true);
	echo $name."\nدر آدرس\n".$path."\nایجاد شد";
}

function get_path_nav()
{
	$path=explode("/", $_POST['path']);
	$path_nav="";
	$p_n="";
	foreach($path as $p)
	{
		if($p)
		{
			if($p!="uploads")
				$p_n.="/";
			$p_n.=$p;
			$path_nav.="<a href=\"file/?path=$p_n\"  >$p</a> &raquo; ";
		}
	}
	echo $path_nav;
}

function get_file_manager()
{
	$path=$_POST['path'];
	$show_dir="";
	$dir_handle=@opendir($path)or die("Unable to open $path");

	$dirs=array();
	$files=array();
	while(false!==($entry=readdir($dir_handle)))
	{
		$dirs[]=$entry;
	}
	closedir($dir_handle);
	sort($dirs);
	foreach($dirs as $dir)
	{
		if($dir=="."||$dir=="..")
			continue;
		$full_path=$path."/".$dir;
		if(is_dir($full_path))
		{
			$show_dir=$show_dir
					."
			<div class=\"folder\" >
			<a href=\"javascript:del_dir('$dir')\" title=\"پوشه $dir و تمام محتویات داخل آن حذف شود؟\" class=\"confirm_dialog\" >X</a>
			<div class='clear'></div>
			<a href=\"file/?path=$full_path\"><div class=\"path\" ></div></a>
			<div class=\"name\" >$dir</div>
			</div>
			";
		}
		else
		{
			$files[]=$dir;
		}
	}
	sort($files);
	foreach($files as $file)
	{
		$full_path=$path."/".$file;
		$fs=round(filesize($full_path)/1024, 0);
		$show_dir=$show_dir
				."
		<div class=\"file\" >
		<a href=\"javascript:del_file('$file')\" title=\"فایل $file حذف شود؟\" class=\"confirm_dialog\" >X</a>
		<div class='fs' >$fs kb</div>
		<div class='clear'></div>
		<a href=\"/$full_path\" target=\"_blank\"><div class=\"path\" ></div></a>
		<div class=\"copy\" ><textarea class=\"input_copy\" readonly=\"readonly\">http://$_SERVER[HTTP_HOST]/$full_path</textarea></div>
		<div class=\"name\" >$file</div>
		</div>
		";
	}
	$show_dir=$show_dir."<div class=\"clear\" ></div>";
	echo $show_dir;
}

function upload_file()
{
	$uploaddir=$_POST['path'].'/';

	// The posted data, for reference
	$file=$_POST['value'];
	$name=$_POST['name'];

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

	if(file_put_contents($uploaddir.$name, $decodedData))
	{
		// 		echo "با موفقیت آپلود شد";
	}
	else
	{
		// Show an error message should something go wrong.
		echo "متاسفانه عملیات آپلود با مشکل مواجه شد";
	}
}

function del_dir()
{
	$name=$_POST['name'];
	$path=$_POST['path'];
	require_once(__COREROOT__."/libs/utility/file.php");
	deleteDir($path."/".$name);
	//echo $name."\nدر آدرس\n".$path."\nپاک شد";
}


/**
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 */
function test_ajax()
{
	echo "testAJAX";
}















function del_file()
{
	$name=$_POST['name'];
	$path=$_POST['path'];
	unlink($path."/".$name);
	//echo $name."\nدر آدرس\n".$path."\nپاک شد";
}

function get_users()
{
	$users=User::get(array("status" => "active", "user_level" => $_POST['level']), true,
			array("by" => "date_created", "sort" => "DESC"), NULL,
			"param_".key($GLOBALS['GCMS_USER_PARAM']));
	next($GLOBALS['GCMS_USER_PARAM']);
	$result='<option value="">انتخاب کنید</option>';
	foreach($users as $user)
	{
		$par2=MetaUser::get(
				array("id_user" => $user->id, "name" => "param_".key($GLOBALS['GCMS_USER_PARAM'])));
		$value=$user->username;
		if($user->value!=""||$par2->value!="")
			$value=$value." (".$user->value." ".$par2->value.")";
		$result=$result."<option ";
		if(isset($_POST['user_id'])&&$_POST['user_id']==$user->id)
			$result=$result."selected=\"selected\" ";
		$result=$result." value=\"".$user->id."\">".$value."</option>";
	}
	prev($GLOBALS['GCMS_USER_PARAM']);
	echo $result;
}
/*  ****** NEW BACKEND */
function dropZone()
{
    $ds          = DIRECTORY_SEPARATOR;  //1

    $storeFolder = 'uploads';   //2

    if (!empty($_FILES)) {

        $tempFile = $_FILES['file']['tmp_name'];          //3

        $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4

        $targetFile =  $targetPath. $_FILES['file']['name'];  //5

        move_uploaded_file($tempFile,$targetFile); //6

    }
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    echo $targetPath;
}