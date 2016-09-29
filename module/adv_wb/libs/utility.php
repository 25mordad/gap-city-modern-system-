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

function smarty_function_find_number_of_student($params, &$smarty)
{
	$fnos = WbScoreStudent::find_number_of_student($params['type'],$params['id_student'],$params['id_class'],$params['id_lesson']);
	if (isset($fnos->number))
		$GLOBALS['GCMS']->assign('number_ls',$fnos->number);
	else
		$GLOBALS['GCMS']->assign('number_ls',"-");

}

/*
 * For old nokhbegan tpl
*/
function smarty_function_show_user_class_info($params, &$smarty)
{
	$id_student=$params['id_student'];
		$query = "
          SELECT class.id as id , class.name as name , class.text as text
            FROM `gcms_wb_rel_class_student` as r_cs 
             INNER JOIN gcms_wb_class as class on class.id = r_cs.id_class 	
            WHERE r_cs.`id_student` =$id_student
        ";
	$GLOBALS['GCMS']->assign('user_class_info',$GLOBALS['GCMS_DB']->get_results($query));
}
function smarty_function_show_lesson($params, &$smarty)
{
	$GLOBALS['GCMS']->assign('show_lesson',WbLesson::get(array("id" => $params['id'])));
}
/*
 * End
*/

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