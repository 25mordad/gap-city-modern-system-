<?php

/**
 * frontend_shop.php
 *
 * This file is part of GCMS > MODULE CONTROLLER
 * The file is part of the layer for controlling the system.
 * Linked place in VIEW: frontend > product
 *
 * @author dahdash  <dahdash@gmail.com>
 * @author 25Mordad <25Mordad@gmail.com>
 * @version 2.0
 *
 */

$utilityfile = __COREROOT__."/module/product/libs/utility.php";
if(file_exists($utilityfile))
	require_once($utilityfile);


function index()
{
	$arr_get=array(
			"pg_type" => "product_group",
			"pg_status" => "publish",
			"parent_id" => 0,
	);
	$GLOBALS['GCMS']->assign('groups', Page::get($arr_get, true,array("by"=>'pg_order',"sort"=>'ASC')));
}

function searchProduct()
{
	// …'"><svg onload=alert('OPENBUGBOUNTY')>
	$_GET["paging"] = htmlspecialchars(strip_tags($_GET["paging"]));
	$_GET["q"] = htmlspecialchars(strip_tags($_GET["q"]));
	$_GET["barcode"] = htmlspecialchars(strip_tags($_GET["barcode"]));
	$_GET["brand"] = htmlspecialchars(strip_tags($_GET["brand"]));
	if(!isset($_GET['q']) or $_GET['q'] == "")
		$_GET['q']="NULL";
	if(!isset($_GET['barcode']))
		$_GET['barcode']="NULL";
	if(!isset($_GET['brand']))
		$_GET['brand']="ALL";
	
	if(!isset($_GET['paging']))
			header("location: /shop/searchProduct/?paging=1&q=".$_GET['q']."&barcode=".$_GET['barcode']."&brand=".$_GET['brand']."");
	
	$max_results=9;
	$start = (($_GET['paging']*$max_results)-$max_results);
	$end = $max_results;
	$limit = " LIMIT $start  , $end ";
	
	//Brand
	$QBrand = " ";
	if ( $_GET['brand'] != "ALL"){
		$fetchBrand = explode("|", htmlspecialchars($_GET['brand'], ENT_QUOTES, 'UTF-8'));
		$QBrand = " AND `brand` = $fetchBrand[0] ";
	}
	
	//barcode
	$Qbarcode = " ";
	if ( $_GET['barcode'] != "NULL")
		$Qbarcode = " AND `barcode` LIKE '%$_GET[barcode]%' ";
	
	//q
	$Qq = " ";
	if ( $_GET['q'] != "NULL")
		$Qq = " AND ( `en_title` LIKE '%$_GET[q]%' OR `fa_title` LIKE '%$_GET[q]%' OR `en_txt` LIKE '%$_GET[q]%' OR `fa_txt` LIKE '%$_GET[q]%' )";
	
	$select = "SELECT * FROM `gcms_products` ";
	$selectCount = "SELECT COUNT(*) as Num FROM `gcms_products` ";
	
	$where = "
	WHERE TRUE
	AND `status` = 'publish'
	$Qbarcode $Qq $QBrand
	ORDER BY `gcms_products`.`p_order` DESC , `gcms_products`.`id` DESC
	";
	$queryWithLimit = $GLOBALS['GCMS_SAFESQL']->query($select.$where.$limit);
	$queryCount = $GLOBALS['GCMS_SAFESQL']->query($selectCount.$where);
	
	
	$GLOBALS['GCMS']->assign('products',$GLOBALS['GCMS_DB']->get_results($queryWithLimit));
	$GLOBALS['GCMS']->assign('paging', ceil($GLOBALS['GCMS_DB']->get_row($queryCount)->Num/$max_results));
	$GLOBALS['GCMS']->assign('gcms_page_title',$GLOBALS['GCMS_SETTING']['seo']['title'] );
	
	//size
	$mySize = Page::get(array("status" => "publish","pg_type" => "size"),true);
	foreach ($mySize as $ms)
	{
		$SizeAry[$ms->pg_title]= "$ms->pg_content";
	}
	$GLOBALS['GCMS']->assign('sizes', $SizeAry);
	
	//color
	$myColor= Page::get(array("status" => "publish","pg_type" => "color"),true);
	foreach ($myColor as $mc)
	{
		$ColorAry[$mc->pg_title]= "$mc->pg_content";
	}
	$GLOBALS['GCMS']->assign('colors', $ColorAry);
	
}

