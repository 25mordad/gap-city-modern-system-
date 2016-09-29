<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    لیست تماس ها
                </h3>
                {include file="tpl/$part/$action/search.tpl"}
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm color-white" href="/gadmin/contact/new">
                        ایجاد تماس جدید
                    </a>
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
                            ایمیل
                        </th>

                        <th>
                            گروه
                        </th>
                        <th>
شماره تماس
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $contacts as $contact}
                        <tr>
                            <td>
                                {$contact->name|truncate:25:"..":true}
                            </td>
                            <td>
                                {if $contact->email}{$contact->email|truncate:20:"..":true}{else}-{/if}
                            </td>
                            <td>
                                {if $contact->id_group}<a href="/gadmin/contact/grouping/?edit={$contact->id_group}">{$group_contacts[$contact->id_group]|truncate:18:"..":true}</a>{else}ندارد{/if}
                            </td>
                            <td>
                                {$contact->cell}
                            </td>

                            <td>

                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/sms/?single=true&cell={$contact->cell}'" data-toggle="tooltip" data-placement="top"  title=" ارسال پیامک " >
                                    <i class=" fa fa-send bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/contact/edit/{$contact->id}'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    <i class=" fa fa-pencil bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-danger"  id="DelBtt{$contact->id}"  data-toggle="tooltip" data-placement="top"  title=" حذف " >
                                    <i class=" fa fa-trash-o bigger-120"></i>
                                </button>
                            </td>
                        </tr>
                        <script>
                            $(document).on("click", "#DelBtt{$contact->id}", function(e) {
                                bootbox.dialog ({
                                    message: " آیا از حذف این  سطر مطمئن هستید؟  ",
                                    buttons: {
                                        success: {
                                            label: "بله",
                                            className: "btn-danger",
                                            callback: function() {
                                                window.location.href = "/gadmin/contact/del/{$contact->id}/?paging={$smarty.get.paging}&search={$smarty.get.search}&id_group={$smarty.get.id_group}";
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