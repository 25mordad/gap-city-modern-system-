{if isset($get_param) }
	{$form_action = "jobinfo/addparam/{$group->id}?edit={$get_param->id}"}
    {$submit_txt = "ویرایش"}
{else if isset($get_param_addvalue)}
	{$form_action = "jobinfo/addparam/{$group->id}?addvalue={$get_param_addvalue->id}"}
    {$submit_txt = "اضافه کردن مقدار"}
{else}
    {$form_action = "jobinfo/addparam/{$group->id}"}
    {$submit_txt = "ثبت"}
{/if}
					<form action="{$form_action}" method="post" class="uniForm">
					<fieldset>
					{if isset($get_param_addvalue)}
							<div class="ctrlHolder">
							    <label for="fa_name"><em>*</em>مقدار به فارسی</label>
							    <input name="fa_name" id="fa_name" type="text" class="textInput required " />
							    <p class="formHint"></p>
							</div>
							<div class="ctrlHolder">
							    <label for="en_name"><em>*</em>مقدار به انگلیسی</label>
							    <input name="en_name" id="en_name" type="text" class="textInput latin required " />
							    <p class="formHint"></p>
							</div>
					{else}
							<div class="ctrlHolder">
							    <label for="fa_name"><em>*</em>نام پارامتر به فارسی</label>
							    <input name="fa_name" id="fa_name" type="text" class="textInput required " {if isset($get_param)}value="{$get_param->fa_name}"{/if} />
							    <p class="formHint"></p>
							</div>
							<div class="ctrlHolder">
							    <label for="en_name"><em>*</em>نام پارامتر به انگلیسی</label>
							    <input name="en_name" id="en_name" type="text" class="textInput latin required " {if isset($get_param)}value="{$get_param->en_name}"{/if} />
							    <p class="formHint"></p>
							</div>
                            
	                    	<div class="ctrlHolder">
	                              <p class="label"><em>*</em>نوع پارامتر</p>
	                              {$type_select = [['name'=>"متن",'value'=>"matn"],['name'=>"توضیحات",'value'=>"tozihat"],['name'=>"چک‌باکس",'value'=>"checkbox"],['name'=>"رادیو",'value'=>"radio"],['name'=>"انتخابی",'value'=>"entekhabi"]]} 
					                {radioTagGenerator info = $type_select radioName = "type" ul="true" class="required" default="{if isset($get_param)}{$get_param->type}{/if}"}
	                              <p class="formHint"></p>
	                    	</div>
                            
	                    	<div class="ctrlHolder">
	                              <p class="label"><em>*</em>وضعیت پارامتر</p>
	                              {$status_select = [['name'=>"فعال",'value'=>"active"],['name'=>"غیرفعال",'value'=>"pending"]]} 
					                {radioTagGenerator info = $status_select radioName = "status" ul="true" class="required" default="{if isset($get_param)}{$get_param->status}{/if}"}
	                              <p class="formHint"></p>
	                    	</div>
	                {/if}	 
					</fieldset>
					<div class="buttonHolder">
					    <button type="submit"  name="submit" class="primaryAction">{$submit_txt}</button>
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