function keyword($id)
{
	$keys=RelKeywordProduct::get(array("key_id" => $id),true);
	
	$keyword = KeywordProduct::get(array("id" => $id));
	$GLOBALS['GCMS']->assign('keyword', $keyword );
	
	if(isset($id)&&isset($keys))
	{
		$_GET["paging"] = htmlspecialchars(strip_tags($_GET["paging"]));
		if(!isset($_GET['paging']))
			header("location: /shop/keyword/$id/".$GLOBALS['GCMS_ROUTER']->title."?paging=1");
		
			$GLOBALS['GCMS']->assign('gcms_page_title',$GLOBALS['GCMS_SETTING']['seo']['title']." | ". $keyword->kw_title  );
			
			$_GET["categoryid"] = htmlspecialchars(strip_tags($_GET["categoryid"]));
			$page=Page::get(array("id" => $_GET["categoryid"], "pg_type" => "product_group", "pg_status" => "publish"));
			if (isset($_GET['categoryid']) && isset($page)){
				
				$SubCat =	Page::get(array("parent_id" => $_GET["categoryid"],"status" => "publish"),true);
				$whereIn = "";
				foreach ($SubCat as $sc)
				{
					$whereIn = $whereIn. "," .$sc->id;
					$Sub2Cat =	Page::get(array("parent_id" => $sc->id,"status" => "publish"),true);
					foreach ($Sub2Cat as $sc2)
					{
						$whereIn = $whereIn. "," .$sc2->id;
					}
				}
				$max_results=9;
				
				$start = (($_GET['paging']*$max_results)-$max_results);
				$end = $max_results;
				$limit = " LIMIT $start  , $end ";
				
				//find key rel
				$queryKeyPro = " SELECT * FROM `gcms_keyword_product` WHERE `gcms_keyword_product`.`kw_title` like '%$page->pg_content%' ";
				$resultKeuId = $GLOBALS['GCMS_DB']->get_row($queryKeyPro);
				$queryKeyRelPro = "SELECT * FROM `gcms_rel_keyword_product` WHERE `key_id` = $resultKeuId->id ";
				$AllProWKey = $GLOBALS['GCMS_DB']->get_results($queryKeyRelPro);
				$allProIdWithKey = "";
				foreach ($AllProWKey as $row)
				{
					$allProIdWithKey = $allProIdWithKey.",".$row->product_id;
				}
				
				
				foreach ($keys as $row)
				{
					$allProdId = $allProdId.$row->product_id;
					if($row != end($keys)) {
				         $allProdId = $allProdId.","; 
				    }
				}
				
				
				$select = "SELECT * FROM `gcms_products` ";
				$selectCount = "SELECT COUNT(*) as Num FROM `gcms_products` ";
				
				$where = "
				WHERE TRUE
				AND `status` = 'publish'
				AND (`group_id` IN (".$_GET["categoryid"]."  $whereIn) OR `id` IN (0 $allProIdWithKey))
				AND (id IN ( $allProdId ))
				ORDER BY `gcms_products`.`p_order` DESC , `gcms_products`.`id` DESC
				";
				$queryWithLimit = $GLOBALS['GCMS_SAFESQL']->query($select.$where.$limit);
				$queryCount = $GLOBALS['GCMS_SAFESQL']->query($selectCount.$where);
				
				$GLOBALS['GCMS']->assign('products',$GLOBALS['GCMS_DB']->get_results($queryWithLimit));
				$GLOBALS['GCMS']->assign('paging', ceil($GLOBALS['GCMS_DB']->get_row($queryCount)->Num/$max_results));
				$GLOBALS['GCMS']->assign('group', $page);
				
				if (!isset($SubCat)){
					$where = "
						WHERE TRUE
						AND `status` = 'publish'
						AND (`group_id` IN (".$_GET["categoryid"]."  $whereIn) OR `id` IN (0 $allProIdWithKey))
						ORDER BY `gcms_products`.`p_order` DESC , `gcms_products`.`id` DESC
									";
					$selectKeysW = "SELECT id FROM `gcms_products` ";
					$queryKeysW = $GLOBALS['GCMS_SAFESQL']->query($selectKeysW.$wherekey);
					$qFindIdIn = "SELECT DISTINCT key_id ,  `gcms_keyword_product`.`kw_title` FROM `gcms_rel_keyword_product` inner join `gcms_keyword_product` on `gcms_keyword_product`.`id` = `gcms_rel_keyword_product`.`key_id` where product_id in ( $queryKeysW )";
					$GLOBALS['GCMS']->assign('keysW',$GLOBALS['GCMS_DB']->get_results($GLOBALS['GCMS_SAFESQL']->query($qFindIdIn)));
				}
				$keywordFa = array(
						"men"             => "مردانه" ,
						"women"           => "زنانه" ,
						"kids"            => "بچه‌گانه" ,
						"football_shirt"  => "پیراهن ورزشی" ,
						"football_short"  => "شورت ورزشی" ,
						"football_sock"   => "جوراب ورزشی" ,
						"goalkeeper"      => "لباس دروازه‌بان" ,
						"jacket"          => "کاپشن‌" ,
						"tracksuit"       => "شلوار و گرمکن ورزشی" ,
						"polo"            => "تی‌شرت یقه‌دار" ,
						"backpack"        => "کوله‌پشتی" ,
							
				);
				$GLOBALS['GCMS']->assign('keywordFa', $keywordFa);
			}else
				header("location: /error404?error=shop&reason=product_group_not_exist");
	}else
		header("location: /error404?error=shop&reason=keyword_group_not_exist");
	
}
function category($id)
{
	$page=Page::get(array("id" => $id, "pg_type" => "product_group", "pg_status" => "publish"));


	if(isset($id)&&isset($page))
	{
		if(!isset($_GET['paging']))
			header("location: /shop/category/$id/".str_replace(" ", "+", $GLOBALS['GCMS_ROUTER']->title)."?paging=1");
			
		$SubCat =	Page::get(array("parent_id" => $id,"status" => "publish"),true);
		$GLOBALS['GCMS']->assign('gcms_page_title',$GLOBALS['GCMS_SETTING']['seo']['title']." | ". $page->pg_content . " + " .$page->pg_title );
		$GLOBALS['GCMS']->assign('SubCat', $SubCat );
		$whereIn = "";
		foreach ($SubCat as $sc)
		{
			$whereIn = $whereIn. "," .$sc->id;
			$Sub2Cat =	Page::get(array("parent_id" => $sc->id,"status" => "publish"),true);
			foreach ($Sub2Cat as $sc2)
			{
				$whereIn = $whereIn. "," .$sc2->id;
			}
		}
		$max_results=9;
		
		$start = (($_GET['paging']*$max_results)-$max_results);
		$end = $max_results;
		$limit = " LIMIT $start  , $end ";
		
		//find key rel
		$queryKeyPro = " SELECT * FROM `gcms_keyword_product` WHERE `gcms_keyword_product`.`kw_title` like '%$page->pg_content%' ";
		$resultKeuId = $GLOBALS['GCMS_DB']->get_row($queryKeyPro);
		$queryKeyRelPro = "SELECT * FROM `gcms_rel_keyword_product` WHERE `key_id` = $resultKeuId->id ";
		$AllProWKey = $GLOBALS['GCMS_DB']->get_results($queryKeyRelPro);
		$allProIdWithKey = "";
		foreach ($AllProWKey as $row)
		{
			$allProIdWithKey = $allProIdWithKey.",".$row->product_id;
		}
		
		
		$select = "SELECT * FROM `gcms_products` ";
		$selectCount = "SELECT COUNT(*) as Num FROM `gcms_products` ";
		
		$where = "
				WHERE TRUE 
					AND `status` = 'publish' 
					AND (`group_id` IN ($id  $whereIn) OR `id` IN (0 $allProIdWithKey))
				ORDER BY `gcms_products`.`p_order` DESC , `gcms_products`.`id` DESC 
				";
		$queryWithLimit = $GLOBALS['GCMS_SAFESQL']->query($select.$where.$limit);
		$queryCount = $GLOBALS['GCMS_SAFESQL']->query($selectCount.$where);
		
		if (!isset($SubCat)){
			$selectKeysW = "SELECT id FROM `gcms_products` ";
			$queryKeysW = $GLOBALS['GCMS_SAFESQL']->query($selectKeysW.$where);
			$qFindIdIn = "SELECT DISTINCT key_id ,  `gcms_keyword_product`.`kw_title` FROM `gcms_rel_keyword_product` inner join `gcms_keyword_product` on `gcms_keyword_product`.`id` = `gcms_rel_keyword_product`.`key_id` where product_id in ( $queryKeysW )";
			$GLOBALS['GCMS']->assign('keysW',$GLOBALS['GCMS_DB']->get_results($GLOBALS['GCMS_SAFESQL']->query($qFindIdIn)));
		}
		
		
		$GLOBALS['GCMS']->assign('products',$GLOBALS['GCMS_DB']->get_results($queryWithLimit));
		$GLOBALS['GCMS']->assign('paging', ceil($GLOBALS['GCMS_DB']->get_row($queryCount)->Num/$max_results));
		$GLOBALS['GCMS']->assign('group', $page);
		
		$keywordFa = array(
						"men"             => "مردانه" ,
						"women"           => "زنانه" ,
						"kids"            => "بچه‌گانه" ,
						"football_shirt"  => "پیراهن ورزشی" ,
						"football_short"  => "شورت ورزشی" ,
						"football_sock"   => "جوراب ورزشی" ,
						"goalkeeper"      => "لباس دروازه‌بان" ,
						"jacket"          => "کاپشن‌" ,
						"tracksuit"       => "شلوار و گرمکن ورزشی" ,
						"polo"            => "تی‌شرت یقه‌دار" ,
						"backpack"        => "کوله‌پشتی" ,
							
				);
		$GLOBALS['GCMS']->assign('keywordFa', $keywordFa);
		
	}
	else
		header("location: /error404?error=shop&reason=product_group_not_exist");
}

