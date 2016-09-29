<div class="box box-primary">
    <div class="box-body no-padding">

        <div class="row" >
            {foreach $boxes as $page}
                <div class="col-md-6 " >
                    <!-- Warning box -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">
                                <a href="/gadmin/box/edit/{$page->id}" >
                                    {$page ->box_title|truncate:43:"..":true}
                                </a>
                            </h3>
                            <div class="box-tools pull-left">
                                {if $page->box_status eq "publish"}
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top"  title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                {/if}
                                {if $page->box_status eq "pending"}
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top"  title=" در دست بررسی " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                {/if}

                                <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/box/edit/{$page->id}'" title=" ویرایش ">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body GCMSblock">
                            <p>
                                <img src="{get_last_image id=$page->id  type="box" thumb="thumb/" class="indx" source="true" }" class="img-thumbnail pull-left" width="115" >
                                {if $page->parent_id}
									{if $page->parent_id eq "1"}
									<a href="/gadmin/page/page_index/1" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" صفحه والد " >{showtitle id=$page->parent_id chagetoplus="false"  } </span></a>									
									{else}
                                    <a href="/gadmin/page/edit/{$page->parent_id}" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" صفحه والد " >{showtitle id=$page->parent_id chagetoplus="false"  } </span></a>
                                    {/if}
									<br><i class="fa fa-level-up"></i>
                                    <small>{$page ->box_title}</small>
                                {else}
                                    <br><i class="fa fa-level-up"></i>
                                    <small>
                                        نمایش در تمام صفحات
                                    </small>
                                {/if}

                                <div class="clearfix" ></div>
                            </p>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            {/foreach}
        </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->