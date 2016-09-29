<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:42:20
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103007181457abd0f4b6f4a0-36353178%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4df352fd8ef109204f1827e16336a24fc6a2cf11' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/menu.tpl',
      1 => 1470314206,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103007181457abd0f4b6f4a0-36353178',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="container" >
	<div class="navbar-header" >
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span
				class="sr-only"> Toggle navigation </span> <span class="icon-bar"> </span> <span
				class="icon-bar"> </span> <span class="icon-bar"> </span></button>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-cart"><i
				class="fa fa-shopping-cart colorWhite"> </i> <span
				class="cartRespons colorWhite"> سبدخرید </span></button>
		<a class="navbar-brand " href="/page"> <img src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/images/logo.png" alt="TSHOP"> </a>

		<!-- this part for mobile -->
		<div class="search-box pull-right hidden-lg hidden-md hidden-sm">
			<div class="input-group">
				<button class="btn btn-nobg getFullSearch" type="button"><i class="fa fa-search"> </i></button>
			</div>
			<!-- /input-group -->

		</div>
	</div>
	<?php $_template = new Smarty_Internal_Template("tpl/menu/mobileBasket.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
	

	<div class="navbar-collapse collapse" >
		<?php $_template = new Smarty_Internal_Template("tpl/menu/mainMenu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
		
		
		<!--- this part will be hidden for mobile version -->
		<div class="nav navbar-nav navbar-left hidden-xs" >
			<?php $_template = new Smarty_Internal_Template("tpl/menu/search.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
			<?php $_template = new Smarty_Internal_Template("tpl/menu/basket.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
			
		</div>
		<!--/.navbar-nav hidden-xs-->
	</div>
	<!--/.nav-collapse -->

</div>
<!--/.container -->

