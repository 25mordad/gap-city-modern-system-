<?php /* Smarty version Smarty-3.0.8, created on 2016-08-31 03:28:13
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/page/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:91070118157c60f85a327f6-10502785%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '605b0baffe69bcf76d33ca1adfca7f813cd45e6c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/page/index.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '91070118157c60f85a327f6-10502785',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="page-header">
    <h1><?php echo $_smarty_tpl->getVariable('show_index')->value->pg_title;?>
</h1>
</div>
<div class="text-justify" >
    <p>
        <?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('show_index')->value->pg_content);?>

    </p>
</div>