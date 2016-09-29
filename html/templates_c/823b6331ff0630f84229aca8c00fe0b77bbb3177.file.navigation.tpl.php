<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 19:04:43
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/groupshow/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204438438057ced40381de30-81235289%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '823b6331ff0630f84229aca8c00fe0b77bbb3177' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/groupshow/navigation.tpl',
      1 => 1473172481,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204438438057ced40381de30-81235289',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<ul class="breadcrumb">
    <li><a href="/page">صفحه اصلی</a> <span class="divider">&rarr;</span></li>
    <li><a href="/news">گروه های خبری</a> <span class="divider">&rarr;</span></li>
    <li class="active"><?php echo $_smarty_tpl->getVariable('show_page')->value->pg_title;?>
</li>
</ul>

