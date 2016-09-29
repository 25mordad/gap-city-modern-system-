<form method="post" action="sound/new" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/sound/form.tpl"}
		{include file="tpl/sound/info.tpl"}
	</div>    
	<div class="right _765 ">
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/title.tpl"}
		{include file="tpl/helper/excerpt.tpl"}	
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
	</div>
	<div class="clear"></div>    
</div>
</form>