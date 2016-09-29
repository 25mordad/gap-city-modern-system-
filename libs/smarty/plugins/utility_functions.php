<?php

/**
 * PLEASE | Do Not Use This File In Aheading Projects | PLEASE
 * 
 * Please use functions in smarty/utility/* instead of functions of this file.
 * Feel free to rewrite functions below in smarty/utility/*.
 * 
 * PLEASE | Do Not Use This File In Aheading Projects | PLEASE
 * 
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 * 
 */

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     utility_functions.php
 * Type:     function
 * Name:     Utility
 * Purpose:  Perform
 * Author: 	 RSES
 * -------------------------------------------------------------*/

function smarty_function_showtitle($params, &$smarty)
{
	$page=Page::get(array("id" => $params['id']));
	if($params['chagetoplus']=="true")
	{
		$letters=array(
					'~',
					'%',
					'=',
					'(',
					')',
					'*',
					'&',
					':',
					';',
					'!',
					'@',
					',',
					'.',
					'|',
					' '
		);
		$rtrn=str_replace($letters, '+', $page->pg_title);
	}
	else
	{
		$rtrn=$page->pg_title;
	}

	return $rtrn;
}

function smarty_function_box_pics($params, &$smarty)
{
	$box_pics=Image::get(array("im_type" => "box"), true, array("by" => "id", "sort" => "DESC"),
			$params['id']);
	$rtn="";
	if(isset($params['source']))
	{
		if($box_pics[0])
		{
			foreach($box_pics as $box_pic)
			{
				$rtn=$box_pic->im_path.$box_pic->im_name ;
			}
		}
	}
	else
	{
		if($box_pics[0])
		{
			foreach($box_pics as $box_pic)
			{
				$rtn.="<img src=\"".$box_pic->im_path.$box_pic->im_name."\" class=\""
						.$box_pic->rel_id."\" >";
			}
		}
	}
	return $rtn;
}

//please use get_last_image function smarty/utility/image.php instead of this

function smarty_function_showlastindeximage($params, &$smarty)
{
	if(isset($params['source']))
	{
		$id=$params['id'];

		$pg_img=Image::get(NULL, false, array("by" => "id", "sort" => "DESC"), $params['id']);

		if(!$pg_img)
		{
			$img="/uploads/index/defult/defult.jpg";
		}
		else
		{
			$extnz=explode(".", $pg_img->im_name);
			if(isset($params['thumb']))
			{
				$img=$pg_img->im_path.$params['thumb'].$extnz[0].".jpg";
			}
			else
			{
				$img=$pg_img->im_path.$extnz[0].".".$extnz[1];
			}

		}
	}
	else
	{
		$id=$params['id'];
		if(isset($params['thumb']))
			$thumb=$params['thumb'];
		(isset($params['align'])) ? $align=" align=\"$params[align]\" " : $align="";
		(isset($params['class'])) ? $class=" class=\"$params[class]\" " : $class="";
		(isset($params['size'])) ? $size=" width=\"$params[size]\" " : $size="";

		$pg_img=Image::get(NULL, false, array("by" => "id", "sort" => "DESC"), $params['id']);

		if(!$pg_img)
		{
			$img="<img src=\"/uploads/index/defult/defult.jpg\" $size  $align $class  />";
		}
		else
		{
			if(isset($thumb))
			{
				$extnz=explode(".", $pg_img->im_name);
				$img=" <img src=\"".$pg_img->im_path."$thumb".$extnz[0]
						.".jpg\" $size  $align $class /> ";
			}
			else
			{
				$extnz=explode(".", $pg_img->im_name);
				$img=" <img src=\"".$pg_img->im_path.$extnz[0]
						.".$extnz[1]\" $size  $align $class /> ";
			}

		}

	}

	return $img;
}

function smarty_function_show_pg_title($params, &$smarty)
{
	$pg=Page::get(array("id" => $params['id']));
	return $pg->pg_title;
}

function smarty_function_show_value_user_param($params, &$smarty)
{
	$row=MetaUser::get(array("id_user" => $params['id_user'], "name" => "param_".$params['name']));
	(isset($row->value)) ? $rt=$row->value : $rt="";
	return $rt;
}

function smarty_function_show_id_user_param($params, &$smarty)
{
	$row=MetaUser::get(array("id_user" => $params['id_user'], "name" => "param_".$params['name']));
	(isset($row->id)) ? $rt=$row->id : $rt="NOT_RESULT";
	return $rt;
}

function smarty_function_show_value_user_credit($params, &$smarty)
{
	$row=MetaUser::get(array("id_user" => $params['id_user'], "name" => "credit"));
	(isset($row->value)) ? $rt=$row->value : $rt="0";
	return $rt;
}

