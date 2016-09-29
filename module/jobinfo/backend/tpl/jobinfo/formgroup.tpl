{if $action eq "newgroup"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} گروه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					<form action="jobinfo/{$action}{if isset($group)}/{$group->id}{/if}" method="post" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="name"><em>*</em>نام گروه</label>
                            <input name="name" id="name" type="text" class="textInput required " {if isset($group)}value="{$group->name}"{/if}/>
                            <p class="formHint"></p>
                            </div>
                            
	                    	<div class="ctrlHolder">
	                              <p class="label">نوع گروه</p>
	                              {$type_select = [['name'=>"خدمات",'value'=>"khadamat"],['name'=>"کالا",'value'=>"kala"]]} 
					                {radioTagGenerator info = $type_select radioName = "type" ul="true" default="{if isset($group)}{$group->type}{/if}"}
	                              <p class="formHint"></p>
	                    	</div>
                           
	                        <div class="ctrlHolder">
	                        	<label for="parent">گروه مادر</label>
	                              <select name="parent" id="parent" class="selectInput" >
	                                <option value="0" selected="selected">--بدون گروه مادر--</option>
	                                {foreach $groups as $g}
	                                {if !isset($group) or $group->id neq $g->id}
	                                <option value="{$g->id}" {if isset($group) && $group->parent eq $g->id }selected="selected"{/if} >{$g->name}</option>
	                                {/if}
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
                            
	                    	<div class="ctrlHolder">
	                              <p class="label">وضعیت گروه</p>
	                              {$status_select = [['name'=>"فعال",'value'=>"active"],['name'=>"به‌زودی",'value'=>"soon"],['name'=>"غیرفعال",'value'=>"pending"]]} 
					                {radioTagGenerator info = $status_select radioName = "status" ul="true" default="{if isset($group)}{$group->status}{/if}"}
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
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->