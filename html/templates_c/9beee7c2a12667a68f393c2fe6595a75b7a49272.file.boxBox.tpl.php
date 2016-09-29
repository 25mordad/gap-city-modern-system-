<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:42:20
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/page_index/boxBox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3962891657abd0f4150869-62472596%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9beee7c2a12667a68f393c2fe6595a75b7a49272' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/page_index/boxBox.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3962891657abd0f4150869-62472596',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
بلوک های صفحه
        </h3>
    </div>
    <div class="box-body">
                <p>
                    <a href="" class="btn bg-purple btn-block" >
                        ایجاد بلوک جدید برای صفحه
                    </a>

                    <?php  $_smarty_tpl->tpl_vars['bx'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('boxes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['bx']->key => $_smarty_tpl->tpl_vars['bx']->value){
?>
                        <a href="/gadmin/box/edit/<?php echo $_smarty_tpl->getVariable('bx')->value->id;?>
"><div class="r_menu">
                                <span><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('bx')->value->box_title,25,"..",true);?>
</span>
                                
                            </div></a>
                    <?php }} ?>

                </p>
    </div>
</div>
<!--  ******  -->