<?php /* Smarty version Smarty-3.0.8, created on 2016-09-28 00:17:47
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/category/list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59189462057eadaf37e7ba1-86366389%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcde7f7cb1279972ca11dec3eeb2351aaba0d504' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/category/list.tpl',
      1 => 1475008809,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59189462057eadaf37e7ba1-86366389',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="w100 clearfix category-top">
                <h2> <?php echo $_smarty_tpl->getVariable('group')->value->pg_content;?>
 </h2>

                <div class="categoryImage">
	                <img src="/uploads/source/category/slide/<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
.jpg" 
	                class="img-responsive" alt="<?php echo $_smarty_tpl->getVariable('group')->value->pg_content;?>
 <?php echo $_smarty_tpl->getVariable('group')->value->pg_title;?>
" title="<?php echo $_smarty_tpl->getVariable('group')->value->pg_content;?>
 <?php echo $_smarty_tpl->getVariable('group')->value->pg_title;?>
" >
                </div>
            </div>
            <!--/.category-top-->

            <!-- <div class="row subCategoryList clearfix">
            <?php  $_smarty_tpl->tpl_vars['sc'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('SubCat')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sc']->key => $_smarty_tpl->tpl_vars['sc']->value){
?>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4  text-center ">
                    <div class="thumbnail equalheight"><a class="subCategoryThumb" 
                    href="/shop/category/<?php echo $_smarty_tpl->getVariable('sc')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('sc')->value->pg_content),$_smarty_tpl);?>
+<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('sc')->value->pg_title),$_smarty_tpl);?>
">
                    <img src="/uploads/source/category/thumb/<?php echo $_smarty_tpl->getVariable('sc')->value->id;?>
.jpg" 
                    class="img-rounded " alt="<?php echo $_smarty_tpl->getVariable('sc')->value->pg_title;?>
"> </a> 
                            <a class="subCategoryTitle"><span> <?php echo $_smarty_tpl->getVariable('sc')->value->pg_content;?>
 </span></a>
                    </div>
                </div>
            <?php }} ?>
            </div> -->
            <!--/.subCategoryList-->

            <!-- <div class="w100 productFilter clearfix">
                <p class="pull-left"> Showing <strong>12</strong> products </p>

                <div class="pull-right ">
                    <div class="change-order pull-right">
                        <select class="form-control" name="orderby">
                            <option selected="selected">Default sorting</option>
                            <option value="popularity">Sort by popularity</option>
                            <option value="rating">Sort by average rating</option>
                            <option value="date">Sort by newness</option>
                            <option value="price">Sort by price: low to high</option>
                            <option value="price-desc">Sort by price: high to low</option>
                        </select>
                    </div>
                    <div class="change-view pull-right"><a href="#" title="Grid" class="grid-view"> <i
                            class="fa fa-th-large"></i> </a> <a href="#" title="List" class="list-view "><i
                            class="fa fa-th-list"></i></a></div>
                </div>
            </div> -->
            <!--/.productFilter-->
            <div class="row  categoryProduct xsResponse clearfix " style="margin-top: 20px">
				<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
                <div class="item itemauto col-sm-4 col-lg-4 col-md-4 col-xs-6">
                    <div class="product">
                        

						<?php echo smarty_function_get_all_images(array('type'=>"shop",'id'=>$_smarty_tpl->getVariable('product')->value->id),$_smarty_tpl);?>

                        <div class="imageHover">
							<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price!="none"){?>
								<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales1"){?>
                            	<div class="promotion"><span class="discount" style="font-family: verdana;font-weight: bold;"><?php echo 100-floor($_smarty_tpl->getVariable('product')->value->salse1_price*100/$_smarty_tpl->getVariable('product')->value->price);?>
% OFF</span></div>
                            	<?php }?>
								<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales2"){?>
                            	<div class="promotion"><span class="discount" style="font-family: verdana;font-weight: bold;"><?php echo 100-floor($_smarty_tpl->getVariable('product')->value->sales2_price*100/$_smarty_tpl->getVariable('product')->value->price);?>
% OFF</span></div>
                            	<?php }?>
								<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="min"){?>
                            	<div class="promotion"><span class="discount" style="font-family: verdana;font-weight: bold;"><?php echo 100-floor($_smarty_tpl->getVariable('product')->value->min_price*100/$_smarty_tpl->getVariable('product')->value->price);?>
% OFF</span></div>
                            	<?php }?>
							<?php }?>
                            <div id="carousel-id-<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                	<?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, null);?>
                                	<?php  $_smarty_tpl->tpl_vars['pageImag'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('getallimages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['pageImag']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['pageImag']->iteration=0;
if ($_smarty_tpl->tpl_vars['pageImag']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pageImag']->key => $_smarty_tpl->tpl_vars['pageImag']->value){
 $_smarty_tpl->tpl_vars['pageImag']->iteration++;
 $_smarty_tpl->tpl_vars['pageImag']->last = $_smarty_tpl->tpl_vars['pageImag']->iteration === $_smarty_tpl->tpl_vars['pageImag']->total;
?>
                                    <li data-target="#carousel-id-<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" data-slide-to="<?php echo $_smarty_tpl->getVariable('i')->value;?>
" <?php if ($_smarty_tpl->tpl_vars['pageImag']->last){?>class="active"<?php }?> ></li>
                                    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->getVariable('i')->value+1, null, null);?>
                                    <?php }} ?>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                	
                                    <?php  $_smarty_tpl->tpl_vars['pageImag'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('getallimages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['pageImag']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['pageImag']->iteration=0;
if ($_smarty_tpl->tpl_vars['pageImag']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pageImag']->key => $_smarty_tpl->tpl_vars['pageImag']->value){
 $_smarty_tpl->tpl_vars['pageImag']->iteration++;
 $_smarty_tpl->tpl_vars['pageImag']->last = $_smarty_tpl->tpl_vars['pageImag']->iteration === $_smarty_tpl->tpl_vars['pageImag']->total;
?>
                                    <div class="item <?php if ($_smarty_tpl->tpl_vars['pageImag']->last){?>active<?php }?>">
                                    <a href="/shop/show/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('product')->value->en_title),$_smarty_tpl);?>
 <?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('product')->value->fa_title),$_smarty_tpl);?>
">
                                    <img src="<?php echo $_smarty_tpl->getVariable('pageImag')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('pageImag')->value->im_name;?>
" alt="<?php echo $_smarty_tpl->getVariable('pageImag')->value->im_name;?>
" class="img-responsive ">
                                    </a>
                                    </div>
                                    <?php }} ?>
                                    
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-id-<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">قبلی</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-id-<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">بعدی</span>
                                </a>
                            </div>


                        </div>


                        <div class="description">
                            <h4><a href="/shop/show/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('product')->value->en_title),$_smarty_tpl);?>
 <?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('product')->value->fa_title),$_smarty_tpl);?>
"> <?php echo $_smarty_tpl->getVariable('product')->value->fa_title;?>
 </a></h4>

                            <div class="grid-description">
                                <p><img src="/uploads/source/brand/<?php echo $_smarty_tpl->getVariable('product')->value->brand;?>
.png" /> </p>
                            </div>
                            <div class="list-description">
                                <p style="text-align: justify;"> 
                                <?php echo $_smarty_tpl->getVariable('product')->value->fa_txt;?>

                                </p>
                            </div>
                            <?php $_smarty_tpl->tpl_vars['sizeArr'] = new Smarty_variable(explode("|",$_smarty_tpl->getVariable('product')->value->size), null, null);?>
                            <span class="size">
                            	<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sizeArr')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['s']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['s']->iteration=0;
if ($_smarty_tpl->tpl_vars['s']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value){
 $_smarty_tpl->tpl_vars['s']->iteration++;
 $_smarty_tpl->tpl_vars['s']->last = $_smarty_tpl->tpl_vars['s']->iteration === $_smarty_tpl->tpl_vars['s']->total;
?>
			                    	<?php if ($_smarty_tpl->tpl_vars['s']->value!=''){?>
                                    <?php echo $_smarty_tpl->getVariable('sizes')->value[$_smarty_tpl->tpl_vars['s']->value];?>
<?php if (!$_smarty_tpl->tpl_vars['s']->last){?>/<?php }?>
                                    <?php }?>
			                     <?php }} ?>
                            </span>
                            <?php $_smarty_tpl->tpl_vars['colorArr'] = new Smarty_variable(explode("|",$_smarty_tpl->getVariable('product')->value->color), null, null);?>
                            <span class="color clearfix">
                            	<ul class="swatchesList ">
			                    	<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('colorArr')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value){
?>
			                    	<?php if ($_smarty_tpl->tpl_vars['c']->value!=''){?>
			                        <li><a class="<?php echo $_smarty_tpl->tpl_vars['c']->value;?>
" > </a></li>
			                        <?php }?>
			                        <?php }} ?>
			                    </ul>
                            </span>
                            
                            </div>
                        <div class="price">
                        	<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="none"){?>
                        	<span><?php echo number_format($_smarty_tpl->getVariable('product')->value->price);?>
</span>
                        	<span style="font-size: 10px;" >تومان</span>
                        	<?php }else{ ?>
                        		<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales1"){?>
	                        	<span><?php echo number_format($_smarty_tpl->getVariable('product')->value->salse1_price);?>
</span>
	                        	<span class="old-price"><?php echo $_smarty_tpl->getVariable('product')->value->price/1000;?>
 هزار تومان</span>
                        		<?php }?>
                        		<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="min"){?>
	                        	<span><?php echo number_format($_smarty_tpl->getVariable('product')->value->min_price);?>
</span>
	                        	<span class="old-price"><?php echo $_smarty_tpl->getVariable('product')->value->price/1000;?>
 هزار تومان</span>
                        		<?php }?>
                        		<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales2"){?>
	                        	<span><?php echo number_format($_smarty_tpl->getVariable('product')->value->sales2_price);?>
</span>
	                        	<span class="old-price"><?php echo $_smarty_tpl->getVariable('product')->value->price/1000;?>
 هزار تومان</span>
                        		<?php }?>
                        	<?php }?>
                        </div>
                        <div class="action-control"><a href="/shop/show/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('product')->value->fa_title),$_smarty_tpl);?>
+<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('product')->value->en_title),$_smarty_tpl);?>
" class="btn btn-primary"> <span class="add2cart"><i
                                class="glyphicon glyphicon-shopping-cart"> </i> اضافه کردن به سبد خرید </span> </a></div>
                    </div>
                </div>
                <!--/.item-->
				<?php }} ?>
            </div>
            <!--/.categoryProduct || product content end-->

            <div class="w100 categoryFooter">
                <div class="pagination pull-left no-margin-top">
                    <?php $_template = new Smarty_Internal_Template("tpl/paging.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
                </div>
                <!-- <div class="pull-right pull-right col-sm-4 col-xs-12 no-padding text-right text-left-xs">
                    <p>Showing 1–450 of 12 results</p>
                </div> -->
            </div>
            <!--/.categoryFooter-->
        </div>