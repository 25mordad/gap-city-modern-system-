<?php /* Smarty version Smarty-3.0.8, created on 2016-08-27 17:54:13
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/group.tpl" */ ?>
<?php /*%%SmartyHeaderCode:166266553357c1947d794226-23656474%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20ae58f26a1512b23ca7b53af6a0adf19f39695c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/group.tpl',
      1 => 1472221459,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '166266553357c1947d794226-23656474',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="container main-container headerOffset">
	
   <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/navigation.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    
    
    
        <div class="row transitionfx">

        <!-- left column -->

        <div class="col-lg-6 col-md-6 col-sm-6 productImageZoom">
		<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/img.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        </div>
        <!--/ left column end -->


        <!-- right column -->
        <div class="col-lg-6 col-md-6 col-sm-5">
		<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/content.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        </div>
        <!--/ right column end -->

    </div>
    <!--/.row-->
	
	<div class="row" >
		
	</div>

    <div style="clear:both"></div>
    
</div>

<div style="margin-top: 10px" ></div>
