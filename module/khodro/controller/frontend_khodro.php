<?php

/**
 * frontend_khodro.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > SAMPLE
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */
//require_once(__COREROOT__."/libs/utility/hashing.php");
$utilityfile = __COREROOT__."/module/khodro/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);

function index()
{
    if (isset($_GET['errorreport']))
    {
        $arr_get['id']=$_POST['id_adv']/171819;
        $advers = KhodroAdver::get($arr_get);
        $arr_update['error_report_count'] = $advers->error_report_count+1;
        $arr_update['error_report_type'] = $_POST['error_report_type']. " | " . $advers->error_report_type;
        $arr_update['id']  = $_POST['id_adv']/171819;
        KhodroAdver::update($arr_update);
        $_SESSION['result']="اطلاعات شما با موفقیت ارسال شد";
        $_SESSION['alert']="success";
        header("location: ".$_POST['REQUEST_URI']);
    }

    //search Form
    if (isset($_GET['submit']) )
    {
        if (!isset($_SESSION["glogin_user_id"]))
            $idusr = 0;
        else
            $idusr = $_SESSION["glogin_user_id"];

        $arr_insert_search = array(
            "id_user" => $_SESSION["glogin_user_id"] ,
            "url"     => $_SERVER['REQUEST_URI'],
            "date"    => date("Y-m-d H:i:s")
            );


        KhodroSearch::insert($arr_insert_search);
        $_SESSION["glogin_userkhodro_sumsrch"] = $_SESSION["glogin_userkhodro_sumsrch"]+1;
    	/* if( !isset($_GET['id_brand']) or !isset($_GET['id_model']) or $_GET['id_brand'] == 0 or  $_GET['id_model'] == 0 )
    		header("location: /khodro"); */
    	//creat query
    	$now = date("Y-m-d H:i:s");


    	//preparing to query
    	$max_results=10;

    	if($_GET['id_brand']!="0")
    		$arr_search['id_brand'] = $_GET['id_brand'];

    	if($_GET['id_model']!="0")
    		$arr_search['id_model'] = $_GET['id_model'];

    	if($_GET['id_tip']!="0")
    		$arr_search['id_tip'] = $_GET['id_tip'];

    	if($_GET['year']!="0")
    		$arr_search['year'] = $_GET['year'];

    	if($_GET['color']!="0")
    		$arr_search['color'] = $_GET['color'];

    	if(isset($_GET['used_zero']))
    		$arr_search['used_zero'] = "true";

    		if(isset($_GET['auto_gear']))
    		$arr_search['auto_gear'] = "true";

    		if(isset($_GET['two_some']))
    		$arr_search['two_some'] = "true";

    		if($_GET['tip_form']!="0")
    		{
    			$add_q = "
    				INNER JOIN gcms_khodro_tip tip on tip.id = adver.id_tip
    				";
    			$add_q_w = " AND tip.tip_form =  '$_GET[tip_form]' ";
    		}else{
    			$add_q   = "";
    			$add_q_w = "";
    		}



    		$betweenfee = explode("-", $_GET['betweenfee']);

    		switch  ($_GET['rfee'])
    		{
    			case "notimportant":
    				$arr_search['minfee'] = "-1";
    				break;
    			case "less":
    				$arr_search['maxfee'] = $_GET['lessthan'];
    				break;
    			case "between":
    				$arr_search['minfee'] = $betweenfee[0];
    				$arr_search['maxfee'] = $betweenfee[1];
    				break;
    		}

    		$limit=array(
    			"start" => (($_GET['paging']*$max_results)-$max_results),
    			"end" => $max_results
    		);

    		$q = "
    			SELECT adver.*  FROM `gcms_khodro_adver` as adver
    			$add_q
    			WHERE TRUE
    			[ AND adver.`id_brand` =  %N ]
    			[ AND adver.`id_model` =  %N ]
    			[ AND adver.`id_tip`   =  %N ]
    			[ AND adver.`year` =  %N ]
    			[ AND CAST(adver.`fee` AS UNSIGNED) >=  %N ]
    			[ AND CAST(adver.`fee` AS UNSIGNED) <=  %N ]
    			[ AND adver.`color` =  %N ]
    			[ AND adver.`used_zero` =  %N ]
    			[ AND adver.`auto_gear` =  %N ]
    			[ AND adver.`two_some` =  %N ]
    			AND adver.adv_status = 'confirm'
    			AND adver.expire_date > '$now'
    			$add_q_w
				ORDER BY `adver`.`adv_type` DESC , `adver`.`register_date` DESC
    			";
    			$query=$GLOBALS['GCMS_SAFESQL']->query(
    			"
    			$q
    			[ LIMIT %I ][ , %I ]
    			",array(
    			$arr_search['id_brand'] ,
    			$arr_search['id_model'] ,
    			$arr_search['id_tip']   ,
    			$arr_search['year']     ,
    			$arr_search['minfee']   ,
    			$arr_search['maxfee']   ,
    			$arr_search['color']    ,
    			$arr_search['used_zero']    ,
    					$arr_search['auto_gear']    ,
    					$arr_search['two_some']    ,
    					$limit['start'],
    					$limit['end']
    			));
    	$count_query=$GLOBALS['GCMS_SAFESQL']->query(
    			"
    			$q
    			",array(
    					$arr_search['id_brand'] ,
    					$arr_search['id_model'] ,
    					$arr_search['id_tip']   ,
    					$arr_search['year']     ,
    					$arr_search['minfee']   ,
    					$arr_search['maxfee']   ,
    					$arr_search['color']    ,
    					$arr_search['used_zero']    ,
    					$arr_search['auto_gear']    ,
    					$arr_search['two_some']    ,
    					
    					
    	));
    	//echo $query;
    	$advs = $GLOBALS['GCMS_DB']->get_results($query);
    	$count_advs = $GLOBALS['GCMS_DB']->get_results($count_query);
    	//print_r(count($count_advs));

    	$GLOBALS['GCMS']->assign('advs', $advs);
    	$GLOBALS['GCMS']->assign('count_adv', count($count_advs));
    	$GLOBALS['GCMS']->assign('paging', ceil(count($count_advs)/$max_results));



        //filters
        //brands
        $now = date("Y-m-d H:i:s");
    	$query=$GLOBALS['GCMS_SAFESQL']->query(
    			"
    			SELECT  adver.`id_brand` , COUNT(adver.`id_brand`) as Num , brand.name  FROM `gcms_khodro_adver`  as adver
    			INNER JOIN `gcms_khodro_brand` as `brand` ON `brand`.`id` = `adver`.`id_brand`
    			WHERE  adver.adv_status = 'confirm'
    			AND adver.expire_date > '$now'
    			GROUP BY adver.`id_brand`
    			ORDER BY `Num` DESC
    			" ,$nol);
    	$brands = $GLOBALS['GCMS_DB']->get_results($query);
    	$GLOBALS['GCMS']->assign('brands', $brands);
        //models
        if ($_GET['id_brand'] != 0)
        {
 	        $now = date("Y-m-d H:i:s");
            $query_model=$GLOBALS['GCMS_SAFESQL']->query(
        	"
            SELECT  adver.`id_model` , COUNT(adver.`id_model`) as Num , model.model_name , model.year_type  FROM `gcms_khodro_adver`  as adver
            INNER JOIN `gcms_khodro_model` as `model` ON `model`.`id` = `adver`.`id_model`
            WHERE [ adver.`id_brand` =  %N ]
            AND adver.adv_status = 'confirm'
            AND adver.expire_date > '$now'
            GROUP BY adver.`id_model`
            ORDER BY `Num` DESC

        	",array($_GET['id_brand']));
            $GLOBALS['GCMS']->assign('models', $GLOBALS['GCMS_DB']->get_results($query_model));

        }

        if ($_GET['id_model'] != 0)
        {
            $query=$GLOBALS['GCMS_SAFESQL']->query(
        	"
            SELECT  adver.`id_tip` , COUNT(adver.`id_tip`) as Num , tip.tip_name  FROM `gcms_khodro_adver`  as adver
            INNER JOIN `gcms_khodro_tip` as `tip` ON `tip`.`id` = `adver`.`id_tip`
            WHERE
            [ adver.`id_brand` =  %N ]
            [ AND adver.`id_model` =  %N ]
            AND adver.adv_status = 'confirm'
            AND adver.expire_date > '$now'
            GROUP BY adver.`id_tip`
            ORDER BY `Num` DESC
        	",array(
            $_GET['id_brand'],
            $_GET['id_model']
            ));
            $GLOBALS['GCMS']->assign('tips', $GLOBALS['GCMS_DB']->get_results($query));
        }





    }else{
        if (!isset($_GET['sf']))
        {
             $now = date("Y-m-d H:i:s");
             $specadver_q=$GLOBALS['GCMS_SAFESQL']->query(
        	"
            SELECT adver.*  FROM `gcms_khodro_adver` as adver
    			WHERE TRUE
    			[ AND adver.`adv_type` =  %N ]
    			AND adver.adv_status = 'confirm'
    			AND adver.expire_date > '$now'
				ORDER BY `adver`.`register_date` DESC
                LIMIT 0 , 10
        	",array(
            "normal"
            ));

             $specadver = $GLOBALS['GCMS_DB']->get_results($specadver_q);
             $GLOBALS['GCMS']->assign('specadver', $specadver);
        }
            $now = date("Y-m-d H:i:s");
        	$query=$GLOBALS['GCMS_SAFESQL']->query(
        			"
        			SELECT  adver.`id_brand` , COUNT(adver.`id_brand`) as Num , brand.name  FROM `gcms_khodro_adver`  as adver
        			INNER JOIN `gcms_khodro_brand` as `brand` ON `brand`.`id` = `adver`.`id_brand`
        			WHERE  adver.adv_status = 'confirm'
        			AND adver.expire_date > '$now'
        			GROUP BY adver.`id_brand`
        			ORDER BY Num DESC 
        			" ,$nol);
			
            
            
        	$brands = $GLOBALS['GCMS_DB']->get_results($query);
        	if (isset($_GET['sf']))
        		usort($brands, "sort_compare" );
        	$GLOBALS['GCMS']->assign('brands', $brands);

    }

    //\search form

}
function register()
{

	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /khodro/profile");

	}
	else
	{

	   $GLOBALS['GCMS']->assign('brands', KhodroBrand::get($arr_get,true));


		if(isset($_GET['register']))
		{

			if(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha'])
			{
				$GLOBALS['GCMS']->assign('result', "کد تصویری را وارد نکرده اید و یا اشتباه وارد کرده اید.");
				$GLOBALS['GCMS']->assign('alert', "alarm");
			}
			else if($_POST['name']=="")
			{
				$GLOBALS['GCMS']->assign('result', "نام را وارد نکرده اید" )  ;
				$GLOBALS['GCMS']->assign('alert', "alarm");
			}
			else if($_POST['cell']=="")
			{
				$GLOBALS['GCMS']->assign('result', "موبایل را وارد نکرده اید" )  ;
				$GLOBALS['GCMS']->assign('alert', "alarm");

			}
			else
			{

				//checking duplicate username
				$chk_username=KhodroUser::get(array("cell" => $_POST['cell']));
				if(isset($chk_username))
				{
					$_SESSION['result']="شماره موبایل قبلا گرفته شده";
					$_SESSION['alert']="alarm";
					if ($_POST['user_type']=="reseller")
					header("location: /khodro/register?reseller=true");
					else
					header("location: /khodro/register");


				}
				else
				{
					require_once(__COREROOT__."/libs/utility/hashing.php");
					//adding user to db
					if ($_POST['user_type']=="normal")
					{
						$active = "active";
					}else{
						$active = "pending";
						if($_POST['office_name']=="")
						{
							$GLOBALS['GCMS']->assign('result', "نام نمایشگاه را وارد نکرده اید" )  ;
							$GLOBALS['GCMS']->assign('alert', "alarm");
							return false;
						}
					}
					$n_p=rndstring(4);
					$password_salt=saltit($_POST['cell']);
					$password=hashit($n_p, $password_salt);

					$mynameres = $_POST['nameres'];
					$mycode    = $_POST['code'];
					foreach ($mynameres as $key => $myn)
					{
						$srt .= $myn." ".$mycode[$key]." * ";
					}
					$arr_insert=array(
								"name"               => $_POST['name'],
								"office_name"        => $_POST['office_name'],
								"email"              => $_POST['email'],
                                "cell"               => $_POST['cell'],
                                "tell"               => $_POST['tell'],
                                "fax"                => $_POST['fax'],
                                "address"            => $_POST['address'],
                                "cell_vrfy"          => "NULL",
								"password"           => $password,
								"password_salt"      => $password_salt,
								"password_temp_code" => "NULL",
								"user_status"        => $active,
								"user_type"          => $_POST['user_type'],
								"created_date"       => date("Y-m-d H:i:s"),
								"res_list"           => $srt
					);
					if(KhodroUser::insert($arr_insert))
					{
						$new_id=mysql_insert_id();

						//sms send
						require_once(__COREROOT__."/libs/utility/sms.php");
						$arr_send=array(
        						"cell" => $_POST['cell'],
        						"sms_text" => "کلمه عبور شما : $n_p \n http://".$_SERVER['HTTP_HOST']
						);
						send_sms($arr_send);
						//send email

						$email_text="
				        کلمه عبور شما : $n_p
				 		";
						$arr_email=array(
            					"from" => "noreply@".$_SERVER['HTTP_HOST'],
            					"to" => $_POST['email'],
            					"subject" => "Register  ".$_SERVER['HTTP_HOST'],
            					"text" => "<div style=\"direction:rtl;text-align=justify;font-family: \"tahoma\";\" >".$email_text."</div>",
            					"sign" => ":: این ایمیل به صورت خودکار برای شما ارسال شده است ::",
            					"URL" => $_SERVER['HTTP_HOST'],
            			);
            			$sendmail=new Email();
            			$sendmail->set("html", true);
            			$sendmail->getParams($arr_email);
            			$sendmail->parseBody();
            			$sendmail->setHeaders();
                        if (isset($_POST['email']))
            			 $sendmail->send();
            			//end send mail
                        if ($_POST['user_type']=="normal")
                        {
						$_SESSION["glogin_username"]=$_POST['cell'];
						$_SESSION["glogin_name"]=$_POST['name'];
						$_SESSION["glogin_user_type"]=$_POST['user_type'];
						$_SESSION["glogin_user_id"]=$new_id;
						$_SESSION['result']="ثبت‌نام با موفقیت انجام شد، لطفا اطلاعات پروفایل کاربری را تکمیل کنید";
                        }else{
						$_SESSION['result']=" اطلاعات شما با موفقیت ثبت شد منتظر تایید مدیر سایت باشید. ";
                        }
						$_SESSION['alert']="success";
                        $r = "/khodro/profile";
                        if (isset($_POST['redirect']))
                            $r = $_POST['redirect'];
						header("location: ".$r);
					}
					else
					{
						$_SESSION['result']="مشکلی به وجود آمد، دوباره تلاش کنید";
						$_SESSION['alert']="error";
                        header("location: /khodro/register");
					}
				}
			}

		}
	}
}

