<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 23:11:36
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/size.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103810081357b9f5e0621d21-25760254%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b37e966516e2edae750a4f3def3eaf6c8d5e521' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/size.tpl',
      1 => 1471738592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103810081357b9f5e0621d21-25760254',
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
		<?php $_smarty_tpl->tpl_vars['arraySize'] = new Smarty_variable(array('size'=>'اندازه','free'=>'فری‌سایز','number'=>'شماره','trousers-size'=>'سایز شلوار','blazer-size'=>'سایز کت','belt-size'=>'سایز کمربند','age-size'=>'سایز بر اساس سن','infants-size'=>'سایز نوزادی'), null, null);?>
		<script >
          function add_size(sizeType)
      	{
          	$.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=addSize", 
          			{ type: sizeType , id:<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
          			function(data,status){
	 					$("#answersSize").html(data);
					});
      	}
          function show_size()
        	{
            	$.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=showSize", 
            			{ id: <?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
            			function(data,status){
  	 					$("#answersSize").html(data);
  					});
        	}
            show_size();
          </script>
	      	<select multiple="multiple" style="width: 100%">
	      	<?php  $_smarty_tpl->tpl_vars['size'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sizes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['size']->key => $_smarty_tpl->tpl_vars['size']->value){
?>
	     		<option value="<?php echo $_smarty_tpl->getVariable('size')->value->id;?>
" onclick="add_size('<?php echo $_smarty_tpl->getVariable('size')->value->sizes;?>
');show_size();" ><?php echo $_smarty_tpl->getVariable('arraySize')->value[$_smarty_tpl->getVariable('size')->value->sizes];?>
</option>
	     	<?php }} ?>
			</select> 
	  	<div id="answersSize"></div> 
	  	
		</p>
    </div>
</div>
<!--  ******  -->
