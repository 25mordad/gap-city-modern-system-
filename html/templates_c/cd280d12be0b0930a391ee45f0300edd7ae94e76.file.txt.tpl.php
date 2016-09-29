<?php /* Smarty version Smarty-3.0.8, created on 2016-09-19 05:05:36
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show/txt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16565310357df32d85a19b5-53859022%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd280d12be0b0930a391ee45f0300edd7ae94e76' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show/txt.tpl',
      1 => 1474245332,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16565310357df32d85a19b5-53859022',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
                <div class="product-tab w100 clearfix">

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#details" data-toggle="tab">توضیحات</a></li>
                        <li><a href="#size" data-toggle="tab">راهنمای سایز</a></li>
                        <li><a href="#shipping" data-toggle="tab">راهنمای ارسال</a></li>
                        <li><a href="#english" data-toggle="tab"><?php echo $_smarty_tpl->getVariable('product')->value->en_title;?>
 </a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="details" style="text-align: justify;">
                        
                        <h3 class="product-code" >کد محصول : <?php echo $_smarty_tpl->getVariable('product')->value->barcode;?>
</h3>
            			<img style="float: left;margin-top: -40px"
            			src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=<?php echo $_SERVER['HTTP_HOST'];?>
<?php echo $_SERVER['REQUEST_URI'];?>
&choe=UTF-8"
            			title="<?php echo $_smarty_tpl->getVariable('product')->value->fa_title;?>
"  />
            			
            			<?php echo $_smarty_tpl->getVariable('product')->value->fa_txt;?>
 
            			<br>
            				<?php  $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allkeywords')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['k']->key => $_smarty_tpl->tpl_vars['k']->value){
?>
            				<a href="#"><span class="badge" ><?php echo $_smarty_tpl->getVariable('k')->value->kw_title;?>
</span></a>
            				<?php }} ?>
                        </div>
                        <div class="tab-pane" id="english" style="direction: ltr;text-align: justify;"> 
                        <?php echo $_smarty_tpl->getVariable('product')->value->en_txt;?>
 
                        </div>
                        
                        <div class="tab-pane" id="size"> 
                        	<a href="/page/show/632/راهنمای+سایز+لباس"> 
							راهنمای سایز لباس
                        </a>
                        </div>

                        <div class="tab-pane" id="shipping">
                            <a href="/page/show/634/راهنمای+ارسال+و+ثبت+سفارش">
                            راهنمای ارسال و ثبت سفارش
                            </a>
                        </div>

                    </div>
                    <!-- /.tab content -->

                </div>
                <!--/.product-tab-->