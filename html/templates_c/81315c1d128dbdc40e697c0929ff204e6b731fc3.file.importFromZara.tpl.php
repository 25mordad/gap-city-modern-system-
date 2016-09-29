<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 21:59:25
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromZara.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94253878357d2f1759d1508-75895351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81315c1d128dbdc40e697c0929ff204e6b731fc3' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromZara.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94253878357d2f1759d1508-75895351',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/title.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </h1>
    <ol class="breadcrumb">
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/breadcrumb.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php $_template = new Smarty_Internal_Template("tpl/alert.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/content.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</section><!-- /.content -->
<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/help.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>