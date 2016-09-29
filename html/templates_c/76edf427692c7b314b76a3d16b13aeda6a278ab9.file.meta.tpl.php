<?php /* Smarty version Smarty-3.0.8, created on 2016-09-27 22:28:10
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/meta.tpl" */ ?>
<?php /*%%SmartyHeaderCode:175576794557eac1421aca32-84436629%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76edf427692c7b314b76a3d16b13aeda6a278ab9' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/meta.tpl',
      1 => 1475002690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '175576794557eac1421aca32-84436629',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('part')->value=="shop"&&$_smarty_tpl->getVariable('action')->value=="show"){?>
<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/meta.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }?>