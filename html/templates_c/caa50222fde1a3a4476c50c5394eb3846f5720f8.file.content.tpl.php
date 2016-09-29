<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:42:36
         compiled from "/var/www/gcms.dev/public_html/core/module/product/backend/tpl/product/grouping/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50102864057abd1046458e8-83985569%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'caa50222fde1a3a4476c50c5394eb3846f5720f8' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/product/backend/tpl/product/grouping/content.tpl',
      1 => 1447715354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50102864057abd1046458e8-83985569',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div >
                    <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/form.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
عنوان گروه
                        </th>
                        <th>
توضیحات گروه
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('groups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
?>
                        <tr>
                            <td>
                                <?php if ($_smarty_tpl->getVariable('group')->value->parent_id){?>
                                    <a href="/gadmin/product/grouping/?edit=<?php echo $_smarty_tpl->getVariable('group')->value->parent_id;?>
" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" گروه والد " ><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('group')->value->parent_id,'chagetoplus'=>"false"),$_smarty_tpl);?>
 </span></a>
                                    <br><i class="fa fa-level-up"></i>
                                <?php }?>
                                <?php echo $_smarty_tpl->getVariable('group')->value->pg_title;?>

                            </td>
                           <td>
                                <?php echo $_smarty_tpl->getVariable('group')->value->pg_content;?>

                            </td>

                            <td>


                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/product/grouping/?edit=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    <i class=" fa fa-pencil bigger-120"></i>
                                </button>
                                <?php if ($_smarty_tpl->getVariable('group')->value->pg_status=="publish"){?>
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" onclick="location.href='?status=publish&id=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
'" title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('group')->value->pg_status=="pending"){?>
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" onclick="location.href='?status=pending&id=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
'" title=" در دست بررسی " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                <?php }?>
                                <button class="btn btn-xs btn-warning" onclick="location.href='/gadmin/product/add_param/<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
'" data-toggle="tooltip" data-placement="top"  title=" افزودن پارامتر " >
                                    <i class=" fa fa-plus bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-danger" id="AddProduct<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
"  data-toggle="tooltip" data-placement="top"  title=" افزودن محصول " >
                                    <i class=" fa fa-cart-plus bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/product/?paging=1&search=NULL&f_parent=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
&f_status=all'" data-toggle="tooltip" data-placement="top"  title=" لیست محصولات " >
                                    <i class=" fa fa-list bigger-120"></i>
                                </button>
                                <script>
                                    $(document).on("click", "#AddProduct<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
", function(e) {
                                        bootbox.dialog ({
                                            title: " افزودن محصول به گروه   <?php echo $_smarty_tpl->getVariable('group')->value->pg_title;?>
 ",
                                            message: " <div class='input-group input-group-sm'><form method='post' action='/gadmin/product/new' ><input type='text' name='name' placeholder='نام محصول' class='form-control' ><span class='input-group-btn' > <button type='submit' class='btn btn-primary btn-flat'> ایجاد محصول جدید </button> </span><input type='hidden' name='group_id' value='<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
' ></form> </div>",
                                            buttons: {

                                                main: {
                                                    label: "انصراف",
                                                    className: "btn-danger"
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
        </div><!-- /.box -->
    </div>
</div>