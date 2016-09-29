<?php /* Smarty version Smarty-3.0.8, created on 2016-09-28 00:15:21
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show/meta.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32393597157eada61ece666-84572253%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40e328aa37c64d79ce3c95664fc6fda9a8a2c467' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show/meta.tpl',
      1 => 1475005246,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32393597157eada61ece666-84572253',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<meta property="og:type" content="product"/>
<meta property="og:title" content="<?php echo $_smarty_tpl->getVariable('product')->value->fa_title;?>
-<?php echo $_smarty_tpl->getVariable('product')->value->en_title;?>
"/>
<meta property="og:description" content="<?php echo $_smarty_tpl->getVariable('product')->value->fa_txt;?>
 " />
<meta property="og:image" content="https://mroozi.com<?php echo $_smarty_tpl->getVariable('product')->value->default_photo;?>
" />
<meta property="og:url" content="https://mroozi.com/shop/show/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
"/>
