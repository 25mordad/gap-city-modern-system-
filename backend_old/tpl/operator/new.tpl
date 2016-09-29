<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/operator/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">ایجاد کاربر جدید</div>
                    <img src="{$loct}/images/icon/new.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $smarty.session.level >= 8}
					<form action="operator/new" method="post" class="uniForm">
					<fieldset>
                            <div class="ctrlHolder">
                            <label for="name"><em>*</em>نام</label>
                            <input name="name" id="name" type="text" class="textInput required" />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="email"><em>*</em>ایمیل</label>
                            <input name="email" id="email" type="text" class="textInput latin required validateEmail"/>
                            <p class="formHint">آدرس ایمیل معتبر</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="username"><em>*</em>نام کاربری</label>
                            <input name="username" id="username" type="text" class="textInput latin required validateAlphaNum"/>
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="password"><em>*</em>کلمه عبور</label>
                            <input type="password" name="password" id="password" class="textInput latin required" />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="confirm_password"><em>*</em>تایید کلمه عبور</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="textInput latin required validateSameAs password" />
                            <p class="formHint">کلمه عبور را دوباره وارد کنید</p>
                            </div>
		               
                            <div class="ctrlHolder">
                              <label for="status"><em>*</em>وضعیت کاربر</label>
                              <select name="status" id="status" class="selectInput required">
				                <option value="" selected="selected">-- @@Choose@@ --</option>
				                <option value="true">@@Active@@</option>
				                <option value="false">@@Deactive@@</option>
                              </select>
                              <p class="formHint">فعال | غیرفعال</p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="level"><em>*</em>سطح دسترسی</label>
                              <select name="level" id="level" class="selectInput required">
		                    	<option value="" selected="selected">-- @@Choose@@ --</option>
								<option value="8">@@Manager@@</option>
								<option value="6">@@Operator@@</option>
                              </select>
                              <p class="formHint">مدیر | اپراتور</p>
                            </div>

                            </fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="new" class="primaryAction">ثبت</button>
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
					اپراتور گرامی، شما به این بخش دسترسی ندارید.
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
