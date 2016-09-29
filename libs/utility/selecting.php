<?php

/**
 * selecting.php
 *
 * This file is part of GCMS > CONTROLLER
 * The file is part of the Utility Component.
 * Main use: returning data in customized mode
 *
 * @author dahdash <dahdash@gmail.com>
 * @version 2.0
 *
 */

function select_page($pg_type = "page")
{
	$arr_get=array(
				"pg_type" => $pg_type,
				"pg_status_not" => "delete"
	);
	$order=array(
				"by" => "date_created",
				"sort" => "ASC"
	);
	$pages=Page::get($arr_get, true, $order);

	$i=0;
	foreach($pages as $page)
	{
		$result[$i]['value']=$page->id;
		$result[$i]['name']=$page->pg_title;
		$i++;
	}
	return $result;
}

function select_page_parental($pg_type = "page", $id_not = "")
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
			}
		}

	}
	return $result;
}

function select_main_menu()
{

	$arr_get=array(
				"parent" => "0"
	);
	$order=array(
				"by" => "order"
	);
	$menus=Menu::get($arr_get, true, $order);
	foreach($menus as $menu)
	{
		$result[$menu->id]=$menu->title;
	}
	return $result;
}

function select_group_contact()
{
	$group_contacts=GroupContact::get(array("status" => "active"), true);
	foreach($group_contacts as $group_contact)
	{
		$result[$group_contact->id]=$group_contact->name;
	}
	return $result;
}

function select_user()
{
	$users=User::get(array("status" => "active"), true,
			array("by" => "date_created", "sort" => "DESC"), NULL,
			"param_".key($GLOBALS['GCMS_USER_PARAM']));
	foreach($users as $user)
	{
		$value=$user->username;
		if($user->value!="")
			$value=$value." (".$user->value.")";
		$result[$user->id]=$value;
	}
	return $result;
}

function select_lesson($id_not = "")
{
	$lessons=WbLesson::get(array("id_not" => $id_not), true);
	foreach($lessons as $lesson)
	{
		$result[$lesson->id]=$lesson->name;
	}
	return $result;
}

function select_branch()
{
	$branches=WbBranch::get(NULL, true);
	foreach($branches as $branch)
	{
		$result[$branch->id]=$branch->name;
	}
	return $result;
}

function select_grade()
{
	$default_year=WbYear::get(array("default" => "true"));
	$grades=WbGrade::get(array("id_year" => $default_year->id), true);
	foreach($grades as $grade)
	{
		$result[$grade->id]=$grade->name;
	}
	return $result;
}

function select_number($start, $end)
{
	$result=array();
	for($i=$start; $i<=$end; ++$i)
	{
		$result[]=array(
					'name' => "$i",
					'value' => $i
		);
	}
	return $result;
}

function select_advance_menu()
{

	$arr_get=array(
				"parent" => "0"
	);
	$order=array(
				"by" => "group",
				"sort" => "DESC",
				"by2" => "order"
	);
	$mothers=AdvanceMenu::get($arr_get, true, $order);
	foreach($mothers as $mother)
	{
		$result[$mother->id]=$mother->title;
		$childs=AdvanceMenu::get(array("parent" => $mother->id), true, array("by" => "order"));
		if(isset($childs))
		{
			foreach($childs as $child)
			{
				$result[$child->id]="> ".$child->title;
				$grandchilds=AdvanceMenu::get(array("parent" => $child->id), true, array("by" => "order"));
				if(isset($grandchilds))
				{
					foreach($grandchilds as $grandchild)
					{
						$result[$grandchild->id]=">> ".$grandchild->title;
					}
				}
			}
		}
	
	}
	return $result;
}
