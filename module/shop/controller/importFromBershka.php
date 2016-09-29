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

	foreach ($html->find('a[class=_seoImg]') as $i) {
		$imagesZara[] = $i->href;
	}
	$GLOBALS['GCMS']->assign('imagesZara', $imagesZara);
}

if ($_GET['step'] == "title" ){
		
	foreach($html->find('h1[class=product-name]') as $header) {
		$headlines[] = $header->plaintext;
	}

	foreach ($html->find('p[class=description]') as $description) {
		$Description[] = $description->plaintext;
	}

	foreach ($html->find('p[class=reference]') as $reference) {
		$Reference[] = $reference->plaintext;
	}

	$scrptTxt = "";
	foreach ($html->find('script') as $scrpt) {
		$scrptTxt = $scrptTxt.$scrpt;
	}
	$priceScript = explode(",",substr($scrptTxt,strpos($scrptTxt,"price")+7,10));
	$realPrice =  ceil($priceScript[0]/100);

	if (strpos($scrptTxt,"oldPrice")) {
		$oldPriceScript = explode(",",substr($scrptTxt,strpos($scrptTxt,"oldPrice")+10,10));
		$buyPrice = $realPrice;
		$realPrice = ceil($oldPriceScript[0]/100);
	}else{
		$buyPrice = $realPrice;
	}

	$GLOBALS['GCMS']->assign('brand', $Brand);
	$GLOBALS['GCMS']->assign('description', $Description);
	$GLOBALS['GCMS']->assign('headlines', $headlines);
	$GLOBALS['GCMS']->assign('realPrice', $realPrice);
	$GLOBALS['GCMS']->assign('buyPrice', $buyPrice);
	$GLOBALS['GCMS']->assign('reference', $Reference);

}

if ($_GET['step'] == "price" ){


	foreach ($html->find('td[class=size-name]') as $sizes) {
		$Allsizes[] = str_replace(" ","-",strtolower(trim($sizes->innertext)));
	}
	$GLOBALS['GCMS']->assign('Allsizes', $Allsizes);

	$updColor = "";
	foreach ($Allsizes  as $size){

		$updSize = $updSize . $size."|";
	}


	foreach ($html->find('span[class=color-description]') as $colors) {
		$allColors[] = str_replace(" ","-",strtolower(trim($colors->innertext)));
	}
	foreach ($html->find('span[class=_colorName]') as $colors) {
		$allColors[] = str_replace(" ","-",strtolower(trim($colors->innertext)));
	}
	$GLOBALS['GCMS']->assign('allColors', $allColors);

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
		header("location: /gadmin/shop/importFromZara/$id?step=price");
	}


	$real_price = $product->real_price;
	$buy_price = $product->buy_price;

	$min_price = ($buy_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate']) + (($buy_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate'])*20/100) + ($GLOBALS['GCMS_SETTING']['shop']['eurorate'] + 5) ;
	$price = ($real_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate']) + (($real_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate'])*50/100)  ;

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

	foreach ($html->find('td[class=size-name]') as $sizes) {
		$Allsizes[] = str_replace(" ","-",strtolower(trim($sizes->innertext)));
	}
	$GLOBALS['GCMS']->assign('Allsizes', $Allsizes);




	foreach ($html->find('span[class=color-description]') as $colors) {
		$allColors[] = str_replace(" ","-",strtolower(trim($colors->innertext)));
	}
	foreach ($html->find('span[class=_colorName]') as $colors) {
		$allColors[] = str_replace(" ","-",strtolower(trim($colors->innertext)));
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