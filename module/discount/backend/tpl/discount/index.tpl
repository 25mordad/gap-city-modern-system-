<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/discount/menu.tpl"}
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
                    <div class="title right">لیست تخفیف‌ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                	{$arr_status = [
	                   'block'=>"مسدود"  ,
	                   'expired' => "پایان‌یافته" ,
	                   'active' => "فعال" ,
	                   'inactive' => "غیر فعال" 
	                   ]} 
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 50px;">کد</span>
                                <span style="width: 90px;">عنوان</span>
                                <span style="width: 30px;">درصد</span>
                                <span style="width: 90px;">فروشگاه</span>
                                <span style="width: 125px;">فروشنده</span>
                                <span style="width: 60px;">تاریخ انقضا</span>
                                <span style="width: 50px;">وضعیت</span>
                                <span style="width: 40px;">ویرایش</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $discounts as $discount}
                            <div class="row_1">
                                <span style="width: 50px;" class="BYekan">{$discount->id*77}</span>
                                <span style="width: 90px;font-size:10px;">{$discount->title|truncate:15:"..":true}</span>
                                <span style="width: 30px;">{$discount->discount_percent}</span>
                                <span style="width: 90px;font-size:10px;">{if $discount->shop_name}{$discount->shop_name|truncate:15:"..":true}{else}-{/if}</span>
                                <span style="width: 120px;font-size:10px;">{if $discount->id_user_seller}{$users[$discount->id_user_seller]|truncate:26:"..":true}{else}ندارد{/if}</span>
                                <span style="width: 60px;font-size:11px;">{miladi_to_shamsi($discount->expire_date)}</span>
                                <span style="width: 50px;font-size:10px;">{$arr_status[$discount->status]}</span>
                                <span style="width: 40px;"><a href="discount/edit/{$discount->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 40px;font-size:10px;"><a href="discount/users/{$discount->id}">خریداران</a></span>
                                <span style="width: 40px;font-size:10px;" class="last"><a href="/discount/show/{$discount->id}">نمایش</a></span>
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
