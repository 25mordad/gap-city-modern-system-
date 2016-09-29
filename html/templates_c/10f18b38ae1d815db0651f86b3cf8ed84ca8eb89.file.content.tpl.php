<?php /* Smarty version Smarty-3.0.8, created on 2016-09-27 18:46:29
         compiled from "/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/setting/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:47846964757ea8d4daa7664-38977260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10f18b38ae1d815db0651f86b3cf8ed84ca8eb89' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/setting/content.tpl',
      1 => 1447715360,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '47846964757ea8d4daa7664-38977260',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/user/setting " id="newUserForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group ">
            <?php echo $_smarty_tpl->getVariable('user')->value->username;?>

        </div>
                <label>
                    سطح دسترسی کاربری
                </label>

<div class="clearfix" ></div>
        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('GCMS_USER_LEVEL')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
        <div class="form-group  col-md-3 " >
            <label>
            </label>
            <input required type="text" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
" class="form-control">
        </div>
        <?php }} ?>

                <label>
تعریف پارامترها
                </label>

        <div class="clearfix" ></div>
        <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('GCMS_USER_PARAM')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
        <div class="form-group  col-md-3 " >
            <label>
            </label>
            <input required type="text" name="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['val']->value;?>
" class="form-control">
        </div>
        <?php }} ?>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ویرایش
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newUserForm').bootstrapValidator();
            });
        </script>
        <input type="hidden" name="submitForm" value="true">
    </form>
    <div class="clearfix" ></div>

</div>