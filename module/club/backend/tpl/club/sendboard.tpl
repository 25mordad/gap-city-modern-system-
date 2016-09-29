<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/club/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">ارسال پیام سراسری به تابلوی اعلانات گروه‌ها</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					<form action="club/sendboard" method="post" class="uniForm">
	                        <div class="ctrlHolder">
	                        	<textarea name="txt" id="txt" class="required" data-default-value="متن پیام" style="width:650px;"></textarea>
	                    	</div>
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">ارسال</button>
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