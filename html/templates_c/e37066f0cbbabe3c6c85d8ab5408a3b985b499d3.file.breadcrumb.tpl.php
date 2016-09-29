<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:00
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173567036357ced270bf82d5-59061203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e37066f0cbbabe3c6c85d8ab5408a3b985b499d3' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/editgroup/breadcrumb.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173567036357ced270bf82d5-59061203',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<li><a href="/gadmin"><i class="fa fa-dashboard"></i> میزکار</a></li>
<li><a href="/gadmin/news"> مدیریت خبر </a></li>
<li><a href="/gadmin/news/listgroup">
    لیست گروه های خبری
    </a></li>
<li class="active">
    ویرایش گروه خبری <?php echo $_smarty_tpl->getVariable('page')->value->pg_title;?>

</li>