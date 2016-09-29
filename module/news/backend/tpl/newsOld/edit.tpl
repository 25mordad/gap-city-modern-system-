<form method="post" action="news/edit/{$news->id}" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
	<!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">بازگشت به . . .</div>
                    <img src="{$loct}/images/icon/facility.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <a href="news/index"><div class="r_menu">
                            <span>لیست اخبار</span>
                            <img src="{$loct}/images/icon/list.png" />
                        </div></a>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
		{include file="tpl/news/form.tpl"}
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/keyword.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
		{include file="tpl/news/info.tpl"}
	</div>    
	<div class="right _765 ">
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/title.tpl"}
		{include file="tpl/helper/content.tpl"}
		{include file="tpl/helper/excerpt.tpl"}
		{include file="tpl/helper/browse.tpl"}	
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->	
	</div>
	<div class="clear"></div>    
</div>
</form>