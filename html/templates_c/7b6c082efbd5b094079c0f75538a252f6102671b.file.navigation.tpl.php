<?php /* Smarty version Smarty-3.0.8, created on 2016-09-05 04:38:07
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/page/show/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145130186057ccb7672a6b40-86524874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b6c082efbd5b094079c0f75538a252f6102671b' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/page/show/navigation.tpl',
      1 => 1473034086,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145130186057ccb7672a6b40-86524874',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- BREADCRUMB -->
<ul class="breadcrumb">
  <li><a href="/page">صفحه اصلی</a> <span class="divider">&rarr;</span></li>
  <?php if ($_smarty_tpl->getVariable('show_page')->value->parent_id){?><li><a href="/page/show/<?php echo $_smarty_tpl->getVariable('show_page')->value->parent_id;?>
/<?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('show_page')->value->parent_id,'chagetoplus'=>"true"),$_smarty_tpl);?>
"><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('show_page')->value->parent_id,'chagetoplus'=>"false"),$_smarty_tpl);?>
</a><?php }?>
    <li class="active"><?php echo $_smarty_tpl->getVariable('show_page')->value->pg_title;?>
</li>
</ul>
<!--END: BREADCRUMB -->