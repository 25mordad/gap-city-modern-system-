<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/contact/menu.tpl"}
		<!-- change Template Directory and show search  -->
		{$GcmsSmarty->addTemplateDir("{$coretemplatedirectory}")}
		{$TemplateDirectory = $GcmsSmarty->getTemplateDir()}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[1])}
		{include file="tpl/helper/search.tpl"}
		{$GcmsSmarty->setTemplateDir($TemplateDirectory[0])}
		<!-- / change Template Directory and show search  -->
		{include file="tpl/contact/filter.tpl"}
	</div>
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست تماس‌ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
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
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .del { background: url({$loct}/images/icon/del.png)  }
	                    .sms { background: url({$loct}/images/icon/publish.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 200px;">نام</span>
                                <span style="width: 120px;">ایمیل</span>
                                <span style="width: 100px;">گروه</span>
                                <span style="width: 90px;">شماره تماس</span>
                                <span style="width: 55px;">ارسال پیام</span>
                                <span style="width: 40px;">ویرایش</span>
                                <span style="width: 40px;">حذف</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $contacts as $contact}
                            <div class="row_1">
                                <span style="width: 200px;" class="BYekan">{$contact->name|truncate:25:"..":true}</span>
                                <span style="width: 120px;font-size:10px;">{if $contact->email}{$contact->email|truncate:20:"..":true}{else}-{/if}</span>
                                <span style="width: 100px;font-size:10px;">{if $contact->id_group}<a href="contact/grouping/?edit={$contact->id_group}">{$group_contacts[$contact->id_group]|truncate:18:"..":true}</a>{else}ندارد{/if}</span>
                                <span style="width: 90px;">{$contact->cell}</span>
                                <span style="width: 55px;"><a href="sms/?single=true&cell={$contact->cell}"><div class="icon sms" ></div></a></span>
                                <span style="width: 40px;"><a href="contact/edit/{$contact->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 40px;" class="last">
                                	<a href="contact/del/{$contact->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}&id_group={$smarty.get.id_group}" 
                                		title="تماس {$contact->name} حذف شود؟"  class="confirm_dialog" ><div class="icon del" ></div></a>
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