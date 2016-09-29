<?php /* Smarty version Smarty-3.0.8, created on 2016-09-11 08:13:52
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/instagram/size.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60435787857d4d2f8ec6667-06021127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '688541959a5b9fc13cc2b3b6f59d6ab261db9052' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/instagram/size.tpl',
      1 => 1473533979,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60435787857d4d2f8ec6667-06021127',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
سایز
        </h3>
    </div>
    <div class="box-body">
		<p>
		<link href="/core/module/shop/backend/css/select2.min.css" rel="stylesheet" />
		<script src="/core/module/shop/backend/js/select2.min.js"></script>
	  	
		<script>
		    $(function(){
		      // turn the element to select2 select style
		      $('#sizeSelect').select2({
		    	  placeholder: 'انتخاب سایز'
		      });
		      
		    });
		    
		  </script>
				<select multiple="multiple" style="width: 100%" name="size[]" id="sizeSelect"> 
	      	<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sizeList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value){
?>
	     		<option value="<?php echo $_smarty_tpl->getVariable('s')->value->pg_title;?>
"  <?php if (in_array($_smarty_tpl->getVariable('s')->value->pg_title,$_smarty_tpl->getVariable('sizes')->value)){?> selected="selected" <?php }?> ><?php echo $_smarty_tpl->getVariable('s')->value->pg_content;?>
</option>
	     	<?php }} ?>
			</select> 
		</p>
    </div>
</div>
<!--  ******  -->
