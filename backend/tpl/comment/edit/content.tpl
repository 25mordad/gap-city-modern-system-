<div class="row">
    <form method="post" action="/gadmin/comment/edit/{$comment->id}" >
        <div class="col-md-3 col-xs-4 ">
            {include file="tpl/$part/$action/boxEdit.tpl"}
            {include file="tpl/$part/$action/boxInfo.tpl"}
        </div><!-- /.col -->
        <div class="col-md-9 col-xs-8">
            {include file="tpl/$part/$action/boxContent.tpl"}
        </div><!-- /.col -->
    </form>
</div>