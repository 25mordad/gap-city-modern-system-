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

/* function smarty_function_find_special_param($params, &$smarty)
{
	//$params['id_product'] $params['id_product_group'] $params['param_tag']
    $GLOBALS['GCMS']->assign('findSpecialParam', RelProParam::get(array("id_product" => $params['id_product'],"id_product_group" =>$params['id_product_group'],"param_tag"=>$params['param_tag']), false, null, "param" ));
}
function smarty_function_getProduct($params, &$smarty)
{
    //$params['id']
    $arr_get=array(
        "id" => $params['id']
    );

    $GLOBALS['GCMS']
        ->assign('getProduct',
            Products::get($arr_get, false));
} */
/**
 * 
 * UTILITY
 *
 */
/* function select_product_parental($pg_type = "page", $id_not = "")
{
	$arr_get=array(
				"id_not" => $id_not,
				"parent_id" => 0,
				"pg_type" => $pg_type,
				"pg_status_not" => "delete"
	);
	$mothers=Page::get($arr_get, true);

	$i=0;
	foreach($mothers as $mother)
	{
		$result[$i]['value']=$mother->id;
		$result[$i]['name']=$mother->pg_title;
		$i++;

		$arr_get['parent_id']=$mother->id;
		$childs=Page::get($arr_get, true);
		if(isset($childs))
		{
			foreach($childs as $child)
			{
				$result[$i]['value']=$child->id;
				$result[$i]['name']=">> ".$child->pg_title;
				$i++;
				
				$arr_get['parent_id']=$child->id;
				$childs2=Page::get($arr_get, true);
				
				
				if(isset($childs2))
				{
					foreach($childs2 as $ch)
					{
						$result[$i]['value']=$ch->id;
						$result[$i]['name']=">>> ".$ch->pg_title;
						$i++;
					}
				}
			}
		}

	}
	return $result;
}

function smarty_function_find_special_model($params, &$smarty)
{
    // $params['modelSearch']
    $GLOBALS['GCMS']->assign('findSpecialModels', Products::get(array("modelSearch" => $params['modelSearch'] , "status" => "publish"),true));
} */
