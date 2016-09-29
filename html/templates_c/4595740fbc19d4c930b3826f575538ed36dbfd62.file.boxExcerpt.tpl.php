<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:19
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/edit/boxExcerpt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124377289657ced283513e41-92904410%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4595740fbc19d4c930b3826f575538ed36dbfd62' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/edit/boxExcerpt.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '124377289657ced283513e41-92904410',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            خلاصه محتوای خبر
        </h3>
    </div>
    <div class="box-body">
        <p>
            <textarea name="pg_excerpt" rows="3" class="form-control" id="pg_excerpt"><?php echo $_smarty_tpl->getVariable('page')->value->pg_excerpt;?>
</textarea>
        </p>
    </div><!-- /.box-body -->
</div><!-- /.box -->