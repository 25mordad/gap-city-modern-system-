<?php /* Smarty version Smarty-3.0.8, created on 2016-08-27 18:10:28
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:65660772957c1984c0af5d2-24203039%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e90574abbc593df10ed45841d98e6f9524d4144' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/show.tpl',
      1 => 1472305227,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '65660772957c1984c0af5d2-24203039',
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
