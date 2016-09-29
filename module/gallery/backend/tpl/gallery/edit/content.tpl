<div class="row">
    <form method="post" action="/gadmin/gallery/edit/{$page->id}" >
    <div class="col-md-3 col-xs-4 ">
    {include file="tpl/$part/$action/boxEdit.tpl"}
    {include file="tpl/$part/$action/boxKeyword.tpl"}
    {include file="tpl/$part/$action/boxInfo.tpl"}
    </div><!-- /.col -->
    <div class="col-md-9 col-xs-8">
        {include file="tpl/$part/$action/boxContent.tpl"}
        {include file="tpl/$part/$action/boxExcerpt.tpl"}
        {include file="tpl/$part/$action/boxImg.tpl"}
    </div><!-- /.col -->
    </form>
</div>