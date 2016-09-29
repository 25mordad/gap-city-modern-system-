<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/club/menu.tpl"}
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
                    <div class="title right">لیست گروه‌های باشگاه مشتریان</div>
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
				            	$(".confirm_dialog").easyconfirm( { locale: $.easyconfirm.locales.faIR } );
				            });
			            </script>
			            {/literal}
	                    <style>
	                    .info { background: url({$loct}/images/icon/info.png)  }
	                    </style>
	                	{$arr_status = [
	                   'suspend'=>"معلق"  ,
	                   'active' => "فعال (ظرفیت خالی)" ,
	                   'full' => "فعال (ظرفیت تکمیل)" 
	                   ]} 
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 120px;">تاریخ ایجاد</span>
                                <span style="width: 200px;">نام</span>
                                <span style="width: 130px;">مدیر</span>
                                <span style="width: 100px;">وضعیت</span>
                                <span style="width: 50px;">اطلاعات</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $groups as $group}
                            <div class="row_1">
                                <span style="width: 120px; font-size:10px;color:red;">{jdate(" l j F Y",strtotime($group->date))}</span>
                            	<span style="width: 200px;" class="BYekan"><img src="{$loct}/images/avatar/{$group->avatar}.jpg" class="indx" />{$group->name|truncate:26:"..":true}</span>
                                <span style="width: 130px;font-size:10px;" ><a href="club/edituser/{$group->id_manager}">{$group->manager_name|truncate:26:"..":true}</a></span>
                                <span style="width: 100px;font-size:10px;">{$arr_status[$group->status]}</span>
                                <span style="width: 50px;"><a href="club/group/{$group->id}"><div class="icon info" ></div></a></span>
                                <span style="width: 50px;" class="last">
                                {if $group->status eq "suspend"}
                                	<a href="club/unsuspendgroup/{$group->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}" 
                                		title="گروه {$group->name} فعال شود؟"  class="confirm_dialog" >رفع تعلیق</a>
                                {else}
                                	<a href="club/suspendgroup/{$group->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}" 
                                		title="گروه {$group->name} معلق شود؟"  class="confirm_dialog" >تعلیق</a>
                                {/if}
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
		                <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->	
	</div>
	<div class="clear"></div>    
</div>