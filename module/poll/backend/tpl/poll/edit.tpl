<form method="post" action="poll/edit/{$poll->id}" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/poll/form.tpl"}
	</div>    
	<div class="right _765 ">
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/title.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
		{if $poll->status neq "del"}
			{include file="tpl/poll/answers.tpl"}
		{/if}	
	</div>
	<div class="clear"></div>    
</div>
</form>