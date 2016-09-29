<?php /* Smarty version Smarty-3.0.8, created on 2016-08-25 04:35:47
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142779134057be365b3335b5-46303837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7c6af3fc9c63377e56da25cf7ff388da4f1a39b8' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/breadcrumb.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142779134057be365b3335b5-46303837',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<li><a href="/gadmin"><i class="fa fa-dashboard"></i> میزکار</a></li>
<li><a href="/gadmin/box"> مدیریت بلوک ها </a></li>
<li class="active">
    ویرایش بلوک <?php echo $_smarty_tpl->getVariable('box')->value->box_title;?>

</li>