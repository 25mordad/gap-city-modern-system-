<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 23:11:36
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64186679857b9f5e0587bc9-73556862%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0b93c3d893feb5689206d6fe4030a2b05b5a141e' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/breadcrumb.tpl',
      1 => 1471800030,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64186679857b9f5e0587bc9-73556862',
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