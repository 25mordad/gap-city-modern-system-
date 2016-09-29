<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 21:50:31
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/edit/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:114342645357b9e2dfbea867-25605125%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6efa9c6fcf04cdb13f2323c92de3b383539573a' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/edit/breadcrumb.tpl',
      1 => 1471800030,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114342645357b9e2dfbea867-25605125',
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
<?php echo $_smarty_tpl->getVariable('product')->value->name;?>

</li>