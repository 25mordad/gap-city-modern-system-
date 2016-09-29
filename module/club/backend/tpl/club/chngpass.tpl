<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/club/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">تغییر کلمه عبور {$user->username}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $user->status neq "delete"}
					<form action="club/chngpass/{$user->id}" method="post" class="uniForm">
							<fieldset>
					
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