<div class="wrapper" >
	<div class="right _255 ">
    	{include file="tpl/sms/info.tpl"}
    	{include file="tpl/sms/menu.tpl"}
	</div>
	<div class="right _765 ">  	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">انتخاب شماره همراه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
				            <form method="post" action="sms/?interval=true" class="uniForm" >
				            <fieldset>
                            <div class="ctrlHolder">
                            <label for="base"><em>*</em>n رقم اول شماره‌ها</label>
                            <input name="base" id="base" type="text" class="textInput latin required validateInteger"/>
                            <p class="formHint">مثال: 0912552</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="from_no"><em>*</em>از شماره</label>
                            <input name="from_no" id="from_no" type="text" class="textInput small latin required validateInteger" />
                            <p class="formHint"></p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="to_no"><em>*</em>تا شماره</label>
                            <input name="to_no" id="to_no" type="text" class="textInput small latin required validateInteger" />
                            <p class="formHint"></p>
                            </div>
                     		</fieldset>
                     		
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">ادامه ...</button>
                            </div>
	                        <div class="clear"></div>
	                        <script>
	                          $(function(){
	                            $('form.uniForm').uniform({
	                              prevent_submit : true
	                            });
	                          });
	                        </script>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->
    </div>
<div class="clear"></div>
</div>
