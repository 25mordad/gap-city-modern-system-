<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 19:57:59
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/boxExcerpt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:39013462857cc3d7f5a03b4-21306223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0185ddfd14eef644a1b2ed1a14cb89f3b375d692' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/boxExcerpt.tpl',
      1 => 1447715370,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '39013462857cc3d7f5a03b4-21306223',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            خلاصه محتوای صفحه
        </h3>
    </div>
    <div class="box-body">
        <p>
            <textarea name="pg_excerpt" rows="3" class="form-control" id="pg_excerpt"><?php echo $_smarty_tpl->getVariable('page')->value->pg_excerpt;?>
</textarea>
        </p>
    </div><!-- /.box-body -->
</div><!-- /.box -->