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
                <a href="/product/show/{$product->id}/{changetoplus title =$product->name}" class="text-aqua "  target="_blank"  ><i class="glyphicon glyphicon-new-window fontSize9" ></i>
                    <small class="fontSize9">لینک محصول در سایت</small></a>
            </div>
            <div class="col-md-6" >
                <a href="/gadmin/menu/new?title={$product->name|truncate:35:"":true}&link=/product/show/{$product->id}/{changetoplus title =$product->pg_title}" class="text-light "  ><i class="glyphicon glyphicon glyphicon-list " ></i>
                    <small class="fontSize9">ایجاد منو برای محصول</small></a>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                <div class="form-group">
                    <label>
گروه محصولی
                    </label>
                    <select class="form-control" name="group_id" id="group_id" disabled>
                        {foreach $select_parent as $sp}
                                <option value="{$sp['value']}" {if $sp['value'] eq $product->group_id} selected="selected" {/if} >{$sp['name']}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                <i class="fa fa-check-square" ></i>
                وضعیت محصول
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
        </div>

        </p>
    </div>
</div>
<!--  ******  -->