function profile()
{
	if(isset($_SESSION["glogin_username"]))
	{
	   if (isset($_GET['profile']))
       {
            $arr_upd = array(
            "id" => $_SESSION["glogin_user_id"],
            "name" => $_POST['name'],
            "office_name" => $_POST['office_name'],
            "email" => $_POST['email'],
            "tell" => $_POST['tell'],
            "fax" => $_POST['fax'],
            "address" => $_POST['address']
            );
            KhodroUser::update($arr_upd);
            $_SESSION["glogin_name"] = $_POST['name'];
            $_SESSION['result']="تغییرات با موفقیت انجام شد";
            $_SESSION['alert']="success";
            header("location: /khodro/profile");
       }
	   $arr_get = array ( "cell" =>  $_SESSION["glogin_username"]);
	   $GLOBALS['GCMS']->assign('profile', KhodroUser::get($arr_get));
	}
	else
		header("location: /khodro?redirect=".$_SERVER["REQUEST_URI"]);
}

function changepass()
{
	if(!isset($_SESSION["glogin_username"]))
        header("location: /khodro/login?redirect=".$_SERVER["REQUEST_URI"]);

   if (isset($_GET['chp']))
   {
        if($_POST['password']=="")
		{
			$_SESSION['result']="کلمه عبور را وارد نکرده‌اید";
			$_SESSION['alert']="alarm";
            header("location: /khodro/changepass");
		}
		else if($_POST['password']!=$_POST['re_password'])
		{
			$_SESSION['result']="تکرار کلمه عبور مانند کلمه عبور نیست";
			$_SESSION['alert']="alarm";
            header("location: /khodro/changepass");
		}else{
            require_once(__COREROOT__."/libs/utility/hashing.php");
            $password_salt=saltit($_SESSION["glogin_username"]);
            $password=hashit($_POST['password'], $password_salt);

    		 $arr_upd = array(
            "id" => $_SESSION["glogin_user_id"],
			"password" => $password,
			"password_salt" => $password_salt,
            );
            KhodroUser::update($arr_upd);
            $_SESSION['result']="تغییرات با موفقیت انجام شد";
            $_SESSION['alert']="success";
            header("location: /khodro/changepass");
		}


   }
   $arr_get = array ( "cell" =>  $_SESSION["glogin_username"]);
   $GLOBALS['GCMS']->assign('profile', KhodroUser::get($arr_get));

}

