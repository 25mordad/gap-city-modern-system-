<div class="wrapper" >
    <div class="right _255 ">
        {include file="tpl/shop_factor/menu.tpl"}
    </div>
    <div class="right _765 ">
        <!-- _LBOX_ -->
        <div class="l_box" >
            <div class="top">
                <div class="title right">لیست فاکتورها</div>
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
                    <style>
                        .edit { background: url({$loct}/images/icon/edit.png)  }

                    </style>
                    <div class="list" id="tooltip">
                        <div class="top">
                            <span style="width: 150px;">شماره فاکتور</span>
                            <span style="width: 200px;">نام خریدار</span>
                            <span style="width: 70px;">تاریخ خرید</span>
                            <span style="width: 70px;">مبلغ</span>
                            <span style="width: 70px;">عملیات</span>
                            <span style="width: 70px;"> پرداخت</span>
                            <div class="clear"></div>
                        </div>

                        {foreach $factors as $factor}
                            <div class="row_1">
                                <span style="width: 150px;" >Shplus#{$factor->id*1234+567}</span>
                                <span style="width: 200px;" >{$factor->name}</span>
                                <span style="width: 70px;" >{jdate("j F y",strtotime($factor->date))}</span>
                                <span style="width: 70px;" >{number_format($factor->fee)}</span>
                                <span style="width: 70px;" >
                                    <a href="shop_factor/show/{$factor->id}"><div class="icon edit" ></div></a>

                                </span>
                                <span style="width: 70px;" >{$factor->status_pay}</span>
                                <div class="clear"></div>
                            </div>
                        {/foreach}
                    </div>
                    <div class="clear"></div>
                    <!-- paging -->
                    <div class="paging">
                        {section name=num start=1 loop=$paging+1 }
                            {if $smarty.section.num.index neq $smarty.get.paging}
                                <a href="{pagingurl url= $smarty.server.REQUEST_URI paging= {$smarty.section.num.index} }"><span>{$smarty.section.num.index}</span></a>
                            {else}
                                <span class="actpagin">{$smarty.section.num.index}</span>
                            {/if}
                        {/section}
                    </div>
                    <!-- paging -->
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