function smarty_function_show_id_user_credit($params, &$smarty)
{
	$row=MetaUser::get(array("id_user" => $params['id_user'], "name" => "credit"));
	if(isset($row->id))
	{
		$rt=$row->id;
	}
	else
	{
		$arr_new_meta=array(
					"id_user" => $params['id_user'],
					"name" => "credit",
					"value" => 0,
		);

		MetaUser::insert($arr_new_meta);
		$row=MetaUser::get(array("id_user" => $params['id_user'], "name" => "credit"));
		$rt=$row->id;
	}
	return $rt;
}

function smarty_function_show_username($params, &$smarty)
{
	$GLOBALS['GCMS']->assign('show_username', User::get(array("id" => $params['id'])));
}

function smarty_function_showimggallery($params, &$smarty)
{

        (isset($params['align'])) ? $align=" align=\"$params[align]\" " : $align="";
        (isset($params['class'])) ? $class=" class=\"$params[class]\" " : $class="";
        (isset($params['size'])) ? $size=" width=\"$params[size]\" " : $size="";
        (isset($params['id'])) ? $size=" id=\"$params[id]\" " : $id="";
        $im_name=explode(".", $params['im_name']);
        (isset($params['thumb'])) ? $rtrn="<img src=\"$params[im_path]thumb/$im_name[0].jpg\" $align $class $size $id />"
            : $rtrn="<img src=\"$params[im_path]$params[im_name]\" $align $class $size $id />";

	return $rtrn;
}

function smarty_function_find_childs($params, &$smarty)
{
	$GLOBALS['GCMS']
			->assign('find_childs',
					Page::get(array("parent_id" => $params['id'], "pg_status" => "publish"), true,
							array("by" => "id", "sort" => "DESC")));
}

function smarty_function_calc_remain_time($params, &$smarty)
{
	$date1=$params['start'];
	$date2=$params['end'];
	//$id       = $params['id'];

	$date1=is_int($date1) ? $date1 : strtotime($date1);
	$date2=is_int($date2) ? $date2 : strtotime($date2);

	if(($date1!==false)&&($date2!==false))
	{
		if($date2>=$date1)
		{
			$diff=($date2-$date1);

			if($days=intval((floor($diff/86400))))
				$diff%=86400;
			if($hours=intval((floor($diff/3600))))
				$diff%=3600;
			if($minutes=intval((floor($diff/60))))
				$diff%=60;
			$hours=$days*24+$hours;
			$rem_t=array(
						$days,
						$hours,
						$minutes,
						intval($diff)
			);

			echo "
               <script type=\"text/javascript\">
					$(function () {
						$('#$date2').countdown({until: '+$rem_t[1]h+$rem_t[2]m+$rem_t[3]s', format: 'HMS'});
					});
					</script>
					<div id=\"$date2\"></div>
                ";
			$GLOBALS['GCMS']->assign('rem_t', "true");
		}
		else
		{
			$GLOBALS['GCMS']->assign('rem_t', "false");
			echo "
            	حراج به پایان رسید
            	";
		}
	}

}

function smarty_function_all_menu_child($params, &$smarty)
{
	$arr_get=array(
				"parent" => $params['id']
	);
	$order=array(
				"by" => "order"
	);
	$GLOBALS['GCMS']->assign('menu_childs', Menu::get($arr_get, true, $order));
}

function smarty_function_find_image_by_id($params, &$smarty)
{
	if(isset($params['thumb']))
		$thumb=$params['thumb'];
	(isset($params['align'])) ? $align=" align=\"$params[align]\" " : $align="";
	(isset($params['class'])) ? $class=" class=\"$params[class]\" " : $class="";
	(isset($params['size'])) ? $size=" width=\"$params[size]\" " : $size="";
	$pg_img=Image::get(array("id" => $params['id']));

	if(!$pg_img)
	{
		$img="<img src=\"/uploads/index/defult/defult.jpg\" $size  $align $class  />";
	}
	else
	{
		if(isset($thumb))
		{
			$extnz=explode(".", $pg_img->im_name);
			$img=" <img src=\"".$pg_img->im_path."$thumb".$extnz[0]
					.".jpg\" $size  $align $class /> ";
		}
		else
		{
			$extnz=explode(".", $pg_img->im_name);
			$img=" <img src=\"".$pg_img->im_path.$extnz[0].".$extnz[1]\" $size  $align $class /> ";
		}

	}

	return $img;
}

function smarty_function_rand_string($params, &$smarty)
{
	$chars="abcdefghijklmnopqrstuvwxyz";
	$size=strlen($chars);
	$str="";

	if(isset($params['length']))
		for($i=0; $i<$params['length']; $i++)
		{
			$str.=$chars[rand(0, $size-1)];
		}
	return $str;

}

function smarty_function_list_pages_by_type_and_order($params, &$smarty)
{
	$GLOBALS['GCMS']
			->assign('pages',
					Page::get(array("pg_type" => $params['pg_type']), true,
							array("by" => $params['order_by'], "sort" => $params['order_type'])));
}
