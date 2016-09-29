<!-- ****** -->
<div class="box box-solid box-info">
    <div class="box-header">
        <h3 class="box-title">
            ویرایش دیدگاه
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
                <i class="fa fa-check-square" ></i>
                وضعیت دیدگاه
                <div class="clearfix" ></div>
                <p>
                    <input id="switch_cm_status" type="checkbox" class="simple"  data-on-color="success" data-off-color="warning"
                           {if $comment->cm_status eq "publish"}checked {/if}
                           name="switch_cm_status"
                           data-on-text="درحال انتشار"
                           data-off-text="در حال بررسی"
                           data-label-width="0"
                            >
                    <input type="hidden" name="cm_status" value="{$comment->cm_status}" id="cm_status">
                    <script>
                        $(document).ready(function() {

                            $('input[name="switch_cm_status"]').on('switchChange.bootstrapSwitch', function(event, state) {

                                if ( $('#switch_cm_status').bootstrapSwitch('state'))
                                    $('#cm_status').val("publish");
                                else
                                    $('#cm_status').val("pending");
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