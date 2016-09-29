<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 19:00:07
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/gallery/show/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35452741957ced2ef9fb914-70444977%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1f9c588cde3e1224f426c08c8d6d3dba9bafc7b4' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/gallery/show/navigation.tpl',
      1 => 1473172203,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35452741957ced2ef9fb914-70444977',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<ul class="breadcrumb">
    <li><a href="/page">صفحه اصلی</a> <span class="divider">&rarr;</span></li>
    <li><a href="/gallery">@@PhotoGallery@@</a> <span class="divider">&rarr;</span></li>
    <li class="active"><?php echo $_smarty_tpl->getVariable('show_gallery')->value->pg_title;?>
</li>
</ul>
