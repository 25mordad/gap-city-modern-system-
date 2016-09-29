<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {include file="tpl/$part/$action/title.tpl"}
    </h1>
    <ol class="breadcrumb">
        {include file="tpl/$part/$action/breadcrumb.tpl"}
    </ol>
</section>

<!-- Main content -->
<section class="content">
    {include file="tpl/alert.tpl"}
    {include file="tpl/$part/$action/content.tpl"}
</section><!-- /.content -->
{include file="tpl/$part/$action/help.tpl"}