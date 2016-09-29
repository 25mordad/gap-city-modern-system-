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

function smarty_function_jobinfo_getgroupname($params, &$smarty)
{
    //$params['id']
	$group=SarfejoJobgroup::get(array("id" => $params['id']));
	return $group->name;
}
function smarty_function_get_sarfejojob_group_childs($params, &$smarty)
{
    //$params['id_parent']
    //$params['type']
    $GLOBALS['GCMS']->assign('getsarfejojobgroupchilds', SarfejoJobgroup::get(array(
        "type"   => $params['type'] ,
        "status" => "active" ,
        "parent" => $params['id_parent']
    ), true));
}
function smarty_function_get_sarfejojob_group($params, &$smarty)
{
    //$params['id']
    $GLOBALS['GCMS']->assign('getsarfejojobgroup', SarfejoJobgroup::get(array(
        "id"   => $params['id'] ,
    )));
}
function smarty_function_get_sarfejo_value_param($params, &$smarty)
{
    //$params['id_service']
    //$params['id_param']
    $getsarfejovalueparam = SarfejoServiceRelParam::get(array(
        "id_service"   => $params['id_service'] ,
        "id_param"   => $params['id_param'] ,
    ));
    if (count($getsarfejovalueparam) == 0)
        SarfejoServiceRelParam::insert(array(
            "id_service"   => $params['id_service'] ,
            "id_param"   => $params['id_param'] ,
        ));
    else
        $GLOBALS['GCMS']->assign('getsarfejovalueparam', $getsarfejovalueparam);
}
function smarty_function_get_sarfejo_last_img($params, &$smarty)
{
    //$params['id_parent']
    //$params['type']
    $GLOBALS['GCMS']->assign('getsarfejolastimg', SarfejoImg::get(array(
        "id_parent" => $params['id_parent'] ,
        "type"      => $params['type'] ,
    )));
}

function smarty_function_get_sarfejo_commentpd($params, &$smarty)
{
    //$params['id_comment']
    //$params['type']
    $GLOBALS['GCMS']->assign('getsarfejocommentpd', SarfejoCommentRelUser::get_count(array(
        "id_comment"       => $params['id_comment'] ,
        "user_action"      => $params['type'] ,
    )));
}
function smarty_function_get_sarfejo_group_childs($params, &$smarty)
{
    //$params['id']
    $GLOBALS['GCMS']->assign('getsarfejogroupchilds', SarfejoJobgroup::get(array("parent"=>$params['id'] , "status"=>"active"), true));
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