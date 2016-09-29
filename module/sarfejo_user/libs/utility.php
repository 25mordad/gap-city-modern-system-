<?php
/**
 * utility.php
 *
 * This file is part of GCMS > MODULE LIBS
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

function smarty_function_get_sarfejo_user($params, &$smarty)
{
    //$params['id']
    $GLOBALS['GCMS']->assign('getsarfejouser', Sarfejo_user::get(array(
        "id" => $params['id'] ,
    )));
}

/**
 * 
 * UTILITY
 *
 */