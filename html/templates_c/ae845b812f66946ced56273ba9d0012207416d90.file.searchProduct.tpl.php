<?php /* Smarty version Smarty-3.0.8, created on 2016-09-21 22:39:36
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/searchProduct.tpl" */ ?>
<?php /*%%SmartyHeaderCode:186093459457e2daf01853e5-23147887%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae845b812f66946ced56273ba9d0012207416d90' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/searchProduct.tpl',
      1 => 1474484972,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '186093459457e2daf01853e5-23147887',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="container main-container headerOffset" >
	<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/navigation.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

    <div class="row">

        <!--left column-->
		<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/filter.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
		
        <!--right column-->
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/list.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

        <!--/right column end-->
    </div>
    <!-- /.row  -->
</div>
<!-- /main container -->
