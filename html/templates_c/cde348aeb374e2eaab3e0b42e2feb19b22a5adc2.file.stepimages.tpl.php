<?php /* Smarty version Smarty-3.0.8, created on 2016-08-23 01:41:29
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/stepimages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:197815790457bb6a817fda19-38520640%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cde348aeb374e2eaab3e0b42e2feb19b22a5adc2' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/stepimages.tpl',
      1 => 1471900287,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '197815790457bb6a817fda19-38520640',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="col-md-12" >
	<h1>انتخاب تصویر</h1>
	<a href="?step=title" class="btn btn-warning" >Next Step</a>
	<div class="row" style="font-family: tahoma" >
	<div id="answersImage" style="margin: 5px;padding: 5px;background: #ffccff;position:fixed; top:20%; left:0;width:40%; height: 200px;overflow: auto;"></div>
		<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allImages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
?>
		
			<img width="100"  src="<?php echo str_replace("180x180","600x600",$_smarty_tpl->getVariable('image')->value->src);?>
"><br>
			<span onclick="add_image('<?php echo str_replace("180x180","600x600",$_smarty_tpl->getVariable('image')->value->src);?>
');show_image();" style="background:blue;cursor:pointer" ><?php echo str_replace("180x180","600x600",$_smarty_tpl->getVariable('image')->value->src);?>
</span><br> 
			
		<?php }} ?>
		<script >
          function add_image(address)
      	{
        	  $.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=addImageToProduct", 
          			{ address: address , id:<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
          			function(data,status){
	 					$("#answersImage").html(data);
					});
      	}
          function show_image(address)
        	{
          	  $.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=showImageOfProduct", 
            			{  id:<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
            			function(data,status){
  	 					$("#answersImage").html(data);
  					});
        	}
          </script>
	</div>
</div>