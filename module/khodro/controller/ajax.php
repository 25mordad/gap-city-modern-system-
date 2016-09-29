<?php

/**
 * ajax.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Use: backend > AJAX Functions
 *
 * @author 25mordad <25mordad@gmail.com>
 * @author dahdash  <dahdash@gmail.com>
 * @version 2.0
 *
 */

$controller=$_GET['controller'];
if(function_exists($controller))
{
	$controller();
}

function khodro_chozbrand()
{
    $query=$GLOBALS['GCMS_SAFESQL']->query(
	"SELECT * FROM `gcms_khodro_model`
      WHERE
      [ `id_brand` =  %N ]
      AND `model_status` = 'active'
	  ORDER BY `model_name`   ASC
	",array($_POST['id_brand']));

    $models = $GLOBALS['GCMS_DB']->get_results($query);

    echo '
    <div class="id_model" id="id_model">
        <div class="ctrlHolder">
        <label for="id_model" >انتخاب مدل</label>
        <select name="id_model" id="setmodel" onchange="chozmodel()">
            <option value="0"  >مدل را انتخاب  کنید ...</option>
            ';
    foreach ($models as $m)
        echo "<option value=\"$m->id\" style=\"background:url(/uploads/khodro/model/model_{$m->id}.png) left  no-repeat ;\" >$m->model_name</option>";
    echo '
        </select>
        <p class="formHint" ></p>
        </div>
    </div>
    ';

}

function khodro_searchmodel()
{
    $now = date("Y-m-d H:i:s");
    $query=$GLOBALS['GCMS_SAFESQL']->query(
	"
    SELECT  adver.`id_model` , COUNT(adver.`id_model`) as Num , model.model_name , model.year_type  FROM `gcms_khodro_adver`  as adver
    INNER JOIN `gcms_khodro_model` as `model` ON `model`.`id` = `adver`.`id_model`
    WHERE [ adver.`id_brand` =  %N ]
    AND adver.adv_status = 'confirm'
    AND adver.expire_date > '$now'
    GROUP BY adver.`id_model`
    ORDER BY `Num` DESC

	",array($_POST['id_brand']));

    $models = $GLOBALS['GCMS_DB']->get_results($query);

    echo '
    <div class="id_model" id="id_model">
        <div class="ctrlHolder">
        <label for="id_model" >انتخاب مدل</label>
        <select name="id_model" id="setmodel" onchange="searchtip()">
            <option value="0"  >مدل را انتخاب  کنید ...</option>
            ';
    foreach ($models as $m)
        echo "<option value=\"$m->id_model\" style=\"background:url(/uploads/khodro/model/model_{$m->id_model}.png) left  no-repeat ;\" >$m->model_name ، تعداد $m->Num مورد</option>";
    echo '
        </select>
        <p class="formHint" ></p>
        </div>
    </div>

    ';

}
function khodro_searchtip()
{
    $model = KhodroModel::get(array("id"=>$_POST['id_model']));
    $now = date("Y-m-d H:i:s");
    $query_year=$GLOBALS['GCMS_SAFESQL']->query(
	"
    SELECT DISTINCT adver.`year` as year
    FROM `gcms_khodro_adver` AS adver

    WHERE
    [ adver.`id_brand` =  %N ]
    [ AND adver.`id_model` =  %N ]
    AND adver.adv_status = 'confirm'
    AND adver.expire_date > '$now'

    ORDER BY `year` DESC
	",array(
    $_POST['id_brand'],
    $_POST['id_model']
    ));

    $query_color=$GLOBALS['GCMS_SAFESQL']->query(
	"
    SELECT DISTINCT adver.`color` as color
    FROM `gcms_khodro_adver` AS adver

    WHERE
    [ adver.`id_brand` =  %N ]
    [ AND adver.`id_model` =  %N ]
    AND adver.adv_status = 'confirm'
    AND adver.expire_date > '$now'

    ORDER BY `color`
	",array(
    $_POST['id_brand'],
    $_POST['id_model']
    ));

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
    $_POST['id_brand'],
    $_POST['id_model']
    ));
    $years = $GLOBALS['GCMS_DB']->get_results($query_year);
    $tips  = $GLOBALS['GCMS_DB']->get_results($query);
	$ech .= '
    <div class="year" id="year" >
        <div class="ctrlHolder">
        <label for="year">انتخاب سال</label>
        <select name="year" id="setyear" onchange="khodrosefr()" >
			<option value="0" >سال را انتخاب  کنید ...</option>
         ';
    foreach ($years as $r)
        {
            $ech .= "<option value=\"$r->year\"  >$r->year</option>";
        }
    $ech .= '
        </select>
        <p class="formHint" ></p>
        </div>
    </div>
    <div class="used_zero" id="used_zero_id" style="float:right;margin-top: 0px;display: none;">
                        <div class="ctrlHolder" id="setusedzero" >
                        <label for="used_zero" style="border:1px solid transparent;width: 60px; float: right;padding-right: 10px;">خودرو صفر</label>
                        <input type="checkbox" name="used_zero" id="used_zero" class="used_zero" style="margin-top: 2px;margin-right: -55px;border:1px solid transparent;" value="true"  />
                        <p class="formHint" ></p>
                        </div>
                    </div>
        <div class="clear"></div>
        <div class="id_tip" id="id_tip">
            <div class="ctrlHolder">
            <label for="id_tip">انتخاب تیپ</label>
            <select name="id_tip" id="settip"  onchange="searchtipform();" >
    			<option value="0" >تیپ را انتخاب  کنید ...</option>
            ';
    foreach ($tips as $t)
    {
        $ech .= "<option value=\"$t->id_tip\"  style=\"background:url(/uploads/khodro/tip/tip_{$t->id_tip}.png) left  no-repeat ;\" >$t->tip_name ، تعداد $t->Num مورد</option>";
    }
    $ech .= '
            </select>
            <p class="formHint" ></p>
            </div>
        </div>
    <div class="clear"></div>

    ';
    $colorValue = array(
    		"0" => "انتخاب کنید . . ." ,
    		"white" => "سفید" ,
    		"black" => "مشکی" ,
    		"blue" => "آبی" ,
    		"noghre" => "نقره ای",
            "green" => "سبز" ,
            "red" => "قرمز" ,
            "nokmedadi" => "نوک مدادی" ,
            "gray" => "خاکستری" ,
            "yellow" => "زرد" ,
            "zereshki" => "زرشکی" ,
            "mesi" => "مسی" ,
            "zeytoni" => "زیتونی" ,
            "bej" => "بژ" ,
            "dodi" => "دودی" ,
            "banafsh" => "بنفش" ,
            "narenji" => "نارنجی" ,
            "keremi" => "کرم" ,
            "yashmi" => "یشمی" ,
            "ghahvee" => "قهوه ای" ,
            "albaloee" => "آلبالویی" ,
            "anabi" => "عنابی" ,
            "tosi" => "طوسی" ,
            "boronzi" => "برنزی" ,
            "gold" => "طلایی" ,
            "dolphin" => "دلفینی" ,
    		"sormee" => "سورمه ای",
			"atlasi" => "اطلسی",
			"abicarboni" => "آبی کاربنی",
            "other" => "سایر" ,



    );
    $colors  = $GLOBALS['GCMS_DB']->get_results($query_color);
    $ech .= "<script>document.getElementById('setcolor').innerHTML = '<option value=\"0\" >رنگ را انتخاب  کنید ...</option>";
    foreach ($colors as $color)
    {
    	$c = $color->color;
    	$ech .= "<option value=\"$color->color\" >$colorValue[$c]</option>";
    }
    $ech .= "';</script>";

    if ($model->auto_gear == "false")
    	$ech .= "<script>document.getElementById('setgear').style.display = 'none';</script>";
    if ($model->two_some == "false")
    	$ech .= "<script>document.getElementById('settwosome').style.display = 'none';</script>";
    $ech .= "
    <script >

        document.getElementById('setyeartype').value = '$model->year_type';
        document.getElementById('setautogear').value = '$model->auto_gear';
        document.getElementById('setminfee').value = '$model->min_fee';
        document.getElementById('setmaxfee').value = '$model->max_fee';
    </script>
    ";
    echo $ech;
}

