<?php /* Smarty version Smarty-3.0.8, created on 2016-09-25 19:22:07
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMangooutlet/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:198415108957e7f2a70115e2-60468439%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf1732f636d7e9f09e7974acb13ace46457b8bbc' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMangooutlet/breadcrumb.tpl',
      1 => 1473705695,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '198415108957e7f2a70115e2-60468439',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<li><a href="/gadmin"><i class="fa fa-dashboard"></i> میزکار</a></li>
<li><a href="/gadmin/shop">
        لیست محصولات
    </a></li>

<li><a href="/gadmin/shop/?paging=1&search=NULL&f_parent=<?php echo $_smarty_tpl->getVariable('product')->value->group_id;?>
&f_status=all">
        همه محصولات گروه
        <?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('product')->value->group_id),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('getpage')->value->pg_title;?>

    </a></li>
<li class="active">
اضافه کردن محصول منگو
</li>