<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/discount/menu.tpl"}
	</div>    
	<div class="right _765 ">
		{include file="tpl/discount/form.tpl"}
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/browse.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
	</div>
	<div class="clear"></div>    
</div>