function khodro_searchtipform()
{
	$tipformValue = array(
			"sedan" => "سدان" ,
			"hatchback" => "هاچ بک" ,
			"suv" => "شاسی بلند" ,
			"pickup" => "وانت" ,
			"coupe" => "کوپه" ,
			"convertible" => "کروک" ,
			"van" => "ون" ,
			"wagon" => "استیشن"
	);
	if ($_POST['id_tip'] != 0)
	{
		$tip   = KhodroTip::get(array("id"=>$_POST['id_tip']));

		$tf = $tip->tip_form;
		echo 	"<option value=\"$tip->tip_form\" >$tipformValue[$tf]</option>";
	}else{
		foreach ($tipformValue as $key => $value)
			echo 	"<option value=\"$key\" >$value</option>";
	}
}
function khodro_chozmodel()
{
    $model = KhodroModel::get(array("id"=>$_POST['id_model']));

    $query=$GLOBALS['GCMS_SAFESQL']->query(
	"SELECT * FROM `gcms_khodro_tip`
      WHERE TRUE
      [ AND `id_brand` =  %N ]
      [ AND `id_model` =  %N ]
      AND `tip_status` = 'active'
	  ORDER BY `tip_name`   ASC
	",array(
    $_POST['id_brand'],
    $_POST['id_model']
    ));

    $tips = $GLOBALS['GCMS_DB']->get_results($query);
	$ech .= '
    <div class="year" id="year">
        <div class="ctrlHolder">
        <label for="year">انتخاب سال</label>
        <select name="year" id="setyear" >
            <option value="0" >سال را انتخاب  کنید ...</option>
         ';
    for ($i = $model->min_year ;$i <= $model->max_year ; $i++)
        {
            $ech .= "<option value=\"$i\" ";
            if ( $i == $model->max_year )
                $ech .= " selected=\"selected\" ";
            $ech .= "  >$i</option>";
        }
    $ech .= '
        </select>
        <p class="formHint" ></p>
        </div>
    </div>

        <div class="clear"></div>
        <div class="id_tip" id="id_tip">
            <div class="ctrlHolder">
            <label for="id_tip">انتخاب تیپ</label>
            <select name="id_tip" id="settip" >
            ';
            if (!$tips)
                die("ERROR Tip not exist");
    foreach ($tips as $t)
    {
        $ech .= "<option value=\"$t->id\"  style=\"background:url(/uploads/khodro/tip/tip_{$t->id}.png) left  no-repeat ;\" >$t->tip_name</option>";
    }
    $ech .= '
            </select>
            <p class="formHint" ></p>
            </div>
        </div>
    <div class="clear"></div>

    ';
    echo $ech;
}

