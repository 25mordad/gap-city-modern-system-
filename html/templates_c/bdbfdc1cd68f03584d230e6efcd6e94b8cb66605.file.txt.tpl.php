<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:35
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/show/txt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15161892057ced29392ec07-35865616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bdbfdc1cd68f03584d230e6efcd6e94b8cb66605' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/show/txt.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15161892057ced29392ec07-35865616',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('show_page')->value->pg_excerpt!=''){?>
<div class="well well-sm">
    <?php echo $_smarty_tpl->getVariable('show_page')->value->pg_excerpt;?>

    <p class="text-left"><small ><?php echo jdate(" l j F Y",strtotime($_smarty_tpl->getVariable('show_page')->value->date_created));?>
</small></p>
</div>
<?php }?>
<br/>
<?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('show_page')->value->pg_content);?>


<div class="clearfix" ></div>
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

