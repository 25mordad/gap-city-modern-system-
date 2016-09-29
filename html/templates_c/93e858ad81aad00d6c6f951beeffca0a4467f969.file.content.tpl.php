<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:09
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/new/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:153913142357ced2794265f8-80569897%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '93e858ad81aad00d6c6f951beeffca0a4467f969' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/new/content.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153913142357ced2794265f8-80569897',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/news/new" id="newPageForm" >
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            <label>
                گروه خبری
            </label>
            <select class="form-control" name="parent_id" id="parent_id">
                <?php  $_smarty_tpl->tpl_vars['sp'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('select_group')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sp']->key => $_smarty_tpl->tpl_vars['sp']->value){
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['sp']->value['value'];?>
" <?php if ($_GET['g']==$_smarty_tpl->tpl_vars['sp']->value['value']){?>selected="selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['sp']->value['name'];?>
</option>
                <?php }} ?>
            </select>
        </div>

        <div class="form-group">
            <label>
عنوان خبر
            </label>
            <input required type="text" name="pg_title" placeholder="یک عنوان مناسب برای خبر خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد خبر جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newPageForm').bootstrapValidator();
            });
        </script>
    </form>
</div>