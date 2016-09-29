<form method="post" action="sms/confirm_send" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/sms/form.tpl"}
    	{include file="tpl/sms/info.tpl"}
    	{include file="tpl/sms/menu.tpl"}
	</div>
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">شماره‌های گیرنده پیام</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    	{$cells = ""}
			            {foreach $smarty.post.cell as $mob }
			            	{$mob}&nbsp;
			            	{$cells = "$mob $cells"} 
			            {/foreach}
			            <input type="hidden" name="cells" value="{$cells}" />
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->		
    	{include file="tpl/sms/text.tpl"}
	</div>
	<div class="clear"></div>
</div>
</form>