function show($id)
{
	$product=Products::get(array("id" => $id , "status" => "publish"));
	if(isset($id)&&isset($product))
	{
		
		if (isset($_GET['addToBasket'])){
			if ($product->show_sales_price == "sales1"){
				$discount = $product->price - $product->salse1_price;
			}
			if ($product->show_sales_price == "sales2"){
				$discount = $product->price - $product->sales2_price;
			}
			if ($product->show_sales_price == "min"){
				$discount = $product->price - $product->min_price;
			}
			if ($product->show_sales_price == "none"){
				$discount = 0;
			}
			if(is_array($_SESSION['gcmsCart'])){
				$max=count($_SESSION['gcmsCart']);
					$_SESSION['gcmsCart'][$max]['productId']=$id;
					$_SESSION['gcmsCart'][$max]['color']=$_GET['color'];
					$_SESSION['gcmsCart'][$max]['size']=$_GET['size'];
					$_SESSION['gcmsCart'][$max]['price']=$product->price;
					$_SESSION['gcmsCart'][$max]['discount']=$discount;
			}else{
				$_SESSION['gcmsCart']=array();
				$_SESSION['gcmsCart'][0]['productId']=$id;
				$_SESSION['gcmsCart'][0]['color']=$_GET['color'];
				$_SESSION['gcmsCart'][0]['size']=$_GET['size'];
				$_SESSION['gcmsCart'][0]['price']=$product->price;
				$_SESSION['gcmsCart'][0]['discount']=$discount;
			}
			$_SESSION['result']=" محصول با موفقیت به سبد خرید اضافه شد.";
			$_SESSION['alert']="success";
			header("location: /shop/cart");
		}

		$GLOBALS['GCMS']
				->assign('gcms_page_title',
						$GLOBALS['GCMS_SETTING']['seo']['title']." | ".$product->fa_title." | ".$product->en_title);
		$GLOBALS['GCMS']->assign('allkeywords',KeywordProduct::get(NULL, true, $order, NULL, $id));
		$GLOBALS['GCMS']->assign('product', $product);
		//size
		$mySize = Page::get(array("status" => "publish","pg_type" => "size"),true);
		foreach ($mySize as $ms)
		{
			$SizeAry[$ms->pg_title]= "$ms->pg_content";
		}
		$GLOBALS['GCMS']->assign('sizes', $SizeAry);
		
		//color
		$myColor= Page::get(array("status" => "publish","pg_type" => "color"),true);
		foreach ($myColor as $mc)
		{
			$ColorAry[$mc->pg_title]= "$mc->pg_content";
		}
		$GLOBALS['GCMS']->assign('colors', $ColorAry);
		
		//update visit
		Products::update(array("id" => $id,"visitor" => $product->visitor + 1));
		
		
	}
	else
		header("location: /error404?error=product&reason=product_not_exist");
}

