<?php /* Smarty version Smarty-3.0.8, created on 2016-09-11 08:13:52
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/instagram/color.tpl" */ ?>
<?php /*%%SmartyHeaderCode:144693398157d4d2f8eb19e4-69739029%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '06754d813039d75fedf8076094946bcf8a9ba0fe' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/instagram/color.tpl',
      1 => 1473537033,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '144693398157d4d2f8eb19e4-69739029',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
رنگ
        </h3>
    </div>
    <div class="box-body">
		<p>
		<link href="/core/module/shop/backend/css/select2.min.css" rel="stylesheet" />
		<script src="/core/module/shop/backend/js/select2.min.js"></script>
	  	
		<script>
		    $(function(){
		      // turn the element to select2 select style
		      $('#colorSelect').select2({
		    	  placeholder: 'انتخاب رنگ'
		      });
		      
		    });
		    
		  </script>
				<select multiple="multiple" style="width: 100%" name="color[]" id="colorSelect"> 
	      	<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('colorList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value){
?>
	     		<option value="<?php echo $_smarty_tpl->getVariable('s')->value->pg_title;?>
"  <?php if (in_array($_smarty_tpl->getVariable('s')->value->pg_title,$_smarty_tpl->getVariable('colors')->value)){?> selected="selected" <?php }?> ><?php echo $_smarty_tpl->getVariable('s')->value->pg_content;?>
</option>
	     	<?php }} ?>
			</select> 
		</p>
    </div>
</div>
<!--  ******  -->