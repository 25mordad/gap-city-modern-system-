<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
لیست ماژول ها
                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm color-white" href="/gadmin/module/new">
                        ایجاد ماژول جدید
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
نام ماژول
                        </th>
                        <th>
وضعیت
                        </th>

                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $modules as $module}
                    <tr>
                        <td>{$module->module_name}</td>
                        <td>{$module->status}</td>

                        <td>
                            {if $module->status eq "active"}
                                <button class="btn btn-xs btn-success" onclick="location.href='/gadmin/module/change_status/{$module->id}?status={$module->status}'" data-toggle="tooltip" data-placement="top"  title=" فعال " >
                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                </button>
                            {else}
                                <button class="btn btn-xs btn-warning" onclick="location.href='/gadmin/module/change_status/{$module->id}?status={$module->status}'" data-toggle="tooltip" data-placement="top"  title=" غیرفعال  " >
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