<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:06:59
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/comment/edit/boxEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35942115557d2123ba5c4b7-25105362%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '435e68d9aae27ed3df96e050e0d42a5988c8a66f' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/comment/edit/boxEdit.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35942115557d2123ba5c4b7-25105362',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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
                           <?php if ($_smarty_tpl->getVariable('comment')->value->cm_status=="publish"){?>checked <?php }?>
                           name="switch_cm_status"
                           data-on-text="درحال انتشار"
                           data-off-text="در حال بررسی"
                           data-label-width="0"
                            >
                    <input type="hidden" name="cm_status" value="<?php echo $_smarty_tpl->getVariable('comment')->value->cm_status;?>
" id="cm_status">
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