function khodro_go2step2()
{

    $brand = KhodroBrand::get(array("id"=>$_POST['id_brand']));
    $model = KhodroModel::get(array("id"=>$_POST['id_model']));
    $tip   = KhodroTip::get(array("id"=>$_POST['id_tip']));
    $d     = date("Y-m-d H:i:s");
    $arr_insert = array(
    "id_brand"      => $_POST['id_brand'] ,
    "id_model"      => $_POST['id_model'] ,
    "id_tip"        => $_POST['id_tip'] ,
    "year"          => $_POST['year'] ,
    "adv_status"    => "temp" ,
    "register_date" => $d

    );
    KhodroAdver::insert($arr_insert);
    $rid = mysql_insert_id();
    if ($model->model_name != $tip->tip_name)
    	$setbrandtip = $brand->name ." ، ".  $model->model_name ." تیپ ". $tip->tip_name ." سال ". $_POST['year'];
    else 
    	$setbrandtip = $brand->name ." ، ".  $model->model_name  ." سال ". $_POST['year'];
    $setbtimages = "<img width=\"120\" src=\"/uploads/khodro/default/tip/$tip->id.png\" style=\"border-radius:5px\" >";
    $setminfee = $model->min_fee;
    $setmaxfee = $model->max_fee;
    echo "<script>document.getElementById('setid').value = '$rid';</script>";
    echo "<script>document.getElementById('setbrandtip').innerHTML = '$setbrandtip';</script>";
    echo "<script>document.getElementById('setbtimages').innerHTML = '$setbtimages';</script>";
    echo "<script>document.getElementById('setminfee').value = '$setminfee';</script>";
    echo "<script>document.getElementById('setmaxfee').value = '$setmaxfee';</script>";

    if ($model->auto_gear == "false")
        echo "<script>document.getElementById('setgear').style.display = 'none';</script>";
    if ($model->two_some == "false")
        echo "<script>document.getElementById('settwosome').style.display = 'none';</script>";
    if ($model->year_type == "shamsi" and $_POST['year'] != jdate("Y"))
        echo "<script>document.getElementById('setusedzero').style.display = 'none';</script>";
    if ($model->year_type == "shamsi" and $_POST['year'] < jdate("Y")-6)
        echo "<script>document.getElementById('setused').style.display = 'none';</script>";
    if ($model->year_type == "miladi" and $_POST['year'] != date("Y"))
        echo "<script>document.getElementById('setusedzero').style.display = 'none';</script>";
    if ($model->year_type == "miladi" and $_POST['year'] <  date("Y")-6)
        echo "<script>document.getElementById('setused').style.display = 'none';</script>";

}

