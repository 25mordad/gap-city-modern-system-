<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
                           نام کاربری
                        </th>
                        <th>
مبلغ
                        </th>

                        <th>
تاریخ
                        </th>
                        <th>
وضعیت
                        </th>
                        <th>
اطلاعات بانک
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {$arr_status = [
                    'pending'=>"در دست بررسی"  ,
                    'cancel' => "لغو" ,
                    'confirm' => "تایید"
                    ]}
                    {foreach $pays as $pay}
                        <tr>
                            <td><span style="font-family: tahoma">{get_user_name id_user=$pay->id_user}<a href="/gadmin/user/edit/{$pay->id_user}" >{$getuser->username|truncate:26:"..":true}</a></span></td>
                            <td >{number_format($pay->amount)}</td>
                            <td>{jdate(" Y/m/d <br> H:i:s",strtotime($pay->date))}</td>
                            <td>{$arr_status[$pay->status]}</td>
                            <td>{$pay->bank_info}</td>
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