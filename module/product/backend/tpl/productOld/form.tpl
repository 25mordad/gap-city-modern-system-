{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title} محصول</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $product->pg_status neq "delete"}
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em> وضعیت محصول
                              </p>
			                    {$pg_status_radio = [['name'=>"در دست بررسی" , 'value' => "pending"],['name' => "status_button_publish" , 'value' => "publish"]]}
			                    {radioTagGenerator info = $pg_status_radio radioName = "pg_status" ul="true" class="required" default="{if isset($product)}{$product->pg_status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
		    		
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em> @@page_comment_status_label@@
                              </p>
				                {$comment_status_radio = [['name'=>"page_comment_status_active",'value'=>"open"],['name'=>"page_comment_status_deactive",'value'=>"close"]] }
				                {radioTagGenerator info = $comment_status_radio radioName = "comment_status" ul="true" class="required" default="{if isset($product)}{$product->comment_status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
                    	
                        <div class="ctrlHolder">
                              <label for="select">گروه محصول</label>
                              <select name="parent_id" id="parent_id" class="selectInput r_size" >
                    			{selectTagGenerator info= $select_parent default= "{if isset($product)}{$product->parent_id}{/if}{if isset($smarty.get.parent)}{$smarty.get.parent}{/if}" }
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
                    	این محصول حذف شده است
                    {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->