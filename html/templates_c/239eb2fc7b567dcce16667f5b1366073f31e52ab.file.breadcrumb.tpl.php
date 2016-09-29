<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:44:31
         compiled from "/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/edit/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123726323357cde037341ee0-43898343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '239eb2fc7b567dcce16667f5b1366073f31e52ab' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/gallery/backend/tpl/gallery/edit/breadcrumb.tpl',
      1 => 1447715362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123726323357cde037341ee0-43898343',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<li><a href="/gadmin"><i class="fa fa-dashboard"></i> میزکار</a></li>
<li><a href="/gadmin/gallery">
        نمایش لیست عکس ها
    </a></li>
<li class="active">
    ویرایش گالری <?php echo $_smarty_tpl->getVariable('page')->value->pg_title;?>

</li>