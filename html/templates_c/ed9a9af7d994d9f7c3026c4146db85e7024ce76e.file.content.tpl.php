<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:44:16
         compiled from "/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/new/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150204548457cde028444385-89355136%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed9a9af7d994d9f7c3026c4146db85e7024ce76e' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/new/content.tpl',
      1 => 1447715362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150204548457cde028444385-89355136',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/gallery/new" id="newGalleryForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group">
            <label>
عنوان گالری عکس
            </label>
            <input required type="text" name="pg_title" placeholder="یک عنوان مناسب برای گالری عکس خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد گالری عکس جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newGalleryForm').bootstrapValidator();
            });
        </script>
    </form>
</div>