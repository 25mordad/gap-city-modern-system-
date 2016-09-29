<?php /* Smarty version Smarty-3.0.8, created on 2016-09-22 00:55:41
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/searchProduct/filter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:111915596957e2fad519c2a1-24369947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '099de97001c5c628b8af19393a48462e2710d9b8' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/searchProduct/filter.tpl',
      1 => 1474493112,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '111915596957e2fad519c2a1-24369947',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="panel-group" id="accordionNo">
                <!--Category-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a data-toggle="collapse" href="#collapseCategory"
                                                   class="collapseWill active ">
                            <span class="pull-left"> <i class="fa fa-caret-right"></i></span> جستجو  </a></h4>
                    </div>
                    <div id="collapseCategory" class="panel-collapse collapse in">
                        <div class="panel-body">
                        	<p>
                            متن جستجو
                            </p>
                            <div class="form-group">
                                <input type="text" class="col-md-12" id="qInput" name="q" onkeypress="checkInter(event);" 
                                       placeholder="عبارت جستجو را وارد کنید و اینتر را بزنید" value="<?php if ($_GET['q']!="NULL"){?><?php echo $_GET['q'];?>
<?php }?>" >
                                
                            </div>
                            <div class="clearfix" ></div>
                        	<hr>
                            <p>
                            کد محصول
                            </p>
                            <div class="form-group">
                                <input type="text" class="col-md-12" id="barcodeInput" name="barcode" onkeypress="checkInter(event);" 
                                       placeholder="کد محصول را وارد کنید و اینتر را بزنید" value="<?php if ($_GET['barcode']!="NULL"){?><?php echo $_GET['barcode'];?>
<?php }?>" >
                                <script type="text/javascript">
                                function goSearch() {
                                	barcodeInput = document.getElementById('barcodeInput').value;
                                	
                                	qInput = document.getElementById('qInput').value;
                                	
                                	window.location = "/shop/searchProduct/?paging=1&q="+qInput+"&barcode="+barcodeInput+"&brand=<?php echo $_GET['brand'];?>
";
								}
                                function checkInter(e) {
                                	if(e.keyCode == 13)
                                		goSearch();
								}
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/Category menu end-->

            
            </div>
        </div>
