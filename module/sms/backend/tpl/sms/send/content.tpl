{include file="tpl/$part/info.tpl"}
    <div class="row">
        <form method="post" action="/gadmin/sms/send" id="smsForm" >
        <div class="col-md-12 col-xs-12">

            <div class="form-group  col-md-12">
                <label>
    متن پیام
                </label>
                <textarea name="sms_text" id="sms_text" required class="form-control" onkeyup="updateLandM(this);" ></textarea>
            </div>


           <div class="form-group  col-md-4">
               <label >زبان پیام</label>
               <p class="formHint" id="show_sms_language">فارسی</p>
           </div>


           <div class="form-group  col-md-4">
               <label for="show_sms_messageLength">تعداد کاراکترهای متن پیام</label>
               <p class="formHint" id="show_sms_messageLength">0</p>
           </div>


           <div class="form-group  col-md-4">
               <label for="show_sms_messageLength">تعداد پیام کوتاه برای ارسال متن</label>
               <p class="formHint" id="show_sms_messageCount">0</p>
           </div>

            {if isset($smarty.get.single) and $smarty.get.single eq "true" }
                <div class="form-group  col-md-12">
                    <label>
                        شماره تماس
                    </label>
                    <input name="cells[]" id="cells" type="text"  required
                           class="form-control"
                           {if isset($smarty.get.cell)}value="{$smarty.get.cell}"{/if}/>
                    <p class="help-block">
                        مثال: 09125521340
                    </p>
                </div>
            {/if}


            <button class="btn btn-success btn-block btn-flat" type="button" id="SubBtt">
    ارسال
            </button>
        </div>
            <script>
                $(document).on("click", "#SubBtt", function(e) {
                    bootbox.dialog ({
                        message: "ارسال پیامک را تایید می کنید؟",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-danger",
                                callback: function() {
                                    $( "#smsForm" ).submit();
                                }
                            },
                            main: {
                                label: "انصراف",
                                className: "btn-primary"
                            }
                        }
                    })
                });
            </script>
            <script>
                $(document).ready(function() {

                });
            </script>
            <script>$("#sms_text").trigger('keyup');</script>
        </form>
    </div>

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
