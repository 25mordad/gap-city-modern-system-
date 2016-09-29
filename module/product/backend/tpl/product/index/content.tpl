<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            لیست محصولات
        </h3>
        {include file="tpl/$part/$action/search.tpl"}
        {include file="tpl/$part/$action/pageFilter.tpl"}
        {include file="tpl/$part/$action/pageParent.tpl"}
    </div><!-- /.box-header -->
    <div class="box-body no-padding">

        <div class="row" >
            {foreach $products as $product}
                <div class="col-md-6 " >
                    <!-- Warning box -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">
                                <a href="/gadmin/product/edit/{$product->id}" >
                                    {$product ->name|truncate:43:"..":true}
                                </a>
                            </h3>
                            <div class="box-tools pull-left">
                                {if $product->status eq "publish"}
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top"  title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                {/if}
                                {if $product->status eq "pending"}
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top"  title=" در دست بررسی " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                {/if}

                                <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/product/edit/{$product->id}'" title=" ویرایش ">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>


                            </div>
                        </div>
                        <div class="box-body GCMSblock">
                            <p>
                                <img src="{get_last_image id=$product->id  type="product" thumb="thumb/" source="true" }" class="img-thumbnail pull-left" width="115" >
                                <i class="fa fa-level-up"></i> <span class="text-red " data-toggle="tooltip" data-placement="left" title=" گروه محصولی " >{showtitle id=$product->group_id chagetoplus="false"  } </span>
                                <br>
                    <span data-toggle="tooltip" data-placement="left" title=" قیمت "><i class="fa fa-dollar" ></i>
                        <small>{number_format($product->price)}</small>
                    </span>
                                <br>
                    <span data-toggle="tooltip" data-placement="left" title=" مدل "><i class="fa fa-bullseye" ></i>
                        <small>{number_format($product->model)}</small>
                    </span>
                                <br>
                    <span data-toggle="tooltip" data-placement="left" title=" تعداد "><i class="fa fa-cubes" ></i>
                        <small>{number_format($product->quantity)}</small>
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
    <div class="box-footer clearfix">
        {include file="tpl/$part/$action/paging.tpl"}
    </div>
</div><!-- /.box -->