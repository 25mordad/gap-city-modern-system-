<!-- ****** -->
<div class="box box-solid box-info">
    <div class="box-header">
        <h3 class="box-title">
            ویرایش بلوک
        </h3>
    </div>
    <div class="box-body">
        <p>
            <button class="btn btn-success btn-block btn-flat">
                ثبت
            </button>
        <div class="clearfix" ></div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                <div class="form-group">
                    <label>
                        صفحه مادر
                    </label>
                    <select class="form-control" name="parent_id" id="parent_id">
                        <option value="0"> نمایش در تمام صفحات </option>
						{if $sp['value'] eq "1"} <option value="1"> نمایش در صفحه نخست </option>{/if}
                        {foreach $select_parent as $sp}
                        	{if $box->parent_id eq "1"} <option value="1" selected="selected" > نمایش در صفحه نخست </option>{/if}
                                <option value="{$sp['value']}" {if $sp['value'] eq $box->parent_id} selected="selected" {/if} >{$sp['name']}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                <i class="fa fa-check-square" ></i>
                وضعیت بلوک
                <div class="clearfix" ></div>
                <p>
                    <input id="switch_box_status" type="checkbox" class="simple"  data-on-color="success" data-off-color="warning"
                           {if $box->box_status eq "publish"}checked {/if}
                           name="switch_box_status"
                           data-on-text="درحال انتشار"
                           data-off-text="در حال بررسی"
                           data-label-width="0"
                            >
                    <input type="hidden" name="box_status" value="{$box->box_status}" id="box_status">
                    <script>
                        $(document).ready(function() {

                            $('input[name="switch_box_status"]').on('switchChange.bootstrapSwitch', function(event, state) {

                                if ( $('#switch_box_status').bootstrapSwitch('state'))
                                    $('#box_status').val("publish");
                                else
                                    $('#box_status').val("pending");
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