<?php /* Smarty version Smarty-3.0.8, created on 2016-09-28 17:30:15
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/newArrivals.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178212918257ebccef8b02b2-14667385%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0fddc8a190d02d3ec0c79e9462bc41b6c74aa08' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/newArrivals.tpl',
      1 => 1475070190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178212918257ebccef8b02b2-14667385',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
    <!-- Main component call to action -->
    <div class="row featuredPostContainer globalPadding style2">
        <h3 class="section-title style2 text-center"><span>جدیدترین محصولات</span></h3>

        <div id="productslider" class="owl-carousel owl-theme">
        	<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('shopNewArrivals')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
?>
            <div class="item" style="direction: rtl;">
                <div class="product">

                    <div class="image">
                        plesk port
                        <a href="/shop/show/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->en_title),$_smarty_tpl);?>
 <?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->fa_title),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->getVariable('row')->value->default_photo;?>
" alt="img"
                                                            class="img-responsive"></a>

                        <div class="promotion"><span class="new-product"> NEW</span> 
                        
                        <?php if ($_smarty_tpl->getVariable('row')->value->show_sales_price!="none"){?>
		                	<span class="discount">
		                	<?php if ($_smarty_tpl->getVariable('row')->value->show_sales_price=="sales1"){?>
		                		<?php echo 100-floor($_smarty_tpl->getVariable('row')->value->salse1_price*100/$_smarty_tpl->getVariable('row')->value->price);?>
% 
		                	<?php }?>	
		                	<?php if ($_smarty_tpl->getVariable('row')->value->show_sales_price=="sales2"){?>
		                		<?php echo 100-floor($_smarty_tpl->getVariable('row')->value->sales2_price*100/$_smarty_tpl->getVariable('row')->value->price);?>
% 
		                	<?php }?>	
		                	<?php if ($_smarty_tpl->getVariable('row')->value->show_sales_price=="min"){?>
		                		<?php echo 100-floor($_smarty_tpl->getVariable('row')->value->min_price*100/$_smarty_tpl->getVariable('row')->value->price);?>
% 
		                	<?php }?>	
		                	OFF </span>
		                <?php }?>
                        </div>
                    </div>
                    <div class="description">
                        <h4><a href="/shop/show/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->en_title),$_smarty_tpl);?>
 <?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->fa_title),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('row')->value->fa_title;?>
</a></h4>

                        <?php echo implode(' ',array_slice(explode(' ',$_smarty_tpl->getVariable('row')->value->fa_txt),0,12));?>
... 
                        <br/>
                        <?php $_smarty_tpl->tpl_vars['sizeArr'] = new Smarty_variable(explode("|",$_smarty_tpl->getVariable('row')->value->size), null, null);?>
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
                            </div>
                    <div class="price" >
                        	<?php if ($_smarty_tpl->getVariable('row')->value->show_sales_price=="none"){?>
                        	<span><?php echo number_format($_smarty_tpl->getVariable('row')->value->price);?>
</span>
                        	<span style="font-size: 10px;" >تومان</span>
                        	<?php }else{ ?>
                        		<?php if ($_smarty_tpl->getVariable('row')->value->show_sales_price=="sales1"){?>
	                        	<span><?php echo number_format($_smarty_tpl->getVariable('row')->value->salse1_price);?>
</span>
	                        	<span class="old-price"><?php echo $_smarty_tpl->getVariable('row')->value->price/1000;?>
 هزار تومان</span>
                        		<?php }?>
                        		<?php if ($_smarty_tpl->getVariable('row')->value->show_sales_price=="min"){?>
	                        	<span><?php echo number_format($_smarty_tpl->getVariable('row')->value->min_price);?>
</span>
	                        	<span class="old-price"><?php echo $_smarty_tpl->getVariable('row')->value->price/1000;?>
 هزار تومان</span>
                        		<?php }?>
                        		<?php if ($_smarty_tpl->getVariable('row')->value->show_sales_price=="sales2"){?>
	                        	<span><?php echo number_format($_smarty_tpl->getVariable('row')->value->sales2_price);?>
</span>
	                        	<span class="old-price"><?php echo $_smarty_tpl->getVariable('row')->value->price/1000;?>
 هزار تومان</span>
                        		<?php }?>
                        	<?php }?>
                        </div>
                    <div class="action-control"><a href="/shop/show/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->en_title),$_smarty_tpl);?>
 <?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->fa_title),$_smarty_tpl);?>
" class="btn btn-primary"> <span class="add2cart"><i
                                class="glyphicon glyphicon-shopping-cart"> </i> اضافه کردن به سبد خرید </span> </a></div>
                </div>
            </div>
            <?php }} ?>
        </div>
        <!--/.productslider-->

    </div>
    <!--/.featuredPostContainer-->
