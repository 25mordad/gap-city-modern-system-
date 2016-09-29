{if $action eq "new"}
	{$title = "ایجاد"}
{else}
	{$title = "ویرایش"}
{/if}
	
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">{$title} مسیر</div>
                    <img src="{$loct}/images/icon/{$action}.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
					<form action="routing/{$action}{if isset($rout)}/{$rout->id}{/if}" method="post" class="uniForm">
					<fieldset>
                            
                            <div class="ctrlHolder">
                            <label for="module"><em>*</em>ماژول</label>
                            <input name="module" id="module" type="text" class="textInput latin required "{if isset($rout)}value="{$rout->module}"{/if}/>
                            <p class="formHint"></p>
                            </div>
					
					        <div class="ctrlHolder">
                            <label for="action"><em>*</em>اکشن</label>
                            <input name="action" id="action" type="text" class="textInput latin required "{if isset($rout)}value="{$rout->action}"{/if}/>
                            <p class="formHint">برای انتخاب ایندکس index را درج کنید</p>
                            </div>
					
					        <div class="ctrlHolder">
                            <label for="action_id"><em>*</em>آی‌دی اکشن</label>
                            <input name="action_id" id="action_id" type="text" class="textInput latin required validateInteger"{if isset($rout)}value="{$rout->action_id}"{/if}/>
                            <p class="formHint">اگر اکشن آی‌دی نمی‌گیرد 0 بگذارید</p>
                            </div>
                            
                            <div class="ctrlHolder">
                            <label for="url"><em>*</em>آدرس</label>
                            <input name="url" id="url" type="text" class="textInput latin required "{if isset($rout)}value="{$rout->url}"{/if}/>
                            <p class="formHint">آدرس نسبی که باید ماژول و اکشن مربوطه به آن نگاشت شود<br>مثال: register/</p>
                            </div>
                            
                            </fieldset>
                            <div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">{$title}</button>
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