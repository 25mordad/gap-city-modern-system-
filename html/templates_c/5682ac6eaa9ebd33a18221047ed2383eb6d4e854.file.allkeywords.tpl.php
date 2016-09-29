<?php /* Smarty version Smarty-3.0.8, created on 2016-08-31 21:50:08
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/page/allkeywords.tpl" */ ?>
<?php /*%%SmartyHeaderCode:38349827457c711c845d174-58447850%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5682ac6eaa9ebd33a18221047ed2383eb6d4e854' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/page/allkeywords.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38349827457c711c845d174-58447850',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('allkeywords')->value[0]){?>
    <span class="glyphicon glyphicon-tags"></span>
		<?php  $_smarty_tpl->tpl_vars['kw'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allkeywords')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['kw']->key => $_smarty_tpl->tpl_vars['kw']->value){
?>
            <span class="label label-primary" style="margin: 1px"><?php echo $_smarty_tpl->getVariable('kw')->value->kw_title;?>
</span>
		<?php }} ?>
<?php }?>

