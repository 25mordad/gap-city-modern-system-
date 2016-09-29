<div class="wrapper" >
    <div class="right _255 ">
        {include file="tpl/shop_factor/menu.tpl"}
    </div>
    <div class="right _765 ">
        <!-- _LBOX_ -->
        <div class="l_box" >
            <div class="top">
                <div class="title right"> نمایش فاکتور
                    Shplus#{$factor->id*1234+567}</div>
                <img src="{$loct}/images/icon/page.png" />
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

                                $( "#dialog-form" ).dialog({
                                    autoOpen: false,
                                    height: 200,
                                    width: 220,
                                    modal: true
                                });
                            });
                        </script>
                    {/literal}
                    <span style="float: right">
                        <a href="/shop_factor/aprint/{$factor->id}?print=true" target="_blank" >
                            پرینت فاکتور
                        </a> | {$factor->status_pay} |
            {$factor->name}
        </span>
        <span style="float: left">
            {jdate("j F y",strtotime($factor->date))}
        </span>
                    <div class="clear" ></div>
                    {get_factor_row id_shop_factor=$factor->id}
                    <div class="list" id="tooltip">
                        <div class="top">
                            <span style="width: 150px;">نام</span>
                            <span style="width: 150px;">تعداد</span>
                            <span style="width: 150px;">مبلغ</span>
                            <div class="clear"></div>
                        </div>

                        {foreach $getfactorrow as $row}
                            <div class="row_1">
                                <span style="width: 150px;" >{$row->name}</span>
                                <span style="width: 150px;" >{$row->number}</span>
                                <span style="width: 150px;" >{$row->fee}</span>
                                <span style="width: 150px;" >
                                </span>
                                <div class="clear"></div>
                            </div>
                        {/foreach}
                    </div>
                    <div class="clear"></div>
                    {$factor->address} <br>
                    کد پستی :
                    {$factor->zipcode}
                    <br>
                    {$factor->text}
                </div>
            </div>
            <div class="dwn"></div>
        </div>
        <div class="clear"></div>
        <!-- _LBOX_ -->
    </div>
    <div class="clear"></div>
</div>