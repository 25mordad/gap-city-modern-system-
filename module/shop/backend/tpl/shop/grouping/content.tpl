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
کد گروه
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
                                    <a href="/gadmin/shop/grouping/?pid={$getpage->parent_id}" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" گروه والد " >{showtitle id=$group->parent_id chagetoplus="false"  } </span></a>
                                    <br><i class="fa fa-level-up"></i>
                                {/if}
                                {$group->pg_title}
                            </td>
                           <td>
                                {$group->pg_content}
                            </td>
							<td>
                                {$group->pg_excerpt}
                            </td>
							<td>
                                {$group->pg_order}
                            </td>

                            <td>

								<button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/shop/grouping?pid={$group->id}'" data-toggle="tooltip" data-placement="top"  title=" لیست گروه‌های زیرمجموعه " >
                                    <i class=" fa fa-list bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/shop/grouping/?pid={$group->parent_id}&edit={$group->id}'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
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
                                
                                <button class="btn btn-xs btn-danger" id="AddProduct{$group->id}"  data-toggle="tooltip" data-placement="top"  title=" افزودن محصول " >                                    
                                <i class=" fa fa-cart-plus bigger-120"></i>                                
                                </button>
                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/shop/?paging=1&search=NULL&f_parent={$group->id}&f_status=all'" data-toggle="tooltip" data-placement="top"  title=" لیست محصولات " >
                                    <i class=" fa fa-list bigger-120"></i>
                                </button>
                                <script>
                                    $(document).on("click", "#AddProduct{$group->id}", function(e) {
                                        bootbox.dialog ({
                                            title: " افزودن محصول به گروه   {$group->pg_title} ",
                                            message: "<div class='row' ><div class='col-md-6' style='background:#CCCCCC' ><h3>اضافه کردن مستقیم محصول</h3><div class='input-group input-group-sm'><form target='_blank' method='post' action='/gadmin/shop/new' ><input type='text' name='name' placeholder='نام محصول' class='form-control' ><span class='input-group-btn' > <button type='submit' class='btn btn-primary btn-flat'> ایجاد محصول جدید </button> </span><input type='hidden' name='group_id' value='{$group->id}' ><input type='hidden' name='barcode' value='{$group->pg_excerpt}' ></form> </div></div>"
                                            +"<div class='col-md-6' ><h3>اضافه کردن از سایت منبع</h3>"
                                            + "<div class='input-group input-group-sm'><form target='_blank' method='post' action='/gadmin/shop/new?import=true' ><input type='text' name='link' placeholder='URL WebSite ' class='form-control' >"
                                            +"<br><div style='padding:5px' >"
                                            +"<label class='col-md-12'><input type='radio' name='type' value='mangooutlet'>Mango Outlet</label>"
                                            +"<label class='col-md-6'><input type='radio' name='type' value='mango'>Mango</label>"
                                            +"<label class='col-md-6'><input type='radio' name='type' value='zara'>Zara</label> "
                                            +"<label class='col-md-12'><input type='radio' name='type' value='stradivarius'>Stradivarius</label> "
                                            +"<label class='col-md-12'><input type='radio' name='type' value='sportsdirect'>SportsDirects</label> "
                                            +"<label class='col-md-6'><input type='radio' name='type' value='mroozi'>Mroozi</label> "
                                            +"</div><span class='input-group-btn' > <button type='submit' class='btn btn-primary btn-flat'> ایجاد محصول جدید </button> </span><input type='hidden' name='group_id' value='{$group->id}' ><input type='hidden' name='barcode' value='{$group->pg_excerpt}' ></form> </div>"
                                            +"</div></div>"
                                            ,
                                            buttons: {

                                                main: {
                                                    label: "انصراف",
                                                    className: "btn-danger"
                                                }
                                            }
                                        })
                                    });
                                </script>
                                <br>
                                
                            </td>
                        </tr>

                    {/foreach}
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>