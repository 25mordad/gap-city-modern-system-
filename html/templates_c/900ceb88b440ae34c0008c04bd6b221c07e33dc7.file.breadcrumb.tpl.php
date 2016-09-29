<?php /* Smarty version Smarty-3.0.8, created on 2016-09-12 20:17:02
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromBershka/breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:23923806857d6cdf6a45806-67390155%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '900ceb88b440ae34c0008c04bd6b221c07e33dc7' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromBershka/breadcrumb.tpl',
      1 => 1473695136,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23923806857d6cdf6a45806-67390155',
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
اضافه کردن محصول برشکا
</li>