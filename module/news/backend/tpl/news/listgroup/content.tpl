<div class="box box-primary">
    <div class="box-header">
        <div class="box-tools pull-left">
            <a class="btn btn-info btn-sm color-white" href="/gadmin/news/newgroup">
ایجاد گروه خبری جدید
            </a>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body no-padding">

        <div class="row" >
            {foreach $groups as $page}
                <div class="col-md-6 " >
                    <!-- Warning box -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">
                                <a href="/gadmin/news/editgroup/{$page->id}" >
                                    {$page ->pg_title|truncate:43:"..":true}
                                </a>
                            </h3>
                            <div class="box-tools pull-left">
                                {if $page->pg_status eq "publish"}
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                {/if}
                                {if $page->pg_status eq "pending"}
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top"  title=" در دست بررسی " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                {/if}

                                <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/news/editgroup/{$page->id}'" title=" ویرایش ">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-warning" id="DelPageBtt{$page->id}" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/news/new/?g={$page->id}'" title=" اضافه کردن خبر جدید ">
                                    <i class="ace-icon fa fa-plus bigger-120"></i>
                                </button>

                            </div>
                        </div>
                        <div class="box-body GCMSblock">
                            <p>
                                <img src="{get_last_image id=$page->id  type="newsgroup" thumb="thumb/" class="indx" source="true" }" class="img-thumbnail pull-left" width="115" >
                                {if $page->parent_id}
                                    <a href="/gadmin/news/editgroup/{$page->parent_id}" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" گروه والد " >{showtitle id=$page->parent_id chagetoplus="false"  } </span></a>
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

</div><!-- /.box -->