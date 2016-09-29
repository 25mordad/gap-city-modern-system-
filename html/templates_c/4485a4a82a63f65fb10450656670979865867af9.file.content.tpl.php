<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:06:39
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/comment/index/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159858637657d212274f0bb8-18671609%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4485a4a82a63f65fb10450656670979865867af9' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/comment/index/content.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159858637657d212274f0bb8-18671609',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
                    لیست دیدگاه‌ها
                </h3>
                <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/search.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
                <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/commentFilter.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
تاریخ
                        </th>
                        <th>
                            دیدگاه
                        </th>
                        <th>
                            مکان (بخش » صفحه)
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $_smarty_tpl->tpl_vars['arr_types'] = new Smarty_variable(array('page'=>"صفحات",'news'=>"اخبار",'gallery'=>"گالری عکس",'sound'=>"گالری صوتی"), null, null);?>
                    <?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('comments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value){
?>
                    <tr>
                        <td>
                            <?php echo jdate(" d / m / Y ",strtotime($_smarty_tpl->getVariable('comment')->value->cm_date));?>

                            <blockquote class="fontSize10">
                                <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('comment')->value->cm_author,16,"..",true);?>
 <br>
                                <i class="fa fa-envelope"></i> <?php echo $_smarty_tpl->getVariable('comment')->value->cm_email;?>

                            </blockquote>
                        </td>
                        <td style="width: 50%"><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('comment')->value->cm_content,230,"..",true);?>
</td>
                        <td>
                            <?php echo $_smarty_tpl->getVariable('arr_types')->value[$_smarty_tpl->getVariable('comment')->value->cm_type];?>
 &raquo; <a href="<?php echo $_smarty_tpl->getVariable('comment')->value->cm_type;?>
/edit/<?php echo $_smarty_tpl->getVariable('comment')->value->id_other;?>
"><?php ob_start();?><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('comment')->value->id_other,'chagetoplus'=>"false"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php echo smarty_modifier_truncate($_tmp1,30,"..",true);?>
</a>
                        </td>

                        <td>
                            <?php if ($_smarty_tpl->getVariable('comment')->value->cm_status=="publish"){?>
                                <button class="btn btn-xs btn-success"  data-toggle="tooltip" data-placement="top"  onclick="location.href='/gadmin/comment/unconfirm/<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
'" title=" انتشاریافته " >
                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                </button>
                            <?php }?>
                            <?php if ($_smarty_tpl->getVariable('comment')->value->cm_status=="pending"){?>
                                <button class="btn btn-xs btn-warning"  data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/comment/confirm/<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
'" title=" در دست بررسی " >
                                    <i class="ace-icon fa fa-close bigger-120"></i>
                                </button>
                            <?php }?>
                            <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/comment/edit/<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
'" title=" ویرایش ">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-danger" id="DelCommentBtt<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
" data-toggle="tooltip" data-placement="top"  title=" حذف ">
                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                            </button>
                            <script>
                                $(document).on("click", "#DelCommentBtt<?php echo $_smarty_tpl->getVariable('comment')->value->id;?>
", function(e) {
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
                        </td>
                    </tr>
                    <?php }} ?>
                    </tbody></table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/paging.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        </div><!-- /.box -->
    </div>
</div>