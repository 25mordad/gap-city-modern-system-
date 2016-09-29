<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 23:11:36
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/color.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204108966757b9f5e05b6da7-06813513%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bf63be872654ba4f901bfda0bdc8501d08fb6209' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/color.tpl',
      1 => 1471733393,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204108966757b9f5e05b6da7-06813513',
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
		<script >
          function add_color(id)
      	{
          	$.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=addColor", 
          			{ id: id ,pid:<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
          			function(data,status){
	 					$("#answers").html(data);
					});
      	}
          function show_color()
      	{
          	$.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=showColor", 
          			{ id: <?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
          			function(data,status){
	 					$("#answers").html(data);
					});
      	}
          show_color();
          </script>
	     
	     
	      	<select multiple="multiple" style="width: 100%">
	      	<?php  $_smarty_tpl->tpl_vars['color'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('colors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['color']->key => $_smarty_tpl->tpl_vars['color']->value){
?>
	     		<option value="<?php echo $_smarty_tpl->getVariable('color')->value->id;?>
" onclick="add_color(<?php echo $_smarty_tpl->getVariable('color')->value->id;?>
);show_color();" ><?php echo $_smarty_tpl->getVariable('color')->value->pg_content;?>
</option>
	     	<?php }} ?>
			</select> 
	  	<div id="answers"></div>
		</p>
    </div>
</div>
<!--  ******  -->
