<?php /* Smarty version Smarty-3.0.8, created on 2016-09-19 05:01:14
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32933797557df31d295e0f5-39238578%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89f4ab50b6179defe08d32a5f0268efc35dcf5f3' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show/content.tpl',
      1 => 1474245073,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32933797557df31d295e0f5-39238578',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
            <?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('product')->value->brand),$_smarty_tpl);?>
<?php $_smarty_tpl->tpl_vars['brand'] = new Smarty_variable($_smarty_tpl->getVariable('getpage')->value, null, null);?>
            <h1 class="product-title" style="float: right">  <?php echo $_smarty_tpl->getVariable('product')->value->fa_title;?>
 </h1>
				<h3 style="color: #999999;float: right;margin-right: 10px" > <?php echo $_smarty_tpl->getVariable('brand')->value->pg_content;?>
 - <?php echo $_smarty_tpl->getVariable('brand')->value->pg_title;?>
</h3>
				<div class="clearfix" ></div>
				<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="none"){?>
                <div class="product-price">
                    <span class="price-sales" ><?php echo number_format($_smarty_tpl->getVariable('product')->value->price);?>
 </span>
                    	<span style="font-size: 14px;" >تومان</span>
                    	<?php if ($_smarty_tpl->getVariable('product')->value->show_real_price=="true"){?>
                    	 <span style="color: #CCCCCC;font-size: 11px;font-family: tahoma;font-weight: normal;">قیمت اصلی €<?php echo $_smarty_tpl->getVariable('product')->value->real_price;?>
  یورو</span>
                    	<?php }?>
                </div>
				<?php }else{ ?>
                <div class="product-price">
                	<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales1"){?>
                    <span class="price-sales" ><?php echo number_format($_smarty_tpl->getVariable('product')->value->salse1_price);?>
 </span>
                    <?php }?>
                	<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales2"){?>
                    <span class="price-sales" ><?php echo number_format($_smarty_tpl->getVariable('product')->value->sales2_price);?>
 </span>
                    <?php }?>
                	<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="min"){?>
                    <span class="price-sales" ><?php echo number_format($_smarty_tpl->getVariable('product')->value->min_price);?>
 </span>
                    <?php }?>
                    	<span style="font-size: 14px;" >تومان</span>
                    	<span class="price-standard"><?php echo number_format($_smarty_tpl->getVariable('product')->value->price);?>
</span>
                    	<?php if ($_smarty_tpl->getVariable('product')->value->show_real_price=="true"){?>
                    	 <span style="color: #CCCCCC;font-size: 11px;font-family: tahoma;font-weight: normal;">قیمت اصلی €<?php echo $_smarty_tpl->getVariable('product')->value->real_price;?>
  یورو</span>
                    	<?php }?>
                </div>
				<?php }?>
                <div class="color-details productFilter productFilterLook2">
	                <div class="row">
	                        <div class="col-lg-6 col-sm-6 col-xs-6">
	                        
	                        <script type="text/javascript">
	                        function showColor(color){
	                        	document.getElementById("showproductcolor").innerHTML = color;
	                        }
	                        </script>
	                        <?php $_smarty_tpl->tpl_vars['colorArr'] = new Smarty_variable(explode("|",$_smarty_tpl->getVariable('product')->value->color), null, null);?>
			                    <ul class="swatches Color">
			                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(1, null, null);?>
			                    	<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('colorArr')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
			                    	<?php if ($_smarty_tpl->tpl_vars['c']->value!=''){?>
			                    	<?php if ($_smarty_tpl->getVariable('i')->value==1){?>
			                    		<?php $_smarty_tpl->tpl_vars['col'] = new Smarty_variable($_smarty_tpl->tpl_vars['c']->value, null, null);?>
			                    	<?php }?>
			                        <li><a class="<?php echo $_smarty_tpl->tpl_vars['c']->value;?>
" id="color_<?php echo $_smarty_tpl->tpl_vars['c']->value;?>
" onclick="showColor('<?php echo $_smarty_tpl->getVariable('colors')->value[$_smarty_tpl->tpl_vars['c']->value];?>
')" > </a></li>
			                        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->getVariable('i')->value+1, null, null);?>
			                        <?php }?>
			                        <?php }} ?>
			                    </ul>
			                    <div id="showproductcolor" ></div>
			                    <script type="text/javascript">
			                    document.getElementById("color_<?php echo $_smarty_tpl->getVariable('col')->value;?>
").click();
			                    </script>
	                        </div>
	                        <div class="col-lg-6 col-sm-6 col-xs-6">
                            <div class="filterBox" style="margin-top: 10px">
                            <?php $_smarty_tpl->tpl_vars['sizeArr'] = new Smarty_variable(explode("|",$_smarty_tpl->getVariable('product')->value->size), null, null);?>
                                <select class="form-control" >
                                	<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sizeArr')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value){
?>
			                    	<?php if ($_smarty_tpl->tpl_vars['s']->value!=''){?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['s']->value;?>
" ><?php echo $_smarty_tpl->getVariable('sizes')->value[$_smarty_tpl->tpl_vars['s']->value];?>
</option>
                                    <?php }?>
			                        <?php }} ?>
                                </select>
                            </div>
                        </div>
	                </div>
                    
                </div>
                <!--/.color-details-->


                <div class="cart-actions">
                    <div class="addto row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                        <div class="socialIcon">
		                        <a href="https://telegram.me/share/url?url=<?php echo $_SERVER['HTTP_HOST'];?>
<?php echo $_SERVER['REQUEST_URI'];?>
" target="_blank" style="background: #269DD8"> <i class="fa fa-paper-plane" ></i></a>
		                        <a href="https://www.instagram.com/mroozi_women/" target="_blank" style="background: #AF34B0"> <i class="fa fa-instagram" ></i></a>
		                        <a href="#" style="background: #48649F"> <i class="fa fa-facebook"></i></a>
		                        <a href="#" style="background: #6FAEDC"> <i class="fa fa-twitter"></i></a>
		                        <a href="#" style="background: #DC4A38"> <i class="fa fa-google-plus"></i></a>
	                        </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <?php if ($_smarty_tpl->getVariable('product')->value->quantity>0){?>
                            <button onclick="goTelegram();"
                                    class="button btn-block btn-cart cart first" title="Add to Cart" type="button">
                                    اضافه کردن به سبد خرید
                            </button>
                            <script type="text/javascript">
                            function goTelegram(){
                            	window.open("https://telegram.me/MrooziShop", "_blank");
                            }
                            </script>
                        <?php }?>
                        </div>
                    </div>

                    <div style="clear:both"></div>
					<?php if ($_smarty_tpl->getVariable('product')->value->quantity>0){?>
					<h3 class="incaps"><i class="fa fa fa-check-circle-o color-in"></i> موجود</h3>
					<?php }else{ ?>
					<h3 class="incaps"><i class="fa fa-minus-circle color-out"></i> ناموجود</h3>
					<?php }?>

                    <h3 class="incaps"><i class="glyphicon glyphicon-lock" style="color: #4CC94A"></i> خرید امن آنلاین</h3> 
                     
                    <h3 class="incaps"><i class="glyphicon glyphicon-check" style="color: #4CC94A" ></i> ضمانت اصل بودن کالا </h3>
                    <h3 class="incaps"><i class="glyphicon glyphicon-plane" style="color: #4CC94A" ></i> تحویل <?php echo $_smarty_tpl->getVariable('product')->value->delivery_time;?>
 روزه</h3> 
                    
                </div>
                <!--/.cart-actions-->
				<div class="clear"></div>
				<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/txt.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
                <div class="clear"></div>



               
