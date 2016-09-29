<?php /* Smarty version Smarty-3.0.8, created on 2016-09-19 04:11:09
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/page/show/img.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64036830557df2615a93339-44050724%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ae53764f0fb611126c6226e3cf47112196ed7e7' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/page/show/img.tpl',
      1 => 1472315961,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64036830557df2615a93339-44050724',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

            <div class='zoom' id='zoomContent'>
                <a class="gall-item" title="<?php echo $_smarty_tpl->getVariable('product')->value->fa_title;?>
-<?php echo $_smarty_tpl->getVariable('product')->value->en_title;?>
" href="<?php echo $_smarty_tpl->getVariable('product')->value->default_photo;?>
">
                <img
                        class="zoomImage1 img-responsive" data-src="<?php echo $_smarty_tpl->getVariable('product')->value->default_photo;?>
"
                        src='<?php echo $_smarty_tpl->getVariable('product')->value->default_photo;?>
' alt='<?php echo $_smarty_tpl->getVariable('product')->value->fa_title;?>
-<?php echo $_smarty_tpl->getVariable('product')->value->en_title;?>
'/></a>
                <img src="/uploads/source/brand/<?php echo $_smarty_tpl->getVariable('product')->value->brand;?>
.png" style="position: absolute; top: 10px; right: 10px;"/>
                <?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price!="none"){?>
                	<div style="position: absolute; top: 10px; left: 10px;font-size: 20px;background: #FF5252;color: white;padding: 5px" >
                	<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales1"){?>
                		<?php echo 100-floor($_smarty_tpl->getVariable('product')->value->salse1_price*100/$_smarty_tpl->getVariable('product')->value->price);?>
% تخفیف
                	<?php }?>	
                	<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales2"){?>
                		<?php echo 100-floor($_smarty_tpl->getVariable('product')->value->sales2_price*100/$_smarty_tpl->getVariable('product')->value->price);?>
% تخفیف
                	<?php }?>	
                	<?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="min"){?>
                		<?php echo 100-floor($_smarty_tpl->getVariable('product')->value->min_price*100/$_smarty_tpl->getVariable('product')->value->price);?>
% تخفیف
                	<?php }?>	
                	</div>
                <?php }?>
            </div>
            
			<div class="zoomThumb ">
			<?php echo smarty_function_get_all_images(array('type'=>"shop",'id'=>$_smarty_tpl->getVariable('product')->value->id),$_smarty_tpl);?>

				<?php  $_smarty_tpl->tpl_vars['pageImag'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('getallimages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['pageImag']->key => $_smarty_tpl->tpl_vars['pageImag']->value){
?>
                <a class="zoomThumbLink">
                    <img data-large="<?php echo $_smarty_tpl->getVariable('pageImag')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('pageImag')->value->im_name;?>
"
                         src="<?php echo $_smarty_tpl->getVariable('pageImag')->value->im_path;?>
thumb/<?php echo $_smarty_tpl->getVariable('pageImag')->value->im_name;?>
" alt="<?php echo $_smarty_tpl->getVariable('pageImag')->value->im_name;?>
" title="<?php echo $_smarty_tpl->getVariable('pageImag')->value->im_name;?>
"/></a>
				<?php }} ?>
                
            </div>