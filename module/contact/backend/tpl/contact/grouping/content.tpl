<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-tools pull-right">
                    {include file="tpl/$part/$action/form.tpl"}
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
                            نام
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $groups as $group}
                        <tr>
                            <td>
                                {$group->name}
                            </td>

                            <td>

                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/sms/?group_{$group->id}=true'" data-toggle="tooltip" data-placement="top"  title=" ارسال پیامک " >
                                    <i class=" fa fa-send bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/contact/grouping/?edit={$group->id}'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    <i class=" fa fa-pencil bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-danger"  id="DelBtt{$group->id}"  data-toggle="tooltip" data-placement="top"  title=" حذف " >
                                    <i class=" fa fa-trash-o bigger-120"></i>
                                </button>
                            </td>
                        </tr>
                        <script>
                            $(document).on("click", "#DelBtt{$group->id}", function(e) {
                                bootbox.dialog ({
                                    message: " آیا از حذف این  سطر مطمئن هستید؟  ",
                                    buttons: {
                                        success: {
                                            label: "بله",
                                            className: "btn-danger",
                                            callback: function() {
                                                window.location.href = "/gadmin/contact/delgroup/{$group->id}";
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
        </div><!-- /.box -->
    </div>
</div>