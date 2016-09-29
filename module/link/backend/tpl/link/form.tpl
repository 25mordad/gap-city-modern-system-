{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
	
{if isset($link)}
	{$parent_id = $link->parent_id}
{else if isset($smarty.get.g)}
	{$parent_id = $smarty.get.g}
{else}
	{$parent_id = ""}
{/if}
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} پیوند</div>
                    <img src="/core/module/link/backend/images/link.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if !isset($link) || $link->pg_status neq "delete"}
					<form action="link/{$action}{if isset($link)}/{$link->id}{/if}" method="post" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="pg_title"><em>*</em>عنوان پیوند</label>
                            <input name="pg_title" id="pg_title" type="text" class="textInput required " {if isset($link)}value="{$link->pg_title}"{/if}/>
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="pg_excerpt"><em>*</em>آدرس url پیوند</label>
                            <input name="pg_excerpt" id="" type="text" class="textInput required latin" {if isset($link)}value="{$link->pg_excerpt}"{/if}/>
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="pg_content">شرح پیوند</label>
                            <input name="pg_content" id="pg_content" type="text" class="textInput " {if isset($link)}value="{$link->pg_content}"{/if}/>
                            <p class="formHint"></p>
                            </div>
                           
	                        <div class="ctrlHolder">
	                        	<label for="parent_id"><em>*</em>گروه‌پیوند</label>
	                              <select name="parent_id" id="parent_id" class="selectInput required" >
                              		<option value="" selected="selected">-- @@Choose@@ --</option>
                    				{selectTagGenerator info= $select_group default= "{$parent_id}" }
	                              </select>
	                              <p class="formHint"></p>
	                        </div>	  
                        
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em>وضعیت پیوند
                              </p>
			                    {$pg_status_radio = [['name'=>"در دست بررسی" , 'value' => "pending"],['name' => "status_button_publish" , 'value' => "publish"]]}
			                    {radioTagGenerator info = $pg_status_radio radioName = "pg_status" ul="true" class="required" default="{if isset($link)}{$link->pg_status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
                    	
                            </fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">{$title}</button>
                            </div>
                        
                        
                        <div class="clear"></div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
					</form>
                        {else}
                        <p>این پیوند حذف شده است</p>
		                {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->