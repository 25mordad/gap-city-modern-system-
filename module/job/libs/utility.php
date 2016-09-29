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
/*
 function smarty_function_SAMPLE($params, &$smarty)
 {
//$params['SAMPLE']
}
*/
function smarty_function_get_job_param($params, &$smarty)
{
	//$params['id_user'] $params['name']
	$row=MetaUser::get(array("id_user" => $params['id_user'], "name" => $params['name']));
	(isset($row->value)) ? $rt=$row->value : $rt="";
	return $rt;
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
function joburlanalyzer($url)
{

	$arr_url = array (
			"currentpage" => $url['paging'] ,
			"search"      => $url['search']  ,
			"marital"     => $url['marital'] ,
			"gender"      => $url['gender'] ,
			"sep"     	  => $url['sep']
	);
		
	return $arr_url;
}
function list_applicants($url)
{
	GLOBAL $max_results ;
	global $count_row;

	$url_sys = joburlanalyzer($url);//$url_sys['mode']
	$from = (($url_sys['currentpage'] * $max_results) - $max_results);

	$add_s_q = "";
	if ($url_sys['search'] != "NULL")$add_s_q = " AND ( main.username LIKE '%$url_sys[search]%' OR main.email LIKE '%$url_sys[search]%' )";

	$add_marital = "";
	if ($url_sys['marital'] != "off")$add_marital = " AND m.marital = '$url_sys[marital]' ";

	$add_gender = "";
	if ($url_sys['gender'] != "off")$add_gender = " AND m.gender = '$url_sys[gender]' ";

	$add_sep = "";
	if ($url_sys['sep'] != "off")$add_sep = " AND m.sep = '$url_sys[sep]' ";

	$whereterm = " WHERE TRUE
	$add_s_q $add_marital $add_gender $add_sep
	ORDER BY main.date_created DESC
	";

	$limitterm = " LIMIT $from , $max_results ";

	$innerjoins = "INNER JOIN
			(SELECT r1.id, r1.gender, r1.marital, r2.sep, r2.avatar FROM
			(SELECT  p1.id_user as id, p1.value as gender, p2.value as marital FROM gcms_meta_user as p1 INNER JOIN
			gcms_meta_user as p2 ON p1.id_user=p2.id_user WHERE p1.name = 'job_gender' AND p2.name = 'job_marital') as r1 INNER JOIN
			(SELECT  p3.id_user as id, p3.value as sep, p4.value as avatar FROM gcms_meta_user as p3 INNER JOIN
			gcms_meta_user as p4 ON p3.id_user=p4.id_user WHERE p3.name = 'job_sep' AND p4.name = 'job_avatar') as r2 on r1.id=r2.id)
			as m ON m.id = main.id";

	$query = "
			SELECT main.id, main.username, m.avatar, m.gender, m.marital, m.sep
			FROM gcms_user as main ".$innerjoins.$whereterm . $limitterm ;

	$count_row = $GLOBALS['GCMS_DB']->get_results("SELECT COUNT(*) as Num FROM gcms_user as main ".$innerjoins.$whereterm );
	$pages = $GLOBALS['GCMS_DB']->get_results($query);

	return $pages;

}