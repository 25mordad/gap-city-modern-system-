<?php /* Smarty version Smarty-3.0.8, created on 2016-09-22 03:00:08
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2885735757e318007f1814-88057363%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6f485bafd2626ef3cd75289070a79fc2b91d21e' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show/navigation.tpl',
      1 => 1474500608,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2885735757e318007f1814-88057363',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('product')->value->group_id),$_smarty_tpl);?>
<?php $_smarty_tpl->tpl_vars['p1'] = new Smarty_variable($_smarty_tpl->getVariable('getpage')->value, null, null);?>
<?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('p1')->value->parent_id),$_smarty_tpl);?>
<?php $_smarty_tpl->tpl_vars['p2'] = new Smarty_variable($_smarty_tpl->getVariable('getpage')->value, null, null);?>
<?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('p2')->value->parent_id),$_smarty_tpl);?>
<?php $_smarty_tpl->tpl_vars['p3'] = new Smarty_variable($_smarty_tpl->getVariable('getpage')->value, null, null);?>
<?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('product')->value->brand),$_smarty_tpl);?>
<?php $_smarty_tpl->tpl_vars['brand'] = new Smarty_variable($_smarty_tpl->getVariable('getpage')->value, null, null);?>
<div class="row">
    <div class="breadcrumbDiv col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/page">صفحه اصلی</a></li>
            <li><a href="/shop">محصولات</a></li>
            <li><a href="/shop/category/<?php echo $_smarty_tpl->getVariable('p3')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p3')->value->pg_content),$_smarty_tpl);?>
+<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p3')->value->pg_title),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('p3')->value->pg_content;?>
</a></li>
            <li><a href="/shop/category/<?php echo $_smarty_tpl->getVariable('p2')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p2')->value->pg_content),$_smarty_tpl);?>
+<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p2')->value->pg_title),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('p2')->value->pg_content;?>
</a></li>
            <li><a href="/shop/category/<?php echo $_smarty_tpl->getVariable('p1')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p1')->value->pg_content),$_smarty_tpl);?>
+<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p1')->value->pg_title),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('p1')->value->pg_content;?>
</a></li>
            <li class="active"><?php echo $_smarty_tpl->getVariable('product')->value->fa_title;?>
 <?php echo $_smarty_tpl->getVariable('brand')->value->pg_content;?>
 - <?php echo $_smarty_tpl->getVariable('brand')->value->pg_title;?>
</li>
            <li >
            <?php if (isset($_SESSION['userid'])){?>
            <a href="/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" class="btn btn-warning btn-xs" >ویرایش محصول</a>
            <?php }?>
            </li>
            
        </ul>
    </div>
</div>
