{if isset($tip)}
	{$form_action = "khodro/edittip/{$tip->id}?brand={$smarty.get.brand}&edit=true"}
	{$title = "ویرایش"}
	{$id_brand = $tip->id_brand}
    {$selectchang = "khodro/edittip/{$tip->id}?brand="}
{else}
	{$form_action = "khodro/newtip?new=true"}
	{$title = "تعریف "}
    {$selectchang = "khodro/newtip?brand="}
	{if isset($smarty.get.brand)}
		{$id_brand = $smarty.get.brand}
	{else}
		{$id_brand = ""}
	{/if}
	
{/if}
	
	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} تیپ</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					<form method="post" action="{$form_action}" class="uniForm">
					<fieldset>
                            
                            
	                        <div class="ctrlHolder">
	                        	<label for="id_brand_onchange"><em>*</em>انتخاب برند</label>
	                              <select name="id_brand_onchange" id="id_brand_onchange" class="selectInput required" onchange="if (this.value) window.location.href=this.value">
		                    		<option value="">-- @@Choose@@ --</option>
	                                {foreach $brands as $row}
	                                <option value="{$selectchang}{$row->id}"  {if isset($tip)}{if $row->id eq $tip->id_brand }selected="selected"{/if}{/if} {if isset($smarty.get.brand) and $smarty.get.brand eq $row->id}selected="selected"{/if} >{$row->name}</option>
	                                {/foreach}
	                              </select>
                                  <input type="hidden" name="id_brand" value="{$smarty.get.brand}" />
	                              <p class="formHint"></p>
	                        </div>
                            
	                        <div class="ctrlHolder">
	                        	<label for="id_brand_onchange"><em>*</em>انتخاب مدل</label>
	                              <select name="id_model" id="id_model" class="selectInput required" >
	                                {foreach $models as $row}
	                                <option value="{$row->id}" {if isset($tip) and $tip->id_model eq $row->id}selected="selected"{/if}   >{$row->model_name} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &laquo; سال تولید از {$row->min_year} تا {$row->max_year}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
                            
	                       <div class="ctrlHolder">
	                            <label for="tip_name"><em>*</em>نام تیپ</label>
	                            	<input name="tip_name" id="tip_name" type="text" class="textInput required " {if isset($tip)}value="{$tip->tip_name}"{/if}/>
	                            <p class="formHint"></p>
                            </div>
                             
                            <div class="ctrlHolder">
	                            <label for="tip_form"><em>*</em>مشخصات ظاهری</label>
	                            {$tip_form = [ 
                                ['name'=>"سدان",'value'=>"sedan"] , 
                                ['name'=>"هاچ بک",'value'=>"hatchback"],
                                ['name'=>"شاسی بلند",'value'=>"suv"],
                                ['name'=>"وانت",'value'=>"pickup"],
                                ['name'=>"کوپه",'value'=>"coupe"],
                                ['name'=>"کروک",'value'=>"convertible"],
                                ['name'=>"ون",'value'=>"van"],
                                ['name'=>"استیشن",'value'=>"wagon"]
                                ]}
	                            <select name="tip_form" id="tip_form" class="selectInput required">
		                    		{selectTagGenerator info= $tip_form default= {$tip->tip_form} }
	                              </select>	
	                            <p class="formHint"></p>
                            </div>

                          
	                        
	                        <div class="ctrlHolder">
	                        	{$tip_status = [['name'=>"در حال نمایش",'value'=>"active"], ['name'=>"عدم نمایش",'value'=>"pending"]]}
	                        	<label for="tip_status"><em>*</em>وضعیت</label>
	                              <select name="tip_status" id="tip_status" class="selectInput required">
		                    		
		                    		{selectTagGenerator info= $tip_status default= {$tip->tip_status} }
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