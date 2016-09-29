<header class="header">
<a href="/gadmin" class="logo">
    <!-- Add the class icon to your logo image or logo icon to add the margining -->
    مدیریت وب سایت گاتریا
    <span class="label jdate hidden-xs" >{jdate(" l j F Y",strtotime( "now" ))}</span>
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
{include file="tpl/comment/boxComment.tpl"}
{include file="tpl/operator/boxProfile.tpl"}
    <li class="dropdown " data-toggle="tooltip" data-placement="bottom" title="نمایش سایت " >
        <a href="http://{$smarty.server.HTTP_HOST}" class="dropdown-toggle" target="_blank" >
            <i class=" glyphicon glyphicon-new-window"></i>
        </a>
    </li>
</ul>
</div>
</nav>



</header>