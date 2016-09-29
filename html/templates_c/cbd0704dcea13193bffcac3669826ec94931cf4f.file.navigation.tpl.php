<?php /* Smarty version Smarty-3.0.8, created on 2016-09-19 04:16:28
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/page/show/navigation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13260413457df2754187c89-08757545%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cbd0704dcea13193bffcac3669826ec94931cf4f' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/page/show/navigation.tpl',
      1 => 1474242387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13260413457df2754187c89-08757545',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <div class="breadcrumbDiv col-lg-12">
        <ul class="breadcrumb">
            <li><a href="/page">صفحه اصلی</a></li>
            <?php if ($_smarty_tpl->getVariable('show_page')->value->parent_id){?><li><a href="/page/show/<?php echo $_smarty_tpl->getVariable('show_page')->value->parent_id;?>
/<?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('show_page')->value->parent_id,'chagetoplus'=>"true"),$_smarty_tpl);?>
"><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('show_page')->value->parent_id,'chagetoplus'=>"false"),$_smarty_tpl);?>
</a><?php }?>
    		<li class="active"><?php echo $_smarty_tpl->getVariable('show_page')->value->pg_title;?>
</li>
        </ul>
    </div>
</div>
