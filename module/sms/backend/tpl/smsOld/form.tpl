{if $action eq "send"}
	{$title = "تایید نهایی ارسال"}
{else}
	{$title = "ارسال پیام کوتاه"}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">{$title}</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    
	                    <div class="ctrlHolder">
	                      <label for="show_sms_messageLength">زبان پیام</label>
	                      <p class="formHint" id="show_sms_language">فارسی</p>
	                    </div>
	                    
	                    <div class="ctrlHolder">
	                      <label for="show_sms_messageLength">تعداد کاراکترهای متن پیام</label>
	                      <p class="formHint" id="show_sms_messageLength">0</p>
	                    </div>
	                    
	                    <div class="ctrlHolder">
	                      <label for="show_sms_messageLength">تعداد پیام کوتاه برای ارسال متن</label>
	                      <p class="formHint" id="show_sms_messageCount">0</p>
	                    </div>
	                    
	                    {if $action eq send}
	                    <div class="ctrlHolder">
	                      <label for="show_sms_messageLength">تعداد افراد گیرنده پیام</label>
	                      <p class="formHint">{count($smarty.post.cell)}</p>
	                    </div>
	                    {/if}
	                    
						<div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">{$title}</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                        
	                    {if $action eq send}
	                        <a href="sms"><div class="r_menu">
	                            <span>انصراف از ارسال</span>
	                            <img src="{$loct}/images/icon/pg_rm.png" />
	                        </div></a>
	                        <div class="clear"></div>
	                    {/if}
                    
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->