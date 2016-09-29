{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
	
{if isset($workbook)}
	{$parent_id = $workbook->parent_id}
{else if isset($smarty.get.t)}
	{$parent_id = $smarty.get.t}
{else}
	{$parent_id = ""}
{/if}

              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} کارنامه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if !isset($workbook) || $workbook->pg_status eq "publish"}
					<form action="workbook/{$action}{if isset($workbook)}/{$workbook->id}{/if}" method="post" class="uniForm">
					<fieldset>
					
                        <div class="ctrlHolder">
                              <label for="parent_id"><em>*</em>عنوان کارنامه</label>
                              <select name="parent_id" id="parent_id" class="selectInput r_size required" >
                              	<option value="" selected="selected">-- @@Choose@@ --</option>
                    			{selectTagGenerator info= $select_title default= "{$parent_id}" }
                              </select>
                              <p class="formHint"></p>
                        </div>
					
                        <div class="ctrlHolder">
                              <label for="pg_title"><em>*</em>مربوط به کاربر</label>
                              <select name="pg_title" id="pg_title" class="selectInput r_size required" >
                              	<option value="" selected="selected">-- @@Choose@@ --</option>
	                                {foreach $users as $key => $val}
	                                <option value="{$key}" {if isset($workbook) && $workbook->pg_title eq $key }selected="selected"{/if} >{$val}</option>
	                                {/foreach}
                              </select>
                              <p class="formHint"></p>
                        </div>
                        
                        <div class="ctrlHolder">
                            <label for="pg_content"><em>*</em>معدل</label>
                            <input name="pg_content" id="pg_content" type="text" class="textInput latin required validateNumber" {if isset($workbook)}value="{$workbook->pg_content}"{/if}/>
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
                        	این کارنامه حذف شده است
		                {/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->