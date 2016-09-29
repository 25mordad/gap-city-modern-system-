<?php /* Smarty version Smarty-3.0.8, created on 2016-09-25 19:22:07
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMangooutlet/stepimages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:201044290057e7f2a7029861-76255983%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '41f226ba0c209a084ffa104699c92957679b924c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMangooutlet/stepimages.tpl',
      1 => 1473708666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201044290057e7f2a7029861-76255983',
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
		<?php  $_smarty_tpl->tpl_vars['img'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allImages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['img']->key => $_smarty_tpl->tpl_vars['img']->value){
?>
		<?php $_smarty_tpl->tpl_vars['im'] = new Smarty_variable(explode("'",$_smarty_tpl->getVariable('img')->value->onclick), null, null);?>
		<?php $_smarty_tpl->tpl_vars['imgmango'] = new Smarty_variable(explode("?",$_smarty_tpl->getVariable('im')->value[3]), null, null);?>
		
			<img width="100"  src="<?php echo $_smarty_tpl->getVariable('imgmango')->value[0];?>
" onclick="add_image('<?php echo $_smarty_tpl->getVariable('imgmango')->value[0];?>
');show_image();"><br>
			<span onclick="add_image('<?php echo $_smarty_tpl->getVariable('imgmango')->value[0];?>
');show_image();" style="background:blue;cursor:pointer" ><?php echo $_smarty_tpl->getVariable('imgmango')->value[0];?>
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