<?php /* Smarty version Smarty-3.0.8, created on 2016-08-31 03:28:13
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/midd.tpl" */ ?>
<?php /*%%SmartyHeaderCode:88878772757c60f85a211c9-50713329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5df85677fd37954cf35c1be5024aa16ecef9c338' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/midd.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '88878772757c60f85a211c9-50713329',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="col-md-9 ">
            <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

        </div>
        <div class="col-md-3 ">
            <?php $_template = new Smarty_Internal_Template("tpl/gallery/lastpic.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
            <?php $_template = new Smarty_Internal_Template("tpl/news/lastnews.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        </div>
    </div>
</div>