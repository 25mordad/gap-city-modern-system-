<div class="row">
    <form method="post" action="/gadmin/shop/edit/{$product->id}" >
    <div class="col-md-3 col-xs-4 ">
    {include file="tpl/$part/$action/boxEdit.tpl"}
    {include file="tpl/$part/$action/color.tpl"}
    {include file="tpl/$part/$action/size.tpl"}
    {include file="tpl/$part/$action/boxInfo.tpl"}
    {include file="tpl/$part/$action/keyword.tpl"}
    
    </div><!-- /.col -->
    <div class="col-md-9 col-xs-8">
        {include file="tpl/$part/$action/boxTitle.tpl"}
        {include file="tpl/$part/$action/price.tpl"}
        
        {include file="tpl/$part/$action/boxContent.tpl"}
        {include file="tpl/$part/$action/boxImg.tpl"}
    </div><!-- /.col -->
    </form>
</div>