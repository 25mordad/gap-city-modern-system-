<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/operator/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">ویرایش کاربر {$operator->name}</div>
                    <img src="{$loct}/images/icon/edit.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $smarty.session.level > {$operator->op_level} || $smarty.session.userid eq {$operator->id}}
					<form action="operator/edit/{$operator->id}" method="post" class="uniForm">
					<fieldset>
                            <div class="ctrlHolder">
                            <label for="name"><em>*</em>نام</label>
                            <input name="name" id="name" type="text" class="textInput required" value="{$operator->name}" />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="email"><em>*</em>ایمیل</label>
                            <input name="email" id="email" type="text" class="textInput latin required validateEmail" value="{$operator->email}" />
                            <p class="formHint">آدرس ایمیل معتبر</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="username"><em>*</em>نام کاربری</label>
                            <input name="username" id="username" type="text" class="textInput latin required validateAlphaNum" value="{$operator->username}" />
                            <p class="formHint"></p>
                            </div>
		               
                            <div class="ctrlHolder">
                              <label for="status"><em>*</em>وضعیت کاربر</label>
                              {$active = [['name'=>"Active",'value'=>"true"],['name'=>"Deactive",'value'=>"false"]]}
                              {if $smarty.session.level >= 8}
                              <select name="status" id="status" class="selectInput required">
				                {selectTagGenerator info= $active default= {$operator->status} }
                              </select>
                              <p class="formHint">فعال | غیرفعال</p>
                              {else}
                              	  <select name="status" id="status" class="selectInput" disabled="disabled" >
			                    	{selectTagGenerator info= $active default= {$operator->status} }
	                              </select>
	                              <p class="formHint">اپراتور گرامی، شما برای ویرایش این بخش دسترسی ندارید</p>
	                          {/if}
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="level"><em>*</em>سطح دسترسی</label>
                              {$roles = [['name'=>"Manager",'value'=>"8"],['name'=>"Operator",'value'=>"6"]]}
                              {if $smarty.session.level >= 8}
                              	{if $operator->op_level eq 10}
                              	  <select name="level" id="level" class="selectInput" disabled="disabled" >
			                    	<option value="10">سوپرادمین</option>
	                              </select>
	                              <p class="formHint">شما مدیر اصلی هستید</p>
                              	{else}
	                              <select name="level" id="level" class="selectInput required">
			                    	{selectTagGenerator info=$roles default= {$operator->op_level} }
	                              </select>
	                              <p class="formHint">مدیر | اپراتور</p>
	                            {/if}
	                          {else}
                              	  <select name="level" id="level" class="selectInput" disabled="disabled" >
			                    	{selectTagGenerator info=$roles default= {$operator->op_level} }
	                              </select>
	                              <p class="formHint">اپراتور گرامی، شما برای ویرایش این بخش دسترسی ندارید</p>
	                          {/if}
                            </div>
                            
							<h3>تاریخ ایجاد کاربر: {jdate(" l j F Y",strtotime({$operator->date_created}))}</h3>

                            </fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="edit" class="primaryAction">@@Edit@@</button>
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
					کاربر گرامی، شما به این بخش دسترسی ندارید.
                    {/if}
				</div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->
	</div>
	<div class="clear"></div>    
</div>
