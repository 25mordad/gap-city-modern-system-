<?php /* Smarty version Smarty-3.0.8, created on 2016-08-31 21:50:08
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/alert.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139668804657c711c839cea8-04883015%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '166f80d1815420d2bfd8d6e36c2bdba38554c518' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/alert.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139668804657c711c839cea8-04883015',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('alert',null,true,false)->value)){?>
<div class="alert alert-<?php echo $_smarty_tpl->getVariable('alert')->value;?>
" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong>@@<?php echo $_smarty_tpl->getVariable('alert')->value;?>
@@</strong>
    <?php  $_smarty_tpl->tpl_vars["res"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('result')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["res"]->key => $_smarty_tpl->tpl_vars["res"]->value){
?>
    <p>@@<?php echo $_smarty_tpl->getVariable('res')->value;?>
@@</p>
    <?php }} ?>
</div>
<?php }?>