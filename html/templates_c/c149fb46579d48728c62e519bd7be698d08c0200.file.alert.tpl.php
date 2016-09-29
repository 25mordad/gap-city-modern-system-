<?php /* Smarty version Smarty-3.0.8, created on 2016-09-05 04:24:09
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/alert.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178748441457ccb421d16690-90692960%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c149fb46579d48728c62e519bd7be698d08c0200' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/alert.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178748441457ccb421d16690-90692960',
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