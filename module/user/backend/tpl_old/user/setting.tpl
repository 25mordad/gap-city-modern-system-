<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/user/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">تنظیمات اعضا</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
			        <form action="user/setting" method="post" class="uniForm">
						<fieldset>
				            <h3>انواع کاربران:</h3>
				                {foreach $GCMS_USER_LEVEL as $key => $val}
	                            <div class="ctrlHolder">
	                            <input type="text" name="{$key}" class="textInput" value="{$val}">
	                            </div>
				                {/foreach}
				            <h3>پارامترها:</h3>
				                {foreach $GCMS_USER_PARAM as $key => $val}
				                <div class="ctrlHolder">
				                <input type="text" name="{$key}" class="textInput" value="{$val}">
				                </div>
				                {/foreach}
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
                        <input type="hidden" name="submitForm" value="true">
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