<?php /* Smarty version Smarty-3.0.8, created on 2016-09-12 23:11:11
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMango/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:75109681657d6f6c7b7ec93-48678853%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '964bc9d67928273cad272dff235e4881332cf43a' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMango/content.tpl',
      1 => 1471805774,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75109681657d6f6c7b7ec93-48678853',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/step".($_GET['step']).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</div>