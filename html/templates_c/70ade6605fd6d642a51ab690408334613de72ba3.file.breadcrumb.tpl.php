<?php /* Smarty version Smarty-3.0.8, created on 2016-09-11 08:13:52
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/instagram/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57707851957d4d2f8e43f78-84392427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70ade6605fd6d642a51ab690408334613de72ba3' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/instagram/breadcrumb.tpl',
      1 => 1473565286,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57707851957d4d2f8e43f78-84392427',
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
<li class="active"> ساخت تصویر اینستاگرام 
<?php echo $_smarty_tpl->getVariable('product')->value->name;?>

</li>