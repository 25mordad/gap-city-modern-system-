{if isset($class)}
	{$form_action = "adv_wb/editclass/{$class->id}"}
	{$title = "ویرایش"}
	{$id_branch = $class->id_branch}
	{$id_grade = $class->id_grade}
{else}
	{$form_action = "adv_wb/newclass"}
	{$title = "ایجاد"}
	{if isset($smarty.get.branch)}
		{$id_branch = $smarty.get.branch}
	{else}
		{$id_branch = ""}
	{/if}
	{if isset($smarty.get.grade)}
		{$id_grade = $smarty.get.grade}
	{else}
		{$id_grade = ""}
	{/if}
{/if}
	
	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} کلاس</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					<form method="post" action="{$form_action}" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
	                            <label for="name"><em>*</em>نام</label>
	                            	<input name="name" id="name" type="text" class="textInput required " {if isset($class)}value="{$class->name}"{/if}/>
	                            <p class="formHint"></p>
                            </div>
	                        <div class="ctrlHolder">
	                        	<label for="id_branch"><em>*</em>شعبه</label>
	                              <select name="id_branch" id="id_branch" class="selectInput required">
		                    		<option value="">-- @@Choose@@ --</option>
	                                {foreach $branches as $key => $val}
	                                <option value="{$key}" {if $id_branch eq $key }selected="selected"{/if} >{$val}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
	                        <div class="ctrlHolder">
	                        	<label for="id_grade"><em>*</em>پایه</label>
	                              <select name="id_grade" id="id_grade" class="selectInput required">
		                    		<option value="">-- @@Choose@@ --</option>
	                                {foreach $grades as $key => $val}
	                                <option value="{$key}" {if $id_grade eq $key }selected="selected"{/if} >{$val}</option>
	                                {/foreach}
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
	                        <div class="ctrlHolder">
	                        	{$ages_select = [['name'=>"خردسال",'value'=>"khord"], ['name'=>"کودک",'value'=>"koodak"],
												['name'=>"ابتدایی",'value'=>"ebteda"], ['name'=>"راهنمایی",'value'=>"rahnama"],
												['name'=>"دبیرستان",'value'=>"dabires"], ['name'=>"پیش‌دانشگاهی",'value'=>"pishdanesh"],
												['name'=>"بزرگسال",'value'=>"bozorg"]]}
	                        	<label for="ages"><em>*</em>رده سنی</label>
	                              <select name="ages" id="ages" class="selectInput required">
		                    		<option value="">-- @@Choose@@ --</option>
		                    		{selectTagGenerator info= $ages_select default= {$class->ages} }
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
	                        <div class="ctrlHolder">
	                        	<label for="capacity"><em>*</em>ظرفیت</label>
	                              <select name="capacity" id="capacity" class="selectInput required">
		                    		<option value="">-- @@Choose@@ --</option>
		                    		{selectTagGenerator info= $select_capacity default= {$class->capacity} }
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
	                        <div class="ctrlHolder">
	                        	{$gender_select = [['name'=>"زن",'value'=>"female"], ['name'=>"مرد",'value'=>"male"], ['name'=>"مختلط",'value'=>"coed"]]}
	                        	<label for="sex"><em>*</em>جنسیت کلاس</label>
	                              <select name="sex" id="sex" class="selectInput required">
		                    		<option value="">-- @@Choose@@ --</option>
		                    		{selectTagGenerator info= $gender_select default= {$class->sex} }
	                              </select>
	                              <p class="formHint"></p>
	                        </div>
                            <div class="ctrlHolder">
	                            <label for="tuition">شهریه</label>
	                            	<input name="tuition" id="tuition" type="text" class="textInput latin validateInteger" {if isset($class)}value="{$class->tuition}"{/if} />
	                            <p class="formHint">به ریال</p>
                            </div>
                            <div class="ctrlHolder">
	                            <label for="text">توضیحات</label>
	                            	<textarea name="text" id="text" >{if isset($class)}{$class->text}{/if}</textarea>
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