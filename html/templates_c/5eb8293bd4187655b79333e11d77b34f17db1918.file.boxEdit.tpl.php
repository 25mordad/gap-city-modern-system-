<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:58:19
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/edit/boxEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:184484194457ced283344f50-31249050%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5eb8293bd4187655b79333e11d77b34f17db1918' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/edit/boxEdit.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '184484194457ced283344f50-31249050',
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
            ویرایش خبر
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
                <a href="/news/show/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('page')->value->pg_title),$_smarty_tpl);?>
" class="text-aqua "  target="_blank"  ><i class="glyphicon glyphicon-new-window fontSize9" ></i>
                    <small class="fontSize9">لینک خبر در سایت</small></a>
            </div>
            <div class="col-md-6" >
                <a href="/gadmin/menu/new?title=<?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('page')->value->pg_title,35,'',true);?>
&link=/news/show/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('page')->value->pg_title),$_smarty_tpl);?>
" class="text-light "  ><i class="glyphicon glyphicon glyphicon-list " ></i>
                    <small class="fontSize9">ایجاد منو برای خبر</small></a>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                <div class="form-group">
                    <label>
گروه خبری مادر
                    </label>
                    <select class="form-control" name="parent_id" id="parent_id">
                        <?php  $_smarty_tpl->tpl_vars['sp'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('select_group')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sp']->key => $_smarty_tpl->tpl_vars['sp']->value){
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['sp']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['sp']->value['value']==$_smarty_tpl->getVariable('page')->value->parent_id){?> selected="selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['sp']->value['name'];?>
</option>
                        <?php }} ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                <i class="fa fa-check-square" ></i>
وضعیت نمایش خبر
                <div class="clearfix" ></div>
                <p>
                    <input id="switch_pg_status" type="checkbox" class="simple"  data-on-color="success" data-off-color="warning"
                           <?php if ($_smarty_tpl->getVariable('page')->value->pg_status=="publish"){?>checked <?php }?>
                           name="switch_pg_status"
                           data-on-text="درحال انتشار"
                           data-off-text="در حال بررسی"
                           data-label-width="0"
                            >
                    <input type="hidden" name="pg_status" value="<?php echo $_smarty_tpl->getVariable('page')->value->pg_status;?>
" id="pg_status">
                    <script>
                        $(document).ready(function() {

                            $('input[name="switch_pg_status"]').on('switchChange.bootstrapSwitch', function(event, state) {

                                if ( $('#switch_pg_status').bootstrapSwitch('state'))
                                    $('#pg_status').val("publish");
                                else
                                    $('#pg_status').val("pending");
                            });
                        });
                    </script>
                </p>
                <div class="clearfix" ></div>
                <i class="fa fa-comments " ></i>

                وضعیت دیدگاه های خبر

                <div class="clearfix" ></div>
                <p>
                    <input id="switch_comment_status" type="checkbox" class="simple"  data-on-color="success" data-off-color="danger"
                           <?php if ($_smarty_tpl->getVariable('page')->value->comment_status=="open"){?>checked <?php }?>
                           name="switch_comment_status"
                           data-on-text=" باز "
                           data-off-text=" بسته "
                           data-label-width="0"
                            >
                    <input type="hidden" name="comment_status" value="<?php echo $_smarty_tpl->getVariable('page')->value->comment_status;?>
" id="comment_status">
                    <script>
                        $(document).ready(function() {

                            $('input[name="switch_comment_status"]').on('switchChange.bootstrapSwitch', function(event, state) {

                                if ( $('#switch_comment_status').bootstrapSwitch('state'))
                                    $('#comment_status').val("open");
                                else
                                    $('#comment_status').val("close");
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