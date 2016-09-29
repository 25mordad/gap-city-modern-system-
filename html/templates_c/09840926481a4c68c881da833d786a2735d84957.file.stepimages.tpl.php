<?php /* Smarty version Smarty-3.0.8, created on 2016-09-12 21:14:55
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromZara/stepimages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6617133457d6db8796c0c0-92768436%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '09840926481a4c68c881da833d786a2735d84957' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromZara/stepimages.tpl',
      1 => 1473698694,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6617133457d6db8796c0c0-92768436',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="col-md-12" >
	<h1>انتخاب گروه محصول </h1>
	<p>
	
	<?php echo $_smarty_tpl->getVariable('group_name')->value->pg_title;?>
 - <?php echo $_smarty_tpl->getVariable('group_name')->value->pg_content;?>
	<span > <a href="?step=images&del=true" >تغییر</a></span>
	</p>
	<h1>انتخاب تصویر</h1>
	<a href="?step=title" class="btn btn-warning" >Next Step</a>
	<div class="row" style="font-family: tahoma" >
	<div id="answersImage" style="margin: 5px;padding: 5px;background: #ffccff;position:fixed; top:20%; left:0;width:40%; height: 200px;overflow: auto;"></div>
		<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('imagesZara')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
?>
		<?php $_smarty_tpl->tpl_vars['img'] = new Smarty_variable(explode("?",$_smarty_tpl->tpl_vars['image']->value), null, null);?>
		<?php if (!isset($_smarty_tpl->tpl_vars['img']) || !is_array($_smarty_tpl->tpl_vars['img']->value)) $_smarty_tpl->createLocalArrayVariable('img', null, null);
$_smarty_tpl->tpl_vars['img']->value[0] = str_replace("/560/","/1024/",$_smarty_tpl->getVariable('img')->value[0]);?>
			<img width="100"  src="<?php echo $_smarty_tpl->getVariable('img')->value[0];?>
" onclick="add_image('http:<?php echo $_smarty_tpl->getVariable('img')->value[0];?>
');show_image();"><br>
			<span onclick="add_image('http://<?php echo $_smarty_tpl->getVariable('img')->value[0];?>
');show_image();" style="background:blue;cursor:pointer" ><?php echo $_smarty_tpl->getVariable('img')->value[0];?>
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