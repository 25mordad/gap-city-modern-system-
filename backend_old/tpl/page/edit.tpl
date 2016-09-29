<form method="post" action="page/edit/{$page->id}" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/page/form.tpl"}
		{include file="tpl/helper/keyword.tpl"}
		{include file="tpl/page/info.tpl"}
        {include file="tpl/box/new_menu.tpl"}
		{include file="tpl/box/list_menu.tpl"}
	</div>    
	<div class="right _765 ">
		{include file="tpl/helper/title.tpl"}
		{include file="tpl/helper/content.tpl"}
		{include file="tpl/helper/excerpt.tpl"}
		{include file="tpl/helper/browse.tpl"}			
	</div>
	<div class="clear"></div>    
</div>
</form>