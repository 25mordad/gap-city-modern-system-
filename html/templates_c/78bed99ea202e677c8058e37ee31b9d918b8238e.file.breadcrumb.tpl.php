<?php /* Smarty version Smarty-3.0.8, created on 2016-09-27 19:44:52
         compiled from "/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/edit/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:130978816357ea9afc341598-85383474%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78bed99ea202e677c8058e37ee31b9d918b8238e' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/edit/breadcrumb.tpl',
      1 => 1447715360,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '130978816357ea9afc341598-85383474',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<li><a href="/gadmin"><i class="fa fa-dashboard"></i> میزکار</a></li>
<li><a href="/gadmin/user"> مدیریت کاربران  </a></li>
<li class="active">
  ویرایش کاربر<?php echo $_smarty_tpl->getVariable('user')->value->username;?>

</li>