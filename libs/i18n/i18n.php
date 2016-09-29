<?php

function i18n_get_language()
{/*
 if(!isset($_COOKIE["lang"]))
 {
 setcookie("lang", "en", time()+30000);
 return "en";
 }
 else
 {
 return $_COOKIE["lang"];
 }
  */
/*
 $lang_variable = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
 if (empty($lang_variable))
 {
 $lang_variable = 'en';
 }
 return $lang_variable;
 */
	if(!isset($_SESSION["language"]))
	{
		$_SESSION["language"]=$GLOBALS['GCMS_SETTING']['general']['language'];
	}
	return $GLOBALS['GCMS_SETTING']['general']['language'];
}

function i18n_substitute_text($tpl_output, &$smarty)
{
	global $i18n_tokens;
	require_once(__COREROOT__.'/i18n/lang_'.i18n_get_language().'.php');
	/*
	 $f = 'i18n/lang_' . i18n_get_language() . '.php';
	 if (file_exists($f) && is_readable($f))
	 {
	 $s = file_get_contents($f);
	 @eval($s);
	 }
	 else
	 {
	 echo "No file access" . $f . " for " . __FILE__;
	 }
	 */
	return preg_replace_callback('/@@(.+?)@@/', 'i18n_substitute_text_token', $tpl_output);
}

function i18n_substitute_text_token($token)
{
	global $i18n_tokens;
	$a=trim($token[1]);
	if(isset($i18n_tokens[$a]))
	{
		// found
		return $i18n_tokens[$a];
	}
	else
	{
		// not found, new entry in language file is created
		$f=__COREROOT__.'/i18n/lang_'.i18n_get_language().'.php';
		if(file_exists($f)&&is_writeable($f))
		{
			$s=file_get_contents($f);
			@eval($s);
		}
		else
		{
			echo "No file access for ".$f." on ".__FILE__."<br>";
			return $token;
		}
		if(isset($i18n_tokens[$a]))
		{
			return $i18n_tokens[$a];
		}

		$i18n_tokens[$a]=$a;
		//$s = '$i18n_tokens' . "['" . $a . "']" . "='" . $a . "'; //new" . PHP_EOL;
		//$handle = fopen($f, 'a');
		//if ($handle)
		//{
		//    fwrite($handle, $s);
		//    fclose($handle);
		//}
		return $a;
	}
}
