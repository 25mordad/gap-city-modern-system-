<div class="row">
    <form method="post" action="/gadmin/box/edit/{$box->id}" >
    <div class="col-md-3 col-xs-4 ">
    {include file="tpl/$part/$action/boxEdit.tpl"}
    </div><!-- /.col -->
    <div class="col-md-9 col-xs-8">
        {include file="tpl/$part/$action/boxContent.tpl"}
        {include file="tpl/$part/$action/boxHtml.tpl"}
        {include file="tpl/$part/$action/boxImg.tpl"}
    </div><!-- /.col -->
    </form>
</div>