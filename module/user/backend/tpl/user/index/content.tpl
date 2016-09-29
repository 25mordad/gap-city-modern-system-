<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    لیست کاربران
                </h3>
                {include file="tpl/$part/$action/search.tpl"}
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm color-white" href="/gadmin/user/new">
                        ایجاد کاربر جدید
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
                           نام کاربری
                        </th>
                        <th>
                            ایمیل
                        </th>

                        <th>
نوع کاربر
                        </th>
                        <th>
وضعیت
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $users as $user}
                        <tr>
                            <td><span {if $user->params neq NULL } data-toggle="tooltip" data-placement="top" title="{$user->params}" {/if} style="font-family: tahoma">{$user->username|truncate:26:"..":true}</span></td>
                            <td style="font-family: tahoma">{if $user->email}{$user->email|truncate:26:"..":true}{else}-{/if}</td>
                            <td>{$GCMS_USER_LEVEL[$user->user_level]|truncate:12:"..":true}</td>
                            <td>{if $user->status eq "active"}فعال{else}غیرفعال{/if}</td>

                            <td>
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/user/edit/{$user->id}'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    {if $user->status eq "active"}<i class="ace-icon fa fa-check bigger-120"></i>{else}<i class="ace-icon fa fa-close bigger-120"></i>{/if}
                                </button>
                                <button class="btn btn-xs btn-warning" onclick="location.href='/gadmin/user/chngpass/{$user->id}'" data-toggle="tooltip" data-placement="top"  title=" تغییر کلمه عبور " >
                                    <i class="ace-icon fa fa-asterisk bigger-120"></i>
                                </button>
                            </td>
                        </tr>
                    {/foreach}
                    </tbody></table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                {include file="tpl/$part/$action/paging.tpl"}
            </div>
        </div><!-- /.box -->
    </div>
</div>