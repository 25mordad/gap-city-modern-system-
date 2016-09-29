<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:40:56
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/page/show/txt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:102906891557cece7047fe31-60869574%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a4a34fdb3d7ada8d74af6f56ed4e1829667bb9c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/page/show/txt.tpl',
      1 => 1473170962,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102906891557cece7047fe31-60869574',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('show_page')->value->pg_content);?>

<?php if (count($_smarty_tpl->getVariable('all_parent')->value)!=0){?>
	<?php $_template = new Smarty_Internal_Template("tpl/page/child_content.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }?>
<?php if (($_smarty_tpl->getVariable('show_page')->value->comment_status=="open")){?>
	<?php $_template = new Smarty_Internal_Template("tpl/page/comment.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php $_template = new Smarty_Internal_Template("tpl/page/allcomment.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }?>
<?php $_template = new Smarty_Internal_Template("tpl/page/allkeywords.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
