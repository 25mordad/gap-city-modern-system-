<?php /* Smarty version Smarty-3.0.8, created on 2016-08-25 04:31:47
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/box/new/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22077932557be356b4048f6-43775652%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '964a4f3af73b9b6c88f996dcafa348fb851e36cc' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/box/new/content.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22077932557be356b4048f6-43775652',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/box/new" id="newPageForm" >
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            <label>
                صفحه مادر
            </label>
            <select class="form-control" name="parent_id" id="parent_id">
                <option value="0"> نمایش در تمام صفحات </option>
                <?php  $_smarty_tpl->tpl_vars['sp'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('select_parent')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sp']->key => $_smarty_tpl->tpl_vars['sp']->value){
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['sp']->value['value'];?>
" <?php if ($_GET['pid']==$_smarty_tpl->tpl_vars['sp']->value['value']){?>selected="selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['sp']->value['name'];?>
</option>
                <?php }} ?>
            </select>
        </div>

        <div class="form-group">
            <label>
عنوان بلوک
            </label>
            <input required type="text" name="box_title" placeholder="یک عنوان مناسب برای بلوک خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد بلوک جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newPageForm').bootstrapValidator();
            });
        </script>
    </form>
</div>