<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/pay_mellat/menu.tpl"}
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
                    <div class="title right">لیست پرداخت‌ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		                {$arr_status = [
		                   'pending'=>"در دست بررسی"  ,
		                   'cancel' => "لغو" ,
		                   'confirm' => "تایید" 
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
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 30px;">ردیف</span>
                                <span style="width: 100px;">زمان پرداخت</span>
                                <span style="width: 110px;">پرداخت‌کننده</span>
                                <span style="width: 70px;">مبلغ (ریال)</span>
                                <span style="width: 200px;">اطلاعات بانکی</span>
                                <span style="width: 90px;">وضعیت</span>
                                <span style="width: 40px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $pays as $pay}
                            <div class="row_1">
                            	<span style="width: 30px;">{$pay@index+(($smarty.get.paging-1)*15)+1}</span>
                            	<span style="width: 100px; font-size:10px;color:green;" title="{jdate(" l j F Y",strtotime($pay->date))}">{jdate("H:i:s Y/m/d",strtotime($pay->date))}</span>
                                <span style="width: 110px;font-size:10px;"><a href="user/edit/{$pay->id_user}" >{$pay->username|truncate:20:"..":true}</a></span>
                                <span style="width: 60px;text-align:left;padding-left:10px;" {if $pay->txt}title="{$pay->txt}"{/if} >{number_format($pay->amount)}</span>
                                <span style="width: 200px;font-size:10px;" {if $pay->bank_info}title="{$pay->bank_info}"{/if}>{if $pay->bank_info}{$pay->bank_info|truncate:40:"..":true}{else}ندارد{/if}</span>
                                <span style="width: 90px;">{$arr_status[$pay->status]}</span>
                                <span style="width: 40px;" class="last">
                                	<a href="pay_mellat/del/{$pay->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}" 
                                		title="پرداخت در تاریخ {$pay->date} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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