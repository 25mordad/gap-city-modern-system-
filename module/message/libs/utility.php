<?php
/**
 * utility.php
 *
 * This file is part of GCMS > MODULE LIBS
 * @author 25Mordad <25Mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

/**
 *
 * SMARTY
 *
 */

function smarty_function_getMessageTexts($params, &$smarty)
{
	//$params['id']
    $GLOBALS['GCMS']->assign('MessageTexts',Messagetext::get(array( "id_message"=> $params['id']  ), true , array("by"=>"date","sort"=>"DESC") ));
}

/**
 * 
 * UTILITY
 *
 */
/*
function SAMPLE()
{
	//SAMPLE
}
*/