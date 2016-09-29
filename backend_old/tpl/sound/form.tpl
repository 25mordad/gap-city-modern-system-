{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title} گالری صوتی</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $sound->pg_status neq "delete"}
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>وضعیت گالری صوتی
                              </p>
			                    {$pg_status_radio = [['name'=>"در دست بررسی" , 'value' => "pending"],['name' => "status_button_publish" , 'value' => "publish"]]}
			                    {radioTagGenerator info = $pg_status_radio radioName = "pg_status" ul="true" class="required" default="{if isset($sound)}{$sound->pg_status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
                    	{if $GCMS_MODULE['user'] eq "active"}
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>نمایش گالری صوتی
                              </p>
			                    {$pg_content_radio = [['name'=>"مخصوص اعضا" , 'value' => "user"],['name' => "نمایش عمومی" , 'value' => "public"]]}
			                    {radioTagGenerator info = $pg_content_radio radioName = "pg_content" ul="true" class="required" default="{if isset($sound)}{$sound->pg_content}{/if}"}
                              <p class="formHint"></p>
                    	</div>
		    			{else}
		    			<input type="hidden" name="pg_content" value="public" />
		    			{/if}
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>@@page_comment_status_label@@
                              </p>
				                {$comment_status_radio = [['name'=>"page_comment_status_active",'value'=>"open"],['name'=>"page_comment_status_deactive",'value'=>"close"]] }
				                {radioTagGenerator info = $comment_status_radio radioName = "comment_status" ul="true" class="required" default="{if isset($sound)}{$sound->comment_status}{/if}"}
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
                    	این گالری صوتی حذف شده است
                    {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->