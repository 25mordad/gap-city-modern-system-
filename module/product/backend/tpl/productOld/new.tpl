<form method="post" action="product/new" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/product/form.tpl"}
		{include file="tpl/product/info.tpl"}
	</div>    
	<div class="right _765 ">
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/title.tpl"}
		{include file="tpl/helper/content.tpl"}
		{include file="tpl/helper/excerpt.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->	
	</div>
	<div class="clear"></div>    
</div>
</form>