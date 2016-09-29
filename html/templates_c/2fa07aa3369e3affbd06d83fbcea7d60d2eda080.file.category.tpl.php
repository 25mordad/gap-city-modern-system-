<?php /* Smarty version Smarty-3.0.8, created on 2016-08-27 19:52:44
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:171965790757c1b044c60f66-44941023%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2fa07aa3369e3affbd06d83fbcea7d60d2eda080' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/category.tpl',
      1 => 1472311363,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171965790757c1b044c60f66-44941023',
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
