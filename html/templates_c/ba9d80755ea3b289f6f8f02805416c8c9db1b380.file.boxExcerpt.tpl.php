<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:42:20
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/page_index/boxExcerpt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90958200657abd0f4163ef5-33978238%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba9d80755ea3b289f6f8f02805416c8c9db1b380' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/page_index/boxExcerpt.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90958200657abd0f4163ef5-33978238',
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