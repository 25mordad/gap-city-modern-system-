<?php

/**
 * box.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Smarty Utility Plugins.
 * Main use: getting images & their info 
 * Functions may use in tpl box.
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */


function smarty_function_get_all_boximg($params, &$smarty)
{
    // $params['id']
    $GLOBALS['GCMS']->assign('getallboximg',Image::get(array("im_type" => "box"), true, array("by" => "id", "sort" => "DESC"),$params['id']));
}