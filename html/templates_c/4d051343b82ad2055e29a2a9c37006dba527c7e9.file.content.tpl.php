<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:06:59
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/comment/edit/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:118486235157d2123ba49f96-63608365%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4d051343b82ad2055e29a2a9c37006dba527c7e9' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/comment/edit/content.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118486235157d2123ba49f96-63608365',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/comment/edit/<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
" >
        <div class="col-md-3 col-xs-4 ">
            <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/boxEdit.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
            <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/boxInfo.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        </div><!-- /.col -->
        <div class="col-md-9 col-xs-8">
            <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/boxContent.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        </div><!-- /.col -->
    </form>
</div>