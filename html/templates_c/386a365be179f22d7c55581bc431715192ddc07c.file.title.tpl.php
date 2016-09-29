<?php /* Smarty version Smarty-3.0.8, created on 2016-08-25 04:35:47
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/title.tpl" */ ?>
<?php /*%%SmartyHeaderCode:213119777357be365b32fb30-36673567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '386a365be179f22d7c55581bc431715192ddc07c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/title.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '213119777357be365b32fb30-36673567',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('box')->value->box_title,43,"..",true);?>

<small>ویرایش بلوک</small>