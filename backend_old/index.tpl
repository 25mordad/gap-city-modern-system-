<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

{if $part eq "auth"}
	{include file="tpl/$part/$action.tpl"}
{else}
	<head>{include file="tpl/head.tpl"}</head>
	<body>
		<div class="header">{include file="tpl/header.tpl"}</div>
		<div class="menu">{include file="tpl/menu.tpl"}</div>
		<div class="center">
		{include file="tpl/alert.tpl"}
		{if $ismodule}
			{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
			{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
			{include file="tpl/$part/$action.tpl"}
			{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		{else}
			{include file="tpl/$part/$action.tpl"}
		{/if}
		</div>
		<div class="footer">{include file="tpl/footer.tpl"}</div>
	</body>
{/if}

</html>