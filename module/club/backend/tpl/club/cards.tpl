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
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">ایجاد کارت</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                		<form method="post" action="club/newcard" class="uniForm" >
                		
                        <div class="ctrlHolder">
                            <label for="number"><em>*</em>تعداد</label>
                            <input name="number" id="number" size="20" type="text" class="textInput latin required validateInteger auto"/>
                            <p class="formHint"></p>
                        </div>
                        
	                    <div class="ctrlHolder">
	                      <label for="serial">سریال شروع</label>
	                      <input name="serial" id="serial" size="20" readonly="readonly" type="text" class="textInput latin disabled auto" value="{$GCMS_SETTING['club']['serial']}" />
	                      <p class="formHint"></p>
	                    </div>
                            
                        <div class="ctrlHolder">
                            <label for="rate"><em>*</em>امتیاز</label>
                            <input name="rate" id="rate" size="20" type="text" class="textInput latin required validateNumber auto"/>
                            <p class="formHint"></p>
                        </div>
	                    
                    	<div class="ctrlHolder">
                              <p class="label"><em>*</em>نوع کارت</p>
				                {$radios = [
				                ['name'=>"طلایی"       , 'value' => "gold"],
				                ['name' => "نقره‌ای" , 'value' => "silver"],
				                ['name' => "برنزی" , 'value' => "bronze"]
				                ]}
				                {radioTagGenerator info = $radios  radioName= "type" ul="true" class="required" default=""}
                              <p class="formHint"></p>
                    	</div>
                    	
	                    <div class="ctrlHolder">
	                      <label for="info">توضیحات</label>
	                      <input name="info" id="info" size="20"  type="text" class="textInput auto" />
	                      <p class="formHint"></p>
	                    </div>
	                    
						<div class="buttonHolder">
                            <button type="submit" name="submit" class="primaryAction">ایجاد</button>
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
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">لیست کارت‌های باشگاه مشتریان</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                	{$arr_status = [
	                   'gold'=>"طلایی"  ,
	                   'silver' => "نقره‌ای" ,
	                   'bronze' => "برنزی" 
	                   ]} 
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 200px;">شماره سریال</span>
                                <span style="width: 100px;">نوع کارت</span>
                                <span style="width: 100px;">امتیاز</span>
                                <span style="width: 250px;">کاربر</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $cards as $card}
                            <div class="row_1">
                            	<span style="width: 200px;" class="BYekan" {if $card->info neq ""}title="{$card->info}"{/if} >{$card->serial}</span>
                                <span style="width: 100px;">{$arr_status[$card->type]}</span>
                                <span style="width: 100px;">{$card->rate}</span>
                                {if $card->id_user eq "0"}
                                <span style="width: 250px;" class="last" title="هنوز کاربری کارت را ثبت نکرده است" >-</span>
                                {else}
                                <span style="width: 250px;" class="last" title="تاریخ ثبت:{jdate(" l j F Y",strtotime($card->reg_date))}" >
                                	<a href="club/edituser/{$card->id_user}">{$card->user_name}</a>
                                </span>
                                {/if}
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