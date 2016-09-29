<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:19
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/edit/title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18328033057ced283243394-99112433%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eada45b12cb441b0be76bb16166ac691d81230e0' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/edit/title.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18328033057ced283243394-99112433',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('page')->value->pg_title,43,"..",true);?>

<small>ویرایش خبر</small>