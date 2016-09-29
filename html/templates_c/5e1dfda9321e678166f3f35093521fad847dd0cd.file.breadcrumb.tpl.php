<?php /* Smarty version Smarty-3.0.8, created on 2016-09-12 23:11:36
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMango/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16116798057d6f6e0dd6df6-15064677%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e1dfda9321e678166f3f35093521fad847dd0cd' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMango/breadcrumb.tpl',
      1 => 1473705695,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16116798057d6f6e0dd6df6-15064677',
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