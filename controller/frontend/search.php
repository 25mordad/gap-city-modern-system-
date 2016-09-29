<?php

/**
 * search.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > search
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function page()
{
	if(isset($_GET['q'])&&trim($_GET['q'])!="")
	{
		//TODO include other pg_types?
		$search=str_replace(" ", "%", htmlspecialchars(trim($_GET['q']), ENT_QUOTES));
		if(!isset($_GET['paging']))
			$_GET['paging']=1;
		$max_results=30;
		$arr_get=array(
					"pg_type" => "page",
					"pg_status" => "publish",
					"search" => "%".$search."%"
		);
		$order=array(
					"by" => "date_created",
					"sort" => "DESC"
		);
		$limit=array(
					"start" => (($_GET['paging']*$max_results)-$max_results),
					"end" => $max_results
		);
		$finds=Page::get($arr_get, true, $order, $limit);
		if(count($finds)>0)
		{
			foreach($finds as $find)
			{
				$temp=explode($search, strip_tags($find->pg_content), 2);
				$templen=strlen($temp[0]);
				if($templen>150)
				{
					$templen=$templen-110;
				}
				$temp[0]=substr($temp[0], $templen);
				$temp[0]=substr($temp[0], strpos($temp[0], " "));
				$temp[0]=" ... ".$temp[0];
				$find->pg_content=$temp[0]."<span style=\"color:red;background-color:yellow\" >"
						.$search."</span>"." ... ";
			}
			$GLOBALS['GCMS']->assign('finds', $finds);
			$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));
			return;
		}
	}
	$GLOBALS['GCMS']->assign('finds', "false");
}
