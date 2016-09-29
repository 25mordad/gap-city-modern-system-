<form method="post" action="up/edit/{$up->id}" class="uniForm" >
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
                        <a href="up/index"><div class="r_menu">
                            <span>لیست صفحات کاربران</span>
                            <img src="{$loct}/images/icon/list.png" />
                        </div></a>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
		{include file="tpl/up/form.tpl"}
		{include file="tpl/up/info.tpl"}
	</div>    
	<div class="right _765 ">
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/title.tpl"}
		{include file="tpl/helper/content.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->	
	</div>
	<div class="clear"></div>    
</div>
</form>