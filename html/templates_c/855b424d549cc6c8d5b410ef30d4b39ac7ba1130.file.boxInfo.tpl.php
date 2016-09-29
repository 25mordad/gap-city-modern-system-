<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 19:57:59
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/boxInfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167919332057cc3d7f5663e6-91351996%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '855b424d549cc6c8d5b410ef30d4b39ac7ba1130' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/edit/boxInfo.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167919332057cc3d7f5663e6-91351996',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            اطلاعات صفحه
        </h3>
    </div>
    <div class="box-body">
        <p>

            <span data-toggle="tooltip" data-placement="left" title=" نویسنده "><i class="fa fa-pencil" ></i> <?php echo $_smarty_tpl->getVariable('operator')->value->name;?>
</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ ایجاد صفحه "><i class="fa fa-clock-o" ></i> <?php echo jdate(" l j F Y",strtotime($_smarty_tpl->getVariable('page')->value->date_created));?>
</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ آخرین تغییر "><i class="fa fa-clock-o" ></i> <?php echo jdate(" l j F Y",strtotime($_smarty_tpl->getVariable('page')->value->date_modified));?>
</span>
            <br>
            <?php if ($_smarty_tpl->getVariable('page')->value->pg_status!="delete"){?>
                <a href="#" id="DelPageBtt" class="btn btn-danger btn-sm " role="button">حذف صفحه</a>
            <?php }else{ ?>
                <a href="#" id="unDelPageBtt" class="btn btn-warning btn-sm " role="button">بازیابی صفحه</a>
            <?php }?>

            <script>
                $(document).on("click", "#unDelPageBtt", function(e) {
                    bootbox.dialog ({
                        message: " آیا از بازیابی این صفحه مطمئن هستید؟  ",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-danger",
                                callback: function() {
                                    window.location.href = "/gadmin/page/undel/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
";
                                }
                            },
                            main: {
                                label: "انصراف",
                                className: "btn-primary"
                            }
                        }
                    })
                });
                $(document).on("click", "#DelPageBtt", function(e) {
                    bootbox.dialog ({
                        message: " آیا از حذف این صفحه مطمئن هستید؟  ",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-danger",
                                callback: function() {
                                    window.location.href = "/gadmin/page/del/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
";
                                }
                            },
                            main: {
                                label: "انصراف",
                                className: "btn-primary"
                            }
                        }
                    })
                });
            </script>

        </p>
    </div>
</div>
<!--  ******  -->
