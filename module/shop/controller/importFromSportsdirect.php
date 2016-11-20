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
	$fi = $html->find('div[id=piThumbs]');
	$subhtml = str_get_html($fi[0]);
	$imghref = $subhtml->find('a');
	$GLOBALS['GCMS']->assign('allImages', $imghref);
}

if ($_GET['step'] == "title" ){
		
	
	$en_titleHtml = $html->find('span[id=ProductName]');
	$en_title = substr(strstr(trim($en_titleHtml[0]->plaintext)," "), 1);
	$en_titleTranslate = json_decode(file_get_contents("https://www.googleapis.com/language/translate/v2?q=".rawurlencode($en_title)."&target=fa&key=".$GLOBALS['GCMS_SETTING']['shop']['translatekey']));
	
	$en_txtHtml = $html->find('span[itemprop=description]');
	$en_txt= trim($en_txtHtml[0]->plaintext);
	$en_txtTranslate = json_decode(file_get_contents("https://www.googleapis.com/language/translate/v2?q=".rawurlencode($en_txt)."&target=fa&key=".$GLOBALS['GCMS_SETTING']['shop']['translatekey']));
	
	$refrenceP = $html->find('p[class=productCode]');
	$rf= $refrenceP[0]->plaintext;
	$reference = explode("Product code: ", $refrenceP[0]->plaintext);
	
	$EuGbRate = json_decode(file_get_contents('http://api.fixer.io/latest?base=GBP&symbols=EUR'));
	
	$originalprice = $html->find('div[class=originalprice]');
	$GBoriginalprice = trim(str_replace("£", "", $originalprice[0]->plaintext)) ;
	$realPrice = ceil($GBoriginalprice * $EuGbRate->rates->EUR + 2);
	
	$productHasRef = $html->find('span[class=productHasRef]');
	$GBproductHasRef = trim(str_replace("£", "", $productHasRef[0]->plaintext)) ;
	$buyPrice = ceil($GBproductHasRef * $EuGbRate->rates->EUR + 2);
	
	
	
	$GLOBALS['GCMS']->assign('en_txt', $en_txt);
	$GLOBALS['GCMS']->assign('fa_txt', $en_txtTranslate->data->translations[0]->translatedText);
	$GLOBALS['GCMS']->assign('fa_title', $en_titleTranslate->data->translations[0]->translatedText);
	$GLOBALS['GCMS']->assign('en_title', $en_title);
	$GLOBALS['GCMS']->assign('realPrice', $realPrice);
	$GLOBALS['GCMS']->assign('buyPrice', $buyPrice);
	$GLOBALS['GCMS']->assign('reference', trim($reference[1]));

}

if ($_GET['step'] == "price" ){



	if ($_GET['upd'] == "true")
	{
		
		$colorDiv = $html->find('div[id=divColour]');
		$colorDiv = str_replace("Colour", "",  trim($colorDiv[0]->plaintext));
		$colorDiv =  trim(substr(strstr(trim($colorDiv)," "), 1));
		$colorDivArr = explode(" ", $colorDiv);
		$updColor = "";
		foreach ($colorDivArr as $row){
			if ($row != "")
				$updColor =  $updColor . trim($row)."|";
		}
		
		$sizeDiv = $html->find('ul[class=sizeButtons]');
		$updSize = preg_replace("/ {2,}/", '|', trim($sizeDiv[0]->plaintext));
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
		header("location: /gadmin/shop/importFromSportsdirect/$id?step=price");
	}

	if ($GLOBALS['GCMS_SETTING']['shop']['type'] == "sportfabric"){
		$costPrice = 10+5+5+5;
		$minCostPrice = 5+5;
		$real_price = $product->real_price;
		$buy_price = $product->buy_price;
		
		$rplusc = $real_price + $costPrice;
		$p20p = $rplusc * 20 /100;
		
		$bplusc = $buy_price + $minCostPrice;
		$b20p = $bplusc * 20 /100;
		
		$price  = $GLOBALS['GCMS_SETTING']['shop']['eurorate'] * ($rplusc + $p20p);
		$min_price  = $GLOBALS['GCMS_SETTING']['shop']['eurorate'] * ($bplusc + $b20p);

		$GLOBALS['GCMS']->assign('price', $price);
		$GLOBALS['GCMS']->assign('min_price', $min_price);	
	
	}else{
		///////////////////////////////////////////////////
		$real_price = $product->real_price;
		$buy_price = $product->buy_price;
		
		$min_price = ($buy_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate']) + (($buy_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate'])*20/100) + ($GLOBALS['GCMS_SETTING']['shop']['eurorate'] * 5) ;
		$price = ($real_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate']) + (($real_price * $GLOBALS['GCMS_SETTING']['shop']['eurorate'])*50/100) + ($GLOBALS['GCMS_SETTING']['shop']['eurorate'] * 5)  ;
		
		$GLOBALS['GCMS']->assign('price', $price);
		$GLOBALS['GCMS']->assign('min_price', $min_price);
	}

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
				"brand" => $_POST['brand'],
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

	$en_titleHtml = $html->find('span[id=ProductName]');
	$GLOBALS['GCMS']->assign('brand', strtok($en_titleHtml[0]->plaintext, " "));
	$GLOBALS['GCMS']->assign('brands', Page::get(array("pg_type" => "brand", "pg_status" => "publish"),true));
	
	$arr_update=array(
			"id" => $id,
			"price" => $_POST['price'],
			"salse1_price" => $_POST['salse1_price'],
			"sales2_price" => $_POST['sales2_price'],
			"min_price" => $_POST['min_price'],

	);
	Products::update($arr_update);
	

}