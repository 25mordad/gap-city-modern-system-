<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:06:59
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/comment/edit/boxInfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:96965565157d2123ba6ee79-11264227%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2097c58c07f9fd9eb2d46696feeb8bd99ab76e47' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/comment/edit/boxInfo.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '96965565157d2123ba6ee79-11264227',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            اطلاعات دیدگاه
        </h3>
    </div>
    <div class="box-body">
        <p>

            <span data-toggle="tooltip" data-placement="left" title=" نویسنده "><i class="fa fa-pencil" ></i> <?php echo $_smarty_tpl->getVariable('comment')->value->cm_author;?>
</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" ایمیل "><i class="fa fa-envelope" ></i> <?php echo $_smarty_tpl->getVariable('comment')->value->cm_email;?>
</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" کشور ">
            <img src="http://ipinfodb.com/img/flags/<?php echo strtolower($_smarty_tpl->getVariable('countryCode')->value['countryCode']);?>
.gif" /> <?php echo $_smarty_tpl->getVariable('countryCode')->value['countryName'];?>

            </span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" شهر "><i class="fa fa-map-marker" ></i> <?php echo $_smarty_tpl->getVariable('countryCode')->value['regionName'];?>
 | <?php echo $_smarty_tpl->getVariable('countryCode')->value['cityName'];?>
</span>
            <br>
            <span class="verdana" data-toggle="tooltip" data-placement="left" title=" شناسه "> <?php echo $_smarty_tpl->getVariable('comment')->value->cm_ip;?>
</span>
            <br>
            <span data-toggle="tooltip" data-placement="left" title=" تاریخ ارسال "><i class="fa fa-clock-o" ></i> <?php echo jdate(" l j F Y",strtotime($_smarty_tpl->getVariable('comment')->value->cm_date));?>
</span>
            <br>
            <?php $_smarty_tpl->tpl_vars['arr_types'] = new Smarty_variable(array('page'=>"صفحات",'news'=>"اخبار",'gallery'=>"گالری عکس",'sound'=>"گالری صوتی"), null, null);?>
            <span data-toggle="tooltip" data-placement="left" title="  مکان (بخش » صفحه)  "><?php echo $_smarty_tpl->getVariable('arr_types')->value[$_smarty_tpl->getVariable('comment')->value->cm_type];?>
 &raquo; <a href="/gadmin/<?php echo $_smarty_tpl->getVariable('comment')->value->cm_type;?>
/edit/<?php echo $_smarty_tpl->getVariable('comment')->value->id_other;?>
"><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('comment')->value->id_other,'chagetoplus'=>"false"),$_smarty_tpl);?>
</a></span>
            <br>
            <?php if ($_smarty_tpl->getVariable('comment')->value->cm_status!="delete"){?>
                <a href="#" id="DelCommentBtt" class="btn btn-danger btn-sm " role="button">حذف دیدگاه</a>
            <?php }else{ ?>
                <a href="#" id="unDelCommentBtt" class="btn btn-warning btn-sm " role="button">بازیابی دیدگاه</a>
            <?php }?>

            <script>
                $(document).on("click", "#unDelCommentBtt", function(e) {
                    bootbox.dialog ({
                        message: " آیا از بازیابی این دیدگاه مطمئن هستید؟  ",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-danger",
                                callback: function() {
                                    window.location.href = "/gadmin/comment/undel/<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
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
                $(document).on("click", "#DelCommentBtt", function(e) {
                    bootbox.dialog ({
                        message: " آیا از حذف این دیدگاه مطمئن هستید؟  ",
                        buttons: {
                            success: {
                                label: "بله",
                                className: "btn-danger",
                                callback: function() {
                                    window.location.href = "/gadmin/comment/del/<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
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
