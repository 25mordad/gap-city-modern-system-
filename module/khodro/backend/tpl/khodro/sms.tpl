<form method="post" action="khodro/sendsms" class="uniForm" >
<div class="wrapper" >
	<div class="right _255 ">
              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">ارسال پیام کوتاه</div>
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
	                    
						<div class="buttonHolder">
                            <button type="submit"  name="submit" class="primaryAction">ارسال پیام کوتاه</button>
                        </div>
                        <script>
                          $(function(){
                            $('form.uniForm').uniform({
                              prevent_submit : true
                            });
                          });
                        </script>
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
                        	<textarea name="sms_text" id="sms_text" class="large required"  onkeyup="updateLandM(this);" ></textarea>
                        	<p class="formHint" ></p>
                    	</div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->
              <!-- _LBOX_ -->
              <div class="l_box" >
                <div class="top">
                    <div class="title right">انتخاب شماره همراه</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
		               	{literal}
		                    <script type="text/javascript">
						      my_submit_callback = function(form) {
						        
						        // Are at least two selectd?
						        if ($('input.cell_selection:checked').length < 1) {
						          // show the error
						          $('#cell_select').addClass('error');
						          return false;
						        }
						        $('#cell_select').removeClass('error');
						        return true;
						      }
						
						      $(function(){
						        $('form.uniForm').uniform({
						            submit_callback : my_submit_callback
						        });
						      });
						      
						    </script>
						{/literal}
				                <div class="ctrlHolder" id="cell_select">
				                <h3>انتخاب شماره‌های آگهی‌های تاریخ {jdate(" l j F Y",strtotime($smarty.get.date))}</h3>
		                              <p class="formHint">حداقل باید یک تماس را انتخاب کنید</p>
		                        </div>  
			                        <div class="ctrlHolder">
			                        {if count($advers) eq 0}
			                        	<p class="label">هیچ شماره‌ای برای این تاریخ وجود ندارد.</p>
			                        {else}
			                        	<p class="label">شماره‌های آگهی‌ها</p>
			                              <ul>
			                              {foreach $advers as $adver}
								            {if $adver->cell neq ""}
								            <li><label for="{$adver->cell}"><input type="checkbox" value="{$adver->cell}" name="cell[]"  class="cell_selection" checked="checked" />{$adver->cell}</label></li>
								            {/if}
								          {/foreach}
			                              </ul>
			                        	<p class="formHint"></p>
			                        {/if}
			                        </div>
		            	<div class="clear"></div>
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