function param($id)
{
    if (!isset($id))
        header("location: /error404?error=product&reason=param_id_not_set");
	$GLOBALS['GCMS']
				->assign('param',
						ProductParam::get(array("id" => $id, "status" => "publish")));
	$GLOBALS['GCMS']
				->assign('paramvaluelist',
						RelProParam::get(array("id_param" => $id), true, array("by" => "value"), null,"value"));
	if (isset($_GET['g']))
	{
		$GLOBALS['GCMS']
				->assign('params',
						ProductParam::get(array("id_product_group" => $_GET['g'], "status" => "publish"),
								true));
	}
	if (isset($_GET['v']))
	{
		$GLOBALS['GCMS']
				->assign('productlist',
						RelProParam::get(array("id_param"=> $id, "value" => $_GET['v']), true, null, null,null));
	}else {
		$GLOBALS['GCMS']
				->assign('productlist',
						RelProParam::get(array("id_param" => $id), true, null, null,null));
	}
}

function search()
{
	if(isset($_GET['q'])&&trim($_GET['q'])!="")
	{
		$search=str_replace(" ", "%", htmlspecialchars(trim($_GET['q']), ENT_QUOTES));
		if(!isset($_GET['paging']))
			header("location: /product/search/?paging=1&q=$_GET[q]");
			
		$max_results=10;
		$arr_get=array(
					"pg_type" => "product",
					"pg_status" => "publish",
					"search" => "%".$search."%"
		);
		$order=array(
					"by" => "date_created",
					"sort" => "DESC"
		);
		$limit=array(
					"start" => (($_GET['paging']*$max_results)-$max_results),
					"end" => $max_results
		);
		$finds=Page::get($arr_get, true, $order, $limit);
		if(count($finds)>0)
		{
			foreach($finds as $find)
			{
				$temp=explode($search, strip_tags($find->pg_content), 2);
				$templen=strlen($temp[0]);
				if($templen>150)
				{
					$templen=$templen-110;
				}
				$temp[0]=substr($temp[0], $templen);
				$temp[0]=substr($temp[0], strpos($temp[0], " "));
				$temp[0]=" ... ".$temp[0];
				$find->pg_content=$temp[0]."<span style=\"color:red;background-color:yellow\" >"
						.$search."</span>"." ... ";
			}
			$GLOBALS['GCMS']->assign('finds', $finds);
			$GLOBALS['GCMS']->assign('paging', ceil(Page::get_count($arr_get)/$max_results));
			return;
		}
	}
	$GLOBALS['GCMS']->assign('finds', "false");
}

