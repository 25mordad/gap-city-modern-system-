<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 19:02:47
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/show.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50310461057ced38f421de1-93451369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e658f283ca1967a972a1dd2a64922847d46cbb9c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/show.tpl',
      1 => 1473172366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50310461057ced38f421de1-93451369',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="main-wrapper">
<?php $_template = new Smarty_Internal_Template("tpl/menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<!-- PAGE HEADER -->
<div class="page-header">
	<div class="shine">
		<div class="container">
			<div class="row-fluid">
				<div class="span12">
						<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/title.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
						<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/navigation.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
		  </div>
		 </div>
		</div>
	   </div>
	 </div>
	<!-- PAGE HEADER -->
</div>
<div class="container">
  <div class="row-fluid blog">
    <div class="span8">
      <div class="blog-post" >
        
        <?php $_template = new Smarty_Internal_Template("tpl/alert.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/txt.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
      </div>
      
				
    </div>
	<!-- END CONTENT SIDE -->
	<!-- SIDEBAR-->
    <div class="span4 side_bar">
	
        <div class="row-fluid">
		<hr class="half" />
				<div class="line2 center">
				<h5 class="standart-h3title"><span><?php echo $_smarty_tpl->getVariable('general_boxes')->value[3]->box_title;?>
</span></h5>
				</div>
				<div class="vendor">
					<div class="container-video">
					<?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[3]->box_content);?>

					</div>
				</div>
        </div>
      
    </div>
	<!-- END SIDEBAR-->
  </div>
  <!-- END INNER ROW-FLUID -->
</div>
<!-- END CONTENT CONTAINER-->
