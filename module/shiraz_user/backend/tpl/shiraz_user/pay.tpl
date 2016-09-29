<div class="wrapper" >
	<div class="right _255 ">

              <!-- _RBOX_ -->
              <div class="r_box" >
                <div class="top">
                    <div class="title right">مدیریت اعضا</div>
                    <img src="{$loct}/images/icon/page.png" />
                    <div class="clear"></div>
                </div>
                <div class="mid">
                    <div class="txt">
                        <a href="shiraz_user"><div class="r_menu">
                            <span>لیست اعضا</span>
                            <img src="{$loct}/images/icon/op_ls.png" />
                        </div></a>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="dwn"></div>
              </div>
              <div class="clear"></div>
              <!-- _RBOX_ -->
	</div>    
	<div class="right _765 ">
        <!-- _LBOX_ -->
        <div class="l_box" >
            <div class="top">
                <div class="title right">لیست پرداختی</div>
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
                        .pass { background: url({$loct}/images/icon/pass.png)  }
                        .user { background: url({$loct}/images/icon/user.png)  }
                        .del { background: url({$loct}/images/icon/del.png)  }
                    </style>
                    <div class="list" id="tooltip">
                        <div class="top">
                            <span style="width: 70px;">نام کاربری</span>
                            <span style="width: 70px;">مبلغ</span>
                            <span style="width: 250px;" > توضیحات</span>
                            <span style="width: 70px;" >تاریخ </span>
                            <span style="width: 90px;">اطلاعات بانک</span>
                            <span style="width: 100px;">وضعیت </span>
                            <div class="clear"></div>
                        </div>

                        {$arr_status = [
                        'pending'=>"در دست بررسی"  ,
                        'cancel' => "لغو" ,
                        'confirm' => "تایید"
                        ]}
                        {foreach $pays as $pay}
                            <div class="row_1">
                                <span style="width: 70px;">{shirazplus_get_user id=$pay->id_user}<a href="shiraz_user/show/{$shirazplusgetuser->id}" >{$shirazplusgetuser->username}</a></span>
                                <span style="width: 70px;">{$pay->amount}</span>
                                <span style="width: 250px;" > {$pay->text}</span>
                                <span style="width: 70px;" >{jdate("Y/m/d",strtotime($pay->date))} </span>
                                <span style="width: 90px;">{$pay->bank_info} </span>
                                <span style="width: 100px;">{$arr_status[$pay->status]} </span>
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