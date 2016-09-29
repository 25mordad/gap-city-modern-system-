<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 05:55:29
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204155158157cb7809635a49-19377194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aa1aff9a03384bcc67cbe0f01c00910a2bf4115b' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/js.tpl',
      1 => 1472952325,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204155158157cb7809635a49-19377194',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Le javascript
    ================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 


<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/modernizr.custom.28468.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-transition.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-alert.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-modal.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-dropdown.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-scrollspy.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-tab.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-tooltip.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-popover.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-button.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-collapse.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-carousel.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-typeahead.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-affix.js" type="text/javascript"></script> 
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/application.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.easing.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/superfish.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.prettyPhoto.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/custom.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.ui.totop.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.mousewheel.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.flexslider-min.js" type="text/javascript"></script> 
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.cslider.js"></script>



					<!-- SLIDER -->
						<script type="text/javascript">
			jQuery(document).ready(function($){
	
				$('#da-slider').cslider({
					autoplay	: true,
					bgincrement	: 50
				});

			});
		</script>	
					<!--END: SLIDER -->
				
					<!--PORTFOLIO SLIDER -->
					<script>
					  // Can also be used with jQuery(document).ready()
					  jQuery(window).load(function() {
					  jQuery('.portfolio_rotator').flexslider({
						animation: 'slide',
						animationLoop: false,
						useCSS: false,
						controlNav: false,
						controlsContainer: '.portfolio-controls',
						easing: 'easeInOutSine',
						animationSpeed:'500',
						touch: true,
						minItems: 1,
						maxItems: 30,
						mousewheel:false,
						pauseOnHover:true,
						itemWidth:170,
						itemMargin: 30,
						move:1,
					
						
					  });
					});
					  
					</script>
					
					<!--END: SLIDER -->
					
					<!--CLIENT SLIDER -->
					<script>
					  // Can also be used with jQuery(document).ready()
					  jQuery(window).load(function() {
					  jQuery('.clients_rotator_widget_wrap').flexslider({
						animation: 'slide',
						animationLoop: false,
						useCSS: false,
						controlNav: false,
						controlsContainer: '.flex-controls-cl',
						easing: 'easeInOutSine',
						animationSpeed:'200',
						touch: true,
						minItems: 1,
						maxItems: 30,
						itemWidth: 170,
						itemMargin: 30,
						mousewheel:false,
						pauseOnHover:true,
						move:5,
					  });
					});
					  
					</script>

					
					<!--END: SLIDER -->