function cart()
{
	//unset($_SESSION['gcmsCart']);
	if (isset($_GET['del'])){
		$id=intval($_GET['del']);
		$max=count($_SESSION['gcmsCart']);
		for($i=0;$i<$max;$i++){
			if($id==$_SESSION['gcmsCart'][$i]['productId']){
				unset($_SESSION['gcmsCart'][$i]);
				break;
			}
		}
		$_SESSION['gcmsCart']=array_values($_SESSION['gcmsCart']);
		header("location: /shop/cart");
		
	}
	if (isset($_GET['discount'])){
		//find discount
		$discount = strtolower(trim($_GET['discount']));
		$isDiscount = Page::get(array("status" => "publish","pg_type" => "discount","pg_title" => $discount));
		if (isset($isDiscount->id)){
			$socialNetwork = substr($discount, 0,2);
			$time = substr($discount, 2,1);
			$code = substr($discount, 3,4);
			$amount = substr($discount, 7,3);
			
			if ($time == "w"){
				if ( date("W") == ($code-2017)/17 ){
					$GLOBALS['GCMS']->assign('discountAmount', $amount*1000);
				}else{
					$_SESSION['result']=" کدتخفیف اعتبار ندارد ";
					$_SESSION['alert']="warning";
					header("location: /shop/cart");
				}
			}elseif($time == "d"){
				if ( date("z")+1 == ($code-2017)/17 ){
					$GLOBALS['GCMS']->assign('discountAmount', $amount*1000);
				}else{
					$_SESSION['result']=" کدتخفیف اعتبار ندارد ";
					$_SESSION['alert']="warning";
					header("location: /shop/cart");
				}
			}
			
		}else{
			$_SESSION['result']=" کدتخفیف اشتباه است ";
			$_SESSION['alert']="warning";
			header("location: /shop/cart");
		}
		
	}
}

