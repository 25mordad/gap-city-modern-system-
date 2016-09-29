<?php

/**
 * page.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > page
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function index()
{
	$index=Page::get(array("pg_type" => "index"));
	if(isset($index))
	{
		$GLOBALS['GCMS']
				->assign('gcms_page_title',
						$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$index->pg_title);
		$GLOBALS['GCMS']
				->assign('boxes',
						Box::get(array("parent_id" => $index->id, "box_status" => "publish"), true,
								array("by" => "id")));
		$GLOBALS['GCMS']->assign('show_index', $index);
	}
	else
		header("location: /error404?error=page&reason=page_not_exist");
}

function show($id)
{

	$page=Page::get(array("id" => $id, "pg_type" => "page", "pg_status" => "publish"));
	if(isset($id)&&isset($page))
	{
		if($page->comment_status=="open")
		{
			require_once(__COREROOT__."/libs/utility/comment.php");
			if(isset($_GET['comment'])&&$_GET['comment']=="true")
			{
                if(isset($_POST['capcha'])&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']) )
                {
                    $_SESSION['result'] = "Capcha code error.";
                    $_SESSION['alert'] = "warning";
                    header("location: /page/show/".$page->id);
                }else{
                    new_comment($id, "page");
                    header("location: /page/show/".$id);
                    return;
                }

			}
			get_comments($id, "page");
		}
		$GLOBALS['GCMS']
				->assign('gcms_page_title',
						$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$page->pg_title);
		$GLOBALS['GCMS']
				->assign('boxes',
						Box::get(array("parent_id" => $id, "box_status" => "publish"), true,
								array("by" => "id")));
		$GLOBALS['GCMS']
				->assign('allkeywords',
						Keyword::get(NULL, true, array("by" => "rel_id", "sort" => "ASC"), NULL,
								$id));
		$GLOBALS['GCMS']
				->assign('all_parent',
						Page::get(
								array(
											"parent_id" => $id,
											"pg_type" => "page",
											"pg_status" => "publish"
								), true, array("by" => "date_created", "sort" => "DESC")));

        	$GLOBALS['GCMS']
				->assign('parent',Page::get(array("id" => $page->parent_id, "pg_type" => "page", "pg_status" => "publish")));

		$GLOBALS['GCMS']
				->assign('brothers',
						Page::get(
								array(
											"parent_id" => $page->parent_id,
											"pg_type" => "page",
											"pg_status" => "publish"
								), true, array("by" => "date_created", "sort" => "DESC")));

		$GLOBALS['GCMS']->assign('show_page', $page);

		if(isset($_GET['pagepaging']))
		{
			$GLOBALS['GCMS']->assign('ajaxpage', $_GET['pagepaging']);
			$GLOBALS['GCMS']->assign('pagepaging', $_GET['pagepaging']);
			$GLOBALS['GCMS']->display("tpl/page/child_content.tpl");
			die();
		}

        ////////form

    if ( isset($_GET['form']) )
	{

		if(isset($_POST['capcha'])&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']) )
		{
			$_SESSION['result'] = "Capcha code error.";
			$_SESSION['alert'] = "warning";
			header("location: /page/show/".$page->id);
			}else{
			//require_once (__COREROOT__."/file/custom_form.php");
            $param = $_POST;
            $id_param = key($param);
             foreach ( $param as &$p_value )
             {
                $p_value      = htmlspecialchars(trim($p_value),ENT_QUOTES);
                $text_form = $text_form . "- : " .$id_param ." :: ". $p_value . " <br/> ";
                $id_param = key($param);
             }
			if (isset($_FILES["file"]["name"]))
			{
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES["file"]["name"]);
				$extension = end($temp);
				if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/jpg")
				|| ($_FILES["file"]["type"] == "image/pjpeg")
				|| ($_FILES["file"]["type"] == "image/x-png")
				|| ($_FILES["file"]["type"] == "image/png"))
				&& ($_FILES["file"]["size"] < 200000)
				&& in_array($extension, $allowedExts))
				  {
				  if ($_FILES["file"]["error"] > 0)
				    {
				    $text_form = $text_form .  "Return Code: " . $_FILES["file"]["error"] . "<br>";
				    }
				  else
				    {
				    $text_form = $text_form .  "Upload: " . $_FILES["file"]["name"] . "<br>";
				    $text_form = $text_form .  "Type: " . $_FILES["file"]["type"] . "<br>";
				    $text_form = $text_form .  "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				    $text_form = $text_form .  "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
				
				      move_uploaded_file($_FILES["file"]["tmp_name"],
				      "uploads/form/" . $_FILES["file"]["name"]);
				      $text_form = $text_form .  "Stored in: " . $_SERVER['HTTP_HOST']."/uploads/form/" . $_FILES["file"]["name"];
				      
				    }
				  }
				else
				  {
				   $text_form = $text_form . " Invalid file <br/>";
				  }
			}
			$arr_email = array(
                    "from"     => $GLOBALS['GCMS_SETTING']['general']['email'],
                    "to"       => $GLOBALS['GCMS_SETTING']['general']['email'] , //"support@rses.ir",
                    "subject"  => "form ".$_SERVER['HTTP_HOST'],
                    "text"     => $text_form,
                    "sign"     => "::ارسال شده توسط سیستم::",
                    "URL"      => "آدرس سایت :: ".$_SERVER['HTTP_HOST'],

			);
			$sendmail = new Email();
			$sendmail = new Email();
			$sendmail->set("html", true);
			$sendmail->getParams($arr_email);
			$sendmail->parseBody();
			$sendmail->setHeaders();

            if ($sendmail->send())
			{
				$_SESSION['result'] = "Thank you";
				$_SESSION['alert'] = "success";
				header("location: /page/show/".$page->id);
				}else{
				$_SESSION['result'] = "error_send_mail";
				$_SESSION['alert'] = "error";
				header("location: /page/show/".$page->id);
			}

		}

	}
        ///////form

	}
	else
		header("location: /error404?error=page&reason=page_not_exist");
}

function rss()
{

	function autoload_rss($class_name)
	{
		$file='core/libs/rss/'.$class_name.'.php';
		if(file_exists($file))
		{
			require_once($file);
		}
	}
	spl_autoload_register('autoload_rss');
	$page=Page::get(array("id"=>$_GET['pid']));
    $rss_channel = new RssGenerator_channel();
    $rss_channel->atomLinkHref   = "";
    $rss_channel->title          = $page->pg_title;
    $rss_channel->link           = "page";
    $rss_channel->description    = $page->pg_excerpt;
    $rss_channel->language       = "fa";
    $rss_channel->generator      = "Gatriya CMS ::GCMS @version 2.0.1 @copyright 2011 RSES.ir";
    $rss_channel->managingEditor = "Support@rses.ir";
    $rss_channel->webMaster      = "webMaster";
    
    
    

    $arr_get=array(
    		"pg_type" => "page",
    		"pg_status" => "publish",
    		"parent_id"=> $_GET['pid']
    );
    $order=array(
    		"by" => "date_created",
    		"sort" => "DESC"
    );
    $list = Page::get($arr_get, true, $order);
    
    foreach ($list as $row)
    {   
    	$pg_img      = Image::get(array("im_type"=>"page"),false, array(), $row->id);
        $item = new RssGenerator_item();
        $item->title       = $row->pg_title;
        $item->description = " <img src=\"".$pg_img->im_path."thumb/".$pg_img->im_name."\" alt=\"".$pg_img->im_name."\" align=\"left\" /> ".$row->pg_excerpt;
        $item->link        = "http://".$_SERVER['HTTP_HOST']."/page/show/".$row->id;
        $item->guid        = "http://".$_SERVER['HTTP_HOST']."/page/show/".$row->id;
        $item->pubDate     = $row->date_created;
        
        $rss_channel->items[] = $item;
    }
    $rss_feed = new RssGenerator_rss();
    $rss_feed->encoding = "UTF-8";
    $rss_feed->version = "2.0";
    header("Content-Type: text/xml");
    $GLOBALS['GCMS']->assign('rss_feed',$rss_feed->createFeed($rss_channel));
}

function  json($id)
{
	/*
	$arr_get=array(
			"pg_type"   => "page",
			"pg_status" => "publish",
			"parent_id" => $id
	);
	$order=array(
			"by" => "pg_title",
			"sort" => "ASC"
	);
	$list = Page::get($arr_get, true, $order);
	*/
	$query=$GLOBALS['GCMS_SAFESQL']->query(
        	"
        	SELECT pg_title as name , id , pg_excerpt , date_modified
			FROM  `gcms_page`
			WHERE pg_type = 'page' AND pg_status = 'publish'
    			[ AND gcms_page.`parent_id` =  %N ]
        	",array(
    			$id  ));

    $list = $GLOBALS['GCMS_DB']->get_results($query);
        	usort($list, "sort_compare" );
    die (print_r($list));
	foreach ($list as $row)
	{
		
		$img = Image::get(array("im_type"=>"page"),false, array(), $row->id );
		
		$page[]     = $row->id ;
		$page[]     = $row->name ;
		$page[]     = $img->im_path . $img->im_name;
		$page[]     = clean($row->pg_excerpt) ;
		$page[]     = $row->date_modified ;
		$jsonExp[]  = $page;
		$page = null;
		
	}
	
	header('Content-type: application/json');
	die ( json_encode(array('posts'=>$jsonExp)));

}
function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

