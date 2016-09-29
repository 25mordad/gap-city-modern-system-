<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-body table-responsive no-padding">
                {$arr_status = [
                'pending'=>" پرداخت نشده "  ,
                'confirm' => " پرداخت شده " ,
                'step1' => " کالا ارسال نشده " ,
                'send' => " کالا ارسال شده "
                ]}
                <p style="padding: 20px">
                    <span style="float: right">
                        <a href="/shop_factor/aprint/{$factor->id}?print=true" target="_blank" >
                            پرینت فاکتور
                        </a> | {$arr_status[$factor->status_pay]} | {$arr_status[$factor->status]} |
                        {$factor->name}
        </span>
        <span style="float: left">
            {jdate("j F y",strtotime($factor->date))}
        </span>
                </p>
                <table class="table table-striped table-hover ">

                    <thead >
                    <tr>
                        <th> نام کالا </th>
                        <th> تعداد </th>
                        <th> مبلغ </th>
                    </tr>
                    </thead>
                    <tbody>
                    {get_factor_row id_shop_factor=$factor->id}
                    {$sum =0}
                    {foreach $getfactorrow as $row}
                        <tr>
                            <td>{$row->name}</td>
                            <td>{$row->number}</td>
                            <td>{number_format($row->fee)}</td>
                        </tr>
                        {$sum = $row->fee+$sum}
                    {/foreach}
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>جمع</td>
                            <td>{number_format($sum)} تومان</td>
                        </tr>
                    </tfoot>
                </table>
                <p style="padding: 20px">
                    {if $factor->status eq "step1"}
                        <span style="border:1px solid red">
                        این فاکتور برای مشتری ارسال نشده است. در صورتی که فاکتور را برای مشتری ارسال کرده اید لطفا وضعیت ارسال فاکتور را تغییر دهید.
                        <a href="?status=send" >
تغییر وضعیت فاکتور
                        </a>
                            </span>
                        <br>
                    {/if}
                    {$factor->address} <br>
                    کد پستی :
                    {$factor->zipcode}
                    <br>
                    {$factor->text}
                </p>
            </div><!-- /.box-body -->

            </div>
        </div><!-- /.box -->
    </div>
</div>