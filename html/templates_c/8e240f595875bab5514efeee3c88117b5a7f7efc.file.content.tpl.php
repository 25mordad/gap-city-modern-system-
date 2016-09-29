<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 20:07:18
         compiled from "/var/www/gcms.dev/public_html/core/module/sms/backend/tpl/sms/index/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162026600057cee2ae8f6d31-71358341%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e240f595875bab5514efeee3c88117b5a7f7efc' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/sms/backend/tpl/sms/index/content.tpl',
      1 => 1447715360,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162026600057cee2ae8f6d31-71358341',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/info.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
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

            <?php if (isset($_GET['single'])&&$_GET['single']=="true"){?>
                <div class="form-group  col-md-12">
                    <label>
                        شماره تماس
                    </label>
                    <input name="cells[]" id="cells" type="text"  required
                           class="form-control"
                           <?php if (isset($_GET['cell'])){?>value="<?php echo $_GET['cell'];?>
"<?php }?>/>
                    <p class="help-block">
                        مثال: 09125521340
                    </p>
                </div>
            <?php }else{ ?>
                <div class="form-group  col-md-12">

                    <div class="row" style=" background: #cccccb;padding-top: 5px;direction: rtl" >
                        <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('groups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
?>

                            <div class="col-md-3" style="height: 200px; overflow: auto;" >
                                <a href="contact/grouping/?edit=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
">گروه تماس <?php echo $_smarty_tpl->getVariable('group')->value->name;?>
</a></b></p>
                                <small><i class="fa fa-check-square-o"></i>
                                    <a href="javascript:insert_param('group_<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
','true')" >انتخاب همه تماس‌های گروه</a></small>

                                    <?php  $_smarty_tpl->tpl_vars['contact'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('contacts')->value[$_smarty_tpl->getVariable('group')->value->id]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['contact']->key => $_smarty_tpl->tpl_vars['contact']->value){
?>
                                        <?php if (isset($_GET[("group_").($_smarty_tpl->getVariable('group',null,true,false)->value->id)])&&$_GET[("group_").($_smarty_tpl->getVariable('group')->value->id)]=="true"){?>
                                            <?php $_smarty_tpl->tpl_vars['checked'] = new Smarty_variable(true, null, null);?>
                                        <?php }else{ ?>
                                            <?php $_smarty_tpl->tpl_vars['checked'] = new Smarty_variable(false, null, null);?>
                                        <?php }?>
                                        <br>

                                            <input type="checkbox" name="cells[]"
                                                   id="contact_<?php echo $_smarty_tpl->getVariable('contact')->value->id;?>
"
                                                   value="<?php echo $_smarty_tpl->getVariable('contact')->value->cell;?>
"  <?php if ($_smarty_tpl->getVariable('checked')->value){?>checked="checked"<?php }?> />
                                        <label for="contact_<?php echo $_smarty_tpl->getVariable('contact')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('contact')->value->name;?>
-<?php echo $_smarty_tpl->getVariable('contact')->value->cell;?>
</label>
                                        <script>
                                            $(document).ready(function() {

                                                $('#contact_<?php echo $_smarty_tpl->getVariable('contact')->value->id;?>
').bootstrapSwitch('destroy')
                                            });
                                        </script>
                                    <?php }} ?>


                            </div>

                        <?php }} ?>
                    </div>
                </div>
            <?php }?>


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
