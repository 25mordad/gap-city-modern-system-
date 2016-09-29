<?php /* Smarty version Smarty-3.0.8, created on 2016-08-27 18:24:33
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/category/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:37090304057c19b99f00e06-88826231%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8313e67f591d09e0128a5257bd7cfaea6200e422' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/category/navigation.tpl',
      1 => 1472306072,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37090304057c19b99f00e06-88826231',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('group')->value->parent_id=="0"){?>
<div class="row">
    <div class="breadcrumbDiv col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/page">صفحه اصلی</a></li>
            <li><a href="/shop">محصولات</a></li>
           
            <li class="active"><?php echo $_smarty_tpl->getVariable('group')->value->pg_content;?>
</li>
        </ul>
    </div>
</div>
<?php }else{ ?>
	<?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('group')->value->parent_id),$_smarty_tpl);?>
<?php $_smarty_tpl->tpl_vars['p2'] = new Smarty_variable($_smarty_tpl->getVariable('getpage')->value, null, null);?>
	<?php if ($_smarty_tpl->getVariable('p2')->value->parent_id!="0"){?>
	<?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('p2')->value->parent_id),$_smarty_tpl);?>
<?php $_smarty_tpl->tpl_vars['p3'] = new Smarty_variable($_smarty_tpl->getVariable('getpage')->value, null, null);?>
	<?php }?>
<div class="row">
    <div class="breadcrumbDiv col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/page">صفحه اصلی</a></li>
            <li><a href="/shop">محصولات</a></li>
            <?php if ($_smarty_tpl->getVariable('p2')->value->parent_id!="0"){?>
            <li><a href="/shop/category/<?php echo $_smarty_tpl->getVariable('p3')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p3')->value->pg_content),$_smarty_tpl);?>
+<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p3')->value->pg_title),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('p3')->value->pg_content;?>
</a></li>
            <?php }?>
            <?php if ($_smarty_tpl->getVariable('group')->value->parent_id!="0"){?>
            <li><a href="/shop/category/<?php echo $_smarty_tpl->getVariable('p2')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p2')->value->pg_content),$_smarty_tpl);?>
+<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('p2')->value->pg_title),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('p2')->value->pg_content;?>
</a></li>
            <?php }?>
            <li class="active"><?php echo $_smarty_tpl->getVariable('group')->value->pg_content;?>
</li>
        </ul>
    </div>
</div>
<?php }?>



