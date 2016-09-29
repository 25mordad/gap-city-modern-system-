<?php

/**
 * frontend_job.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > job
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/user/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

//TODO update functions with new Model
function index()
{
	$job_file = MetaUser::get(array("id_user" => $_SESSION["glogin_user_id"], "name" => "job_file"));
	if ($job_file)
	{
		header("location: /job/profile");
	}
	else
	{
		if(isset($_POST['new']))
		{
			$job_names =  array("job_file","job_avatar","job_marital","job_gender","job_sep","job_txt");
			for ($i = 0; $i < 6; $i++)
			{
				$arr_insert = array(
						"id_user"       => $_SESSION["glogin_user_id"],
						"name"      	=> $job_names[$i],
						"value"         => NULL
				);
				MetaUser::insert($arr_insert);
			}
			$_SESSION['result'] = "success";
			$_SESSION['alert'] = "success";
			header("location: /job/profile");

		}
	}
}

function list_job()
{
	GLOBAL $max_results ;
	global $count_row;
	$max_results = 20 ;
	if (!isset($_GET['search']))$_GET['search']="NULL";
	if (!isset($_GET['marital']))$_GET['marital']="off";
	if (!isset($_GET['gender']))$_GET['gender']="off";
	if (!isset($_GET['sep']))$_GET['sep']="off";
	if (!isset($_GET['paging']))header("location: /job/list/?paging=1&search=".$_GET['search']."&marital=".$_GET['marital']."&gender=".$_GET['gender']."&sep=".$_GET['sep']); ;

	$GLOBALS['GCMS']->assign('applicant_list',list_applicants($_GET));
	$GLOBALS['GCMS']->assign('paging',ceil($count_row[0]->Num / $max_results));
}

function profile()
{
	$job_names =  array("job_file","job_avatar","job_marital","job_gender","job_sep","job_txt");
	$job_info = array();
	for ($i = 0; $i < 6; $i++)
	{
		$job_info[$job_names[$i]] = MetaUser::get(array("id_user" => $_SESSION["glogin_user_id"], "name" => $job_names[$i]));
	}
	$GLOBALS['GCMS']->assign('job_info',$job_info);
	if (isset($_POST['edit']))
	{
		if (is_valid())
		{
			//upload file(s)
			if ($_FILES["job_file"]['tmp_name'] || $_FILES["job_avatar"]['tmp_name'])
			{
				$req_folder = '/uploads/job/'.$_SESSION["glogin_user_id"].'/'.date("Y-m-d").'/';
				$targetPath = str_replace('//','/',$_SERVER['DOCUMENT_ROOT'].$req_folder);
				mkdir($targetPath, 0755, true);
				for ($i = 0; $i < 2; $i++)
				{
					if (!$job_info[$job_names[$i]]->value && $_FILES[$job_names[$i]]['tmp_name'])
					{
						$fileParts  = pathinfo($_FILES[$job_names[$i]]['name']);
						$filename = $fileParts['filename'];
						$targetFile =  $targetPath . $filename ."." .$fileParts['extension'] ;
						$j = 1 ;
						while (file_exists($targetFile))
						{
							$filename = $fileParts['filename']."-".$j++;
							$targetFile =  $targetPath . $filename ."." .$fileParts['extension'] ;
						}
						move_uploaded_file($_FILES[$job_names[$i]]['tmp_name'],$targetFile);
						$arr_update = array(
								"id"       => $job_info[$job_names[$i]]->id,
								"value"    => $req_folder.$filename.".".$fileParts['extension']
						);
						MetaUser::update($arr_update);
					}
				}
			}

			//update other values
			for ($i = 2; $i < 6; $i++)
			{
				$arr_update = array(
						"id"       => $job_info[$job_names[$i]]->id,
						"value"    => $_POST[$job_names[$i]]
				);
				MetaUser::update($arr_update);
			}
			$_SESSION['result'] = "اطلاعات شما به روز شد";
			$_SESSION['alert'] = "success";
			header("location: /job/profile");

		}
		else
		{
			$_SESSION['result'] = "خطایی رخ داده است";
			$_SESSION['alert'] = "error";
			header("location: /job/profile" );
		}
	}
}

function is_valid()
{
	$validation = true;
	if ($_FILES['job_file']['tmp_name'])
	{
		$extension = end(explode(".", $_FILES["job_file"]["name"]));
		$typesArray = array("pdf","doc","docx");
		if (!in_array($extension,$typesArray))
		{
			$validation = false;
		}
	}
	if ($_FILES['job_avatar']['tmp_name'])
	{
		$extension = end(explode(".", $_FILES["job_avatar"]["name"]));
		$typesArray = array("jpg","gif","png");
		if (!in_array($extension,$typesArray) || $_FILES['job_avatar']['size'] > 150000)
		{
			$validation = false;
		}
	}
	return $validation;
}