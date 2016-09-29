<?php /* Smarty version Smarty-3.0.8, created on 2016-08-31 21:47:12
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/page/index/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:64359377057c71118a15022-85400917%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72727374972a626e9a31776fa68780ffe921b654' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/page/index/content.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64359377057c71118a15022-85400917',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            لیست صفحات
        </h3>
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/search.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/pageFilter.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/pageParent.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </div><!-- /.box-header -->
    <div class="box-body no-padding">

        <div class="row" >
            <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('pages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value){
?>
                <div class="col-md-6 " >
                    <!-- Warning box -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">
                                <a href="/gadmin/page/edit/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
" >
                                    <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('page')->value->pg_title,43,"..",true);?>

                                </a>
                            </h3>
                            <div class="box-tools pull-left">
                                <?php if ($_smarty_tpl->getVariable('page')->value->pg_status=="publish"){?>
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" onclick="location.href='?pgStatus=pending&pgId=<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
'" title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('page')->value->pg_status=="pending"){?>
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" onclick="location.href='?pgStatus=publish&pgId=<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
'" title=" در دست بررسی " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('page')->value->comment_status=="open"){?>
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" onclick="location.href='?commentStatus=close&pgId=<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
'" title=" دیدگاه‌ها فعال " >
                                        <i class="ace-icon fa fa-comments bigger-120"></i>
                                    </button>
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('page')->value->comment_status=="close"){?>
                                    <button class="btn btn-xs " data-toggle="tooltip" data-placement="top" onclick="location.href='?commentStatus=open&pgId=<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
'" title=" دیدگاه‌ها غیرفعال " >
                                        <i class="ace-icon fa fa-comments bigger-120"></i>
                                    </button>
                                <?php }?>
                                <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/page/edit/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
'" title=" ویرایش ">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-danger" id="DelPageBtt<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
" data-toggle="tooltip" data-placement="top"  title=" حذف ">
                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </button>
                                <script>
                                    $(document).on("click", "#DelPageBtt<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
", function(e) {
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
                            </div>
                        </div>
                        <div class="box-body GCMSblock">
                            <p>
                                <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('page')->value->id,'type'=>"page",'thumb'=>"thumb/",'class'=>"indx",'source'=>"true"),$_smarty_tpl);?>
" class="img-thumbnail pull-left" width="115" >
                                <?php if ($_smarty_tpl->getVariable('page')->value->parent_id){?>
                                    <a href="/gadmin/page/edit/<?php echo $_smarty_tpl->getVariable('page')->value->parent_id;?>
" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" صفحه والد " ><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('page')->value->parent_id,'chagetoplus'=>"false"),$_smarty_tpl);?>
 </span></a>
                                    <br><i class="fa fa-level-up"></i>
                                    <small><?php echo $_smarty_tpl->getVariable('page')->value->pg_title;?>
</small>
                                <?php }?>
                                <br>
                    <span data-toggle="tooltip" data-placement="left" title=" تاریخ آخرین تغییر "><i class="fa fa-clock-o" ></i>
                        <small><?php echo jdate("y/m/d",strtotime($_smarty_tpl->getVariable('page')->value->date_modified));?>
</small>
                    </span>
                                <br>
                                <div class="clearfix" ></div>
                            </p>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            <?php }} ?>
        </div>


    </div><!-- /.box-body -->
    <div class="box-footer clearfix">
        <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/paging.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    </div>
</div><!-- /.box -->