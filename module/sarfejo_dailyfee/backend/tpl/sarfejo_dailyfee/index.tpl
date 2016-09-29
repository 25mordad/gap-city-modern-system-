<div class="wrapper" >
    <div class="right _255 ">
        {include file="tpl/sarfejo_dailyfee/formedit.tpl"}
        {include file="tpl/sarfejo_dailyfee/menu.tpl"}
    </div>
    <div class="right _765 ">
        <!-- _LBOX_ -->
        <div class="l_box" >
            <div class="top">
                <div class="title right">لیست قیمت روزانه</div>
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
                            <span style="width: 180px;">تاریخ </span>
                            <span style="width: 180px;">نام کالا</span>
                            <span style="width: 180px;">قیمت </span>
                            <span style="width: 50px;">ویرایش</span>
                            <div class="clear"></div>
                        </div>
                        {foreach $dfstuffees as $dfstuffee}
                            <div class="row_1">
                                <span style="width: 180px;" class="BYekan" title="{$dfstuffee->date}">
                                    {jdate("y/m/d",strtotime( $dfstuffee->date ))}</span>
                                <span style="width: 180px;" class="BYekan" title="{$dfstuffee->name}">
                                    {$dfstuffee->name}</span>
                                <span style="width: 180px;" class="BYekan" title="{number_format($dfstuffee->fee)}">
                                    {number_format($dfstuffee->fee)}</span>

                                <span style="width: 50px;"><a href="sarfejo_dailyfee?paging={$smarty.get.paging}&edit={$dfstuffee->id}"><div class="icon edit" ></div></a></span>

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
                </div>
            </div>
            <div class="dwn"></div>
        </div>
        <div class="clear"></div>
        <!-- _LBOX_ -->

    </div>
    <div class="clear"></div>
</div>
