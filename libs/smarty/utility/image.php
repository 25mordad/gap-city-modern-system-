<?php

/**
 * image.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Smarty Utility Plugins.
 * Main use: getting images & their info 
 * Functions may use in tpl files.
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function smarty_function_get_last_image($params, &$smarty)
{
	$arr_get=array(
				"im_type" => $params['type']
	);
	$order=array(
				"by" => "id",
				"sort" => "DESC"
	);

	/**
	 * This If below is for an old bug in last version...
	 * Type of images in page madule was saved index_page.
	 */
	if($params['type']=="page")
		$arr_get['im_type_or']="index_page";

	$pg_img=Image::get($arr_get, false, $order, $params['id']); //$param['id'] is the join parameter (other_id)

	if(isset($params['source']))
	{
		if(!$pg_img)
		{
			$img="/uploads/index/defult/defult.jpg";
		}
		else
		{
			if(isset($params['thumb']))
			{
				$img=$pg_img->im_path.$params['thumb'].$pg_img->im_name;
			}
			else
			{
				$img=$pg_img->im_path.$pg_img->im_name;
			}
		}
	}
	else
	{
		if(isset($params['thumb']))
			$thumb=$params['thumb'];
		(isset($params['align'])) ? $align=" align=\"$params[align]\" " : $align="";
		(isset($params['class'])) ? $class=" class=\"$params[class]\" " : $class="";
		(isset($params['size'])) ? $size=" width=\"$params[size]\" " : $size="";

		if(!$pg_img)
		{
			if(isset($params['show_default']) && $params['show_default']=="false")
				$img="";
			else
				$img="<img src=\"/uploads/index/defult/defult.jpg\" $size  $align $class  />";
		}
		else
		{
			if(isset($thumb))
			{
				$img=" <img src=\"".$pg_img->im_path."$thumb".$pg_img->im_name
						."\" alt=\"".$pg_img->im_name."\" $size  $align $class /> ";
			}
			else
			{
				$img=" <img src=\"".$pg_img->im_path.$pg_img->im_name."\" alt=\"".$pg_img->im_name."\" $size  $align $class /> ";
			}
		}
	}
	
	return $img;
}

function smarty_function_get_rand_files($params, &$smarty)
{
    //$params['count'] , $params['type'] , 
	$arr_get=array(
				"rel_type" => $params['type']
	);
	$order=array(
				"by" => "RAND()",
                "limit" => $params['count']
	);
	$limit=array(
			"start" => $params['count']
	);
	$GLOBALS['GCMS']
				->assign('getrandfiles',
						RelImageOther::get($arr_get, true, $order,$limit));

	
    
}
function smarty_function_get_files($params, &$smarty)
{
    //$params['start'] , $params['end'] , $params['type'] , $params['by'] , $params['sort'] , $params['other_id'] , 
	$arr_get=array(
				"rel_type" => $params['type'],
                "other_id" => $params['other_id']
	);
	$order=array(
                "by"   => $params['by'] ,
                "sort" => $params['sort']
	);
    if (isset($params['start']))
	   $limit=array("start" => $params['start'],"end"   => $params['end']);
	
    $GLOBALS['GCMS']->assign('getfiles',RelImageOther::get($arr_get, true, $order,$limit));

}
function smarty_function_get_file($params, &$smarty)
{
    //$params['id']  
    $arr_get=array(
        "id" => $params['id']

    );

    $GLOBALS['GCMS']
        ->assign('getfile',
            Image::get($arr_get, false));



}
function smarty_function_get_all_images($params, &$smarty)
{
    //$params['id']  $params['type']

    $GLOBALS['GCMS'] ->assign('getallimages',Image::get(array("im_type" => $params['type']), true, array("by" => "id","sort" => "ASC"), $params['id']));


}


