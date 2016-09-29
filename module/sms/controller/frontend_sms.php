<?php

/**
 * frontend_sms.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > sms
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

if(file_exists($utilityfile))
	require_once($utilityfile);


function register()
{
	if(isset($_GET['send'])&&$_GET['send']=="true")
	{
		if(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha'])
		{
			$_SESSION['result']="کد تصویری را وارد نکرده‌اید و یا اشتباه وارد کرده‌اید";
			$_SESSION['alert']="warning";
		}
		else
		{
			//TODO cell validation? id_group? email?
			$arr_insert=array(
						"id_group" => 1,
						"name" => $_POST['name'],
						"cell" => $_POST['cell'],
						"email" => $_POST['email'],
						"status" => "active"
			);
			if(Contact::insert($arr_insert))
			{
				$_SESSION['result']="شماره تماس شما در سیستم ثبت شد";
				$_SESSION['alert']="success";
			}
			else
			{
				$_SESSION['result']="مشکلی در ثبت اطلاعات به وجود آمد، دوباره تلاش کنید";
				$_SESSION['alert']="error";
			}
		}
		header("location: /sms/register/");
	}
}

function autoresponse()
{
	if(isset($_GET['From'])&&isset($_GET['Message']))
	{
		require_once(__COREROOT__."/libs/utility/sms.php");
		$arr_send=array(
					"cell" => $_GET['From']
		);
		$part1=substr($_GET['Message'], 0, 5);
		$part2=substr($_GET['Message'], 5);
		if(strcasecmp($part1, "laziz")==0&&$part2>13726&&$part2%7==0)
		{
			//$arr_send['sms_text']="منتظر دیدار شما، 16 اسفند، ساعت 17، سالن شهید دستغیبlazizfars.com";
			if(Contact::get_count(
					array(
								"id_group" => 1,
								"name" => $_GET['From'],
								"cell" => $_GET['From'],
								"status" => "active"
					))==0)
			{
				$arr_insert=array(
							"id_group" => 2,
							"name" => $_GET['From'],
							"cell" => $_GET['From'],
							"email" => "",
							"status" => "active"
				);
				Contact::insert($arr_insert);
			}
		}
		else
		{
			$arr_send['sms_text']="شماره سریال اشتباه می باشد. لطفا سریال را بررسی و مجددا ارسال فرمایید";
		}
		//send_sms($arr_send);
	}
}
	