function sort_compare($elem1, $elem2)
{
	return compare_internal( $elem1->name, $elem2->name );
}

function compare_internal($elem1, $elem2)
{
	// if one of the items don't have the sort index we're looking for
	// assume NULL > everything
	if (is_null( $elem1 ) && is_null( $elem2 ))
	{
		return 0; // assume they are equal
	}
	if (is_null( $elem1 ))
	{
		return 1;
	}
	else if (is_null( $elem2 ))
	{
		return -1;
	}
	
	// check to see if both sort index values are numbers, in which case, perform a natsort
	if (strlen( $elem1 ) && strlen( $elem2 ) &&
		ctype_digit( $elem1 ) && ctype_digit( $elem2 ))
	{
		return strnatcmp( $elem1, $elem2 );
	}
	
	// try to compare Persian strings	
	$sort_order = //'آاأإؤئبپتثجچحخدذرزژسشصضطظعغفقکگلمنوهی۱۲۳۴۵۶۷۸۹۰';
		array( 'آ', 'ا', 'أ', 'إ', 'ؤ', 'ئ', 'ب', 'پ', 'ت', 'ث', 'ج', 'چ', 'ح', 'خ', 'د',
			'ذ', 'ر', 'ز', 'ژ', 'س', 'ش', 'ص', 'ض', 'ط', 'ظ', 'ع', 'غ', 'ف', 'ق', 'ک', 'گ',
			'ل', 'م', 'ن', 'و', 'ه', 'ی', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰' );
	$sort_array = array();
	$index = 1;
	foreach ($sort_order as $item)
	{
		$sort_array[ $item ] = $index ++;
	}
	$len1 = strlen( $elem1 );
	$len2 = strlen( $elem2 );
	$failed = false;
	for ($i = 0, $j = 0; $i < $len1 && $j < $len2;)
	{
		$c1 = extract_utf8_char( $elem1, $i );
		$c2 = extract_utf8_char( $elem2, $j );
		
		if (array_key_exists( $c1, $sort_array ) &&
			array_key_exists( $c2, $sort_array ))
		{
			if ($sort_array[ $c1 ] == $sort_array[ $c2 ])
			{
				continue;
			}
			else
			{
				return $sort_array[ $c1 ] - $sort_array[ $c2 ];
			}
		}
		else
		{
			$failed = true;
			break;
		}
	}
	
	if ($failed == false)
	{
		return 0; // equal strings
	}
	
	return strcmp( $elem1, $elem2 );
}

function extract_utf8_char($str, &$i)
{
	$ascii_pos = ord( $str{ $i } );
	if ($ascii_pos < 192)
	{
		return $str{ $i ++ };
	}
	else if (($ascii_pos >= 240) && ($ascii_pos <= 255))
	{
		$i += 4;
		return substr( $str, $i - 4, $i );
	}
	else if (($ascii_pos >= 224) && ($ascii_pos <= 239))
	{
		$i += 3;
		return substr( $str, $i - 3, $i );
	}
	else
	{
		$i += 2;
		return substr( $str, $i - 2, $i );
	}
}
