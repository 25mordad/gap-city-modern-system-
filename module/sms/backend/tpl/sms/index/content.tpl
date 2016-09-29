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
            {else}
                <div class="form-group  col-md-12">

                    <div class="row" style=" background: #cccccb;padding-top: 5px;direction: rtl" >
                        {foreach $groups as $group}

                            <div class="col-md-3" style="height: 200px; overflow: auto;" >
                                <a href="contact/grouping/?edit={$group->id}">گروه تماس {$group->name}</a></b></p>
                                <small><i class="fa fa-check-square-o"></i>
                                    <a href="javascript:insert_param('group_{$group->id}','true')" >انتخاب همه تماس‌های گروه</a></small>

                                    {foreach $contacts[$group->id] as $contact}
                                        {if isset($smarty.get.{"group_"|cat:$group->id}) && $smarty.get.{"group_"|cat:$group->id} eq "true"}
                                            {$checked = true}
                                        {else}
                                            {$checked = false}
                                        {/if}
                                        <br>

                                            <input type="checkbox" name="cells[]"
                                                   id="contact_{$contact->id}"
                                                   value="{$contact->cell}"  {if $checked}checked="checked"{/if} />
                                        <label for="contact_{$contact->id}">{$contact->name}-{$contact->cell}</label>
                                        <script>
                                            $(document).ready(function() {

                                                $('#contact_{$contact->id}').bootstrapSwitch('destroy')
                                            });
                                        </script>
                                    {/foreach}


                            </div>

                        {/foreach}
                    </div>
                </div>
            {/if}


            <button class="btn btn-success btn-block btn-flat" type="button" id="SubBtt">
    ارسال
            </button>
        </div>

            <script>
                $(document).ready(function() {
                    $(window).keydown(function(event){
                        if(event.keyCode == 13) {
                            event.preventDefault();
                            return false;
                        }
                    });
                });

                $(document).on("click", "#SubBtt", function(e) {
                    bootbox.dialog ({
                        message: "ارسال پیامک را تایید می کنید؟",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-primary",
                                callback: function() {
                                    $( "#smsForm" ).submit();
                                }
                            },
                            main: {
                                label: "انصراف",
                                className: "btn-danger"
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
{literal}
    <script type="text/javascript">
        function insert_param(key, value) {
            key = escape(key); value = escape(value);

            var kvp = document.location.search.substr(1).split('&');
            if (kvp == '') {
                document.location.search = '?' + key + '=' + value;
            }
            else {

                var i = kvp.length; var x; while (i--) {
                    x = kvp[i].split('=');

                    if (x[0] == key) {
                        x[1] = value;
                        kvp[i] = x.join('=');
                        break;
                    }
                }

                if (i < 0) { kvp[kvp.length] = [key, value].join('='); }

                //this will reload the page, it's likely better to store this until finished
                document.location.search = kvp.join('&');
            }
        }
    </script>
{/literal}