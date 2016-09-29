<?php

/**
 * frontend_support.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > support
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/support/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


if(!isset($_SESSION["glogin_username"]))
	header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);


function index()
{

	if(!isset($_GET['paging']))
		header(
				"location: /support/?paging=1");
	//preparing to query
	$max_results=10;

	$arr_get=array(
			"id_user" => $_SESSION["glogin_user_id"] ,
	);
	$order=array(
			"by"   => "id",
			"sort" => "DESC"
	);
	$limit=array(
			"start" => (($_GET['paging']*$max_results)-$max_results),
			"end" => $max_results
	);

	$GLOBALS['GCMS']->assign('supportList',Supprts::get($arr_get, true, $order,$limit));
	$GLOBALS['GCMS']->assign('supportCount',Supprts::get_count($arr_get));
	$GLOBALS['GCMS']->assign('paging', ceil(Supprts::get_count($arr_get)/$max_results));

}

function new_support()
{
    if(isset($_POST['newSupport']) )
    {
        if ($_POST['text'] != "")
        {
            $arr_insert=array(
                "id_user"        => $_SESSION["glogin_user_id"],
                "part"           => "support",
                "priority"       => "normal",
                "title"          => $_POST['title'],
                "status"         => "send",
                "create_date"    => date("Y-m-d H:i:s"),
            );
            Supprts::insert($arr_insert);
            $id_support = mysql_insert_id();
            $arr_insert=array(
                "id_support"        => $id_support,
                "id_user"           => $_SESSION["glogin_user_id"],
                "text"              => stripcslashes($_POST['text']),
                "date"              => date("Y-m-d H:i:s"),
            );
            Supprtext::insert($arr_insert);

            $email_text="
					<p style=\"direction:rtl;font-family:tahoma;\">
				 کاربر گرامی ".$_POST['un']." <br />
				 	پشتیبانی شما ثبت شد. <br />
				 		<strong>".$_POST['title']."</strong> <br />
				 				</p>
				 				<p style=\"direction:rtl;font-family:tahoma;background-color:#CCCCCC;padding:10px\">".html_entity_decode($_POST['text'])."</p>
				 								<p style=\"direction:rtl;font-family:tahoma;\">مشاهده پشتیبانی و فایل های پیوست : <br />
				 								".$_SERVER['HTTP_HOST']."/support/show/$id_support?number=". $id_support*181819 ."</p>
				 								";
            $name="noreply-gatriya";
            $from="noreply@gatriya.com";
            $mail= new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth=true;
            $mail->Host       = "mail.gatriya.com";
            $mail->Username= "noreply@gatriya.com";
            $mail->Password= "+,FDJ?#Gm*qE";
            $mail->AddAddress($_POST['um'], $_POST['un']);
            $mail->SetFrom($from, $name);
            $mail->AddReplyTo($from, $name);
            $mail->Subject    = " پشتیبانی شماره  " . $id_support*181819 ." - ".$_POST['title'];
            $mail->IsHTML(true);
            $body = '<html><body>';
            $body .= '<p style="direction:rtl;font-family:tahoma;">'.$email_text.'</p>';
            $body .= '<p style="direction:rtl;font-family:tahoma;">:: این ایمیل به صورت خودکار برای شما ارسال شده است ::</p>';
            $body .= "</body></html>";
            $mail->MsgHTML($body);
            $mail->AltBody= $email_text;
            $mail->Send();

            $_SESSION['result']="پشتیبانی جدید ایجاد شد ، شما می توانید فایل های مربوطه را نیز آپلود کنید";
            $_SESSION['alert']="success";
            header("location: /support/show/".$id_support."?number=".$id_support*181819);

        }else {
            $_SESSION['result']="محتوای پشتیبانی را وارد نکرده اید";
            $_SESSION['alert']="warning";
            header("location: /support/new/");
        }

    }

}

function show($id)
{
    if($_SESSION["glogin_user_level"] != 42)
        $sup = Supprts::get(array( "id"=> $id , "id_user" => $_SESSION["glogin_user_id"]), false );
    else
        $sup = Supprts::get(array( "id"=> $id ), false );

    if(isset($_GET['send']) )
    {
        if ($_POST['text'] != "")
        {

            $arr_insert=array(
                "id_support"        => $id,
                "id_user"           => $_SESSION["glogin_user_id"],
                "text"              => stripcslashes($_POST['text']),
                "date"              => date("Y-m-d H:i:s"),
            );
            Supprtext::insert($arr_insert);

            if($_SESSION["glogin_user_level"] != 42)
            {
                $arrUpd = array("id" => $id,"status" => "send");
                Supprts::update($arrUpd);
                //send email

                $email_text="
					<p style=\"direction:rtl;font-family:tahoma;\">
				 کاربر گرامی ".$_POST['un']." <br />
				 	پشتیبانی شما ثبت شد. <br />
				 		<strong>".$sup->title."</strong> <br />
				 				</p>
				 				<p style=\"direction:rtl;font-family:tahoma;background-color:#CCCCCC;padding:10px\">".html_entity_decode($_POST['text'])."</p>
				 								<p style=\"direction:rtl;font-family:tahoma;\">مشاهده پشتیبانی و فایل های پیوست : <br />
				 								".$_SERVER['HTTP_HOST']."/support/show/$id?number=". $id*181819 ."</p>
				 								";
            }
            else
            {
                $arrUpd = array("id" => $id,"status" => "waiting");
                Supprts::update($arrUpd);
                //sms send
                if (isset($_POST['sms']))
                {
                    $txt4sms = substr(substr(strip_tags($_POST['text']), 0, 200 ), strpos(substr(strip_tags($_POST['text']), 0, 200 ), " "));
                    require_once(__COREROOT__."/libs/utility/sms.php");
                    $persianText = "پشتیبانی گاتریا:";
                    $arr_send=array(
                        "cell" => $_POST['sms'],
                        "sms_text" => "$persianText \n$txt4sms ... \n".$_SERVER['HTTP_HOST']."/support/show/$id?number=". $id*181819
                    );
                    send_sms($arr_send);
                }
                //send email

                $email_text="
					<p style=\"direction:rtl;font-family:tahoma;\">
				 کاربر گرامی ".$_POST['un']." <br />
				 		به پشتیبانی شما پاسخ داده شد <br />
				 		<strong>".$sup->title."</strong> <br />
				 				</p>
				 				<p style=\"direction:rtl;font-family:tahoma;background-color:#CCCCCC;padding:10px\">".html_entity_decode($_POST['text'])."</p>
				 								<p style=\"direction:rtl;font-family:tahoma;\">مشاهده پشتیبانی و فایل های پیوست : <br />
				 								".$_SERVER['HTTP_HOST']."/support/show/$id?number=". $id*181819 ."</p>
				 								";
            }

            $name="noreply-gatriya";
            $from="noreply@gatriya.com";
            $mail= new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth=true;
            $mail->Host       = "mail.gatriya.com";
            $mail->Username= "noreply@gatriya.com";
            $mail->Password= "+,FDJ?#Gm*qE";
            $mail->AddAddress($_POST['um'], $_POST['un']);
            $mail->SetFrom($from, $name);
            $mail->AddReplyTo($from, $name);
            $mail->Subject    = " پشتیبانی شماره  " . $id*181819 ." - ".$sup->title;
            $mail->IsHTML(true);
            $body = '<html><body>';
            $body .= '<p style="direction:rtl;font-family:tahoma;">'.$email_text.'</p>';
            $body .= '<p style="direction:rtl;font-family:tahoma;">:: این ایمیل به صورت خودکار برای شما ارسال شده است ::</p>';
            $body .= "</body></html>";
            $mail->MsgHTML($body);
            $mail->AltBody= $email_text;
            $mail->Send();

            $_SESSION['result']= " پاسخ شما ارسال شد ";
            $_SESSION['alert']="success";
            header("location: /support/show/".$id."?number=".$id*181819);

        }else {
            $_SESSION['result']="محتوای پشتیبانی را وارد نکرده اید";
            $_SESSION['alert']="warning";
            header("location: /support/show/".$id."?number=".$id*181819);
        }

    }


    if ($sup->id)
    {
        $GLOBALS['GCMS']->assign('support',$sup);
        $GLOBALS['GCMS']->assign('supportext',Supprtext::get(array( "id_support"=> $id ), true , array("by"=>"date","sort"=>"DESC") ));
        $GLOBALS['GCMS']->assign('pageImg', Image::get(array("im_type" => "support" ), true, $order=array("by" => "id", "sort" => "DESC" ), $id));
    }else
        header("location: /error404?error=support&reason=supportNotFound");
}

function adminList()
{
    if($_SESSION["glogin_user_level"] != 42)
    {
        header("location: /support");
        die();
    }
    if(!isset($_GET['paging']))
        header(
            "location: /support/adminList?paging=1");
    //preparing to query
    $max_results=10;
    $arr_get=array();
    if (isset($_GET["status"]))
        $arr_get['status']=$_GET['status'];

    if (isset($_GET["user"]))
        $arr_get['id_user']=$_GET['user'];

    $order=array(
        "by"   => "id",
        "sort" => "DESC"
    );
    $limit=array(
        "start" => (($_GET['paging']*$max_results)-$max_results),
        "end" => $max_results
    );
    $GLOBALS['GCMS']->assign('supportList',Supprts::get($arr_get, true, $order,$limit));
    $GLOBALS['GCMS']->assign('supportCount',Supprts::get_count($arr_get));
    $GLOBALS['GCMS']->assign('paging', ceil(Supprts::get_count($arr_get)/$max_results));

}

function ch2closed($id)
{
    $arrUpd = array("id" => $id,"status" => "closed");
    Supprts::update($arrUpd);

    $_SESSION['result']= " پشتیبانی با موفقیت بسته شد ";
    $_SESSION['alert']="success";
    header("location: /support/adminList?paging=".$_GET['paging']."&status=".$_GET['status']);
}

function adminNew()
{
    if(isset($_POST['newSupport']) )
    {
        if ($_POST['text'] != "")
        {
            $arr_insert=array(
                "id_user"        => $_POST['id_user'],
                "part"           => "support",
                "priority"       => "normal",
                "title"          => $_POST['title'],
                "status"         => "waiting",
                "create_date"    => date("Y-m-d H:i:s"),
            );
            Supprts::insert($arr_insert);
            $id_support = mysql_insert_id();
            $arr_insert=array(
                "id_support"        => $id_support,
                "id_user"           => $_SESSION["glogin_user_id"],
                "text"              => stripcslashes($_POST['text']),
                "date"              => date("Y-m-d H:i:s"),
            );
            Supprtext::insert($arr_insert);
            //sms send
            if (isset($_POST['sms']))
            {
                $txt4sms = substr(substr(strip_tags($_POST['text']), 0, 200 ), strpos(substr(strip_tags($_POST['text']), 0, 200 ), " "));
                require_once(__COREROOT__."/libs/utility/sms.php");
                $persianText = "پشتیبانی گاتریا:";
                $arr_send=array(
                    "cell" => $_POST['sms'],
                    "sms_text" => "$persianText \n$txt4sms ... \n".$_SERVER['HTTP_HOST']."/support/show/$id_support?number=". $id_support*181819
                );
                send_sms($arr_send);
            }
            $email_text="
					<p style=\"direction:rtl;font-family:tahoma;\">
				 کاربر گرامی ".$_POST['un']." <br />
				 پیغامی از طرف گاتریا برای شما ارسال شد. <br />
				 		<strong>".$_POST['title']."</strong> <br />
				 				</p>
				 				<p style=\"direction:rtl;font-family:tahoma;background-color:#CCCCCC;padding:10px\">".html_entity_decode($_POST['text'])."</p>
				 								<p style=\"direction:rtl;font-family:tahoma;\">مشاهده پشتیبانی و فایل های پیوست : <br />
				 								".$_SERVER['HTTP_HOST']."/support/show/$id_support?number=". $id_support*181819 ."</p>
				 								";
            $name="noreply-gatriya";
            $from="noreply@gatriya.com";
            $mail= new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth=true;
            $mail->Host       = "mail.gatriya.com";
            $mail->Username= "noreply@gatriya.com";
            $mail->Password= "+,FDJ?#Gm*qE";
            $mail->AddAddress($_POST['um'], $_POST['un']);
            $mail->SetFrom($from, $name);
            $mail->AddReplyTo($from, $name);
            $mail->Subject    = " پشتیبانی شماره  " . $id_support*181819 ." - ".$_POST['title'];
            $mail->IsHTML(true);
            $body = '<html><body>';
            $body .= '<p style="direction:rtl;font-family:tahoma;">'.$email_text.'</p>';
            $body .= '<p style="direction:rtl;font-family:tahoma;">:: این ایمیل به صورت خودکار برای شما ارسال شده است ::</p>';
            $body .= "</body></html>";
            $mail->MsgHTML($body);
            $mail->AltBody= $email_text;
            $mail->Send();

            $_SESSION['result']="پشتیبانی جدید ایجاد شد ، شما می توانید فایل های مربوطه را نیز آپلود کنید";
            $_SESSION['alert']="success";
            header("location: /support/show/".$id_support."?number=".$id_support*181819);

        }else {
            $_SESSION['result']="محتوای پشتیبانی را وارد نکرده اید";
            $_SESSION['alert']="warning";
            header("location: /support/new/");
        }

    }

}
