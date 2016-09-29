<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:15:06
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:75043089157d2142222b5d4-89653059%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c7a8ba877eb2cdcd0a1a1643034477e817578e45' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/head.tpl',
      1 => 1473385497,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75043089157d2142222b5d4-89653059',
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

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/css/lovehub.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--
    * LoveHub - Multipurpose Non-Profit Theme
    * https://wrapbootstrap.com/theme/lovehub-WB0T1J69J
    * Copyright 1994-2015 ForBetterWeb.com
    * To use this theme you must have a license purchased at WrapBootstrap (https://wrapbootstrap.com)
    -->
    <!-- jQuery -->

<!-- analytics -->
<?php $_template = new Smarty_Internal_Template("tpl/analytics.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>