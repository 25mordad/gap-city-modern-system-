<div class="wrapper" >
    <div class="right _255 ">
        {include file="tpl/sarfejo_dailyfee/formstuff.tpl"}
        {include file="tpl/sarfejo_dailyfee/menu.tpl"}
    </div>
    <div class="right _765 ">
        <!-- _LBOX_ -->
        <div class="l_box" >
            <div class="top">
                <div class="title right">لیست کالاها</div>
                <img src="/core/module/sarfejo_dailyfee/backend/images/stuff.png" />
                <div class="clear"></div>
            </div>
            <div class="mid">
                <div class="txt">
                    <script src="{$loct}/js/jquery-ui-1.7.2.custom.min.js"></script>
                    <link rel="stylesheet" href="{$loct}/css/jq/jquery.ui.all.css" />
                    <script src="{$loct}/js/jquery.easy-confirm-dialog.js"></script>
                    {literal}
                        <script>
                            $(function() {
                                $(".confirm_dialog").easyconfirm({locale: $.easyconfirm.locales.faIR});
                            });
                        </script>
                    {/literal}

                    <style>
                        .edit { background: url({$loct}/images/icon/edit.png)  }

                    </style>

                    <div class="list" id="tooltip">
                        <div class="top">
                            <span style="width: 480px;">نام کالا</span>
                            <span style="width: 50px;">ویرایش</span>
                            <div class="clear"></div>
                        </div>
                        {foreach $stuffs as $stuff}
                            <div class="row_1">
                                <span style="width: 480px;" class="BYekan" title="{$stuff->name}">
                                    {$stuff->name}</span>
                                <span style="width: 50px;"><a href="sarfejo_dailyfee/stuffs?edit={$stuff->id}"><div class="icon edit" ></div></a></span>

                                <div class="clear"></div>
                            </div>
                        {/foreach}
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
