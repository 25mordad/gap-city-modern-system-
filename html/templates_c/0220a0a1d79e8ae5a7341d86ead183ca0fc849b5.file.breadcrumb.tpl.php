<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 19:57:59
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:40704124057cc3d7f493709-09767828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0220a0a1d79e8ae5a7341d86ead183ca0fc849b5' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/breadcrumb.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '40704124057cc3d7f493709-09767828',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<li><a href="/gadmin"><i class="fa fa-dashboard"></i> میزکار</a></li>
<li><a href="/gadmin/page"> مدیریت صفحات </a></li>
<li class="active">
    ویرایش صفحه <?php echo $_smarty_tpl->getVariable('page')->value->pg_title;?>

</li>