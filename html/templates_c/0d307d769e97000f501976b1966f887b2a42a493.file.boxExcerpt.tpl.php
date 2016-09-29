<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:44:31
         compiled from "/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/edit/boxExcerpt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12177953157cde0373e4a32-38286284%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0d307d769e97000f501976b1966f887b2a42a493' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/edit/boxExcerpt.tpl',
      1 => 1447715362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12177953157cde0373e4a32-38286284',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            خلاصه محتوای گالری عکس
        </h3>
    </div>
    <div class="box-body">
        <p>
            <textarea name="pg_excerpt" rows="3" class="form-control" id="pg_excerpt"><?php echo $_smarty_tpl->getVariable('page')->value->pg_excerpt;?>
</textarea>
        </p>
    </div><!-- /.box-body -->
</div><!-- /.box -->