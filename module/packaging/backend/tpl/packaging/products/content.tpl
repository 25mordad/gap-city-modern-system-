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
 عنوان محصول
                        </th>
                        <th>
 سایز
                        </th>
                        <th>
 رنگ
                        </th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $packsprdct as $row}
                        <tr>
                            <td>
                            {getProductShop id=$row->pg_title}
                            <div><a href="/shop/show/{$row->pg_title}/?title={$getProduct->en_title} {$getProduct->fa_title}" target="_blank">
                            <img alt="{$getProduct->fa_title}" src="{$getProduct->default_photo}" width="100" align="right" style="padding:10px" ></a>
                            
                            <h4><a href="/shop/show/{$row->pg_title}/?title={$getProduct->en_title} {$getProduct->fa_title}" target="_blank">{$getProduct->fa_title} </a></h4>
                                    </div>
                            </td>
                           <td>
                                {$row->pg_content}
                            </td>
							<td>
                                {$row->pg_excerpt}
                            </td>

                            <td>

								
                                <button class="btn btn-xs btn-danger" 
                                onclick="location.href='?del={$row->id}'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    <i class=" fa fa-trash-o bigger-120"></i>
                                </button>
                               
                            </td>
                        </tr>

                    {/foreach}
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>