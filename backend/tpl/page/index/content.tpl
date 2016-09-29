<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            لیست صفحات
        </h3>
        {include file="tpl/$part/$action/search.tpl"}
        {include file="tpl/$part/$action/pageFilter.tpl"}
        {include file="tpl/$part/$action/pageParent.tpl"}
    </div><!-- /.box-header -->
    <div class="box-body no-padding">

        <div class="row" >
            {foreach $pages as $page}
                <div class="col-md-6 " >
                    <!-- Warning box -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">
                                <a href="/gadmin/page/edit/{$page->id}" >
                                    {$page ->pg_title|truncate:43:"..":true}
                                </a>
                            </h3>
                            <div class="box-tools pull-left">
                                {if $page->pg_status eq "publish"}
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" onclick="location.href='?pgStatus=pending&pgId={$page->id}'" title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                {/if}
                                {if $page->pg_status eq "pending"}
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" onclick="location.href='?pgStatus=publish&pgId={$page->id}'" title=" در دست بررسی " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                {/if}
                                {if $page->comment_status eq "open"}
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" onclick="location.href='?commentStatus=close&pgId={$page->id}'" title=" دیدگاه‌ها فعال " >
                                        <i class="ace-icon fa fa-comments bigger-120"></i>
                                    </button>
                                {/if}
                                {if $page->comment_status eq "close"}
                                    <button class="btn btn-xs " data-toggle="tooltip" data-placement="top" onclick="location.href='?commentStatus=open&pgId={$page->id}'" title=" دیدگاه‌ها غیرفعال " >
                                        <i class="ace-icon fa fa-comments bigger-120"></i>
                                    </button>
                                {/if}
                                <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/page/edit/{$page->id}'" title=" ویرایش ">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-danger" id="DelPageBtt{$page->id}" data-toggle="tooltip" data-placement="top"  title=" حذف ">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </button>
                                <script>
                                    $(document).on("click", "#DelPageBtt{$page->id}", function(e) {
                                        bootbox.dialog ({
                                            message: " آیا از حذف این صفحه مطمئن هستید؟  ",
                                            buttons: {
                                                success: {
                                                    label: "بله",
                                                    className: "btn-danger",
                                                    callback: function() {
                                                        window.location.href = "/gadmin/page/del/{$page->id}";
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
                            </div>
                        </div>
                        <div class="box-body GCMSblock">
                            <p>
                                <img src="{get_last_image id=$page->id  type="page" thumb="thumb/" class="indx" source="true" }" class="img-thumbnail pull-left" width="115" >
                                {if $page->parent_id}
                                    <a href="/gadmin/page/edit/{$page->parent_id}" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" صفحه والد " >{showtitle id=$page->parent_id chagetoplus="false"  } </span></a>
                                    <br><i class="fa fa-level-up"></i>
                                    <small>{$page ->pg_title}</small>
                                {/if}
                                <br>
                    <span data-toggle="tooltip" data-placement="left" title=" تاریخ آخرین تغییر "><i class="fa fa-clock-o" ></i>
                        <small>{jdate("y/m/d",strtotime($page->date_modified))}</small>
                    </span>
                                <br>
                                <div class="clearfix" ></div>
                            </p>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            {/foreach}
        </div>


    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        {include file="tpl/$part/$action/paging.tpl"}
    </div>
</div><!-- /.box -->