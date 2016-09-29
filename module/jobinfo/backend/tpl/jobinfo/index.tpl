<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/jobinfo/menu.tpl"}
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
                    <div class="title right">لیست واحدهای صنفی</div>
                    <img src="/core/module/jobinfo/backend/images/jobinfo.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                	{$arr_status = [
	                   'block' => "مسدودشده" ,
	                   'active' => "فعال" ,
	                   'pending' => "غیر فعال" 
	                   ]} 
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 170px;">نام شرکت</span>
                                <span style="width: 130px;">نام حقیقی یا حقوقی</span>
                                <span style="width: 130px;">کاربر متصل</span>
                                <span style="width: 70px;">تلفن</span>
                                <span style="width: 50px;">وضعیت</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $jobinfos as $jobinfo}
                            <div class="row_1">
                                <span style="width: 170px;" title="{$jobinfo->co_name}">{$jobinfo->co_name|truncate:24:"..":true}</span>
                                <span style="width: 130px;font-size:10px;" title="{$jobinfo->name}">{$jobinfo->name|truncate:24:"..":true}</span>
                                <span style="width: 130px;font-size:10px;" title="{$jobinfo->user_email}">{$jobinfo->user_name|truncate:24:"..":true}</span>
                                <span style="width: 70px;font-size:10px;" title="همراه: {$jobinfo->cell}">{$jobinfo->tell}</span>
                                <span style="width: 50px;font-size:10px;" >{$arr_status[$jobinfo->status]}</span>
                                <span style="width: 45px;font-size:10px;"><a href="/jobinfo/show/{$jobinfo->id}">اطلاعات</a></span>
                                <span style="width: 45px;font-size:10px;" class="last"><a href="jobinfo/service/{$jobinfo->id}">خدمات</a></span>
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