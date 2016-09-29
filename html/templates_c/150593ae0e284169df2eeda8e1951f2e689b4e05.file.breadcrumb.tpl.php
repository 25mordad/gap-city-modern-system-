<?php /* Smarty version Smarty-3.0.8, created on 2016-09-11 00:37:30
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromZara/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35151645357d468024b6860-70076399%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '150593ae0e284169df2eeda8e1951f2e689b4e05' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromZara/breadcrumb.tpl',
      1 => 1473538043,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35151645357d468024b6860-70076399',
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
اضافه کردن محصول زارا
</li>