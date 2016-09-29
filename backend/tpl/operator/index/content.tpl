<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
لیست اپراتورها
                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm color-white" href="/gadmin/operator/new">
                        ایجاد اپراتور جدید
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
                            نام کاربری
                        </th>
                        <th>
                            ایمیل
                        </th>
                        <th>
                            سطح دسترسی
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $operators as $opt}
                    {if $smarty.session.level >= $opt->op_level}
                    <tr>
                        <td>{$opt ->name}</td>
                        <td>{$opt ->username}</td>
                        <td>{$opt ->email}</td>
                        <td>{if $opt ->op_level eq 6}اپراتور{else}مدیر{/if}</td>
                        <td>
                            {if $opt->status eq "true"}
                                <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top"  title=" فعال " >
                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                </button>
                            {else}
                                <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top"  title=" غیرفعال  " >
                                    <i class="ace-icon fa fa-close bigger-120"></i>
                                </button>
                            {/if}
                            <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/operator/edit/{$opt->id}'" title=" ویرایش ">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/operator/pass/{$opt->id}'" title=" تغییر کلمه عبور ">
                                <i class="ace-icon fa fa-asterisk bigger-120"></i>
                            </button>
                        </td>
                    </tr>
                    {/if}
                    {/foreach}
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>