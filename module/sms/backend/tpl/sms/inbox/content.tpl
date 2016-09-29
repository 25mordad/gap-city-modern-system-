<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    لیست پیام‌های دریافتی شما
                </h3>
                {include file="tpl/$part/$action/search.tpl"}
                {include file="tpl/$part/$action/form.tpl"}
            </div><!-- /.box-header -->


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
ارسال کننده
                        </th>


                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $sms_inbox as $sms}
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
                                                window.location.href = "/gadmin/sms/delinbox/{$sms->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}";
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
