<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 23:26:19
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131948151557b9f95385c759-95796025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b033f0a0e63e923b6d915a88b710e4ead305b5a7' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/content.tpl',
      1 => 1471805774,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131948151557b9f95385c759-95796025',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/step".($_GET['step']).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</div>