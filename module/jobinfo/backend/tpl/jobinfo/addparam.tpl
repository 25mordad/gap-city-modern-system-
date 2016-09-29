<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/jobinfo/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">
                    	{if isset($get_param) }
                    	ویرایش پارامتر «{$get_param->fa_name}» مربوط به گروه «{$group->name}»
                    	{else if isset($get_param_addvalue)}
                    	اضافه کردن مقدار به پارامتر «{$get_param_addvalue->fa_name}» مربوط به گروه «{$group->name}»
                    	{else}
                    	افزودن پارامتر به گروه «{$group->name}»
                    	{/if}
                    </div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                      {include file="tpl/jobinfo/formparam.tpl"}
                          
                      <div class="clear"></div>
                      <b>لیست پارامترهای مربوط به گروه «{$group->name}»</b><br />
                      {if count($param_lists) neq "0"}  	
                      <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    .plus { background: url({$loct}/images/icon/plus.png)  }
	                    </style>
		                	{$arr_type = [
			                   'matn'=>"متن"  ,
			                   'tozihat' => "توضیحات" ,
			                   'checkbox' => "چک‌باکس" ,
			                   'radio' => "رادیو" ,
			                   'entekhabi' => "انتخابی" 
			                   ]}   
		                	{$arr_status = [
			                   'active' => "فعال" ,
			                   'pending' => "غیر فعال" 
			                   ]} 
                      <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 180px;">نام پارامتر</span>
                                <span style="width: 50px;">نوع</span>
                                <span style="width: 50px;">وضعیت</span>
                                <span style="width: 220px;">مقدار(ها)</span>
                                <span style="width: 100px;">اضافه کردن مقدار</span>
                                <span style="width: 50px;">ویرایش</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $param_lists as $param_list}
                            <div class="row_1" style="min-height:34px;height:auto;">
                                <span style="width: 180px;" class="BYekan" title="{$param_list->en_name}" >{$param_list->fa_name|truncate:24:"..":true}</span>
                                <span style="width: 50px;">{$arr_type[$param_list->type]}</span>
                                <span style="width: 50px;">{$arr_status[$param_list->status]}</span>
                                <span style="width: 270px;">
                                {if count($param_list->param_values) neq "0"}  
                                	{foreach $param_list->param_values as $param_value}
                                	{$param_value->fa_name} ({$param_value->en_name}) <a href="jobinfo/addparam/{$group->id}?delvalue={$param_list->id}&delvalueid={$param_value->id}">حذف</a>
                                	<br/>
                                	{/foreach}
                                {else}
                                هنوز مقداری برای این پارامتر ایجاد نشده است.
                                {/if}
                                </span>
                                <span style="width: 50px;"><a href="jobinfo/addparam/{$group->id}?addvalue={$param_list->id}"><div class="icon plus" ></div></a></span>
                                <span style="width: 50px;" class="last"><a href="jobinfo/addparam/{$group->id}?edit={$param_list->id}"><div class="icon edit" ></div></a></span>
                                                                
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
		                <div class="clear"></div>
		                {else}
		                هنوز پارامتری برای این گروه ایجاد نشده است.
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
