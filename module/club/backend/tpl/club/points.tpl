<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/club/menu.tpl"}
		
{if isset($point) }
	{$edit_form = true}
	{$form_action = "club/editpoint/{$point->id}"}
	{$title = "ویرایش"}
{else if $smarty.session.level eq 10}
	{$new_form = true}
	{$form_action = "club/newpoint"}
	{$title = "ایجاد"}
{/if}
		{if $edit_form or $new_form}
              <!-- _RBOX_ -->
              <div class="r_box {if isset($point)}highlights{/if}" >
                <div class="top">
                    <div class="title right">{$title} مورد امتیازی</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                          {if isset($point)}		                		
		                  <a href="club/points">&laquo; بازگشت</a>
                          {/if}
                		<form method="post" action="{$form_action}" class="uniForm" >
                		
                		{if $new_form}
                        <div class="ctrlHolder">
                            <label for="name"><em>*</em>نام</label>
                            <input name="name" id="name" size="20" type="text" class="textInput latin required auto"/>
                            <p class="formHint">نام لاتین</p>
                        </div>
	                    
                    	<div class="ctrlHolder">
                              <p class="label"><em>*</em>نوع مورد</p>
				                {$radios = [
				                ['name' => "عضویت" , 'value' => "membership"],
				                ['name' => "خرید" , 'value' => "purchase"],
				                ['name'=>"جایزه"       , 'value' => "prize"],
				                ['name' => "حذف" , 'value' => "remove"]
				                ]}
				                {radioTagGenerator info = $radios  radioName= "type" ul="true" class="required" default=""}
                              <p class="formHint"></p>
                    	</div>
                    	{/if}
                    	
	                    <div class="ctrlHolder">
	                      <label for="title"><em>*</em>عنوان</label>
	                      <input name="title" id="title" size="20"  type="text" class="textInput required auto" {if isset($point)}value="{$point->title}"{/if} />
	                      <p class="formHint"></p>
	                    </div>
                            
                        <div class="ctrlHolder">
                            <label for="user_rate"><em>*</em>امتیاز کاربر</label>
                            <input name="user_rate" id="user_rate" size="20" type="text" class="textInput latin required validateNumber auto" {if isset($point)}value="{$point->user_rate}"{/if}/>
                            <p class="formHint"></p>
                        </div>
                            
                        <div class="ctrlHolder">
                            <label for="group_rate"><em>*</em>امتیاز گروه</label>
                            <input name="group_rate" id="group_rate" size="20" type="text" class="textInput latin required validateNumber auto" {if isset($point)}value="{$point->group_rate}"{/if}/>
                            <p class="formHint"></p>
                        </div>
	                    
						<div class="buttonHolder">
                            <button type="submit" name="submit" class="primaryAction">{$title}</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                        </form>
                       
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
    	{/if}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست موارد امتیازی</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                	{$arr_types = [
	                   'prize'=>"جایزه"  ,
	                   'membership' => "عضویت" ,
	                   'purchase' => "خرید" ,
	                   'remove' => "حذف" 
	                   ]} 
	                    <style>
	                    .edit { background: url({$loct}/images/icon/edit.png)  }
	                    </style>
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 300px;">عنوان مورد</span>
                                <span style="width: 100px;">نوع</span>
                                <span style="width: 100px;">امتیاز کاربر</span>
                                <span style="width: 100px;">امتیاز گروه</span>
                                <span style="width: 50px;">ویرایش</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $points as $point}
                            <div class="row_1">
                            	<span style="width: 300px;" class="BYekan">{$point->title}</span>
                                <span style="width: 100px;">{$arr_types[$point->type]}</span>
                                <span style="width: 100px;">{$point->user_rate}</span>
                                <span style="width: 100px;">{$point->group_rate}</span>
                                <span style="width: 50px;" class="last" ><a href="club/points/?edit={$point->id}"><div class="icon edit" ></div></a></span>
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