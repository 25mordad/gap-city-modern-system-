<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div >
                    {include file="tpl/$part/$action/form.tpl"}
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
نام پارمتر
                        </th>
                        <th>
نام لاتین پارامتر
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $param_lists as $param_list}
                        <tr>
                            <td>
                                {$param_list->param_name}
                            </td>
                           <td>
                                {$param_list->param_tag}
                            </td>

                            <td>


                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/product/add_param/{$g_product->id}?edit={$param_list->id}'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    <i class=" fa fa-pencil bigger-120"></i>
                                </button>
                                {if $param_list->status eq "publish"}
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" onclick="location.href='?status={$param_list->status}&id={$param_list->id}'" title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                {/if}
                                {if $param_list->status eq "pending"}
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" onclick="location.href='?status={$param_list->status}&id={$param_list->id}'" title=" در دست بررسی " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                {/if}

                            </td>
                        </tr>

                    {/foreach}
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>