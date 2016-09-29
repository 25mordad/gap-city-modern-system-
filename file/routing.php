<?php

/**
 * routing.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the layer for controlling the system.
 * This file routs the project.
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */
$not_modules=array(
		"error404",
		"auth",
		"admin",
		"routing",
		"operator",
		"page",
		"box",
		"comment",
		"file",
		"menu",
		"setting",
		"statistic",
		"map",
		"search"
);


//Mapping urls
$special_routing=false;
$routs=Routing::get(NULL, true);
foreach($routs as $rout)
{
	if($rout->url==$GLOBALS['GCMS_ROUTER']->request_uri)
	{

		if($rout->action_id=="0")
			$GLOBALS['GCMS_ROUTER']->map($rout->url, array('backend' => 'false', 'controller' => $rout->module, 'action' => $rout->action));
		else
			$GLOBALS['GCMS_ROUTER']->map($rout->url, array('backend' => 'false', 'controller' => $rout->module, 'action' => $rout->action, 'id' => $rout->action_id), array('id' => '[\d]{1,8}'));
		$special_routing=true;
	}
}
if(!$special_routing)
{
	$GLOBALS['GCMS_ROUTER']->map('/login', array('backend' => 'true', 'controller' => 'auth', 'action' => 'login'));
	$GLOBALS['GCMS_ROUTER']->map('/logout', array('backend' => 'true', 'controller' => 'auth', 'action' => 'logout'));
	$GLOBALS['GCMS_ROUTER']->map('/forgot', array('backend' => 'true', 'controller' => 'auth', 'action' => 'forgot'));
	$GLOBALS['GCMS_ROUTER']->map('/gadmin', array('backend' => 'true', 'controller' => 'admin'));
	$GLOBALS['GCMS_ROUTER']->map('/gadmin/:controller', array('backend' => 'true'));
	$GLOBALS['GCMS_ROUTER']->map('/gadmin/:controller/:action', array('backend' => 'true'));
	$GLOBALS['GCMS_ROUTER']->map('/gadmin/:controller/:action/:title', array('backend' => 'true'), array('title' => '[a-zA-Z_\+\-%]+'));
	$GLOBALS['GCMS_ROUTER']->map('/gadmin/:controller/:action/:id', array('backend' => 'true'), array('id' => '[\d]{1,8}'));
	$GLOBALS['GCMS_ROUTER']->map('/gadmin/:controller/:action/:id/:title', array('backend' => 'true'), array('id' => '[\d]{1,8}', 'title' => '[a-zA-Z0-9_\+\-%]+'));
	$GLOBALS['GCMS_ROUTER']->map('/', array('backend' => 'false', 'controller' => 'page'));
	$GLOBALS['GCMS_ROUTER']->map('/error404', array('backend' => 'false', 'controller' => 'error404'));
	$GLOBALS['GCMS_ROUTER']->map('/:controller', array('backend' => 'false'));
	$GLOBALS['GCMS_ROUTER']->map('/:controller/:action', array('backend' => 'false'));
	$GLOBALS['GCMS_ROUTER']->map('/:controller/:action/:id', array('backend' => 'false'), array('id' => '[\d]{1,8}'));
	$GLOBALS['GCMS_ROUTER']->map('/:controller/:action/:id/:title', array('backend' => 'false'), array('id' => '[\d]{1,8}', 'title' => '[a-zA-Z0-9_\+\-%]+'));
}
$GLOBALS['GCMS_ROUTER']->execute();
//Setting routing variables
if($GLOBALS['GCMS_ROUTER']->backend=="true")
	$section="backend";
else
	$section="frontend";
$part=$GLOBALS['GCMS_ROUTER']->controller;
$GLOBALS['GCMS']->assign('part', $part);
if(isset($GLOBALS['GCMS_ROUTER']->action))
{
	$action=$GLOBALS['GCMS_ROUTER']->action;
	$GLOBALS['GCMS']->assign('action', $action);
}
else
{
	header("location: /error404?error=rout");
	exit();
}
//Redirecting if necessary
if($section=="backend"&&$part!="auth")
{
	if(!isset($_SESSION["username"]))
	{
		header("location: /login?redirect=".$_SERVER["REQUEST_URI"]);
		exit();
	}
}
//Include controller
if($GLOBALS['GCMS_ROUTER']->title=='AjaxController')
{
	require_once(__COREROOT__."/file/runall_".$section.".php");
	
	if (!in_array($part, $not_modules))
		include "./core/module/$part/controller/ajax.php";
	else
		include "./core/file/ajax_".$section.".php";
	
	exit();
}
else
{
	$f="./core/controller/".$section."/".strtolower($part).".php";
	
	require_once(__COREROOT__."/file/runall_".$section.".php");
	if(file_exists($f))
	{
		
		if(!in_array($part, $not_modules)&&$GLOBALS['GCMS_MODULE'][$part]!='active')
		{
			
			header("location: /error404?error=Config&l=16&module=".$part);
			exit();
		}
		else if($part=="register"&&$GLOBALS['GCMS_MODULE']['user']!='active')
		{
			header("location: /error404?error=Config&l=16&module=user");
			exit();
		}
		
		include_once $f;
	}
	elseif (!in_array($part, $not_modules))
	{
		
		$f="./core/module/".strtolower($part)."/controller/".$section."_".$part.".php";
		if(file_exists($f))
		{
			include_once $f;
		}else{
			header("location: /error404?error=routModule");
			exit();
		}
		
	}else{
		header("location: /error404?error=rout");
		exit();
	}
}
//Setting alerts
if(isset($_SESSION['alert']))
{
	$GLOBALS['GCMS']->assign('result', $_SESSION['result']);
	$GLOBALS['GCMS']->assign('alert', $_SESSION['alert']);
	unset($_SESSION['result']);
	unset($_SESSION['alert']);
}
//Calling controller function
if($action=="new" || $action=="list")
	$action=$action."_".$part;
if(function_exists($action))
{
	if(isset($GLOBALS['GCMS_ROUTER']->id))
		$action($GLOBALS['GCMS_ROUTER']->id);
	else
		$action();
}
else
{
	header("location: /error404?error=".$part."&reason=function_".$action."_not_exists");
	exit();
}