function login()
{
	if(isset($_SESSION["glogin_username"]))
	{
		header("location: /khodro");
	}
	else
	{
		if(isset($_GET['login']))
		{
			if($_POST['capcha']
					&&(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha']))
			{
				$GLOBALS['GCMS']->assign('result', "کد تصویری را وارد نکرده اید و یا اشتباه وارد کرده اید." )  ;
                $GLOBALS['GCMS']->assign('alert', "alarm");
			}
			else if($_POST['cell']=="")
			{
				$GLOBALS['GCMS']->assign('result', "موبایل را وارد نکرده اید" )  ;
                $GLOBALS['GCMS']->assign('alert', "alarm");
			}
			else if($_POST['password']=="")
			{
				$GLOBALS['GCMS']->assign('result', "کلمه عبور را وارد نکرده اید" )  ;
                $GLOBALS['GCMS']->assign('alert', "alarm");
			}
			else
			{
				$chk_user=KhodroUser::get(array("cell" => $_POST['cell'], "user_status" => "active" ));
				if(isset($chk_user))
				{
						//user ok. checking password...
						require_once(__COREROOT__."/libs/utility/hashing.php");
						if($chk_user->password
								==hashit($_POST['password'], $chk_user->password_salt))
						{

							//password ok. setting sessions...
							$_SESSION["glogin_username"]  = $chk_user->cell;
							$_SESSION["glogin_name"]      = $chk_user->name;
							$_SESSION["glogin_user_type"] = $chk_user->user_type;
							$_SESSION["glogin_user_id"]   = $chk_user->id;
                            $_SESSION["glogin_userkhodro_etebar"]    =  FindUserEtebar($chk_user->id);
                            $_SESSION["glogin_userkhodro_sumsrch"]   =  KhodroSearch::get_count(array("id_user" => $chk_user->id));

							$_SESSION['result']="خوش‌آمدید";
							$_SESSION['alert']="success";

							if($_POST['redirect'] != "" )
							 header("location: ".$_POST['redirect']);
							else
							 header("location: /khodro");

						}
						else
						{
							$_SESSION['result']="کلمه عبور نادرست است";
							$_SESSION['alert']="error";
                            $r = "";
                            if (isset($_POST['redirect']))
                                $r = "?redirect=".$_POST['redirect'];
                            header("location: /khodro/login".$r);
						}


				}
				else
				{
					$_SESSION['result']="نام کاربری نادرست است";
					$_SESSION['alert']="error";
                    $r = "";
                    if (isset($_POST['redirect']))
                        $r = "?redirect=".$_POST['redirect'];
                    header("location: /khodro/login".$r);
				}
			}
		}
	}
}

function forgot()
{
    if(isset($_SESSION["glogin_username"]))
	{
		header("location: /khodro/profile");
	}else{
	   if(isset($_GET['forgot']))
		{
            if(trim($_POST['capcha'])==""||trim($_POST['capcha'])!=$_SESSION['gcms_cpcha'])
			{
				$_SESSION['result']="کد تصویری را وارد نکرده‌اید و یا اشتباه وارد کرده‌اید";
				$_SESSION['alert']="alarm";
			}else{
			     $chk_user=KhodroUser::get(array("cell" => $_POST['cell'] ,"user_status" => "active"  ));
                 if(isset($chk_user))
				{
				    require_once(__COREROOT__."/libs/utility/hashing.php");

                $n_p=rndstring(4);
				$password_salt=saltit($chk_user->cell);
				$password=hashit($n_p, $password_salt);

				$arr_update=array(
							"id" => $chk_user->id,
							"password" => $password,
							"password_salt" => $password_salt
				);
				KhodroUser::update($arr_update);
                //sms send
				require_once(__COREROOT__."/libs/utility/sms.php");
				$arr_send=array(
						"cell" => $chk_user->cell,
						"sms_text" => "کلمه عبور شما : $n_p \n http://".$_SERVER['HTTP_HOST']
				);
				send_sms($arr_send);
			    //send email
                $_SESSION['result']="کلمه عبور جدید به موبایل شما ارسال شد";
				$_SESSION['alert']="success";
                header("location: /khodro");
                }else{
                    $_SESSION['result']="شماره همراه در سیستم ثبت نشده است";
					$_SESSION['alert']="error";
                    header("location: /khodro/forgot");
                }
			}
        }
	}
}

function useredit($id)
{
	 if ( !isset($_SESSION['userid']) or $_SESSION['level'] < 8 )
        header("location: /khodro/");

	   if (isset($_GET['edit']))
       {
            $arr_upd = array(
            "id" => $id,
            "name" => $_POST['name'],
            "office_name" => $_POST['office_name'],
            "email" => $_POST['email'],
            "tell" => $_POST['tell'],
            "fax" => $_POST['fax'],
            "user_status" => $_POST['user_status'],
            "address" => $_POST['address'],
            "admin_txt" => $_POST['admin_txt'],
            "label" => $_POST['label']
            );
            KhodroUser::update($arr_upd);
            $_SESSION["glogin_name"] = $_POST['name'];
            $_SESSION['result']="تغییرات با موفقیت انجام شد";
            $_SESSION['alert']="success";
            header("location: /khodro/useredit/".$id);
       }
	   $arr_get = array ( "id" => $id );
	   $GLOBALS['GCMS']->assign('profile', KhodroUser::get($arr_get));

}

function sendmessage($id)
{
	 if ( !isset($_SESSION['userid']) or $_SESSION['level'] < 8 )
        header("location: /khodro/");

	   if (isset($_GET['send']))
       {
            $arr_insert = array(
            "id_user"   => $id,
            "title"     => $_POST['title'],
            "txt"       => $_POST['txt'],
            "date"      => date("Y-m-d H:i:s"),
            "flag_read" => "false"
            );
            KhodroMessage::insert($arr_insert);
            $_SESSION['result']="پیغام به کاربر ارسال شد";
            $_SESSION['alert']="success";
            header("location: /khodro/userslist/?paging=1&search=NULL&user_type=all");
       }

}
function setting()
{
	if ( !isset($_SESSION['userid']) or $_SESSION['level'] < 8 )
	header("location: /khodro/");

	if (isset($_GET['send']))
	{
	$st_group="khodro";
	$to_updates=Setting::get(array("st_group" => $st_group), true);
	foreach($to_updates as $to_update)
	{
		if(isset($_REQUEST[$st_group."|".$to_update->st_key]))
		Setting::update(
		array(
									"id" => $to_update->id,
									"st_value" => $_REQUEST[$st_group."|".$to_update->st_key]
						));
		}
		$_SESSION['result']="تنظیمات به‌روز شد";
		$_SESSION['alert']="success";
		header("location: /khodro/setting");
	}


}

function messages()
{
	if(!isset($_SESSION["glogin_username"]))
      header("location: /khodro/login");

    $arr_get['id_user'] = $_SESSION["glogin_user_id"];
    $order=array(
			"by"   => "date",
			"sort" => "DESC"


	);
    $GLOBALS['GCMS']->assign('messages', KhodroMessage::get($arr_get,true,$order));
    $GLOBALS['GCMS']->assign('count_message', KhodroMessage::get_count($arr_get));
}

function showmessages($id)
{
	if(!isset($_SESSION["glogin_username"]))
      header("location: /khodro/login");

    $arr_upd['flag_read'] = "true";
    $arr_upd['id']        = $id;
    KhodroMessage::update($arr_upd);

    $arr_get['id_user'] = $_SESSION["glogin_user_id"];
    $arr_get['id']      = $id;
    $GLOBALS['GCMS']->assign('message', KhodroMessage::get($arr_get));
}


function userslist()
{
    if ( !isset($_SESSION['userid']) or $_SESSION['level'] < 8 )
        header("location: /khodro/");

	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['user_type']))
			$_GET['user_type']="all";
	if(!isset($_GET['paging']))
		header(
				"location: /khodro/userslist?paging=1&search=".$_GET['search']."&user_type=".$_GET['user_type']);
	//preparing to query
	$max_results=20;

    $limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
    $order=array(
			"by" => "created_date",
			"sort" => "DESC"


	);
    if($_GET['search']!="NULL")
        $arr_get['search']="%".$_GET['search']."%";

    if($_GET['user_type']!="all")
		$arr_get['user_type']=$_GET['user_type'];


    $GLOBALS['GCMS']->assign('users', KhodroUser::get($arr_get,true,$order,$limit));
    $GLOBALS['GCMS']->assign('count_users', KhodroUser::get_count($arr_get));
    $GLOBALS['GCMS']->assign('paging', ceil(KhodroUser::get_count($arr_get)/$max_results));
}

