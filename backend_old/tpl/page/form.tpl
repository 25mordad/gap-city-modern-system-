{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title} صفحه</div>
                    <img src="{$loct}/images/icon/{$action}.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $page->pg_status neq "delete"}
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em> @@page_status_label@@
                              </p>
			                    {$pg_status_radio = [['name'=>"در دست بررسی" , 'value' => "pending"],['name' => "status_button_publish" , 'value' => "publish"]]}
			                    {radioTagGenerator info = $pg_status_radio radioName = "pg_status" ul="true" class="required" default="{if isset($page)}{$page->pg_status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
		    		
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em> @@page_comment_status_label@@
                              </p>
				                {$comment_status_radio = [['name'=>"page_comment_status_active",'value'=>"open"],['name'=>"page_comment_status_deactive",'value'=>"close"]] }
				                {radioTagGenerator info = $comment_status_radio radioName = "comment_status" ul="true" class="required" default="{if isset($page)}{$page->comment_status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
                    	
                        <div class="ctrlHolder">
                              <label for="select">صفحه مادر</label>
                              <select name="parent_id" id="parent_id" class="selectInput r_size" >
                                    <option value="0"> -- @@no_parent@@ --</option>
                    			{selectTagGenerator info= $select_parent default= "{if isset($page)}{$page->parent_id}{/if}" }
                              </select>
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
                    	این صفحه حذف شده است
                    {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->