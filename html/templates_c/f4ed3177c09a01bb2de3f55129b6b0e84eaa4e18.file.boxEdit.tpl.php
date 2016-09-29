<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 23:11:36
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/boxEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:123352111757b9f5e05a1b62-47963961%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4ed3177c09a01bb2de3f55129b6b0e84eaa4e18' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/boxEdit.tpl',
      1 => 1471791644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123352111757b9f5e05a1b62-47963961',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><!-- ****** -->
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
                <a href="/shop/show/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('product')->value->name),$_smarty_tpl);?>
" class="text-aqua "  target="_blank"  ><i class="glyphicon glyphicon-new-window fontSize9" ></i>
                    <small class="fontSize9">لینک محصول در سایت</small></a>
            </div>
            <div class="col-md-6" >
                <a href="/gadmin/menu/new?title=<?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('product')->value->name,35,'',true);?>
&link=/product/show/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('product')->value->pg_title),$_smarty_tpl);?>
" class="text-light "  ><i class="glyphicon glyphicon glyphicon-list " ></i>
                    <small class="fontSize9">ایجاد منو برای محصول</small></a>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                
                    <label>
                    
<?php echo $_smarty_tpl->getVariable('group_name')->value->pg_title;?>
 - <?php echo $_smarty_tpl->getVariable('group_name')->value->pg_content;?>

                    </label>
                    <br>
                    <label> 
                    تعداد بازدید از محصول
                    
<?php echo $_smarty_tpl->getVariable('product')->value->visitor;?>
 نفر
<br>
<center>
<img src="/core/module/shop/backend/images/barcode.php?text=<?php echo $_smarty_tpl->getVariable('product')->value->barcode;?>
" alt="<?php echo $_smarty_tpl->getVariable('product')->value->barcode;?>
" />
<br>
<span style="font-family: tahoma;font-size: 12px"><?php echo $_smarty_tpl->getVariable('product')->value->barcode;?>
</span>
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
                           <?php if ($_smarty_tpl->getVariable('product')->value->status=="publish"){?>checked <?php }?>
                           name="switch_status"
                           data-on-text="درحال انتشار"
                           data-off-text="در حال بررسی"
                           data-label-width="0"
                            >
                    <input type="hidden" name="status" value="<?php echo $_smarty_tpl->getVariable('product')->value->status;?>
" id="status">
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
             <?php if ($_smarty_tpl->getVariable('product')->value->default_photo=="0"){?>
             تصویر شاخص نامشخص
             <?php }else{ ?>
             <img src="<?php echo $_smarty_tpl->getVariable('product')->value->default_photo;?>
" >
             <?php }?>
             </div>
        </div>

        </p>
    </div>
</div>
<!--  ******  -->