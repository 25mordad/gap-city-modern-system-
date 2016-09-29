<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/jobinfo/menu.tpl"}             
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
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .plus { background: url({$loct}/images/icon/plus.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 200px;">عنوان گروه</span>
                                <span style="width: 80px;">نوع گروه</span>
                                <span style="width: 70px;">وضعیت</span>
                                <span style="width: 100px;">گروه مادر</span>
                                <span style="width: 150px;">اضافه کردن پارامتر جدید</span>
                                <span style="width: 50px;">ویرایش</span>
                                <div class="clear"></div>
                            </div>  
		                	{$arr_type = [
			                   'khadamat'=>"خدمات"  ,
			                   'kala' => "کالا" 
			                   ]}   
		                	{$arr_status = [
			                   'soon' => "به‌زودی" ,
			                   'active' => "فعال" ,
			                   'pending' => "غیر فعال" 
			                   ]} 
                            {foreach $groups as $group}
                            <div class="row_1">
                                <span style="width: 200px;" class="BYekan">{$group->name|truncate:34:"..":true}</span>
                                <span style="width: 80px;">{$arr_type[$group->type]}</span>
                                <span style="width: 70px;">{$arr_status[$group->status]}</span>
                                <span style="width: 100px;font-size:10px;">{if $group->parent neq 0}<a href="jobinfo/editgroup/{$group->parent}">{jobinfo_getgroupname id=$group->parent }</a>{else}ندارد{/if}</span>
                                <span style="width: 150px;"><a href="jobinfo/addparam/{$group->id}"><div class="icon plus" ></div></a></span>
                                <span style="width: 50px;" class="last"><a href="jobinfo/editgroup/{$group->id}"><div class="icon edit" ></div></a></span>
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