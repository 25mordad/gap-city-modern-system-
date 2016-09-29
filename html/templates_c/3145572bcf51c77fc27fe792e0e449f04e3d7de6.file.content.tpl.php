<?php /* Smarty version Smarty-3.0.8, created on 2016-09-27 18:46:34
         compiled from "/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/new/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125279338257ea8d52914c78-06223912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3145572bcf51c77fc27fe792e0e449f04e3d7de6' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/new/content.tpl',
      1 => 1447715360,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125279338257ea8d52914c78-06223912',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/user/new" id="newUserForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group  col-md-6">
            <label>
نام کاربری
            </label>
            <input required type="text" name="username" placeholder="نام کاربری را وارد کنید" class="form-control">
        </div>

        <div class="form-group  col-md-6">
            <label>
                ایمیل معتبر
            </label>
            <input required type="email" name="email" placeholder="ایمیل خود را وارد کنید" class="form-control">
        </div>

        <div class="form-group  col-md-6">
            <label>
کلمه عبور
            </label>
            <input required type="password" name="password" placeholder="کلمه عبور" class="form-control">
        </div>

        <div class="form-group  col-md-6">
            <label>
تایید کلمه عبور
            </label>
            <input required type="password" name="confirm_password" placeholder="تکرار کلمه عبور" class="form-control">
        </div>


        <div class="form-group col-md-6">
            <label>
                @@UserStatus@@
            </label>
            <select class="form-control"  name="status" id="status" >
                <option value="active">@@Active@@</option>
                <option value="pending">@@Deactive@@</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>
نوع عضویت
            </label>
            <select name="user_level" id="user_level" class="form-control">
                <?php  $_smarty_tpl->tpl_vars['val'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('GCMS_USER_LEVEL')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['val']->key => $_smarty_tpl->tpl_vars['val']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['val']->key;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</option>
                <?php }} ?>
            </select>
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد کاربر جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newUserForm').bootstrapValidator();
            });
        </script>
    </form>
</div>