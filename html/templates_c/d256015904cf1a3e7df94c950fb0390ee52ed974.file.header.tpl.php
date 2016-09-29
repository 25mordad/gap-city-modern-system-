<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:32:58
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206298399757abcec275d7f3-52851488%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd256015904cf1a3e7df94c950fb0390ee52ed974' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/header.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206298399757abcec275d7f3-52851488',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<header class="header">
<a href="/gadmin" class="logo">
    <!-- Add the class icon to your logo image or logo icon to add the margining -->
    مدیریت وب سایت گاتریا
    <span class="label jdate hidden-xs" ><?php echo jdate(" l j F Y",strtotime("now"));?>
</span>
    <div class="clearfix" ></div>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top navbarBgBlue" role="navigation" >
<!-- Sidebar toggle button-->
<a href="#" class="navbar-btn sidebar-toggle hidden-lg hidden-md " data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>
<div class="navbar-left ">
<ul class="nav navbar-nav ">

    <li class="dropdown " data-toggle="tooltip" data-placement="bottom" title=" راهنمای سایت " >
        <a href="" class="dropdown-toggle" data-toggle="modal" data-target="#gcmsHelp" >
            <i class=" fa fa-question-circle"></i>
        </a>
    </li>

    <li class="dropdown " data-toggle="tooltip" data-placement="bottom" title=" آمار سایت " >
        <a href="/gadmin/statistic" class="dropdown-toggle"  >
            <i class=" fa fa-line-chart"></i>
        </a>
    </li>

    <li class="dropdown " data-toggle="tooltip" data-placement="bottom" title="  مدیریت فایل‌ها " >
        <a href="/gadmin/file" class="dropdown-toggle"  >
            <i class=" fa fa-file"></i>
        </a>
    </li>

    <li class="dropdown " data-toggle="tooltip" data-placement="bottom" title="  مدیریت اپراتورها " >
        <a href="/gadmin/operator" class="dropdown-toggle"  >
            <i class=" fa fa-user"></i>
        </a>
    </li>

    <li class="dropdown " data-toggle="tooltip" data-placement="bottom" title="   مدیریت منوها " >
        <a href="/gadmin/menu" class="dropdown-toggle"  >
            <i class=" fa fa-list-ul"></i>
        </a>
    </li>

    <li class="dropdown " data-toggle="tooltip" data-placement="bottom" title=" تنظیمات سایت " >
        <a href="/gadmin/setting" class="dropdown-toggle"  >
            <i class=" fa fa-gears"></i>
        </a>
    </li>
<?php $_template = new Smarty_Internal_Template("tpl/comment/boxComment.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template("tpl/operator/boxProfile.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <li class="dropdown " data-toggle="tooltip" data-placement="bottom" title="نمایش سایت " >
        <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>
" class="dropdown-toggle" target="_blank" >
            <i class=" glyphicon glyphicon-new-window"></i>
        </a>
    </li>
</ul>
</div>
</nav>



</header>