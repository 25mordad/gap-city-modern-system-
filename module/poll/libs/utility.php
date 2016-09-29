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

function smarty_function_get_pollanswer($params, &$smarty)
{
	//$params['id']
	$GLOBALS['GCMS']->assign('getpollanswer',PollAnswer::get(array("id_question" => $params['id']), true));


}

function smarty_function_count_poll_result($params, &$smarty)
{
	echo PollResult::get_count(array("id_answer" => $params['id_answer']));
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