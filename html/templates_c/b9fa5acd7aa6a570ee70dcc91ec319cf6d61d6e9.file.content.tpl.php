<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:43:53
         compiled from "/var/www/gcms.dev/public_html/core/module/module/backend/tpl/module/new/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14613613657cde01113d323-73266785%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9fa5acd7aa6a570ee70dcc91ec319cf6d61d6e9' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/module/backend/tpl/module/new/content.tpl',
      1 => 1447715354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14613613657cde01113d323-73266785',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/module/new" target="_blank" id="newModuleForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group">
            <label>
                نام ماژول به لاتین
            </label>
            <input required type="text" name="module_name" placeholder="یک عنوان مناسب برای ماژول خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد ماژول جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newModuleForm').bootstrapValidator();
            });
        </script>
    </form>
</div>