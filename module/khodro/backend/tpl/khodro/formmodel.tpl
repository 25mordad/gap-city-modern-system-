{if isset($model)}
	{$form_action = "khodro/editmodel/{$model->id}?edit=true"}
	{$title = "ویرایش"}
	{$id_brand = $model->id_brand}
{else}
	{$form_action = "khodro/newmodel?new=true"}
	{$title = "تعریف "}
	{if isset($smarty.get.brand)}
		{$id_brand = $smarty.get.brand}
	{else}
		{$id_brand = ""}
	{/if}
	
{/if}
	
	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} مدل</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					<form method="post" action="{$form_action}" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
	                            <label for="model_name"><em>*</em>نام مدل</label>
	                            	<input name="model_name" id="model_name" type="text" class="textInput required " {if isset($model)}value="{$model->model_name}"{/if}/>
	                            <p class="formHint"></p>
                            </div>
	                        <div class="ctrlHolder">
	                        	<label for="id_brand"><em>*</em>انتخاب برند</label>
	                              <select name="id_brand" id="id_brand" class="selectInput required">
		                    		<option value="">-- @@Choose@@ --</option>
	                                {foreach $brands as $row}
	                                <option value="{$row->id}"  {if isset($model)}{if $row->id eq $model->id_brand }selected="selected"{/if}{/if} >{$row->name}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
                            
	                       <div class="ctrlHolder">
	                            <label for="min_year"><em>*</em>حداقل سال تولید</label>
	                            	<input name="min_year" id="min_year" type="text" class="textInput required " {if isset($model)}value="{$model->min_year}"{/if}/>
	                            <p class="formHint"></p>
                            </div>
                            <div class="ctrlHolder">
	                            <label for="max_year"><em>*</em>حداکثر سال تولید</label>
	                            	<input name="max_year" id="max_year" type="text" class="textInput required " {if isset($model)}value="{$model->max_year}"{/if}/>
	                            <p class="formHint"></p>
                            </div>
                            <div class="ctrlHolder">
	                            <label for="year_type"><em>*</em>میلادی | شمسی</label>
                                {$year_type = [ ['name'=>"شمسی",'value'=>"shamsi"] , ['name'=>"میلادی",'value'=>"miladi"] ]}
	                            <select name="year_type" id="year_type" class="selectInput required">
		                    		{selectTagGenerator info= $year_type default= {$model->year_type} }
	                              </select>	
	                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
	                            <label for="auto_gear"><em>*</em>قابلیت دنده اتوماتیک</label>
	                            {$auto_gear = [ ['name'=>"ندارد",'value'=>"false"] , ['name'=>"دارد",'value'=>"true"] ]}
	                            <select name="auto_gear" id="auto_gear" class="selectInput required">
		                    		{selectTagGenerator info= $auto_gear default= {$model->auto_gear} }
	                              </select>	
	                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
	                            <label for="two_some"><em>*</em>قابلیت دوگانه سوز</label>
	                            	<select name="two_some" id="two_some" class="selectInput required">
		                    		{selectTagGenerator info= $auto_gear default= {$model->two_some} }
	                              </select>
	                            <p class="formHint"></p>
                            </div>
                            
	                        <div class="ctrlHolder">
	                            <label for="min_fee"><em>*</em>حداقل قیمت</label>
	                            	<input name="min_fee" id="min_fee" type="text" class="textInput required " {if isset($model)}value="{$model->min_fee}"{/if}/>
	                            <p class="formHint">تومان</p>
                            </div>
                            <div class="ctrlHolder">
	                            <label for="max_fee"><em>*</em>حداکثر قیمت</label>
	                            	<input name="max_fee" id="max_fee" type="text" class="textInput required " {if isset($model)}value="{$model->max_fee}"{/if}/>
	                            <p class="formHint">تومان</p>
                            </div>
	                        
	                        <div class="ctrlHolder">
	                        	{$model_status = [['name'=>"در حال نمایش",'value'=>"active"], ['name'=>"عدم نمایش",'value'=>"pending"]]}
	                        	<label for="model_status"><em>*</em>وضعیت</label>
	                              <select name="model_status" id="model_status" class="selectInput required">
		                    		
		                    		{selectTagGenerator info= $model_status default= {$model->model_status} }
	                              </select>
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