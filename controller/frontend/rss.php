<?php

/**
 * rss.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > rss
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function index()
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
	
    $rss_channel = new RssGenerator_channel();
    $rss_channel->atomLinkHref   = "";
    $rss_channel->title          = $GLOBALS['GCMS_SETTING']['seo']['title'];
    $rss_channel->link           = "page";
    $rss_channel->description    = $GLOBALS['GCMS_SETTING']['seo']['description'];
    $rss_channel->language       = "fa";
    $rss_channel->generator      = "Gatriya CMS ::GCMS @version 2.0.1 @copyright 2011 RSES.ir";
    $rss_channel->managingEditor = "Support@rses.ir";
    $rss_channel->webMaster      = "webMaster";
    
    

    $arr_get=array(
    		"pg_type" => "news",
    		"pg_status" => "publish"
    );
    $order=array(
    		"by" => "date_created",
    		"sort" => "DESC"
    );
    $limit=array(
    		"start" => 0,
    		"end" => 20
    );
    $news_list = Page::get($arr_get, true, $order, $limit);
    
    foreach ($news_list as $row)
    {             
        $item = new RssGenerator_item();
        $item->title       = $row->pg_title;
        $item->description = $row->pg_excerpt;
        $item->link        = "http://".$_SERVER['HTTP_HOST']."/news/show/".$row->id;
        $item->guid        = "http://".$_SERVER['HTTP_HOST']."/news/show/".$row->id;
        $item->pubDate     = $row->date_created;
        $rss_channel->items[] = $item;
    }
    $rss_feed = new RssGenerator_rss();
    $rss_feed->encoding = "UTF-8";
    $rss_feed->version = "2.0";
    header("Content-Type: text/xml");
    $GLOBALS['GCMS']->assign('rss_feed',$rss_feed->createFeed($rss_channel));
}
