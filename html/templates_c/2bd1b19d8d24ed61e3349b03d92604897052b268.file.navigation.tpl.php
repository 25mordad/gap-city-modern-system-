<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 19:05:05
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/show/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155886087557ced419d32989-56078848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2bd1b19d8d24ed61e3349b03d92604897052b268' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/show/navigation.tpl',
      1 => 1473172504,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '155886087557ced419d32989-56078848',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<ul class="breadcrumb">
    <li><a href="/page">صفحه اصلی</a> <span class="divider">&rarr;</span></li>
    <li><a href="/news">گروه های خبری</a> <span class="divider">&rarr;</span></li>
    <li><a href="/news/groupshow/<?php echo $_smarty_tpl->getVariable('show_page')->value->parent_id;?>
/<?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('show_page')->value->parent_id,'chagetoplus'=>"true"),$_smarty_tpl);?>
"><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('show_page')->value->parent_id,'chagetoplus'=>"false"),$_smarty_tpl);?>
</a> <span class="divider">&rarr;</span></li>
    <li class="active"><?php echo $_smarty_tpl->getVariable('show_page')->value->pg_title;?>
</li>
</ul>

