<?php /* Smarty version Smarty-3.0.8, created on 2016-09-27 23:27:11
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28816789357eacf176de133-86636805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21e17bad18e6051e18e8929ae76838458c90725c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/head.tpl',
      1 => 1475004454,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28816789357eacf176de133-86636805',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<meta charset="utf-8">
<title><?php echo $_smarty_tpl->getVariable('gcms_page_title')->value;?>
</title>
<!-- metas -->
<meta http-equiv="content-language" content="fa" />
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
<meta	name="Author"	content="Gatriya CMS ::GCMS @version 3.0 @copyright 2016 gatriya.com" />
<meta property="og:title" content="<?php echo $_smarty_tpl->getVariable('gcms_page_title')->value;?>
" />
<meta property="og:site_name" content="Mroozi"/>
<?php $_template = new Smarty_Internal_Template("tpl/meta.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<!-- /metas -->

<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/ico/favicon.png">
<title><?php echo $_smarty_tpl->getVariable('gcms_page_title')->value;?>
</title>
<!-- Bootstrap core CSS -->
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

<!-- styles needed by swiper slider -->
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/plugins/swiper-master/css/swiper.min.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/style.css" rel="stylesheet">

<!-- Just for debugging purposes. -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<!-- gall-item Gallery for gallery page -->
    <link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/plugins/magnific/magnific-popup.css" rel="stylesheet">
<script>
	paceOptions = {
		elements: true
	};
</script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/pace.min.js"></script>
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/bootstrap-rtl.css" rel="stylesheet">
<link href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/gcms.css" rel="stylesheet">
<?php $_template = new Smarty_Internal_Template("tpl/analytics.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
