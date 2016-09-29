<form method="post" action="khodro/confirmsend" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
	{if $action eq "send"}
	{$title = "تایید نهایی ارسال"}
{else}
	{$title = "ارسال پیام کوتاه"}
{/if}
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">تایید نهایی ارسال</div>
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
	                    
	                    <div class="ctrlHolder">
	                      <label for="show_sms_messageLength">تعداد افراد گیرنده پیام</label>
	                      <p class="formHint">{count($smarty.post.cell)}</p>
	                    </div>
	                    
						<div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">تایید نهایی ارسال</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
                        <div class="clear"></div>
                        
	                        <a href="khodro"><div class="r_menu">
	                            <span>انصراف از ارسال</span>
	                            <img src="{$loct}/images/icon/pg_rm.png" />
	                        </div></a>
	                        <div class="clear"></div>
                    
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">اطلاعات حساب پیام کوتاه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
	                    <p>اعتبار شما: {$GCMS_SETTING['sms']['credit']} تومان</p>
	                    <p>شماره پیام کوتاه: {$GCMS_SETTING['sms']['number']}</p>
	                    <p>نوع پلن: {$GCMS_SETTING['sms']['plan']}</p>
	                    <p>هزینه ارسال پیام کوتاه:</p>
	                    <p style="margin-right:95px;">- فارسی: &nbsp;&nbsp;&nbsp;&nbsp;{$GCMS_SETTING['sms']['fa_fee']} تومان</p>
	                    <p style="margin-right:95px;">- انگلیسی: &nbsp;{$GCMS_SETTING['sms']['en_fee']} تومان</p>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
		{include file="tpl/khodro/menu.tpl"} 
	</div>
	<div class="right _765 ">
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">شماره‌های گیرنده پیام</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    	{$cells = ""}
			            {foreach $smarty.post.cell as $mob }
			            	{$mob}&nbsp;
			            	{$cells = "$mob $cells"} 
			            {/foreach}
			            <input type="hidden" name="cells" value="{$cells}" />
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->		
                          
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">متن پیام</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                    {literal}
                    	<script>
						// Sms Count
						function processEnter(input)
						{
						    var enterCount = 0;
						    for (var i = 0; i < input.length; i++)
						    {
						        if (input.charCodeAt(i) == 10)
						        {
						            enterCount ++;
						        }
						    }
						    return enterCount;
						}
						//Find language
						function isEnglishString(input)
						{
						    if (input == '')
						    {
						        return true;
						    }
						    
						    for (var i = 0; i < input.length; i++)
						    {
						        if (input.charCodeAt(i) > 127)
						        {   
						            document.getElementById('show_sms_language').innerHTML = "فارسی";
						            return false;
						        }
						    }
						    document.getElementById('show_sms_language').innerHTML = "انگلیسی";
						    return true;
						}
						// update
						function updateLandM(fieldObj)
						{
						    var messageContent = fieldObj.value;
						    var enterCount = processEnter(messageContent);
						    var browserName = navigator.appName;
						    var messageLength = fieldObj.value.length;
						    if (browserName != 'Netscape')
						    {
						        messageLength = messageLength - enterCount;
						    }
						 
						    var maxMessageCount = 10;
						    var maxEnglishLength = 160;
						    var maxPersianLength = 70;
						    var maxLongEnglishLength = 153;
						    var maxLongPersianLength = 67;
						
						    var isEnMessage = isEnglishString(messageContent);
						    var maxMessageLength = isEnMessage ? (maxMessageCount * maxLongEnglishLength) : (maxMessageCount * maxLongPersianLength);
						
						    var messageCount = 1;
						
						    if (isEnMessage && messageLength > maxEnglishLength)
						    {
						        messageCount = messageLength > maxMessageLength ?
						                       maxMessageCount : parseInt(messageLength % maxLongEnglishLength) == 0 ?
						                                         parseInt(messageLength / maxLongEnglishLength) :
						                                         parseInt(messageLength / maxLongEnglishLength) + 1;
						    }
						    
						    if (!isEnMessage && messageLength > maxPersianLength)
						    {
						        messageCount = messageLength > maxMessageLength ?
						                       maxMessageCount : parseInt(messageLength % maxLongPersianLength) == 0 ?
						                                         parseInt(messageLength / maxLongPersianLength) :
						                                         parseInt(messageLength / maxLongPersianLength) + 1;
						
						    }
						    
						    document.getElementById('show_sms_messageLength').innerHTML = messageLength;
						    document.getElementById('show_sms_messageCount').innerHTML = messageCount;
						
						}
						
						</script>
					{/literal}
                        <div class="ctrlHolder">
                        	<textarea name="sms_text" id="sms_text" class="large required"  readonly="readonly" onkeyup="updateLandM(this);" >{$smarty.post.sms_text}</textarea>
                        	<p class="formHint" ></p>
                    	</div>
					<script>$("#sms_text").trigger('keyup');</script>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->
	</div>
	<div class="clear"></div>
</div>
</form>