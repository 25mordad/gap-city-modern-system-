<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 23:11:36
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/boxInfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94342576057b9f5e0649b35-03075291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0188f8c4b64747033655714ae3263aace416049' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/boxInfo.tpl',
      1 => 1471746583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94342576057b9f5e0649b35-03075291',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
اطلاعات محصول
        </h3>
    </div>
    <div class="box-body">
        <p class="col-md-12">
            <label for="brand" >
 برند
            </label>
          
            <select class="form-control" name="brand" id="brand" >
            
                 <?php  $_smarty_tpl->tpl_vars['br'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('brands')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['br']->key => $_smarty_tpl->tpl_vars['br']->value){
?>
                     <option value="<?php echo $_smarty_tpl->getVariable('br')->value->id;?>
" <?php if ($_smarty_tpl->getVariable('product')->value->brand==$_smarty_tpl->getVariable('br')->value->id){?> selected="selected" <?php }?> 	><?php echo $_smarty_tpl->getVariable('br')->value->pg_content;?>
</option>
                 <?php }} ?>
             </select>
        </p>
        
        <p class="col-md-6">
            <label for="quantity" >
تعداد
            </label>
            <input type="number" value="<?php echo $_smarty_tpl->getVariable('product')->value->quantity;?>
" name="quantity" id="quantity" placeholder="تعداد" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="p_order" >
ترتیب نمایش
            </label>
            <input type="number" value="<?php echo $_smarty_tpl->getVariable('product')->value->p_order;?>
" name="p_order" id="p_order" placeholder="ترتیب نمایش" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="delivery_time" >
 تحویل (روز)
            </label>
            <input type="number" value="<?php echo $_smarty_tpl->getVariable('product')->value->delivery_time;?>
" name="delivery_time" id="delivery_time" placeholder="زمان تحویل کالا" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="refrence" >
کد رفرنس
            </label>
            <input type="text" value="<?php echo $_smarty_tpl->getVariable('product')->value->refrence;?>
" name="refrence" id="refrence" placeholder="رفرنس" class="form-control">
        </p>
        <p class="col-md-12">
            <label for="link" >
لینک به سایت رفرنس
            </label>
            <input type="text" value="<?php echo $_smarty_tpl->getVariable('product')->value->link;?>
" name="link" id="link" placeholder="URL" class="form-control" style="font-family: tahoma;font-size: 12px">
            <label for="link" >
				<a href="<?php echo $_smarty_tpl->getVariable('product')->value->link;?>
" target="_blank" style="font-size: 9px;font-weight: normal;"><i class="glyphicon glyphicon-new-window fontSize9" ></i> Open in new window</a>
            </label>
        </p>
        
        
        

        <div class="clearfix" ></div>
    </div>
</div>
<!--  ******  -->
