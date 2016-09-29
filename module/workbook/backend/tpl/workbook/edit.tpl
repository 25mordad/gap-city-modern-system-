<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/workbook/menu.tpl"}
		{include file="tpl/workbook/info.tpl"}
	</div>    
	<div class="right _765 ">
		{include file="tpl/workbook/form.tpl"}
		{if $workbook->pg_status neq "delete"}
			<!-- change Template Directory and show search  -->
			{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
			{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
			{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
			{include file="tpl/helper/browse.tpl"}
			{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
			<!-- / change Template Directory and show search  -->	
		{/if}
	</div>
	<div class="clear"></div>    
</div>