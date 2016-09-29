<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:29:31
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:52864204457cecbc3360a61-74508419%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8096a161225efccc74744c7f28b6907db6c2e76e' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/head.tpl',
      1 => 1473170370,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '52864204457cecbc3360a61-74508419',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<meta charset="utf-8">
<title><?php echo $_smarty_tpl->getVariable('gcms_page_title')->value;?>
</title>
<!-- metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta	name="description"	content="<?php echo $_smarty_tpl->getVariable('gcms_site_description')->value;?>
" />
<meta	name="keywords"	content="<?php echo $_smarty_tpl->getVariable('gcms_site_keyword')->value;?>
<?php if (isset($_smarty_tpl->getVariable('allkeywords',null,true,false)->value[0])){?> , <?php  $_smarty_tpl->tpl_vars['kw'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allkeywords')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['kw']->key => $_smarty_tpl->tpl_vars['kw']->value){
?><?php echo $_smarty_tpl->getVariable('kw')->value->kw_title;?>
 , <?php }} ?><?php }?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta	name="Author"	content="Gatriya CMS ::GCMS @version 2.0.1 @copyright 2012 RSES.ir" />
<!-- /metas -->
<link	rel="icon"	type="image/png"	href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/fav.png" />


<!-- Le styles -->

<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/bootstrap-responsive.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/flexslider.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/parallax_slider/style.css" rel="stylesheet">
<noscript>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/css/parallax_slider/nojs.css" />
</noscript>
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/font-awesome.min.css" rel="stylesheet"> 
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/social.css" rel="stylesheet"> 
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/style_warhols_green.css" rel="stylesheet" id="colors"><!-- !important THIS STYLE CSS ON BOTTOM OF STYLEs LIST-->




<!--[if lt IE 7]>
	<link href="assets/css/font-awesome-ie7.min.css" rel="stylesheet">
	<![endif]-->
    <!-- Fav and touch icons -->

<link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
    <![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/ico/apple-touch-icon-57-precomposed.png">

<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/bootstrap-rtl.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/gcms.css" rel="stylesheet" media="screen">
<!-- analytics -->
<?php $_template = new Smarty_Internal_Template("tpl/analytics.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>