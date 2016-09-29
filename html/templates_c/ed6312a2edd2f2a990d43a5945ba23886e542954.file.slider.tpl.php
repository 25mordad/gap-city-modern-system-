<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:37:04
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3925607057cdde789c7268-46060943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed6312a2edd2f2a990d43a5945ba23886e542954' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/slider.tpl',
      1 => 1473109622,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3925607057cdde789c7268-46060943',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- SLIDER START-->

			<div class="banner-rotator">
				<div id="da-slider" class="da-slider">
				
				<div class="da-slide">
					<h2><?php echo $_smarty_tpl->getVariable('general_boxes')->value[2]->box_title;?>
</h2>
					<div style="direction: rtl;text-align: right;"><?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[2]->box_content);?>
</div>
					<span class="da-link">
						<a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[2]->class_name;?>
" >
							<span class="main-link"><i class="fa-icon-tablet"></i> بیشتر بخوانید...</span> 
							<span class="arrow"> &rarr;</span>
						</a>
					</span>
					<div class="da-img visible-desktop"><img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[2]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="image01" /></div>
				</div>
				
				<div class="da-slide">
					<h2><?php echo $_smarty_tpl->getVariable('general_boxes')->value[4]->box_title;?>
</h2>
					<div style="direction: rtl;text-align: right;"><?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[4]->box_content);?>
</div>
					<span class="da-link">
						<a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[2]->class_name;?>
" >
							<span class="main-link"><i class="fa-icon-tablet"></i> بیشتر بخوانید...</span> 
							<span class="arrow"> &rarr;</span>
						</a>
					</span>
					<div class="da-img visible-desktop"><img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[4]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="image01" /></div>
				</div>
				
				
				<nav class="da-arrows">
					<span class="da-arrows-prev"></span>
					<span class="da-arrows-next"></span>
				</nav>
			</div>
			</div>
			<!-- SLIDER [END]-->