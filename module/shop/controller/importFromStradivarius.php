<?php

$product=Products::get(array("id" => $id));
$GLOBALS['GCMS']->assign('product', $product);
$GLOBALS['GCMS']->assign('sizeList', Page::get(array("pg_type" => "size", "pg_status" => "publish"),true,array("by"=>'pg_order',"sort"=>'ASC')));
$GLOBALS['GCMS']->assign('sizes', explode("|",$product->size));
$GLOBALS['GCMS']->assign('colorList', Page::get(array("pg_type" => "color", "pg_status" => "publish"),true));
$GLOBALS['GCMS']->assign('colors', explode("|",$product->color));
$GLOBALS['GCMS']->assign('group_name', Page::get(array("id" => $product->group_id, "pg_type" => "product_group", "pg_status" => "publish")));

require_once(__COREROOT__."/libs/simple_html_dom/simple_html_dom.php");
// Create DOM from URL or file
$html = file_get_html($product->link);

if ($_GET['step'] == "images" ){
	if (isset($_GET['del'])){
		Products::del($id);
		header("location: /gadmin/shop/grouping");
			
	}

	$metaprop = $html->find('meta[property=og:image]');
	$FirstAddress = $metaprop[0]->content;
	$FirstAddress = explode("?", $FirstAddress);
	$image1 = trim(str_replace("_1_1_3","_1_1_1",$FirstAddress[0]));
	$image2 = trim(str_replace("_1_1_","_2_1_",$image1));
	$allImages[] = $image1;
	$allImages[] = $image2;
	for ($i=2; $i<11 ; $i++){
		$imi = trim(str_replace("_2_1_1","_2_".$i."_1",$image2));
		if (getimagesize($imi) !== false) {
			$allImages[] = $imi;
		}
		
	}
	$GLOBALS['GCMS']->assign('allImages', $allImages);
}

if ($_GET['step'] == "title" ){
		
	foreach($html->find('span[class=itemName]') as $header) {
		$headlines[] = $header->plaintext;
	}

	foreach ($html->find('div[class=careDetails]') as $description) {
		$Description[] = $description->plaintext;
	}

	$metaprop = $html->find('meta[property=og:image]');
	$FirstAddress = $metaprop[0]->content;
	$FirstAddress = explode("?", $FirstAddress);
	$FirstAddressArr = explode("/", $FirstAddress[0]);
	$ref1 = explode("_1_1_", end($FirstAddressArr));
	$reference =  substr($ref1[0], 0, 7);
 
	
	$scrptTxt = "";
	foreach ($html->find('script') as $scrpt) {
		$scrptTxt = $scrptTxt.$scrpt;
	}
	$pArr = explode('"price":"', $scrptTxt);
	$pArr = explode('",', $pArr[1]);
	
	$realPrice =  ceil($pArr[0]) ;
	
	$GLOBALS['GCMS']->assign('description', "");
	$GLOBALS['GCMS']->assign('headlines', $headlines);
	$GLOBALS['GCMS']->assign('realPrice', $realPrice);
	$GLOBALS['GCMS']->assign('buyPrice', $realPrice);
	$GLOBALS['GCMS']->assign('reference', $reference);

}

if ($_GET['step'] == "price" ){


foreach ($html->find('input[class=inputOcultoColor]') as $sizes) {
		$Fetchsizes[] = $sizes;
	}
	$sizFa = explode("#", trim($Fetchsizes[0]));
	foreach ($sizFa as $row){
		$AllsizesArr[] = explode("|", $row);
	}
		
	foreach ($AllsizesArr as $row){
		$Allsizes[] = strtolower(str_replace('" />', "", trim($row[3])) );
	}
		
	
	$updColor = "";
	foreach ($Allsizes  as $size){

		$updSize = $updSize . $size."|";
	}


$scrptTxt = "";
	foreach ($html->find('img[onclick]') as $imclick) {
		$scrptTxt = $scrptTxt.$imclick;
	}
	$findColors = explode("$('#id_colorDesc_hidden').val('",$scrptTxt);
	
	 foreach (array_slice($findColors,1) as $row) {
		$allColorsarr[] = explode("'", $row);
	}
	
	 foreach ($allColorsarr as $row) {
		$allColors[] = str_replace(" ", "-",  $row[0]);
	} 

	$updColor = "";
	foreach ($allColors  as $color){

		$updColor = $updColor . $color."|";
	}

	if ($_GET['upd'] == "true")
	{
		$arr_update=array(
				"id" => $id,
				"fa_title" => stripcslashes($_POST['fa_title']),
				"en_title" => stripcslashes($_POST['en_title']),
				"en_txt" => stripcslashes($_POST['en_txt']),
				"fa_txt" => stripcslashes($_POST['fa_txt']),
				"real_price" => $_POST['real_price'],
				"buy_price" => $_POST['buy_price'],
				"refrence" => $_POST['refrence'],
				"sales2_price" => "0",
				"min_price" => "0",
				"status" => "publish",
				"show_real_price" => "false",
				"size" =>$updSize,
				"color" =>$updColor,
		);
		Products::update($arr_update);
		header("location: /gadmin/shop/importFromStradivarius/$id?step=price");
	}


	$real_price = $product->real_price;
	$buy_price = $product->buy_price;

	$min_price = ($buy_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate']) + (($buy_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate'])*20/100) + ($GLOBALS['GCMS_SETTING']['shop']['eurorate'] * 5) ;
	$price = ($real_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate']) + (($real_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate'])*50/100) + ($GLOBALS['GCMS_SETTING']['shop']['eurorate'] * 5)  ;

	$GLOBALS['GCMS']->assign('price', $price);
	$GLOBALS['GCMS']->assign('min_price', $min_price);

}

if ($_GET['step'] == "size" ){

	if ($_GET['upd'] == "true")
	{
		$updColor = "";
		foreach ($_POST['color']  as $color){
				
			$updColor = $updColor . $color."|";
		}
			
		$updSize = "";
		foreach ($_POST['size']  as $size){
				
			$updSize = $updSize . $size."|";
		}
		$arr_update=array(
				"id" => $id,
				"size" =>$updSize,
				"color" =>$updColor,
		);
		Products::update($arr_update);
		header("location: /gadmin/shop/edit/".$id);
	}

	foreach ($html->find('input[class=inputOcultoColor]') as $sizes) {
		$Fetchsizes[] = $sizes;
	}
	$sizFa = explode("#", trim($Fetchsizes[0]));
	foreach ($sizFa as $row){
		$AllsizesArr[] = explode("|", $row);
	}
		
	foreach ($AllsizesArr as $row){
		$Allsizes[] = strtolower(str_replace('" />', "", trim($row[3])) );
	}
		
	$GLOBALS['GCMS']->assign('Allsizes', $Allsizes);



	$scrptTxt = "";
	foreach ($html->find('img[onclick]') as $imclick) {
		$scrptTxt = $scrptTxt.$imclick;
	}
	$findColors = explode("$('#id_colorDesc_hidden').val('",$scrptTxt);
	
	 foreach (array_slice($findColors,1) as $row) {
		$allColorsarr[] = explode("'", $row);
	}
	
	 foreach ($allColorsarr as $row) {
		$allColors[] = str_replace(" ", "-",  $row[0]);
	} 
	
	
	$GLOBALS['GCMS']->assign('allColors', $allColors);



	$arr_update=array(
			"id" => $id,
			"price" => $_POST['price'],
			"salse1_price" => $_POST['salse1_price'],
			"sales2_price" => $_POST['sales2_price'],
			"min_price" => $_POST['min_price'],

	);
	Products::update($arr_update);

}