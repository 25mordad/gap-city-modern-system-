<?php /* Smarty version Smarty-3.0.8, created on 2016-08-24 01:20:22
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/steptitle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59592819957bcb70e111755-20278509%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a274b5ebcd18567f547818534c10223b43b2c31e' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/steptitle.tpl',
      1 => 1471985420,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59592819957bcb70e111755-20278509',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="col-md-12" >
	<h1>انتخاب عنوان و متن</h1>
	<form action="?step=size" method="post">
	<button class="btn btn-warning" type="submit">Next Step</button>
	<div class="row" style="font-family: tahoma" >
		
		
		<div class="form-group">
		     <label for="brand" >
  برند  ------- <?php echo $_smarty_tpl->getVariable('brand')->value[0];?>

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
		</div>
		
		<div class="form-group">
		    <label for="price">قیمت  ----- <?php echo $_smarty_tpl->getVariable('price')->value[0];?>
</label>
		    <input type="text" class="form-control" name="price" id="price"  placeholder="price">
		</div>
		
		<div class="form-group">
		    <label for="salse1_price">قیمت حراج  ----- <?php echo $_smarty_tpl->getVariable('price')->value[1];?>
</label>
		    <input type="text" class="form-control" name="salse1_price" id="salse1_price"  placeholder="salse1_price">
		</div>
		
		<div class="form-group">
		    <label for="real_price">قیمت یورو  ----- <?php echo $_smarty_tpl->getVariable('priceeu')->value[0];?>
</label>
		    <input type="text" class="form-control" name="real_price" value="<?php echo trim(str_replace("€",'',$_smarty_tpl->getVariable('priceeu')->value[0]));?>
" id="real_price"  placeholder="real_price">
		</div>
		
		<div class="form-group">
		    <label for="fa_title">عنوان فارسی</label>
		    <input type="text" class="form-control" name="fa_title" id="fa_title" value="<?php echo $_smarty_tpl->getVariable('headlines')->value[1];?>
" placeholder="fa_title">
		</div>
		
		<div class="form-group">
		    <label for="en_title">عنوان انگلیسی</label>
		    <input type="text" class="form-control" name="" id="en_title" value="<?php echo $_smarty_tpl->getVariable('headlines')->value[1];?>
" placeholder="en_title">
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن فارسی</label>
		    <textarea class="form-control" name="fa_txt" rows="3"><?php echo trim($_smarty_tpl->getVariable('description')->value[0]);?>
</textarea>
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن انگلیسی</label>
		    <textarea class="form-control" name="en_txt" rows="3"></textarea>
		</div>	
	</div>
	</form>
</div>