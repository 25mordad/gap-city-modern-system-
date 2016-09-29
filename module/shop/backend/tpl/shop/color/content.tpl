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
نام لاتین
                        </th>
                        <th>
نام فارسی
                        </th>
                        <th>
 ترتیب
                        </th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $groups as $group}
                        <tr>
                            <td>
                                {if $group->parent_id}
                                {get_page id=$group->parent_id}
                                    <a href="/gadmin/shop/brand/" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" گروه والد " >{showtitle id=$group->parent_id chagetoplus="false"  } </span></a>
                                    <br><i class="fa fa-level-up"></i>
                                {/if}
                                {$group->pg_title}
                            </td>
                           <td>
                                {$group->pg_content}
                            </td>
							<td>
                                {$group->pg_order}
                            </td>

                            <td>

								
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/shop/color/?edit={$group->id}'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    <i class=" fa fa-pencil bigger-120"></i>
                                </button>
                                {if $group->pg_status eq "publish"}
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" onclick="location.href='?status=publish&id={$group->id}'" title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                {/if}
                                {if $group->pg_status eq "pending"}
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" onclick="location.href='?status=pending&id={$group->id}'" title=" در دست بررسی " >
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