<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/pay_mellat/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">تنظیمات پرداخت</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    <script>
            		function show_pass()
					{ 
            			$('#password').get(0).type = 'text';
            		}
                    </script>
			        <form action="pay_mellat/setting" method="post" class="uniForm">
						<fieldset>
						
                        <div class="ctrlHolder">
                            <label for="terminal_id">آی‌دی ترمینال</label>
                            <input name="terminal_id" id="terminal_id" type="text" class="textInput latin" value="{$GCMS_SETTING['pay_mellat']['terminal_id']}" />
                            <p class="formHint"></p>
                        </div>
                        <div class="ctrlHolder">
                            <label for="username">نام کاربری</label>
                            <input name="username" id="username" type="text" class="textInput latin" value="{$GCMS_SETTING['pay_mellat']['username']}" />
                            <p class="formHint"></p>
                        </div>
                        <div class="ctrlHolder">
                            <label for="password">کلمه عبور</label>
                            <input name="password" id="password" type="password" class="textInput latin" value="{$GCMS_SETTING['pay_mellat']['password']}" />
                            <p class="formHint"><a href="javascript:show_pass()">نمایش متن کلمه عبور</a></p>
                        </div>
                        <div class="ctrlHolder">
                            <label for="site_url">آدرس برگشت</label>
                            <input name="site_url" id="site_url" type="text" class="textInput latin" value="{$GCMS_SETTING['pay_mellat']['site_url']}" />
                            <p class="formHint">مثال:‌ http://www.gatriya.com</p>
                        </div>
                        
                     	</fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">@@Edit@@</button>
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