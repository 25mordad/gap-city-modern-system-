<?php /* Smarty version Smarty-3.0.8, created on 2016-09-27 19:44:52
         compiled from "/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/edit/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:195246021457ea9afc348020-03552831%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5072d520fc9423d547e29ec70a4b06615c728a84' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/edit/content.tpl',
      1 => 1447715360,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '195246021457ea9afc348020-03552831',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/user/edit/<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
" id="newUserForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group ">
            <label>
نام کاربری
            </label>
            <?php echo $_smarty_tpl->getVariable('user')->value->username;?>

        </div>
        <?php if (isset($_GET['edit_params'])&&$_GET['edit_params']=="true"){?>
        <input type="hidden" name="edit_params" id="edit_params" value="true" />
        <?php  $_smarty_tpl->tpl_vars['user_param'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('user_params')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user_param']->key => $_smarty_tpl->tpl_vars['user_param']->value){
?>
            <div class="form-group col-md-3">
                <label for="meta_<?php echo $_smarty_tpl->tpl_vars['user_param']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['user_param']->value['label'];?>
</label>
                <input name="meta_<?php echo $_smarty_tpl->tpl_vars['user_param']->value['id'];?>
" id="meta_<?php echo $_smarty_tpl->tpl_vars['user_param']->value['id'];?>
"  type="text" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['user_param']->value['value'];?>
"/>
            </div>
        <?php }} ?>

        <?php }else{ ?>
        <div class="form-group">
            <label>
                ایمیل معتبر
            </label>
            <input required type="email" name="email" value="<?php echo $_smarty_tpl->getVariable('user')->value->email;?>
" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label>
                @@UserStatus@@
            </label>
            <select class="form-control"  name="status" id="status" >
                <option value="active" <?php if ($_smarty_tpl->getVariable('user')->value->status=="active"){?>selected="selected" <?php }?> >@@Active@@</option>
                <option value="pending" <?php if ($_smarty_tpl->getVariable('user')->value->status=="pending"){?>selected="selected" <?php }?> >@@Deactive@@</option>
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
" <?php if ($_smarty_tpl->getVariable('user')->value->user_level==$_smarty_tpl->tpl_vars['key']->value){?>selected="selected"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['val']->value;?>
</option>
                <?php }} ?>
            </select>
        </div>
        <?php }?>
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
    <p style="padding: 10px" >
        <span data-toggle="tooltip" style="font-size: 10px" data-placement="bottom" title="  تاریخ ایجاد عضو"><i class="fa fa-clock-o" ></i>
              تاریخ ایجاد عضو :
            <?php ob_start();?><?php echo $_smarty_tpl->getVariable('user')->value->date_created;?>
<?php $_tmp1=ob_get_clean();?><?php echo jdate(" l j F Y",strtotime($_tmp1));?>
</span>
        <?php if (isset($_GET['edit_params'])&&$_GET['edit_params']=="true"){?>
            <button class="btn bg-purple margin" onclick="location.href='/gadmin/user/edit/<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
'" >
بازگشت به ویرایش عضو
            </button>
            <?php }else{ ?>
        <button class="btn bg-purple margin" onclick="location.href='/gadmin/user/edit/<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
/?edit_params=true'" >
            ویرایش پارامترهای عضو
        </button>
        <?php }?>
    </p>
</div>