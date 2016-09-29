<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:19
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/edit/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57345790157ced28328b121-05738950%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d7a840629afb8ae04697e7a058e7854283226d6' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/edit/breadcrumb.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57345790157ced28328b121-05738950',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<li><a href="/gadmin"><i class="fa fa-dashboard"></i> میزکار</a></li>
<li><a href="/gadmin/news"> مدیریت خبر </a></li>
<li class="active">
    ویرایش خبر <?php echo $_smarty_tpl->getVariable('page')->value->pg_title;?>

</li>