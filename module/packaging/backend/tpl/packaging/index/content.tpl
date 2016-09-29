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
نماینده فروش
                        </th>
                        <th>
مسوول ارسال
                        </th>
                        <th>
تاریخ ارسال
                        </th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $packs as $row}
                        <tr>
                            <td>
                                
                                {get_user_name id_user=$row->pg_title} 
                                {get_user_params id_user=$row->pg_title name="55"}
                                -
                                {$getuser->username} 
                            </td>
                           <td>
                                {$row->pg_content}
                            </td>
							<td>
                                {date("Y-m-d",strtotime($row->date_modified))} /  {jdate("Y-m-d",strtotime($row->date_modified))}
                            </td>

                            <td>

								
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/packaging/?edit={$row->id}'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    <i class=" fa fa-pencil bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/packaging/products/{$row->id}'" data-toggle="tooltip" data-placement="top"  title=" اضافه کردن محصول به بسته " >
                                    <i class=" fa fa-plus bigger-120"></i>
                                </button>
                                {if $row->pg_status eq "publish"}
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" onclick="location.href='?status=publish&id={$group->id}'" title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                {/if}
                                {if $row->pg_status eq "pending"}
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" onclick="location.href='?status=pending&id={$group->id}'" title=" در حال ارسال  " >
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