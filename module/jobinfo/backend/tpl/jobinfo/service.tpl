<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/jobinfo/menu.tpl"}        
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">خدمات واحد صنفی {$jobinfo->co_name}</div>
                    <img src="/core/module/jobinfo/backend/images/jobinfo.png" />
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
				            	
				                $( "#dialog-form" ).dialog({
				                    autoOpen: false,
				                    height: 200,
				                    width: 220,
				                    modal: true
				                });
				            });
				            function edit_admin_rank(id_service, admin_rank)
				            {
				            	$( "#id_service" ).val(id_service);
				            	$( "#admin_rank" ).val(admin_rank);
				            	$( "#dialog-form" ).dialog( "open" );
				            }
			            </script> 
			            {/literal} 
	                	{$arr_status = [
	                   'active' => "تاییدشده" ,
	                   'pending' => "عدم تایید" 
	                   ]} 
	                    <div class="list" id="tooltip">
                            <div class="top">
                                <span style="width: 120px;">عنوان</span>
                                <span style="width: 110px;">کاربر</span>
                                <span style="width: 110px;">گروه</span>
                                <span style="width: 50px;">قیمت</span>
                                <span style="width: 50px;">وضعیت</span>
                                <div class="clear"></div>
                            </div>
                            {foreach $services as $service}
                            <div class="row_1">
                                <span style="width: 120px;" title="{$service->title}">{$service->title|truncate:20:"..":true}</span>
                                <span style="width: 110px;font-size:10px;" title="{$service->user_email}">{$service->user_name|truncate:20:"..":true}</span>
                                <span style="width: 110px;font-size:10px;" title="{$service->group_name}">{$service->group_name|truncate:20:"..":true}</span>
                                <span style="width: 50px;font-size:10px;" title="ریال">{$service->fee}</span>
                                <span style="width: 50px;font-size:10px;" >{$arr_status[$service->status]}</span>
                                <span style="width: 45px;font-size:10px;"><a href="/jobinfo/showservice/{$service->id}">اطلاعات</a></span>
                                <span style="width: 35px;font-size:10px;"><a href="#">نظرات</a></span>
                                <span style="width: 50px;font-size:10px;"><a href="#">افزودن تگ</a></span>
                                <span style="width: 50px;font-size:10px;" class="last" title="برای ویرایش امتیاز سایت کلیک کنید" ><a href="javascript:edit_admin_rank({$service->id}, {$service->admin_rank})">امتیاز سایت</a></span>
                                <div class="clear"></div>
                            </div>
                            {/foreach}
                        </div>
		                <div class="clear"></div>  
		                 
						<div id="dialog-form" title="ویرایش امتیاز سایت">
						    <form method="post" action="jobinfo/edit_admin_rank" class="uniForm">                            
						    <fieldset>
						    	<input type="hidden" name="id_service" id="id_service" />
						    <div class="ctrlHolder">
						        <label for="admin_rank">امتیاز سایت</label>
						        <input type="text" name="admin_rank" id="admin_rank" size="15"  class="textInput latin auto validateInteger required" />
						        <p class="formHint"></p>
						    </div>
						    </fieldset>
                        
						<div class="buttonHolder" style="text-align:center;">
                            <button type="submit"  name="submit" class="primaryAction">ویرایش</button>
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
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->    	
	</div>
	<div class="clear"></div>    
</div>