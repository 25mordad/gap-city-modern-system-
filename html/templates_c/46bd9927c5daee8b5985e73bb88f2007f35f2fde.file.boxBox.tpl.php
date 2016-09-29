<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 19:57:59
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/boxBox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:177896527457cc3d7f5197e7-82558476%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46bd9927c5daee8b5985e73bb88f2007f35f2fde' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/boxBox.tpl',
      1 => 1447715370,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '177896527457cc3d7f5197e7-82558476',
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
                    <a href="/gadmin/box/new?pid=<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
" class="btn bg-purple btn-block" >
                        ایجاد بلوک جدید برای صفحه
                    </a>

                    <?php  $_smarty_tpl->tpl_vars['bx'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('boxes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['bx']->key => $_smarty_tpl->tpl_vars['bx']->value){
?>
                        <br/>
                        <i class="fa fa-th-large" ></i>
                         <a href="/gadmin/box/edit/<?php echo $_smarty_tpl->getVariable('bx')->value->id;?>
" > <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('bx')->value->box_title,25,"..",true);?>
</a>
                    <?php }} ?>

                </p>
    </div>
</div>
<!--  ******  -->