<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/user/menu.tpl"}
		{include file="tpl/user/info.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">ویرایش عضو {$user->username}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $user->status neq "delete"}
						<form action="user/edit/{$user->id}" method="post" class="uniForm">
						<fieldset>
                    	{if isset($smarty.get.edit_params) and $smarty.get.edit_params eq "true"}
                    		<input type="hidden" name="edit_params" id="edit_params" value="true" />
                    		{foreach $user_params as $user_param}
		                    <div class="ctrlHolder">
		                      <label for="meta_{$user_param['id']}">{$user_param['label']}</label>
		                      <input name="meta_{$user_param['id']}" id="meta_{$user_param['id']}" size="20"  type="text" class="textInput" value="{$user_param['value']}"/>
		                      <p class="formHint"></p>
		                    </div>
		                	{/foreach}
		                	<h3><a href="user/edit/{$user->id}">بازگشت به ویرایش عضو</a></h3>
                    	{else}
                            <div class="ctrlHolder">
                            <label for="username"><em>*</em>نام کاربری</label>
                            <input name="username" id="username" type="text" class="textInput latin disabled" value="{$user->username}" readonly="readonly" />
                            <p class="formHint">غیرقابل ویرایش</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="email"><em>*</em>ایمیل</label>
                            <input name="email" id="email" type="text" class="textInput latin required validateEmail" value="{$user->email}" />
                            <p class="formHint">آدرس ایمیل معتبر</p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="status"><em>*</em>وضعیت عضو</label>
                              {$status_select = [['name'=>"Active",'value'=>"active"],['name'=>"Deactive",'value'=>"pending"]]}
                              <select name="status" id="status" class="selectInput required">
				                <option value="" selected="selected">-- @@Choose@@ --</option>
				                {selectTagGenerator info= $status_select default= {$user->status} }
                              </select>
                              <p class="formHint">فعال | غیرفعال</p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="user_level"><em>*</em>نوع عضو</label>
                              <select name="user_level" id="user_level" class="selectInput required">
		                    	<option value="">-- @@Choose@@ --</option>
								{foreach $GCMS_USER_LEVEL as $key=>$val }
								<option value="{$key}" {if $user->user_level eq $key}selected="selected"{/if} >{$val}</option>
								{/foreach}
                              </select>
                              <p class="formHint"></p>
                            </div>
                            
							<h3>تاریخ ایجاد عضو: {jdate(" l j F Y",strtotime({$user->date_created}))}</h3>
							<h3><a href="user/edit/{$user->id}/?edit_params=true">ویرایش پارامترهای عضو</a></h3>
		            	{/if}
	                    </fieldset>
	                    <div class="buttonHolder">
	                    	<button type="submit"  name="submit" class="primaryAction">@@Edit@@</button>
	                    </div>
	                    <div class="clear"></div>
	                    {literal}
	                    <script>
	                    $(function(){
	                    	$('form.uniForm').uniform({
	                    		prevent_submit : true
	                    	});
	                    });
	                    </script>
	                    {/literal}
	                    </form>
					{else}
						این عضو حذف شده است.
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