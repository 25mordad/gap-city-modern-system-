<?php

/**
 * runall_frontend.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file will be excuted before other controllers in frontend section.
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */


$GLOBALS['GCMS']->assign('product_groups', Page::get(array("pg_type" => "product_group", "pg_status" => "publish"), true));
$arr_get=array(
    "status" => "publish"
);
$order=array(
    "by" => "id",
    "sort" => "DESC"
);
$limit=array(
    "start" => 0,
    "end" => 30
);
$GLOBALS['GCMS']->assign('all_rand_products', Products::get($arr_get, true, $order, $limit));

if(is_array($_SESSION['gcmsCart'])){
    $GLOBALS['GCMS']->assign('gcmsCart', $_SESSION['gcmsCart']);
}

////////////color and size
//size
$mySize = Page::get(array("status" => "publish","pg_type" => "size"),true);
foreach ($mySize as $ms)
{
	$SizeAry[$ms->pg_title]= "$ms->pg_content";
}
$GLOBALS['GCMS']->assign('sizes', $SizeAry);

//color
$myColor= Page::get(array("status" => "publish","pg_type" => "color"),true);
foreach ($myColor as $mc)
{
	$ColorAry[$mc->pg_title]= "$mc->pg_content";
}
$GLOBALS['GCMS']->assign('colors', $ColorAry);

///////////// NEW Arrivals

$newArrivalQuery = "
		SELECT * FROM `gcms_products`
		WHERE TRUE
		AND `status` = 'publish'
		ORDER BY `gcms_products`.`id` DESC
		LIMIT 0  , 10
";


$GLOBALS['GCMS']->assign('shopNewArrivals',$GLOBALS['GCMS_DB']->get_results($GLOBALS['GCMS_SAFESQL']->query($newArrivalQuery)));





