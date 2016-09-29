<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/discount/formgroup.tpl"}
		{include file="tpl/discount/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست گروه‌ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 400px;">نام</span>
                                <span style="width: 60px;">وضعیت</span>
                                <span style="width: 50px;">ویرایش</span>
                                <span style="width: 140px;">اضافه کردن تخفیف جدید</span>
                                <div class="clear"></div>
                            </div>
                            
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .plus { background: url({$loct}/images/icon/plus.png)  }
	                    </style>
                            {foreach $groups as $group}
                            <div class="row_1">
                                <span style="width: 400px;" class="BYekan">{$group->name|truncate:38:"..":true}</span>
                                <span style="width: 60px;font-size:10px;">{if $group->status eq "active"}فعال{else}غیرفعال{/if}</span>
                                <span style="width: 50px;"><a href="discount/grouping/?edit={$group->id}"><div class="icon edit" ></div></a></span>
                                <span style="width: 140px;" class="last"><a href="discount/new/?g={$group->id}"><div class="icon plus" ></div></a></span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
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
