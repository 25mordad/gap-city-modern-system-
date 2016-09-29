<?php /* Smarty version Smarty-3.0.8, created on 2016-09-19 04:22:17
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/page/allkeywords.tpl" */ ?>
<?php /*%%SmartyHeaderCode:122349336457df28b10b3c40-14072399%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22ae7edef30603e8506c5fa81a5f2d8ee8ed9683' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/page/allkeywords.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '122349336457df28b10b3c40-14072399',
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

