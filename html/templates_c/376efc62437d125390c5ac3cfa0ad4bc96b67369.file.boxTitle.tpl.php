<?php /* Smarty version Smarty-3.0.8, created on 2016-09-17 20:50:23
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/edit/boxTitle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:56403464657dd6d47390668-35363407%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '376efc62437d125390c5ac3cfa0ad4bc96b67369' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/edit/boxTitle.tpl',
      1 => 1474129221,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '56403464657dd6d47390668-35363407',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
	<div class="col-md-6 " >
		<!--  box -->
		
		<div class="box box-solid box-primary">
		    <div class="box-header">
		        <h3 class="box-title">
		            عنوان محصول فارسی
		        </h3>
		    </div>
		    <div class="box-body">
		        <p>
		            <input type="text" value="<?php echo $_smarty_tpl->getVariable('product')->value->fa_title;?>
" name="fa_title" class="form-control">
		        </p>
		    </div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
	<div class="col-md-6 " >
		<!--  box -->
		
		<div class="box box-solid box-primary">
		    <div class="box-header">
		        <h3 class="box-title">
		            Title in English
		        </h3>
		    </div>
		    <div class="box-body">
		        <p>
		            <input type="text" value="<?php echo $_smarty_tpl->getVariable('product')->value->en_title;?>
" name="en_title" class="form-control">
		        </p>
		    </div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>

</div>
