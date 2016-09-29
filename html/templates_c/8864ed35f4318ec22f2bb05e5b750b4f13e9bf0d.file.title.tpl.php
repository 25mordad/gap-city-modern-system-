<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 19:57:59
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:181028799357cc3d7f428815-02920239%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8864ed35f4318ec22f2bb05e5b750b4f13e9bf0d' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/title.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '181028799357cc3d7f428815-02920239',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('page')->value->pg_title,43,"..",true);?>

<small>ویرایش صفحه</small>