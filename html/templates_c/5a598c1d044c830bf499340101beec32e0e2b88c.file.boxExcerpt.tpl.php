<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:00
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/boxExcerpt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3230199657ced270ed4f76-30208504%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5a598c1d044c830bf499340101beec32e0e2b88c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/boxExcerpt.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3230199657ced270ed4f76-30208504',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            خلاصه محتوای گروه خبری
        </h3>
    </div>
    <div class="box-body">
        <p>
            <textarea name="pg_excerpt" rows="3" class="form-control" id="pg_excerpt"><?php echo $_smarty_tpl->getVariable('page')->value->pg_excerpt;?>
</textarea>
        </p>
    </div><!-- /.box-body -->
</div><!-- /.box -->