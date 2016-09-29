<?php /* Smarty version Smarty-3.0.8, created on 2016-08-31 03:28:13
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/error404/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:201747708857c60f85da35b6-05989220%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b25155614e44964d2085178c67390888e066dbb' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/error404/index.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '201747708857c60f85da35b6-05989220',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<ol  class="breadcrumb">
    <li><a href="/page">صفحه اصلی</a></li>
    <li class="active">خطا</li>
</ol >
<div class="page-header">
    <h4 >@@Error@@</h1>
</div>
<div class="text-justify" >
    <p>
        <?php if ((isset($_GET['module']))){?>
            @@PluginNotAllowed@@ <b><?php echo $_GET['module'];?>
</b>
        <?php }else{ ?>
            <?php if ($_GET['error']=="Auth"){?>
                @@NoAccessLevel@@ | <a href="user">@@Login@@</a>
            <?php }else{ ?>
                @@PageNotFound@@
            <?php }?>
        <?php }?>
    </p>
</div>