function adverlist()
{

    if ( !isset($_SESSION['userid']) or $_SESSION['level'] < 8 )
        header("location: /khodro/");


    if (isset($_GET['adminvije']))
    {
    	$expire_date  = mktime(0, 0, 0, date("m")+$GLOBALS['GCMS_SETTING']['khodro']['vijeMoon'] , date("d")+$GLOBALS['GCMS_SETTING']['khodro']['vijeDay'], date("Y"));
		$arr_update['id']          = $_GET['adminvije'];
        $arr_update['adv_type']    = "special";
		$arr_update['expire_date'] = date("Y-m-d H:i:s",$expire_date);
		KhodroAdver::update($arr_update);
    	$_SESSION['result']="آگهی به آگهی ویژه تبدیل شد";
    	$_SESSION['alert']="success";
    	header("location: /khodro/adverlist?paging=1");
    }

    if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['adv_type']))
			$_GET['adv_type']="normal";
	if(!isset($_GET['id_user']))
			$_GET['id_user']="all";

	if(!isset($_GET['paging']))
		header(
				"location: /khodro/adverlist?paging=1&search=".$_GET['search']."&adv_type=".$_GET['adv_type']."&id_user=".$_GET['id_user']);
		//preparing to query
	$max_results=10;

    $limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
    $order=array(
			"by" => "register_date",
			"sort" => "DESC"


	);
    if($_GET['search']!="NULL")
        $arr_get['id']=$_GET['search']/171819;
    else
        $arr_get['adv_type']=$_GET['adv_type'];

    if($_GET['id_user']!="all")
        $arr_get['id_user']=$_GET['id_user'];

    $GLOBALS['GCMS']->assign('advers', KhodroAdver::get($arr_get,true,$order,$limit));
    $GLOBALS['GCMS']->assign('count_advers', KhodroAdver::get_count($arr_get));
    $GLOBALS['GCMS']->assign('paging', ceil(KhodroAdver::get_count($arr_get)/$max_results));
}

function cost()
{

    if(!isset($_SESSION["glogin_username"]))
      header("location: /khodro/login");

    $arr_get['id_user'] = $_SESSION["glogin_user_id"];
    $order=array(
			"by"   => "cost_date",
			"sort" => "DESC"


	);
    $GLOBALS['GCMS']->assign('costs', KhodroUsercost::get($arr_get,true,$order));
    $GLOBALS['GCMS']->assign('count_costs', KhodroUsercost::get_count($arr_get));

}
function pay()
{

    if(!isset($_SESSION["glogin_username"]))
      header("location: /khodro/login");

    $arr_get['id_user'] = $_SESSION["glogin_user_id"];
    $order=array(
			"by"   => "pay_date",
			"sort" => "DESC"


	);
    $GLOBALS['GCMS']->assign('pays', KhodroPay::get($arr_get,true,$order));
    $GLOBALS['GCMS']->assign('count_pays', KhodroPay::get_count($arr_get));

}

function payofl()
{

    if(!isset($_SESSION["glogin_username"]))
      header("location: /khodro/login");

    if (isset($_GET['payreg']))
    {
    	$arr_insert = array(
            "id_user"    => $_SESSION["glogin_user_id"] ,
            "pay_fee"    => $_POST['pay_fee'],
            "pay_title"  => $_POST['pay_title'],
            "pay_text"   => $_POST['pay_text'],
            "bank_info"  => $_POST['bank_info'],
            "pay_status" => "pending",
            "pay_type"   => "ofline",
            "pay_date"   => shamsi_to_miladi($_POST['pay_date_Year']."-". $_POST['pay_date_Month']."-". $_POST['pay_date_Day'])
            );


        KhodroPay::insert($arr_insert);
        $_SESSION['result']="پرداخت شما ثبت شد . ";
        $_SESSION['alert']="success";
        header("location: /khodro/payofl/");
    }

}


