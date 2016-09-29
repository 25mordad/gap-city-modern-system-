<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/club/menu.tpl"}
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
					<form action="club/newuser" method="post" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="name"><em>*</em>نام و نام خانوادگی</label>
                            <input name="name" id="name" type="text" class="textInput required"/>
                            <p class="formHint"></p>
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
                            <label for="email">ایمیل</label>
                            <input name="email" id="email" type="text" class="textInput latin validateEmail"/>
                            <p class="formHint">آدرس ایمیل معتبر</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="cell">موبایل</label>
                            <input name="cell" id="cell" type="text" class="textInput latin validatePhone"/>
                            <p class="formHint">مثال: 09125521340</p>
                            </div>
                            
                            <div class="ctrlHolder">
                              <label for="user_level"><em>*</em>نوع عضو</label>
                              <select name="user_level" id="user_level" class="selectInput required">
		                    	<option value="" selected="selected">-- @@Choose@@ --</option>
		                    	<option value="original">اصلی</option>
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
