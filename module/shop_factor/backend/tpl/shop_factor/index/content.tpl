<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    لیست فاکتورها
                </h3>
                {include file="tpl/$part/$action/search.tpl"}
                {include file="tpl/$part/$action/pay.tpl"}
                {include file="tpl/$part/$action/user.tpl"}
                {include file="tpl/$part/$action/send.tpl"}

            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
شماره فاکتور
                        </th>
                        <th>
نام کاربری
                        </th>
                        <th>
نام خریدار
                        </th>

                        <th>
تاریخ خرید
                        </th>
                        <th>
مبلغ
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $factors as $factor}
                        <tr>
                            <td>
                                Shop#{$factor->id*1234+567}
                            </td>
                            <td>
                                {get_user_name id_user=$factor->id_user}
                                <a href="/gadmin/user/?search={$getuser->email}&paging=1" >{$getuser->username}</a>
                            </td>
                            <td>
                                {$factor->name}
                            </td>
                            <td>
                                {jdate("j F y",strtotime($factor->date))}
                            </td>
                            <td>
                                {number_format($factor->fee)}
                            </td>

                            <td>

                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/shop_factor/show/{$factor->id}'" data-toggle="tooltip" data-placement="top"  title=" نمایش فاکتور " >
                                    <i class=" fa fa-play bigger-120"></i>
                                </button>
                                {if $factor->status_pay eq "confirm"}
                                <button class="btn btn-xs btn-success"  data-toggle="tooltip" data-placement="top"  title=" پرداخت تایید شده " >
                                    <i class=" fa fa-check-square bigger-120"></i>
                                </button>
                                    {else}
                                <button class="btn btn-xs btn-warning"  data-toggle="tooltip" data-placement="top"  title=" پرداخت انجام نشده " >
                                    <i class=" fa fa-close bigger-120"></i>
                                </button>
                                {/if}
                                {if $factor->status eq "step1"}
                                <button class="btn btn-xs btn-warning"  data-toggle="tooltip" data-placement="top"  title=" کالا ارسال نشده " >
                                    <i class=" fa fa-send-o bigger-120"></i>
                                </button>
                                    {else}
                                <button class="btn btn-xs btn-success"  data-toggle="tooltip" data-placement="top"  title="  کالا ارسال شده " >
                                    <i class=" fa fa-send bigger-120"></i>
                                </button>
                                {/if}
                            </td>
                        </tr>

                    {/foreach}
                    </tbody></table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                {include file="tpl/$part/$action/paging.tpl"}
            </div>
        </div><!-- /.box -->
    </div>
</div>