function payonl()
{

	if(!isset($_SESSION["glogin_username"]))
	header("location: /khodro/login");
	if (isset($_GET['back']))
	{

		$khodro_pay=KhodroPay::get(array("id" => $_GET['r']));
		if($khodro_pay->id_user!=$_SESSION["glogin_user_id"] or $khodro_pay->pay_fee!=$_GET['fee'] or $_POST['resnumber']!= $_GET['r'])
		{
			$_SESSION['result']="یه چیزی ، یه جایی اشتباه شده";
			$_SESSION['alert']="error";
			header("location: /khodro/payonl");
		}else {
		$MerchantID = '912403';
	    $Password = 'oP8FVzkLQ';

	  $Price = $_GET['fee']; //Price By Toman


	  if(isset($_POST['status']) && $_POST['status'] == 100)
	  {
	  	$Status = $_POST['status'];

	  	$Refnumber = $_POST['refnumber'];

	  	$Resnumber = $_POST['resnumber'];//Your Order ID

	  	$client = new SoapClient('http://merchant.parspal.com/WebService.asmx?wsdl');

	  	$res = $client->VerifyPayment(array("MerchantID" => $MerchantID , "Password" =>$Password , "Price" =>$Price,"RefNum" =>$Refnumber ));

	  	$Status = $res->verifyPaymentResult->ResultStatus;
	  	$PayPrice = $res->verifyPaymentResult->PayementedPrice;
	  	if($Status == 'success')// Your Peyment Code Only This Event
	  	{
			$arr_update=array(
						"id" => $Resnumber,
						"bank_info" => $khodro_pay->bank_info." | شماره رسید پرداخت : ".$Refnumber,
						"pay_status" => "confirm"
			);
			KhodroPay::update($arr_update);
			//TODO send sms and email
			$_SESSION['result']="پرداخت شما با موفقیت در سیستم ثبت شد";
			$_SESSION['alert']="success";
			$GLOBALS['GCMS']->assign('khodro_pay', $khodro_pay);
			$GLOBALS['GCMS']->assign('Refnumber' , $Refnumber);
			header("location: /khodro/payonl");

	  	}else{
	  		$_SESSION['result']="خطا در پردازش عملیات پرداخت ، نتیجه پرداخت : $Status !";
			$_SESSION['alert']="error";
			header("location: /khodro/payonl");
	  	}
	  }else{
	  		$arr_update=array(
						"id" => $_GET['r'],
						"pay_status" => "cancel"
			);
			KhodroPay::update($arr_update);
	  		$_SESSION['result']="بازگشت از عمليات پرداخت، خطا در انجام عملیات پرداخت ( پرداخت ناموق ) !";
			$_SESSION['alert']="error";
			header("location: /khodro/payonl");
	  }



		}
	}
		if (isset($_GET['payreg']))
		{
			$arr_insert = array(
            "id_user"    => $_SESSION["glogin_user_id"] ,
            "pay_fee"    => $_POST['pay_fee'],
            "pay_title"  => "پارس پال",
            "pay_text"   => $_POST['pay_text'],
            "bank_info"  => "پرداخت با پارس پال",
            "pay_status" => "pending",
            "pay_type"   => "online",
            "pay_date"   => date("Y-m-d H:i:s")
			);
			KhodroPay::insert($arr_insert);
			$ResNumber = mysql_insert_id() ;// Order Id In Your System

			$MerchantID = '912403';
			$Password = 'oP8FVzkLQ';
			$Price = $_POST['pay_fee']; //Price By Toman
			$site_url= "http://".$_SERVER['SERVER_NAME'];
			require_once(__COREROOT__."/libs/utility/hashing.php");
			$ReturnPath = $site_url.'/khodro/payonl?back=true&id='.rndstring(77).'&r='.$ResNumber.'&fee='.$_POST['pay_fee'];


			$Description = $_POST['pay_text'];
			$arr_get = array ( "cell" =>  $_SESSION["glogin_username"]);
	   		$userkhodro =  KhodroUser::get($arr_get);
			$Paymenter = $userkhodro->name;
			$Email = $userkhodro->email;
			$Mobile = $userkhodro->cell;

			$client = new SoapClient('http://merchant.parspal.com/WebService.asmx?wsdl');

			$res = $client->RequestPayment(array("MerchantID" => $MerchantID , "Password" =>$Password , "Price" =>$Price, "ReturnPath" =>$ReturnPath, "ResNumber" =>$ResNumber, "Description" =>$Description, "Paymenter" =>$Paymenter, "Email" =>$Email, "Mobile" =>$Mobile));

			$PayPath = $res->RequestPaymentResult->PaymentPath;
			$Status = $res->RequestPaymentResult->ResultStatus;

			if($Status == 'Succeed')
			header("location: $PayPath");
			else
			header("location: /khodro/payonl/?status=$Status");

		}


}
function usershow($id)
{

    if ( !isset($_SESSION['userid']) or $_SESSION['level'] < 8 )
        header("location: /khodro/");


    $arr_get['id_user'] = $id;
    $order=array(
			"by"   => "pay_date",
			"sort" => "DESC"


	);
    $GLOBALS['GCMS']->assign('pays', KhodroPay::get($arr_get,true,$order));
    $GLOBALS['GCMS']->assign('count_pays', KhodroPay::get_count($arr_get));

    $order=array(
			"by"   => "cost_date",
			"sort" => "DESC"


	);
    $GLOBALS['GCMS']->assign('costs', KhodroUsercost::get($arr_get,true,$order));
    $GLOBALS['GCMS']->assign('count_costs', KhodroUser::get_count($arr_get));

   $arr_get = array ( "id" => $id );
   $GLOBALS['GCMS']->assign('profile', KhodroUser::get($arr_get));

   $arr_search_get = array(
   							"id_user" => $id
   							);
   	$GLOBALS['GCMS']->assign('count_search', KhodroSearch::get_count($arr_search_get));

}

function paylist()
{

    if ( !isset($_SESSION['userid']) or $_SESSION['level'] < 8 )
        header("location: /khodro/");

    if (isset($_GET['chang2']))
    {
         $arr_get['pay_status'] = $_GET['chang2'];
         $arr_get['id'] = $_GET['id'];
         KhodroPay::update($arr_get);
         $_SESSION['result']="تغییرات با موفقیت انجام شد";
         $_SESSION['alert']="success";
         header("location: /khodro/paylist?paging=1&search=".$_GET['search']."&pay_status=".$_GET['pay_status']);
    }

	if(!isset($_GET['search']) or $_GET['search']=="")
		$_GET['search']="NULL";
	if(!isset($_GET['pay_status']))
			$_GET['pay_status']="all";
	if(!isset($_GET['paging']))
		header("location: /khodro/paylist?paging=1&search=".$_GET['search']."&pay_status=".$_GET['pay_status']);
	//preparing to query
	$max_results=20;

    $limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);
    $order=array(
			"by" => "id",
			"sort" => "DESC"


	);
    if($_GET['search']!="NULL")
        $arr_get['search']="%".$_GET['search']."%";

    if($_GET['pay_status']!="all")
		$arr_get['pay_status']=$_GET['pay_status'];


    $GLOBALS['GCMS']->assign('paylist', KhodroPay::get($arr_get,true,$order,$limit));
    $GLOBALS['GCMS']->assign('count_paylist', KhodroPay::get_count($arr_get));
    $GLOBALS['GCMS']->assign('paging', ceil(KhodroPay::get_count($arr_get)/$max_results));

}

