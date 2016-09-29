<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/user/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">ایجاد عضو جدید</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					<form action="user/new" method="post" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="username"><em>*</em>نام کاربری</label>
                            <input name="username" id="username" type="text" class="textInput latin required validateAlphaNum"/>
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="email"><em>*</em>ایمیل</label>
                            <input name="email" id="email" type="text" class="textInput latin required validateEmail"/>
                            <p class="formHint">آدرس ایمیل معتبر</p>
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
                              <label for="status"><em>*</em>@@UserStatus@@</label>
                              <select name="status" id="status" class="selectInput required">
				                <option value="" selected="selected">-- @@Choose@@ --</option>
				                <option value="active">@@Active@@</option>
				                <option value="pending">@@Deactive@@</option>
                              </select>
                              <p class="formHint">فعال | غیرفعال</p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="user_level"><em>*</em>نوع عضو</label>
                              <select name="user_level" id="user_level" class="selectInput required">
		                    	<option value="" selected="selected">-- @@Choose@@ --</option>
								{foreach $GCMS_USER_LEVEL as $key=>$val }
								<option value="{$key}">{$val}</option>
								{/foreach}
                              </select>
                              <p class="formHint"></p>
                            </div>

                            </fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">ثبت</button>
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
	</div>
	<div class="clear"></div>    
</div>
