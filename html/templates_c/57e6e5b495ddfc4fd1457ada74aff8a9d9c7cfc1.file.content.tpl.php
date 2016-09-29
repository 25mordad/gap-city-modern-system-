<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:57:51
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/newgroup/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8446740757ced267bd1591-63948858%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57e6e5b495ddfc4fd1457ada74aff8a9d9c7cfc1' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/newgroup/content.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8446740757ced267bd1591-63948858',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/news/newgroup" id="newPageForm" >
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            <label>
                گروه خبری مادر
            </label>
            <select class="form-control" name="parent_id" id="parent_id">
                <option value="0">بدون گروه مادر</option>
                <?php  $_smarty_tpl->tpl_vars['sp'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('select_group')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sp']->key => $_smarty_tpl->tpl_vars['sp']->value){
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['sp']->value['value'];?>
" ><?php echo $_smarty_tpl->tpl_vars['sp']->value['name'];?>
</option>
                <?php }} ?>
            </select>
        </div>

        <div class="form-group">
            <label>
عنوان گروه خبری
            </label>
            <input required type="text" name="pg_title" placeholder="یک عنوان مناسب برای گروه خبری خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد صفحه جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newPageForm').bootstrapValidator();
            });
        </script>
    </form>
</div>