function khodro_findlastimg()
{

	$arr_get=array(
			"im_type" => "khodroadv"
	);
	$order=array(
			"by" => "id",
			"sort" => "DESC"
	);
	$pg_img=Image::get($arr_get, false, $order, $_POST['id_adv']);

	echo '<img src="'.$pg_img->im_path.$pg_img->im_name.'" width="120" />';
}

function upload_file()
{

	$uploaddir='uploads/'.$_POST['part'].'/'.$_POST['id'].'/';
	$i=2;
	while(is_dir($uploaddir)&&!chmod($uploaddir, 0755))
	{
		$uploaddir='uploads/'.$_POST['part'].'/'.$_POST['id'].'_'.$i.'/';
		$i++;
	}
	$uploaddir=$uploaddir.date("Y-m-d").'/'.date("His").'/';
	if(!is_dir($uploaddir))
	{
		mkdir($uploaddir, 0755, true);
	}


	// The posted data, for reference
	$file=$_POST['value'];
	$name=$_POST['name'];
	if (isset($_POST['sz']))
	{
		$data = file_get_contents($file);
		$size = strlen($data);
		if ($size > $_POST['sz'])
			die("سایز فایل ". round($size/1000) ."K و  بیش از 155K");
	}
	if (isset($_POST['mx']))
	{
		$arr_get=array(
				"rel_type" => $_POST['part'],
				"other_id" => $_POST['id']
		);

		$getfiles=RelImageOther::get_count($arr_get);
		if ($getfiles > $_POST['mx'] )
		{
			die ("<script type=\"text/javascript\">location.reload();</script>");
		}

	}


	// Get the mime & original
	$getMime=explode('.', $name);
	$mime=strtolower(end($getMime));
	$original=substr($name, 0, -1-strlen($mime));
	// Separate out the data
	$data=explode(',', $file);

	// Encode it correctly
	$encodedData=str_replace(' ', '+', $data[1]);
	$decodedData=base64_decode($encodedData);


	//if file_exists
	$i=2;
	$chk_file=$uploaddir.$name;
	while(file_exists($chk_file))
	{
		$name=$original."_".$i.".".$mime;
		$chk_file=$uploaddir.$name;
		$i++;
	}

	if( file_put_contents($uploaddir.$name, $decodedData) )
	{

		$arr_insert=array(
				"im_name" => $name,
				"im_path" => '/'.$uploaddir,
				"im_type" => $_POST['part']
		);
		Image::insert($arr_insert);
		$arr_insert2=array(
				"image_id" => mysql_insert_id(),
				"other_id" => $_POST['id'],
				"rel_type" => $_POST['part']
		);
		RelImageOther::insert($arr_insert2);


		// 		echo "با موفقیت آپلود شد";
	}
	else
	{
		// Show an error message should something go wrong.
		echo "متاسفانه عملیات آپلود با مشکل مواجه شد";
	}
}


function get_file()
{
	//$_POST['show'] {file=default | image} $_POST['maxwidth']


	$arr_get=array(
			"im_type" => $_POST['part']
	);
	$order=array(
			"by" => "id",
			"sort" => "DESC"
	);


	$images=Image::get($arr_get, true, $order, $_POST['id']); //$_POST['id'] is the join parameter (other_id)
	$imgstring="";
	if($images)
	{
		if (isset($_POST['show']) and $_POST['show'] == "image")
		{
			foreach($images as $image)
			{
				$imgstring=$imgstring
				."<a href=\"$image->im_path$image->im_name\" target=\"_blank\" ><div class=\"sh_thmb\" ><img src=\"$image->im_path$image->im_name\" width=\"$_POST[maxwidth]\"  > </div></a>";
			}
			}else{
			foreach($images as $image)
			{
			$imgstring=$imgstring
				."<a href=\"$image->im_path$image->im_name\" target=\"_blank\" ><div class=\"sh_thmb\" >$image->im_name</div></a>";
			}
			}


			}
			else
				{
				$imgstring="هیچ فایلی آپلود نشده است";
				}
	echo "
	$imgstring
	<div class=\"clear\" ></div>";
}