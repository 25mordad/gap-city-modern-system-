{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}

{if isset($news)}
	{$parent_id = $news->parent_id}
{else if isset($smarty.get.g)}
	{$parent_id = $smarty.get.g}
{else}
	{$parent_id = ""}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title} خبر</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $news->pg_status neq "delete"}
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>وضعیت خبر
                              </p>
			                    {$pg_status_radio = [['name'=>"در دست بررسی" , 'value' => "pending"],['name' => "status_button_publish" , 'value' => "publish"]]}
			                    {radioTagGenerator info = $pg_status_radio radioName = "pg_status" ul="true" class="required" default="{if isset($news)}{$news->pg_status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
		    		
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>@@page_comment_status_label@@
                              </p>
				                {$comment_status_radio = [['name'=>"page_comment_status_active",'value'=>"open"],['name'=>"page_comment_status_deactive",'value'=>"close"]] }
				                {radioTagGenerator info = $comment_status_radio radioName = "comment_status" ul="true" class="required" default="{if isset($news)}{$news->comment_status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
                    	
                        <div class="ctrlHolder">
                              <label for="select"><em>*</em>گروه خبری</label>
                              <select name="parent_id" id="parent_id" class="selectInput r_size required" >
                              	<option value="" selected="selected">-- @@Choose@@ --</option>
                    			{selectTagGenerator info= $select_group default= "{$parent_id}" }
                              </select>
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
                    	این خبر حذف شده است
                    {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->