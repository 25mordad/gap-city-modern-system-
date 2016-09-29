{if $action eq "new"}
	{$title = "ایجاد"}
	
{else}
	{$title = "ویرایش"}
{/if}
{if isset($box)}
	{$parent_id = $box->parent_id}
{else if isset($smarty.get.p)}
	{$parent_id = $smarty.get.p}
{else}
	{$parent_id = ""}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title} باکس</div>
                    <img src="{$loct}/images/icon/{$action}.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    
	                    <div class="ctrlHolder">
	                      <label for="class_name">نام کلاس و id</label>
	                      <input name="class_name" id="class_name" size="20"  type="text" class="latin textInput auto" {if isset($box)}value="{$box->class_name}"{/if}/>
	                      <p class="formHint"></p>
	                    </div>
	                    
                    	<div class="ctrlHolder">
                              <p class="label">
                                <em>*</em> وضعیت باکس
                              </p>
				                {$radios = [
				                ['name'=>"فعال"       , 'value' => "publish"],
				                ['name' => "غیر فعال" , 'value' => "pending"]
				                ]}
				                {radioTagGenerator info = $radios  radioName= "box_status" ul="true" class="required" default="{if isset($box)}{$box->box_status}{/if}"}
                              <p class="formHint"></p>
                    	</div>
                    	
                        <div class="ctrlHolder">
                              <label for="select">صفحه مادر</label>
                              <select name="parent_id" id="parent_id" class="selectInput r_size" >
                                <option value="0">نمایش در تمام صفحات</option>
                                <option  value="1" {if $parent_id eq "1"} selected="selected" {/if}>صفحه نخست</option>
                    			{selectTagGenerator info= $select_parent default= "{$parent_id}" }
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
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->