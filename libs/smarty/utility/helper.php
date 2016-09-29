<?php

/**
 * helper.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Smarty Utility Plugins.
 * Main use: preparing html tags & paging
 * Functions may use in tpl files.
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function smarty_function_selectTagGenerator($params, &$smarty)
{

	$option="";
	$info=$params['info'];
	$default=$params['default'];
	$selected="";

	foreach($info as $key => $row)
	{
		$selected="";

		if($row['value']==$default)
		{
			$selected=" selected=\"selected\"";
		}

		$option.="<option value=\"".$row['value']."\"".$selected.">@@".$row['name']."@@</option>";
	}
	return $option;
}

function smarty_function_radioTagGenerator($params, &$smarty)
{
	$radio="";
	$selected="";
	$info=$params['info'];
	$default=$params['default'];
	$radioName=$params['radioName'];
	$class=$params['class'];
	$in_ul=false;
	if($params['ul']=="true")
		$in_ul=true;

	if($in_ul)
		$radio.="<ul>";
	foreach($info as $key => $row)
	{

		$selected="";
		if($row['value']==$default)
		{
			$selected=" checked";
		}

		if($in_ul)
			$radio.="<li>";
		$radio.="<label for=\"".$radioName.$row['value']."\" ><input type=\"radio\" name=\""
				.$radioName."\" class=\"".$class."\" value=\"".$row['value']."\"".$selected." id=\"".$radioName.$row['value']."\" />@@"
				.$row['name']."@@</label>";
		if($in_ul)
			$radio.="</li>";
	}
	if($in_ul)
		$radio.="</ul>";

	return $radio;
}

function smarty_function_changetoplus($params, &$smarty)
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
                '/',
				' '
	);
	echo str_replace($letters, '+', $params['title']);
}

function smarty_function_pagingurl($params, &$smarty)
{
	$url=$params['url'];
	$paging=$params['paging'];

	$ps=explode("?paging=", $url);
	$ps1=explode("&", $ps[1], 2);

	$new_url=$ps[0]."?paging=".$paging."&".$ps1[1];
	return $new_url;
}

function smarty_function_isactivemenu($params, &$smarty)
{
	//$params['menu_link'] $params['url'] $params['menu_id']   
	$url = explode("/", $params['url']);
	$mnl = explode("/", $params['menu_link']);
		$maxchek=count($mnl);
		//(count($mnl)>3 : $maxchek=3 ; $maxchek=count($mnl));
		if(count($mnl)>3)
			$maxchek=3;
		$validUrl  = "";
		$validLink = "";
		for ($i=1;$i<=$maxchek;++$i)
		{
			$validUrl .= $url[$i];
			if ($mnl[0]=="http:")
				$validLink .= $mnl[$i+2];
			else 
				$validLink .= $mnl[$i];
		}
	//echo $validUrl." - ".$validLink . " * " ;
	if($validUrl=="page")
		$validUrl= "";
	if($validLink=="page")
		$validLink= "";
	
	if (strnatcmp($validUrl,$validLink)==0)
		return true;
	/* else
	{
		$m=Menu::get(array("parent" => $params['menu_id']  ));
		if (isset($m->id))
			echo "p:".$params['menu_id']  ." + m:".$m->id ."+ mnlink:".$mnl[3];
	} */	
	
	/* if (count($url) == count($mnl))
	{
		$maxchek=count($mnl);
		if(count($mnl)>3)
			$maxchek=3;
		$st = false;
		for ($i=1;$i<=$maxchek;++$i)
		{
			if ($url[$i]==$mnl[$i])
				$st= true;
			else
				$st = false;				
		}
		//check parent
		if ($st==false)
		{
			$m=Menu::get(array("parent" => $params['menu_id']  ));
			if (isset($m->id))
				$st = true; 
		}
		
	} */
	
	//return $st;
	
}
