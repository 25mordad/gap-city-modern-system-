<?php /* Smarty version Smarty-3.0.8, created on 2016-09-05 04:32:31
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94303748657ccb617879e98-99790770%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f60d15c99462446e607cd2086227688525986603' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/index.tpl',
      1 => 1473033750,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94303748657ccb617879e98-99790770',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('part')->value=="rss"){?>
<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }else{ ?>
<!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['general']['language'];?>
">
<head>
<?php $_template = new Smarty_Internal_Template("tpl/head.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</head>
<body >
<?php if (isset($_GET['print'])){?>
    <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/print/".($_smarty_tpl->getVariable('action')->value).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }else{ ?>
<?php if ($_smarty_tpl->getVariable('part')->value=="page"&&$_smarty_tpl->getVariable('action')->value=="index"){?> 
<div class="main-wrapper">
	<!-- START HEADER headertop -->
	<?php $_template = new Smarty_Internal_Template("tpl/header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
			<!-- END HEADER headertop -->
			
			<!-- MAIN CONTENT CONTAINER -->
			
	<div class="container">
  
  <?php $_template = new Smarty_Internal_Template("tpl/boxes.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</div>
<!-- END MAIN WRAPPER-->
<!-- Footer
    ================================================== -->
    <?php $_template = new Smarty_Internal_Template("tpl/footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

<!-- END FOOTER -->
<!--[END] MAIN WRAPPER-->
</div>
<?php }else{ ?>
    <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php }?>
<?php }?>
<?php $_template = new Smarty_Internal_Template("tpl/js.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
</body>
</html>
<?php }?>