function  checkout()
{
	if(isset($_SESSION["glogin_username"]))
	{
		if (isset($_GET['discount'])){
			//find discount
			$discount = strtolower(trim($_GET['discount']));
			$isDiscount = Page::get(array("status" => "publish","pg_type" => "discount","pg_title" => $discount));
			if (isset($isDiscount->id)){
				$socialNetwork = substr($discount, 0,2);
				$time = substr($discount, 2,1);
				$code = substr($discount, 3,4);
				$amount = substr($discount, 7,3);
					
				if ($time == "w"){
					if ( date("W") == ($code-2017)/17 ){
						$GLOBALS['GCMS']->assign('discountAmount', $amount*1000);
					}else{
						$_SESSION['result']=" کدتخفیف اعتبار ندارد ";
						$_SESSION['alert']="warning";
						header("location: /shop/cart");
					}
				}elseif($time == "d"){
					if ( date("z")+1 == ($code-2017)/17 ){
						$GLOBALS['GCMS']->assign('discountAmount', $amount*1000);
					}else{
						$_SESSION['result']=" کدتخفیف اعتبار ندارد ";
						$_SESSION['alert']="warning";
						header("location: /shop/cart");
					}
				}
					
			}else{
				$_SESSION['result']=" کدتخفیف اشتباه است ";
				$_SESSION['alert']="warning";
				header("location: /shop/cart");
			}
		
		}
	}else
		header("location: /user?redirect=".$_SERVER["REQUEST_URI"]);
	
}




