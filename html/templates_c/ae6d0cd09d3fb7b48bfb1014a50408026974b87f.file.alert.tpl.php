<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 06:18:20
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/alert.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173284570757abd964ebdc53-26507266%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae6d0cd09d3fb7b48bfb1014a50408026974b87f' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/alert.tpl',
      1 => 1470880098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173284570757abd964ebdc53-26507266',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (isset($_smarty_tpl->getVariable('alert',null,true,false)->value)){?>
    <div class="alert alert-<?php echo $_smarty_tpl->getVariable('alert')->value;?>
 alert-dismissable " id="alert_box">
        <i class="fa fa-<?php if ($_smarty_tpl->getVariable('alert')->value=="success"){?>check<?php }?><?php if ($_smarty_tpl->getVariable('alert')->value=="danger"){?>ban<?php }?><?php if ($_smarty_tpl->getVariable('alert')->value=="info"){?>info<?php }?><?php if ($_smarty_tpl->getVariable('alert')->value=="warning"){?>warning<?php }?>"></i>
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4>@@<?php echo $_smarty_tpl->getVariable('alert')->value;?>
@@</h4>
        <p>
        <?php  $_smarty_tpl->tpl_vars["res"] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('result')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars["res"]->key => $_smarty_tpl->tpl_vars["res"]->value){
?>
        <p><?php echo $_smarty_tpl->getVariable('res')->value;?>
</p>
        <?php }} ?>
        </p>
    </div>

    <script>
    setTimeout(function() {
            $('#alert_box').fadeOut('slow');
        }, 5000); 
    </script>
<?php }?>
