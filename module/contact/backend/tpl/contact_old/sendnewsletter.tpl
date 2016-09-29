<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/contact/menu.tpl"}
	</div>    
	<div class="right _765 ">
	{if isset($smarty.get.send)}
	 <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">ارسال خبرنامه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					{$msg}
					</div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->
	{else}
		{include file="tpl/contact/formnewsletter.tpl"}
	{/if}
	</div>
	<div class="clear"></div>    
</div>