<?php /* Smarty version Smarty-3.0.8, created on 2016-09-11 08:25:48
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/instagram/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173860844857d4d5c4ee1208-56388320%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48a3ba24f89696d78cd09a82300acf20d1a376a2' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/instagram/content.tpl',
      1 => 1473566148,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173860844857d4d5c4ee1208-56388320',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <form method="post" action="/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" >
    <div class="col-md-12 col-xs-2">
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/boxContent.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/boxImg.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </div><!-- /.col -->
    </form>
</div>