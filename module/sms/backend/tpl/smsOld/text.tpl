            
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
                        	<textarea name="sms_text" id="sms_text" class="large required"  {if $action eq send}readonly="readonly"{/if} onkeyup="updateLandM(this);" >{if $action eq send}{$smarty.post.sms_text}{/if}</textarea>
                        	<p class="formHint" ></p>
                    	</div>
					{if $action eq send}
					<script>$("#sms_text").trigger('keyup');</script>
					{/if}
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _LBOX_ -->