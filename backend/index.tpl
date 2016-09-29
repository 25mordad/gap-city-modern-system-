<!DOCTYPE html>
<html class="bg-black">
{if $part eq "auth"}
	{include file="tpl/$part/$action.tpl"}
{else}
    {include file="tpl/head.tpl"}
    <body class="skin-blue">
    {include file="tpl/header.tpl"}

    <!-- header logo: style can be found in header.less -->

    <div class="wrapper row-offcanvas row-offcanvas-left"  >
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="left-side sidebar-offcanvas">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                {include file="tpl/operator/userPanel.tpl"}
                {include file="tpl/searchForm.tpl"}
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    {include file="tpl/menu.tpl"}
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            {include file="tpl/$part/$action.tpl"}
        </aside><!-- /.right-side -->
    </div><!-- ./wrapper -->
    {include file="tpl/footer.tpl"}
    <!-- AdminLTE App -->
    <script src="{$loct}/js/AdminLTE/app.js" type="text/javascript"></script>
    </body>
{/if}
</html>