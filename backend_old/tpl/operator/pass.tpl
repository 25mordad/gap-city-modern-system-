<div class="wrapper" >
	<div class="right _255 ">
		{include file="tpl/operator/menu.tpl"}
	</div>    
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">تغییر کلمه عبور کاربر {$operator->name}</div>
                    <img src="{$loct}/images/icon/changpass.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {if $smarty.session.level > {$operator->op_level} || $smarty.session.userid eq {$operator->id}}
					<form action="operator/pass/{$operator->id}" method="post" class="uniForm">
						<fieldset>
                            <h3>تغییر کلمه عبور کاربر {$operator->username}</h3>
                            
                            <div class="ctrlHolder">
                            <label for="password"><em>*</em>کلمه عبور جدید</label>
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
