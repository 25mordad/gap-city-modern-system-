<?php /* Smarty version Smarty-3.0.8, created on 2016-08-25 04:35:47
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/boxHtml.tpl" */ ?>
<?php /*%%SmartyHeaderCode:134667062157be365b354b36-02784425%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fada4e9fa4ac1491c9f380845261ce2f8e159c64' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/boxHtml.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134667062157be365b354b36-02784425',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
کد HTML
        </h3>
    </div>
    <div class="box-body">
        <p>
            <textarea name="class_name" placeholder="HTML CODE" rows="3" class="form-control" style="text-align: left;direction: ltr"><?php echo $_smarty_tpl->getVariable('box')->value->class_name;?>
</textarea>
        </p>
    </div><!-- /.box-body -->
</div><!-- /.box -->