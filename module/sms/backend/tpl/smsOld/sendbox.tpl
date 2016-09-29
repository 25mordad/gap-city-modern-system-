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
                    <div class="title right">لیست پیام‌های ارسالی شما</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                   {$status_info = [
							"unknown" => "نامشخص<br>برای پیگیری وضعیت کلیک کنید",
							"Indeterminate" => "وضعیت پیامک نامشخص است",
							"SentToMobile" => "پیامک به گوشی مخاطب رسیده است",
							"FailedToMobile" => "پیامک به گوشی مخاطب نرسیده است",
							"SentToComunicationCenter" => "پیامک به مرکز مخابراتی رسیده است",
							"FailedToComunicationCenter" => "پیامک هنوز به مرکز مخابراتی نرسیده است",
							"Pending" => "پیامک به مرکز مخابراتی رسیده است اما وضعیت آن هنوز نامشخص است"
						]}
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
	                    .unknown { background: url({$loct}/images/icon/pending.png)  }
	                    .Indeterminate { background: url({$loct}/images/icon/pending.png)  }
	                    .FailedToMobile‫‪ { background: url({$loct}/images/icon/pending.png)  }
	                    .SentToComunicationCenter‫‪ { background: url({$loct}/images/icon/pending.png)  }
	                    .FailedToComunicationCenter‫‪ { background: url({$loct}/images/icon/pending.png)  }
	                    .Pending { background: url({$loct}/images/icon/pending.png)  }
	                    .SentToMobile { background: url({$loct}/images/icon/publish.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                            	<span style="width: 100px;">زمان ارسال</span>
                                <span style="width: 370px;">متن ارسالی</span>
                                <span style="width: 100px;">دریافت‌کننده</span>
                                <span style="width: 40px;">وضعیت</span>
                                <span style="width: 40px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $sms_send_box as $sms}
                            <div class="row_1">
                                <span style="width: 100px; font-size:10px;color:red;">{jdate("H:i:s Y/m/d",strtotime($sms->date))}</span>
                                <span style="width: 370px;" title="{$sms->text}">{$sms->text|truncate:60:"..":true}</span>
                                <span style="width: 100px;font-size:10px;" title="{$sms->cell_no}">
                                	{get_contact cell= $sms->cell_no }
									{if isset($contact)}
										<a href="contact/edit/{$contact->id}">{$contact->name|truncate:16:"..":true}</a>
									{else}
										{$sms->cell_no}
										
									{/if}
								</span>
                                <span style="width: 40px;">
                                	<a href="sms/get_status/{$sms->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}" 
                                		title="پیام کوتاه ارسالی در {$sms->date} پیگیری وضعیت شود؟"  class="confirm_dialog" >
                                		<div class="icon {$sms->final_result}" title="{$status_info[$sms->final_result]}" ></div>
                                	</a>
                                </span>
                                <span style="width: 40px;" class="last">
                                	<a href="sms/del/{$sms->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}" 
                                		title="پیام کوتاه ارسالی در {$sms->date} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	 
	</div>
	<div class="clear"></div>
</div>