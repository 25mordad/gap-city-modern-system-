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
عنوان گروه
                        </th>
                        <th>
توضیحات گروه
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $groups as $group}
                        <tr>
                            <td>
                                {if $group->parent_id}
                                    <a href="/gadmin/product/grouping/?edit={$group->parent_id}" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" گروه والد " >{showtitle id=$group->parent_id chagetoplus="false"  } </span></a>
                                    <br><i class="fa fa-level-up"></i>
                                {/if}
                                {$group->pg_title}
                            </td>
                           <td>
                                {$group->pg_content}
                            </td>

                            <td>


                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/product/grouping/?edit={$group->id}'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
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
                                <button class="btn btn-xs btn-warning" onclick="location.href='/gadmin/product/add_param/{$group->id}'" data-toggle="tooltip" data-placement="top"  title=" افزودن پارامتر " >
                                    <i class=" fa fa-plus bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-danger" id="AddProduct{$group->id}"  data-toggle="tooltip" data-placement="top"  title=" افزودن محصول " >
                                    <i class=" fa fa-cart-plus bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/product/?paging=1&search=NULL&f_parent={$group->id}&f_status=all'" data-toggle="tooltip" data-placement="top"  title=" لیست محصولات " >
                                    <i class=" fa fa-list bigger-120"></i>
                                </button>
                                <script>
                                    $(document).on("click", "#AddProduct{$group->id}", function(e) {
                                        bootbox.dialog ({
                                            title: " افزودن محصول به گروه   {$group->pg_title} ",
                                            message: " <div class='input-group input-group-sm'><form method='post' action='/gadmin/product/new' ><input type='text' name='name' placeholder='نام محصول' class='form-control' ><span class='input-group-btn' > <button type='submit' class='btn btn-primary btn-flat'> ایجاد محصول جدید </button> </span><input type='hidden' name='group_id' value='{$group->id}' ></form> </div>",
                                            buttons: {

                                                main: {
                                                    label: "انصراف",
                                                    className: "btn-danger"
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
        </div><!-- /.box -->
    </div>
</div>