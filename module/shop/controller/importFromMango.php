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

	$allImages = $html->find('img[id=tableFoto]');
	
	$GLOBALS['GCMS']->assign('allImages', $allImages);
}

if ($_GET['step'] == "title" ){
		
	foreach($html->find('div[class=nombreProducto]') as $header) {
		$headlines[] = $header->plaintext;
	}

	foreach ($html->find('div[id=collapseOne]') as $description) {
		$Description[] = $description->plaintext;
	}

	foreach ($html->find('div[class=referenciaProducto]') as $reference) {
		$Reference[] = $reference->plaintext;
	}
	$ReferenceMango =  explode(" ",$Reference[0]);
 
 	foreach ($html->find('span[itemprop=price]') as $prices) {
		$Prices[] = $prices->plaintext;
	}
	$realPrice = ceil(trim(str_replace(" ","",str_replace("€","",str_replace(",",".",$Prices[0])))));
	
	
	$GLOBALS['GCMS']->assign('brand', $Brand);
	$GLOBALS['GCMS']->assign('description', $Description);
	$GLOBALS['GCMS']->assign('headlines', $headlines);
	$GLOBALS['GCMS']->assign('realPrice', $realPrice);
	$GLOBALS['GCMS']->assign('buyPrice', $realPrice);
	$GLOBALS['GCMS']->assign('reference', trim($ReferenceMango[2]));

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
		header("location: /gadmin/shop/importFromMango/$id?step=price");
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