function regadv()
{
    /*
    $order['by']   = "name";
    $order['sort'] = "ASC";
    $GLOBALS['GCMS']->assign('brands', KhodroBrand::get($arr_get,true,$order));
    */
    if (isset($_GET['demo']))
    {
        if (isset($_GET['final']) and isset($_SESSION["glogin_user_id"]))
        {
            $arr_get['id']  = $_GET['a'];
            $arr_get["id_user"] = $_SESSION["glogin_user_id"];
            $final_adver = KhodroAdver::get($arr_get);
            if(isset($final_adver))
           {
                if($final_adver->adv_type == "normal")
                {
                    $arr_update['adv_status'] = "confirm";
                    $arr_update['id']  = $_GET['a'];
                    KhodroAdver::update($arr_update);
                    $_SESSION['result']="ثبت آگهی با موفقیت انجام شد";
                	$_SESSION['alert']="success";
                    header("location: /khodro/adver");
                }else{
                    $expire_date  = mktime(0, 0, 0, date("m")+$GLOBALS['GCMS_SETTING']['khodro']['vijeMoon']  , date("d")+$GLOBALS['GCMS_SETTING']['khodro']['vijeDay'], date("Y"));
                    $cost_fee = $GLOBALS['GCMS_SETTING']['khodro']['vijeFee'] ;

                    $ins_arr = array(
                    "id_user"   => $_SESSION["glogin_user_id"] ,
                    "cost_name" => "ثبت آگهی ویژه" ,
                    "cost_fee"  => $cost_fee ,
                    "cost_text" => "بابت ثبت آگهی ویژه کد ". ($final_adver->id)*171819 ."
                    <br /> تاریخ انقضای آگهی ".jdate("y/m/j",$expire_date) ,
                    "cost_date" => date("Y-m-d H:i:s")

                    );

                    if (FindUserEtebar($_SESSION["glogin_user_id"])-$cost_fee >= 0)
                    {
                        KhodroUsercost::insert($ins_arr);
                        $arr_update['adv_status'] = "confirm";
                        $arr_update['id']  = $_GET['a'];
                        $arr_update['expire_date']  = date("Y-m-d H:i:s",$expire_date);
                        KhodroAdver::update($arr_update);
                        $_SESSION['result']="ثبت آگهی با موفقیت انجام شد";
                	    $_SESSION['alert']="success";
                        header("location: /khodro/adver");
                    }else{
                            $_SESSION['result']="اعتبار شما کافی نیست";
                            $_SESSION['alert']="alarm";
                            header("location: /khodro/pay");
                        }
                    $_SESSION["glogin_userkhodro_etebar"]   =  FindUserEtebar($_SESSION["glogin_user_id"]);

                }
           }
        }

        if (isset($_SESSION["glogin_user_id"]) and isset($_GET['signup']))
       {
            $arr_update['id_user'] = $_SESSION["glogin_user_id"];
            $arr_update['id']  = $_GET['a'];
            KhodroAdver::update($arr_update);
            header("location: /khodro/regadv?demo=true&adv_type=$_GET[adv_type]&id=$_GET[id]&a=$_GET[a]&adv=$_GET[adv]");
       }
        if (isset($_GET['adv_type']))
       {
            $arr_update['adv_type']  = $_GET['adv_type'];
            $arr_update['id']  = $_GET['a'];
            KhodroAdver::update($arr_update);
       }
       if ( !isset($_GET['final']) )
       {
           $arr_get = array("id"=>$_GET['a'],"adv_status"=>"confirm");
           if (isset($_SESSION["glogin_user_id"]))
            $arr_get["id_user"] = $_SESSION["glogin_user_id"];
           else
            $arr_get["id_user"] = 0;

           $adver = KhodroAdver::get($arr_get);
           if(isset($adver))
           {
            $GLOBALS['GCMS']->assign('adver', $adver);
           }else{
            header("location: /error404?error=adver&reason=adv_not_exist");
           }
       }

    }else{
        if (isset($_GET['register']))
        {
            if (!isset($_POST['auto_gear']))
                $_POST['auto_gear'] = "false";
            if (!isset($_POST['two_some']))
                $_POST['two_some'] = "false";
            if (!isset($_POST['used_zero']))
                $_POST['used_zero'] = "false";
            if (!isset($_POST['bim_body']))
                $_POST['bim_body'] = "false";
            $expire_date  = mktime(0, 0, 0, date("m")+$GLOBALS['GCMS_SETTING']['khodro']['normalMoon']  , date("d")+$GLOBALS['GCMS_SETTING']['khodro']['normalDay'], date("Y"));
            $myghest = "";
            if (isset($_POST['pishpardaxt']) and $_POST['pishpardaxt']!="")
            {
            	$myghest   =  
				"موعد تحویل : ".$_POST['tahvil'] . "ماه ، پیش پرداخت ".number_format($_POST['pishpardaxt']) ;
            	$ghestlist = $_POST['ghest'];
				$trxlist    = $_POST['trx'];
				foreach ($ghestlist as $key => $myn)
				{
					$myghest .= " - ".number_format($myn)." تاریخ ".$trxlist[$key] ;
				}
            }

            $arr_update = array(
            "id"                  => $_POST['id_adver'],
            "cell"                => $_POST['cell'] ,
            "auto_gear"           => $_POST['auto_gear'] ,
            "two_some"            => $_POST['two_some'] ,
            "fee"                 => $_POST['fee'] ,
            "used_zero"           => $_POST['used_zero'] ,
            "used"                => $_POST['used'] ,
            "color"               => $_POST['color'] ,
            "bim_month"           => $_POST['bim_month'] ,
            "bim_body"            => $_POST['bim_body'] ,
            "fabric"              => $_POST['fabric'] ,
            "txt"                 => $_POST['txt'] ,
            "adv_type"            => "normal" ,
            "adv_status"          => "confirm" ,
            "expire_date"         => date("Y-m-d H:i:s",$expire_date),
            "error_report_count"  => "0" ,
            "error_report_type"   => "0" ,
            "aghsat"              => $myghest
            );
            require_once(__COREROOT__."/libs/utility/hashing.php");
            if (isset($_SESSION["glogin_user_id"]))
            {
               $arr_update['id_user'] = $_SESSION["glogin_user_id"];
               $redirect = "?demo=true&id=".rndstring(90)."&a=".$_POST['id_adver']."&adv=".rndstring(90);
            }else{
                $redirect = "?demo=true&signup=true&id=".rndstring(90)."&a=".$_POST['id_adver']."&adv=".rndstring(90);
            }
            KhodroAdver::update($arr_update);
            header("location: /khodro/regadv".$redirect);

        }else{
			/*
        	$query=$GLOBALS['GCMS_SAFESQL']->query(
        	"SELECT  adver.`id_brand` as id , COUNT(adver.`id_brand`) as Num , brand.name  FROM `gcms_khodro_adver`  as adver
        			INNER JOIN `gcms_khodro_brand` as `brand` ON `brand`.`id` = `adver`.`id_brand`
        			WHERE  adver.adv_status = 'confirm'
        			AND adver.expire_date > '$now'
        			GROUP BY adver.`id_brand`
        			ORDER BY `Num` DESC
        	",$nol);
            $brands = $GLOBALS['GCMS_DB']->get_results($query);

            $queryExtra=$GLOBALS['GCMS_SAFESQL']->query(
        	"SELECT * FROM `gcms_khodro_brand`
        	WHERE id NOT IN (
   					SELECT  adver.`id_brand`  FROM `gcms_khodro_adver`  as adver
        			INNER JOIN `gcms_khodro_brand` as `brand` ON `brand`.`id` = `adver`.`id_brand`
        			WHERE  adver.adv_status = 'confirm'
        			AND adver.expire_date > '$now'
        			GROUP BY adver.`id_brand`
        			)
        	  ORDER BY RAND()
        	",$nol);
            $brandsExtra = $GLOBALS['GCMS_DB']->get_results($queryExtra);
            
			if (count($brandsExtra) == 0 )
				$resultBrands = $brands;
			else
				$resultBrands = array_merge($brands, $brandsExtra);
				*/
        	
        	$query=$GLOBALS['GCMS_SAFESQL']->query(
        	"
        	SELECT name, id
			FROM  `gcms_khodro_brand` 
        	",$nol);
            $brands = $GLOBALS['GCMS_DB']->get_results($query);
        	usort($brands, "sort_compare" );
            $GLOBALS['GCMS']->assign('brands', $brands);
        }

    }
}

function sort_compare($elem1, $elem2)
{
	return compare_internal( $elem1->name, $elem2->name );
}

function compare_internal($elem1, $elem2)
{
	// if one of the items don't have the sort index we're looking for
	// assume NULL > everything
	if (is_null( $elem1 ) && is_null( $elem2 ))
	{
		return 0; // assume they are equal
	}
	if (is_null( $elem1 ))
	{
		return 1;
	}
	else if (is_null( $elem2 ))
	{
		return -1;
	}
	
	// check to see if both sort index values are numbers, in which case, perform a natsort
	if (strlen( $elem1 ) && strlen( $elem2 ) &&
		ctype_digit( $elem1 ) && ctype_digit( $elem2 ))
	{
		return strnatcmp( $elem1, $elem2 );
	}
	
	// try to compare Persian strings	
	$sort_order = //'آاأإؤئبپتثجچحخدذرزژسشصضطظعغفقکگلمنوهی۱۲۳۴۵۶۷۸۹۰';
		array( 'آ', 'ا', 'أ', 'إ', 'ؤ', 'ئ', 'ب', 'پ', 'ت', 'ث', 'ج', 'چ', 'ح', 'خ', 'د',
			'ذ', 'ر', 'ز', 'ژ', 'س', 'ش', 'ص', 'ض', 'ط', 'ظ', 'ع', 'غ', 'ف', 'ق', 'ک', 'گ',
			'ل', 'م', 'ن', 'و', 'ه', 'ی', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '۰' );
	$sort_array = array();
	$index = 1;
	foreach ($sort_order as $item)
	{
		$sort_array[ $item ] = $index ++;
	}
	$len1 = strlen( $elem1 );
	$len2 = strlen( $elem2 );
	$failed = false;
	for ($i = 0, $j = 0; $i < $len1 && $j < $len2;)
	{
		$c1 = extract_utf8_char( $elem1, $i );
		$c2 = extract_utf8_char( $elem2, $j );
		
		if (array_key_exists( $c1, $sort_array ) &&
			array_key_exists( $c2, $sort_array ))
		{
			if ($sort_array[ $c1 ] == $sort_array[ $c2 ])
			{
				continue;
			}
			else
			{
				return $sort_array[ $c1 ] - $sort_array[ $c2 ];
			}
		}
		else
		{
			$failed = true;
			break;
		}
	}
	
	if ($failed == false)
	{
		return 0; // equal strings
	}
	
	return strcmp( $elem1, $elem2 );
}

function extract_utf8_char($str, &$i)
{
	$ascii_pos = ord( $str{ $i } );
	if ($ascii_pos < 192)
	{
		return $str{ $i ++ };
	}
	else if (($ascii_pos >= 240) && ($ascii_pos <= 255))
	{
		$i += 4;
		return substr( $str, $i - 4, $i );
	}
	else if (($ascii_pos >= 224) && ($ascii_pos <= 239))
	{
		$i += 3;
		return substr( $str, $i - 3, $i );
	}
	else
	{
		$i += 2;
		return substr( $str, $i - 2, $i );
	}
}

function editadver($id)
{
	if (!isset($id))
		header("location: /error404?error=adver&reason=adv_not_exist");

	if(isset($_GET['t']))
	{
		$expire_date  = mktime(0, 0, 0, date("m")+$GLOBALS['GCMS_SETTING']['khodro']['normalMoon']   , date("d")+$GLOBALS['GCMS_SETTING']['khodro']['normalDay'] , date("Y"));
		$arr_update['id']          = $id;
        $arr_update['adv_type']    = "normal";
		$arr_update['expire_date'] = date("Y-m-d H:i:s",$expire_date);
		KhodroAdver::update($arr_update);
		$_SESSION['result']="اعتبار  آگهی با موفقیت تمدید شد";
		$_SESSION['alert']="success";
		require_once(__COREROOT__."/libs/utility/hashing.php");
		header("location: /khodro/editadver/$id?id=".rndstring(90));
	}

	if(isset($_GET['s']))
	{
		$expire_date  = mktime(0, 0, 0, date("m")+$GLOBALS['GCMS_SETTING']['khodro']['vijeMoon'] , date("d")+$GLOBALS['GCMS_SETTING']['khodro']['vijeDay'], date("Y"));
		$arr_update['id']          = $id;
        $arr_update['adv_type']    = "special";
		$arr_update['expire_date'] = date("Y-m-d H:i:s",$expire_date);


        $cost_fee = $GLOBALS['GCMS_SETTING']['khodro']['vijeFee'] ;
        $ins_arr = array(
                    "id_user"   => $_SESSION["glogin_user_id"] ,
                    "cost_name" => "ثبت آگهی ویژه" ,
                    "cost_fee"  => $cost_fee ,
                    "cost_text" => "بابت ثبت آگهی ویژه کد ". ($id)*171819 ."
                    <br /> تاریخ انقضای آگهی ".jdate("y/m/j",$expire_date) ,
                    "cost_date" => date("Y-m-d H:i:s")

                    );


         if (FindUserEtebar($_SESSION["glogin_user_id"])-$cost_fee >= 0)
        {
            KhodroUsercost::insert($ins_arr);
            KhodroAdver::update($arr_update);
    		$_SESSION['result']="آگهی به آگهی ویژه تبدیل شد";
    		$_SESSION['alert']="success";
    		require_once(__COREROOT__."/libs/utility/hashing.php");
    		header("location: /khodro/editadver/$id?id=".rndstring(90));
        }else{
                $_SESSION['result']="اعتبار شما کافی نیست";
                $_SESSION['alert']="alarm";
                header("location: /khodro/pay");
            }
        $_SESSION["glogin_userkhodro_etebar"]   =  FindUserEtebar($_SESSION["glogin_user_id"]);


	}

	if (isset($_GET['edit']) and isset($_SESSION["glogin_user_id"]))
	{
		$arr_get['id']  = $id;
		$arr_get["id_user"] = $_SESSION["glogin_user_id"];
		$final_adver = KhodroAdver::get($arr_get);

		if(isset($final_adver))
		{
			$arr_update['id']         = $id;
			$arr_update['fee']        = $_POST['fee'];
			$arr_update['bim_month']  = $_POST['bim_month'];
			$arr_update['bim_body']   = $_POST['bim_body'];
			$arr_update['fabric']     = $_POST['fabric'];
			$arr_update['txt']        = $_POST['txt'];
			KhodroAdver::update($arr_update);
			$_SESSION['result']="ویرایش  آگهی با موفقیت انجام شد";
			$_SESSION['alert']="success";
			require_once(__COREROOT__."/libs/utility/hashing.php");
			header("location: /khodro/editadver/$id?id=".rndstring(90));

		}
	}

	if (isset($_GET['cngs']) and isset($_SESSION["glogin_user_id"]) and $_GET['cngs'] == "dis" )
	{
		$arr_get['id']  = $id;
		$arr_get["id_user"] = $_SESSION["glogin_user_id"];
		$final_adver = KhodroAdver::get($arr_get);

		if(isset($final_adver))
		{
			$arr_update['id']         = $id;
			$arr_update['adv_status']        = "disable";
			KhodroAdver::update($arr_update);
			$_SESSION['result']="آگهی غیر فعال شد";
			$_SESSION['alert']="success";
			header("location: /khodro/adver");

		}
	}

	$arr_get = array("id"=>$id,"adv_status_not"=>"demo");
	if (isset($_SESSION["glogin_user_id"]))
		$arr_get["id_user"] = $_SESSION["glogin_user_id"];
		else
		$arr_get["id_user"] = 0;

		$adver = KhodroAdver::get($arr_get);
		if(isset($adver))
		{
			$GLOBALS['GCMS']->assign('adver', $adver);
		}else{
			header("location: /error404?error=adver&reason=adv_not_exist");
		}


}
function admineditadver($id)
{
	if ( !isset($_SESSION['userid']) or $_SESSION['level'] < 8 )
        header("location: /khodro/");

	if (isset($_GET['edit']) )
	{
		$arr_get['id']  = $id;
		$final_adver = KhodroAdver::get($arr_get);

		if(isset($final_adver))
		{
			$arr_update['id']         = $id;
			$arr_update['fee']        = $_POST['fee'];
			$arr_update['bim_month']  = $_POST['bim_month'];
			$arr_update['bim_body']   = $_POST['bim_body'];
			$arr_update['fabric']     = $_POST['fabric'];
			$arr_update['txt']        = $_POST['txt'];
			KhodroAdver::update($arr_update);
			$_SESSION['result']="ویرایش  آگهی با موفقیت انجام شد";
			$_SESSION['alert']="success";
			require_once(__COREROOT__."/libs/utility/hashing.php");
			header("location: /khodro/admineditadver/$id");

		}
	}

	if (isset($_GET['cngs'])  )
	{
		$arr_get['id']  = $id;

		$final_adver = KhodroAdver::get($arr_get);

		if(isset($final_adver))
		{
			$arr_update['id']         = $id;
			$arr_update['adv_status']        = $_GET['cngs'];
			KhodroAdver::update($arr_update);
			$_SESSION['result']="وضعیت آگهی تغییر یافت";
			$_SESSION['alert']="success";
			header("location: /khodro/admineditadver/$id");

		}
	}

	$arr_get = array("id"=>$id);

		$adver = KhodroAdver::get($arr_get);
		if(isset($adver))
		{
			$GLOBALS['GCMS']->assign('adver', $adver);
		}else{
			header("location: /error404?error=adver&reason=adv_not_exist");
		}


}
function agency()
{
	$order=array(
				"by" => "office_name"
				);
	$arr_get['user_type']   ="reseller";
	$arr_get['user_status'] ="active";


    $GLOBALS['GCMS']->assign('agencys', KhodroUser::get($arr_get,true,$order));
    $GLOBALS['GCMS']->assign('count_agencys', KhodroUser::get_count($arr_get));
}
function adver()
{

    if(!isset($_SESSION["glogin_username"]))
      header("location: /khodro/login");

    $arr_get['id_user'] = $_SESSION["glogin_user_id"];
    $order=array(
			"by"   => "expire_date",
			"sort" => "DESC"


	);
    $GLOBALS['GCMS']->assign('advers', KhodroAdver::get($arr_get,true,$order));
    $GLOBALS['GCMS']->assign('count_advers', KhodroAdver::get_count($arr_get));

}


function logout()
{
	if(isset($_SESSION["glogin_username"]))
	{
		unset($_SESSION["glogin_username"]);
        unset($_SESSION["glogin_name"]);
        unset($_SESSION["glogin_user_type"]);
        unset($_SESSION["glogin_user_id"]);
        unset($_SESSION["glogin_userkhodro_etebar"]);
	}
    $_SESSION['result']="خروج از سیستم با موفقیت انجام شد.";
	$_SESSION['alert']="success";
	header("location: /khodro");
}

function FindUserEtebar($IdUser)
{
    $pays = KhodroPay::get(array("id_user"=>$IdUser,"pay_status"=>"confirm"),true);
    $sumPay = 0 ;
    foreach ($pays as $pay)
    $sumPay += $pay->pay_fee;

    $costs = KhodroUsercost::get(array("id_user"=>$IdUser,"pay_status"=>"confirm"),true);
    $sumCost = 0 ;
    foreach ($costs as $cost)
        $sumCost += $cost->cost_fee;
    return $sumPay-$sumCost;
}

function rss()
{

	function autoload_rss($class_name)
	{
		$file='core/libs/rss/'.$class_name.'.php';
		if(file_exists($file))
		{
			require_once($file);
		}
	}
	spl_autoload_register('autoload_rss');
	$brand=KhodroBrand::get(array("id"=>$_GET['brand']));
	$rss_channel = new RssGenerator_channel();
	$rss_channel->atomLinkHref   = "";
	$rss_channel->title          = $brand->name;
	$rss_channel->link           = "page";
	$rss_channel->description    = $brand->name;
	$rss_channel->language       = "fa";
	$rss_channel->generator      = "Gatriya CMS ::GCMS @version 2.0.1 @copyright 2011 RSES.ir";
	$rss_channel->managingEditor = "Support@rses.ir";
	$rss_channel->webMaster      = "webMaster";




	$arr_get=array(
			"adv_status" => "confirm",
			"id_brand"=> $_GET['brand']
	);
	$order=array(
			"by" => "register_date",
			"sort" => "DESC"
	);
	$list = KhodroAdver::get($arr_get, true, $order);

	foreach ($list as $row)
	{
		$model=KhodroModel::get(array("id"=>$row->id_model));
		$tip=KhodroTip::get(array("id" => $row->id_tip));
		$item = new RssGenerator_item();
		$item->title       = $brand->name."، ".$model->model_name;
		if($model->model_name!=$tip->tip_name)
			$item->title = $item->title." تیپ ".$tip->tip_name;
		$item->description="";
		//$item->description .= "<img width=\"30\"  src=\"/images/type/".$tip->tip_form.".png\" /> ";
		$item->description.=$brand->name."، ".$model->model_name;
		if($model->model_name!=$tip->tip_name)
			$item->description.=" تیپ ".$tip->tip_name;
		$item->description.=" سال ".$row->year;
		$arr_color =array(		
		"white" => "سفید",
		"black" => "مشکی",
		"blue" => "آبی",
		"noghre" => "نقره ای",
		"green" => "سبز",
		"red" => "قرمز",
		"nokmedadi" => "نوک مدادی",
		"gray" => "خاکستری",
		"yellow" => "زرد",
		"zereshki" => "زرشکی",
		"mesi" => "مسی",
		"zeytoni" => "زیتونی",
		"bej" => "بژ",
		"dodi" => "دودی",
		"banafsh" => "بنفش",
		"narenji" => "نارنجی",
		"keremi" => "کرمی",
		"yashmi" => "یشمی",
		"ghahvee" => "قهوه ای",
		"albaloee" => "آلبالویی",
		"anabi" => "عنابی",
		"tosi" => "طوسی",
		"boronzi" => "برنزی",
		"gold" => "طلایی",
		"dolphin" => "دلفینی",
		"sormee" => "سورمه ای",
		"atlasi" => "اطلسی",
		"abicarboni" => "آبی کاربنی",
		"other" => "سایر");
		$item->description.=" ".$arr_color[$row->color]." ";
		//$item->description.="<br>";
		if ($row->bim_month != 0)
			if ($row->bim_month == -1)
				$item->description.="بیمه دارد";
			else
				$item->description.="مانده بیمه ثالث $row->bim_month ماه";
		else $item->description.="بیمه ثالث مشخص نشده";
		$item->description.=" | ";
		if ($row->bim_body == "true" )
			$item->description.="، بیمه بدنه  دارد ";
		if ($row->fabric != 0) 
			$item->description.="$row->fabric % فابریک ";
		//$item->description.="<br>";
		if ($row->aghsat != "")
			$item->description.=$row->aghsat;
		else
			$item->description.=$row->txt;
		//$item->description.="<br>";
		if ($row->fee == 0)
		$item->description.=" برای اطلاع از قیمت ، تماس بگیرید ";
		else
		$item->description.=number_format($row->fee)." تومان ";
		$item->description.=$row->cell;
		if ($row->used_zero == "true")
			$item->description.="خودرو صفر";
		if ($row->used != 0)
			$item->description.="کارکرد $row->used کیلومتر"; 
		if ($row->two_some == "true")
			$item->description.=" دوگانه سوز ";
		if ($row->auto_gear == "true")
			$item->description.=" دنده اتوماتیک ";
		
		$item->link        = "http://".$_SERVER['HTTP_HOST']."/khodro?id_brand=".$row->id_brand;
		$item->guid        = "http://".$_SERVER['HTTP_HOST']."/khodro?id_brand=".$row->id_brand;
		$item->pubDate     = $row->register_date;

		$rss_channel->items[] = $item;
	}
	$rss_feed = new RssGenerator_rss();
	$rss_feed->encoding = "UTF-8";
	$rss_feed->version = "2.0";
	header("Content-Type: text/xml");
	$GLOBALS['GCMS']->assign('rss_feed',$rss_feed->createFeed($rss_channel));
}
