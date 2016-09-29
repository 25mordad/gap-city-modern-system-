<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    لیست دیدگاه‌ها
                </h3>
                {include file="tpl/$part/$action/search.tpl"}
                {include file="tpl/$part/$action/commentFilter.tpl"}
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
تاریخ
                        </th>
                        <th>
                            دیدگاه
                        </th>
                        <th>
                            مکان (بخش » صفحه)
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {$arr_types = [
                    'page'=>"صفحات",
                    'news' => "اخبار",
                    'gallery' => "گالری عکس",
                    'sound' => "گالری صوتی"
                    ]}
                    {foreach $comments as $comment}
                    <tr>
                        <td>
                            {jdate(" d / m / Y ",strtotime($comment->cm_date))}
                            <blockquote class="fontSize10">
                                {$comment->cm_author|truncate:16:"..":true} <br>
                                <i class="fa fa-envelope"></i> {$comment->cm_email}
                            </blockquote>
                        </td>
                        <td style="width: 50%">{$comment->cm_content|truncate:230:"..":true}</td>
                        <td>
                            {$arr_types[$comment->cm_type]} &raquo; <a href="{$comment->cm_type}/edit/{$comment->id_other}">{{showtitle id=$comment->id_other chagetoplus="false" }|truncate:30:"..":true}</a>
                        </td>

                        <td>
                            {if $comment->cm_status eq "publish"}
                                <button class="btn btn-xs btn-success"  data-toggle="tooltip" data-placement="top"  onclick="location.href='/gadmin/comment/unconfirm/{$comment->id}'" title=" انتشاریافته " >
                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                </button>
                            {/if}
                            {if $comment->cm_status eq "pending"}
                                <button class="btn btn-xs btn-warning"  data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/comment/confirm/{$comment->id}'" title=" در دست بررسی " >
                                    <i class="ace-icon fa fa-close bigger-120"></i>
                                </button>
                            {/if}
                            <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/comment/edit/{$comment->id}'" title=" ویرایش ">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-danger" id="DelCommentBtt{$comment->id}" data-toggle="tooltip" data-placement="top"  title=" حذف ">
                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                            </button>
                            <script>
                                $(document).on("click", "#DelCommentBtt{$comment->id}", function(e) {
                                    bootbox.dialog ({
                                        message: " آیا از حذف این دیدگاه مطمئن هستید؟  ",
                                        buttons: {
                                            success: {
                                                label: "بله",
                                                className: "btn-danger",
                                                callback: function() {
                                                    window.location.href = "/gadmin/comment/del/{$comment->id}";
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
                        </td>
                    </tr>
                    {/foreach}
                    </tbody></table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                {include file="tpl/$part/$action/paging.tpl"}
        </div><!-- /.box -->
    </div>
</div>