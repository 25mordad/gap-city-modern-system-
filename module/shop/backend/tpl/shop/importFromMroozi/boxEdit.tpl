<!-- ****** -->
<div class="box box-solid box-info">
    <div class="box-header">
        <h3 class="box-title">
            ویرایش محصول
        </h3>
    </div>
    <div class="box-body">
        <p>
            <button class="btn btn-success btn-block btn-flat">
                ثبت
            </button>
        <div class="clearfix" ></div>
        <div class="row" >
            <div class="col-md-6" >
                <a href="/shop/show/{$product->id}/{changetoplus title =$product->name}" class="text-aqua "  target="_blank"  ><i class="glyphicon glyphicon-new-window fontSize9" ></i>
                    <small class="fontSize9">لینک محصول در سایت</small></a>
            </div>
            <div class="col-md-6" >
                <a href="/gadmin/menu/new?title={$product->name|truncate:35:"":true}&link=/product/show/{$product->id}/{changetoplus title =$product->pg_title}" class="text-light "  ><i class="glyphicon glyphicon glyphicon-list " ></i>
                    <small class="fontSize9">ایجاد منو برای محصول</small></a>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                
                    <label>
                    
{$group_name->pg_title} - {$group_name->pg_content}
                    </label>
                    <br>
                    <label> 
                    تعداد بازدید از محصول
                    
{$product->visitor} نفر
<br>
<center>
<img src="/core/module/shop/backend/images/barcode.php?text={$product->barcode}" alt="{$product->barcode}" />
<br>
<span style="font-family: tahoma;font-size: 12px">{$product->barcode}</span>
</center>
                    </label>
               
            </div>
        </div>
        <div class="row" >
            <div class="col-md-8" >
                <i class="fa fa-check-square" ></i>
                وضعیت نمایش محصول
                <div class="clearfix" ></div>
                <p>
                    <input id="switch_status" type="checkbox" class="simple"  data-on-color="success" data-off-color="warning"
                           {if $product->status eq "publish"}checked {/if}
                           name="switch_status"
                           data-on-text="درحال انتشار"
                           data-off-text="در حال بررسی"
                           data-label-width="0"
                            >
                    <input type="hidden" name="status" value="{$product->status}" id="status">
                    <script>
                        $(document).ready(function() {

                            $('input[name="switch_status"]').on('switchChange.bootstrapSwitch', function(event, state) {

                                if ( $('#switch_status').bootstrapSwitch('state'))
                                    $('#status').val("publish");
                                else
                                    $('#status').val("pending");
                            });
                        });
                    </script>
                </p>
                <div class="clearfix" ></div>
            </div>
             <div class="col-md-4" >
             {if $product->default_photo eq "0"}
             تصویر شاخص نامشخص
             {else}
             <img src="{$product->default_photo}" >
             {/if}
             </div>
        </div>

        </p>
    </div>
</div>
<!--  ******  -->