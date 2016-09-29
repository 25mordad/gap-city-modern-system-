{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title} نظرسنجی</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $poll->status neq "del"}
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>وضعیت نظرسنجی
                              </p>
                              {$status_radio = [
		                        ['name'=>"فعال",'value'=>"open"],
		                        ['name'=>"در دست بررسی",'value'=>"close"],
		                        ['name'=>"آرشیو",'value'=>"archive"]
		                        ]}
			                    {radioTagGenerator info = $status_radio radioName = "status" ul="true" class="required" default="{if isset($poll)}{$poll->status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>رابطه بین پاسخ‌ها
                              </p>
                              {$answer_rel_radio = [
		                        ['name'=>"رادیو",'value'=>"radio"],
		                        ['name'=>"چک باکس",'value'=>"checkbox"]
		                        ]} 
				                {radioTagGenerator info = $answer_rel_radio radioName = "answer_rel" ul="true" class="required" default="{if isset($poll)}{$poll->answer_rel}{/if}"}
                              <p class="formHint"></p>
                    	</div>
                        
						<div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">{$title}</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                    {else}
                    	این نظرسنجی حذف شده است
                    	
				                <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
				                <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
								<script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
		                		{literal}
		                		<script>
		                		$(function() {
		                			$(".confirm_del").easyconfirm({locale: $.easyconfirm.locales.faIR});
		                		});
		                		</script>
		                		{/literal}	
		                		<p style="margin-top:10px;text-align:center;">
		                			<a href="poll/undel/{$poll->id}" title="نظرسنجی {$poll->question|truncate:30} بازیابی شود؟"  class="del_btn confirm_del" >بازیابی نظرسنجی</a>
		                		</p>
                    {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->