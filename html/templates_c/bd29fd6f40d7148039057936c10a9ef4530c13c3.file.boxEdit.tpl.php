<?php /* Smarty version Smarty-3.0.8, created on 2016-08-25 04:35:47
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/boxEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:118404234957be365b33cd66-62614166%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd29fd6f40d7148039057936c10a9ef4530c13c3' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/box/edit/boxEdit.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '118404234957be365b33cd66-62614166',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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
						<?php if ($_smarty_tpl->getVariable('sp')->value['value']=="1"){?> <option value="1"> نمایش در صفحه نخست </option><?php }?>
                        <?php  $_smarty_tpl->tpl_vars['sp'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('select_parent')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sp']->key => $_smarty_tpl->tpl_vars['sp']->value){
?>
                        	<?php if ($_smarty_tpl->getVariable('box')->value->parent_id=="1"){?> <option value="1" selected="selected" > نمایش در صفحه نخست </option><?php }?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['sp']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['sp']->value['value']==$_smarty_tpl->getVariable('box')->value->parent_id){?> selected="selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['sp']->value['name'];?>
</option>
                        <?php }} ?>
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
                           <?php if ($_smarty_tpl->getVariable('box')->value->box_status=="publish"){?>checked <?php }?>
                           name="switch_box_status"
                           data-on-text="درحال انتشار"
                           data-off-text="در حال بررسی"
                           data-label-width="0"
                            >
                    <input type="hidden" name="box_status" value="<?php echo $_smarty_tpl->getVariable('box')->value->box_status;?>
" id="box_status">
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