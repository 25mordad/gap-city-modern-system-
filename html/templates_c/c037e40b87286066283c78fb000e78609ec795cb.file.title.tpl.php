<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:00
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65757938657ced270bd4559-32699712%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c037e40b87286066283c78fb000e78609ec795cb' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/title.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65757938657ced270bd4559-32699712',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('page')->value->pg_title,43,"..",true);?>

<small>ویرایش گروه خبری</small>