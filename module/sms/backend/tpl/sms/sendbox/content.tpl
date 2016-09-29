<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    لیست پیام‌های ارسالی شما
                </h3>
                {include file="tpl/$part/$action/search.tpl"}

            </div><!-- /.box-header -->

            {$status_info = [
            "unknown" => "نامشخص",
            "Indeterminate" => "وضعیت پیامک نامشخص است",
            "SentToMobile" => "پیامک به گوشی مخاطب رسیده است",
            "FailedToMobile" => "پیامک به گوشی مخاطب نرسیده است",
            "SentToComunicationCenter" => "پیامک به مرکز مخابراتی رسیده است",
            "FailedToComunicationCenter" => "پیامک هنوز به مرکز مخابراتی نرسیده است",
            "Pending" => "پیامک به مرکز مخابراتی رسیده است اما وضعیت آن هنوز نامشخص است"
            ]}
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
زمان ارسال
                        </th>
                        <th>
                            متن ارسالی
                        </th>

                        <th>
                            دریافت‌کننده
                        </th>
                        <th>
وضعیت
                        </th>

                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $sms_send_box as $sms}
                        <tr>
                            <td>
                                {jdate("H:i:s Y/m/d",strtotime($sms->date))}
                            </td>
                            <td>
                                {$sms->text}
                            </td>

                            <td>
                                {get_contact cell= $sms->cell_no }
                                {if isset($contact)}
                                    <a href="/gadmin/contact/edit/{$contact->id}">{$contact->name|truncate:16:"..":true}</a>
                                {else}
                                    {$sms->cell_no}

                                {/if}
                            </td>

                           <td>
                               {$status_info[$sms->final_result]}
                           </td>

                            <td>

                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/sms/get_status/{$sms->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}'" data-toggle="tooltip" data-placement="top"  title=" پیگیری وضعیت " >
                                    <i class="fa  fa-circle-o-notch bigger-120"></i>
                                </button>

                                <button class="btn btn-xs btn-danger"  id="DelBtt{$sms->id}"  data-toggle="tooltip" data-placement="top"  title=" حذف " >
                                    <i class=" fa fa-trash-o bigger-120"></i>
                                </button>
                            </td>
                        </tr>
                        <script>
                            $(document).on("click", "#DelBtt{$sms->id}", function(e) {
                                bootbox.dialog ({
                                    message: " آیا از حذف این  سطر مطمئن هستید؟  ",
                                    buttons: {
                                        success: {
                                            label: "بله",
                                            className: "btn-danger",
                                            callback: function() {
                                                window.location.href = "/gadmin/sms/del/{$sms->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}";
                                            }
                                        },
                                        main: {
                                            label: "انصراف",
                                            className: "btn-primary"
                                        }
                                    }
                                })
                            });
                        </script>
                    {/foreach}
                    </tbody></table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                {include file="tpl/$part/$action/paging.tpl"}
            </div>
        </div><!-- /.box -->
    </div>
</div>