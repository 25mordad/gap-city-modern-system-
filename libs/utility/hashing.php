<?php

/**
 * hashing.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Utility Component.
 * Main use: hashing passwords 
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function hashit($password, $salt)
{
	return sha1($password.$salt);
}

function saltit($username)
{
	return md5(rand(100000, 999999).$username.time());
}

function rndstring($length)
{
	$characters="0123456789abcdefghijklmnopqrstuvwxyz";
	$string="";

	for($p=0; $p<$length; $p++)
	{
		$string.=$characters[mt_rand(0, strlen($characters))];
	}
	return $string;
}

function cryptit($str)
{
	$result="";
	$type=rand(1, 3);
	if($type==1) //k
	{
		$unenc=array('0','1','2','3','4','5','6','7','8','9');
		$hash =array('q','w','r','t','k','e','y','v','a','n');
		$result.="k";
		$result.=str_replace($unenc, $hash, $str+13);
	}
	else if($type==2) //e
	{
		$unenc=array('0','1','2','3','4','5','6','7','8','9');
		$hash =array('d','v','o','r','b','a','h','m','n','z');
		$result.="e";
		$result.=str_replace($unenc, $hash, $str+31);
	}
	else if($type==3) //y
	{
		$unenc=array('0','1','2','3','4','5','6','7','8','9');
		$hash =array('e','p','s','t','f','i','n','g','x','j');
		$result.="y";
		$result.=str_replace($unenc, $hash, $str+131);
	}
	return $result;
}

function decryptit($str)
{
	$result=-1;
	$type=$str[0];
	if($type=="k")
	{
		$unenc=array('0','1','2','3','4','5','6','7','8','9');
		$hash =array('q','w','r','t','k','e','y','v','a','n');
		$result=str_replace($hash, $unenc, substr($str, 1))-13;
	}
	else if($type=="e")
	{
		$unenc=array('0','1','2','3','4','5','6','7','8','9');
		$hash =array('d','v','o','r','b','a','h','m','n','z');
		$result=str_replace($hash, $unenc, substr($str, 1))-31;
	}
	else if($type=="y")
	{
		$unenc=array('0','1','2','3','4','5','6','7','8','9');
		$hash =array('e','p','s','t','f','i','n','g','x','j');
		$result=str_replace($hash, $unenc, substr($str, 1))-131;
	}
	return $result;
}