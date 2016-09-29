<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 20:10:20
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/error404/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:118856470757cee3644b75e8-35617710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad57f932c6bb9ff1a116383b7a8e09953cbbc1e7' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/error404/index.tpl',
      1 => 1473176419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118856470757cee3644b75e8-35617710',
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
				<h4 >خطا</h1>
						<ol  class="breadcrumb">
    <li><a href="/page">صفحه اصلی</a> <span class="divider">&rarr;</span></li>
    <li class="active">خطا</li>
</ol >
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
        <?php if ((isset($_GET['module']))){?>
            @@PluginNotAllowed@@ <b><?php echo $_GET['module'];?>
</b>
        <?php }else{ ?>
            <?php if ($_GET['error']=="Auth"){?>
                @@NoAccessLevel@@ | <a href="user">@@Login@@</a>
            <?php }else{ ?>
                @@PageNotFound@@
            <?php }?>
        <?php }?>
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
