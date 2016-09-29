<?php /* Smarty version Smarty-3.0.8, created on 2016-08-31 22:11:18
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/page/show/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35067932257c716be92d869-21721391%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '97efc4499a907e0a0169ce7c76b79c7f533dc3f2' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/page/show/navigation.tpl',
      1 => 1472665263,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35067932257c716be92d869-21721391',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<ol  class="breadcrumb">
    <li><a href="/page">Home Page </a></li>
    <?php if ($_smarty_tpl->getVariable('show_page')->value->parent_id){?><li><a href="/page/show/<?php echo $_smarty_tpl->getVariable('show_page')->value->parent_id;?>
/<?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('show_page')->value->parent_id,'chagetoplus'=>"true"),$_smarty_tpl);?>
"><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('show_page')->value->parent_id,'chagetoplus'=>"false"),$_smarty_tpl);?>
</a><?php }?>
    <li class="active"><?php echo $_smarty_tpl->getVariable('show_page')->value->pg_title;?>
</li>
</ol >

