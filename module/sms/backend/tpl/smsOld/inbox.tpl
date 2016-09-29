<div class="wrapper" >
	<div class="right _255 ">
    	{include file="tpl/sms/menu.tpl"}
    	<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/search.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
	</div>
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست پیام‌های دریافتی شما</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $GCMS_SETTING['sms']['inbox'] neq "true"}
                    شما به این بخش دسترسی ندارید
                    {else}
					    <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
					    <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
						<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
			            {literal}
			            <script>
				            $(function() {
				            $(".confirm_dialog").easyconfirm({locale: $.easyconfirm.locales.faIR});
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                            	<span style="width: 100px;">زمان ارسال</span>
                                <span style="width: 400px;">متن ارسالی</span>
                                <span style="width: 100px;">دریافت‌کننده</span>
                                <span style="width: 40px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $sms_inbox as $sms}
                            <div class="row_1">
                                <span style="width: 100px; font-size:10px;color:red;">{jdate("H:i:s Y/m/d",strtotime($sms->date))}</span>
                                <span style="width: 400px;" title="{$sms->text}">{$sms->text|truncate:65:"..":true}</span>
                                <span style="width: 100px;font-size:10px;" title="{$sms->cell_no}">
                                	{get_contact cell= $sms->cell_no }
									{if isset($contact)}
										<a href="contact/edit/{$contact->id}">{$contact->name|truncate:16:"..":true}</a>
									{else}
										{$sms->cell_no}										
									{/if}
								</span>
                                <span style="width: 40px;" class="last">
                                	<a href="sms/delinbox/{$sms->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}" 
                                		title="پیام کوتاه دریافتی در {$sms->date} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
                                </span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
		                <div class="clear"></div>      
		                <!-- paging -->
		                <div class="paging">
		                {section name=num start=1 loop=$paging+1 }
		                    {if $smarty.section.num.index neq $smarty.get.paging}
		                    <a href="{pagingurl url= $smarty.server.REQUEST_URI paging= {$smarty.section.num.index} }"><span>{$smarty.section.num.index}</span></a>
		                    {else}
		                    <span class="actpagin">{$smarty.section.num.index}</span>
		                    {/if}
		                {/section}
		                </div>
		                <!-- paging -->
				            <form method="post" action="sms/inbox" class="uniForm" >                     		
                            <div class="buttonHolder" style="text-align:center">
                            <button type="submit"  name="submit" class="primaryAction">اتصال به شبکه و دریافت پیام‌های جدید</button>
                            </div>
	                        <div class="clear"></div>
	                        </form>
		            {/if}              	
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	 
	</div>
	<div class="clear"></div>
</div>