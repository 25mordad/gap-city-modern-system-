<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            لیست پیام ها
        </h3>
        {include file="tpl/$part/$action/pageFilter.tpl"}
    </div><!-- /.box-header -->
    <div class="box-body no-padding">
        <script src="{$loct}/js/plugins/slimScroll/jquery.slimscroll.js"></script>
        <div class="row" >
            {foreach $messageList as $row}
                <div class="col-md-6 " >
                    <!-- Warning box -->
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title">
                                <a href="/gadmin/message/show/{$row->id}" >
                                    {$row->title}
                                </a>

                            </h3>

                            <div class="box-tools pull-left">
                                <span data-toggle="tooltip" data-placement="top" title=" تاریخ ایجاد "><i class="fa fa-clock-o" ></i>
                                    <small>{jdate("y/m/d",strtotime($row->create_date))}</small>
                                </span>
                                {if $row->status eq "send"}
                                    <button class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top"  title=" در انتظار پاسخ " >
                                        <i class="ace-icon fa fa-share-square bigger-120"></i>
                                    </button>
                                {/if}
                                {if $row->status eq "waiting"}
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top"  title=" پاسخ داده شد" >
                                        <i class="ace-icon fa fa-pause bigger-120"></i>
                                    </button>
                                {/if}


                                <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/message/show/{$row->id}'" title=" نمایش ">
                                    <i class="ace-icon fa fa-eye bigger-120"></i>
                                </button>

                            </div>
                        </div>

                        <script>
                            $(function() {
                            //SLIMSCROLL FOR CHAT WIDGET
                            $('#chat-box{$row->id}').slimScroll({
                                height: '200px',
                                wheelStep: 1
                            });
                            });
                        </script>
                        <div class="box-body "  id="chat-box{$row->id}" >
                            <p >
                                {get_user_params id_user=$row->id_user name="14"} -  {get_user_name id_user=$row->id_user }{$getuser->username}
                                <div class="clearfix" style="margin-bottom: 10px" ></div>
                                {getMessageTexts id=$row->id}
                                {foreach $MessageTexts as $rowMss}
                                <div class="callout callout-{if $rowMss->id_user eq "0" }danger{else}info{/if}">
                                    <p>{htmlspecialchars_decode($rowMss->text)}</p>
                                <small>
                                    <cite >
                                        {if $rowMss->id_user eq "0" }
                                            ارسال شده توسط ادمین
                                        {else}
                                        {get_user_params  id_user=$rowMss->id_user name="14"}
                                        {get_user_name id_user=$rowMss->id_user } {$getuser->username}
                                        {/if}
                                        <span class="pull-left label label-info">{jdate("H:i l j F Y ",strtotime( $rowMss->date ))}</span>
                                    </cite >
                                </small>
                                </div>
                                {/foreach}
                                <div class="clearfix" ></div>
                            </p>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <form action="/gadmin/message/show/{$row->id}?send=true&rapid=true" method="post" name="sendRapid" >
                                <div class="input-group">
                                    <input placeholder="ارسال پاسخ سریع به پیام {$row->title}" class="form-control" name="text">
                                    <div class="input-group-btn">
                                        <button class="btn btn-success"><i class="fa fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box -->
                </div>
            {/foreach}
        </div>


    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        {include file="tpl/$part/$action/paging.tpl"}
    </div>
</div><!-- /.box -->