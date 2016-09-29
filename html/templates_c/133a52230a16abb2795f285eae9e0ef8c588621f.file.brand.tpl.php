<?php /* Smarty version Smarty-3.0.8, created on 2016-08-15 06:15:31
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/brand.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94375019657b11ebb0c3594-69630049%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '133a52230a16abb2795f285eae9e0ef8c588621f' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/brand.tpl',
      1 => 1447715354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94375019657b11ebb0c3594-69630049',
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