<?php /* Smarty version Smarty-3.0.8, created on 2016-09-25 19:16:09
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/grouping/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151150236257e7f141e05fc8-14611567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd536b3aad0e4bffb377c035187b0c9d6b1d716eb' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/grouping/content.tpl',
      1 => 1474818369,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '151150236257e7f141e05fc8-14611567',
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
نام لاتین
                        </th>
                        <th>
نام فارسی
                        </th>
                        <th>
کد گروه
                        </th>
                        <th>
 ترتیب
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
                                <?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('group')->value->parent_id),$_smarty_tpl);?>

                                    <a href="/gadmin/shop/grouping/?pid=<?php echo $_smarty_tpl->getVariable('getpage')->value->parent_id;?>
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
                                <?php echo $_smarty_tpl->getVariable('group')->value->pg_excerpt;?>

                            </td>
							<td>
                                <?php echo $_smarty_tpl->getVariable('group')->value->pg_order;?>

                            </td>

                            <td>

								<button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/shop/grouping?pid=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
'" data-toggle="tooltip" data-placement="top"  title=" لیست گروه‌های زیرمجموعه " >
                                    <i class=" fa fa-list bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/shop/grouping/?pid=<?php echo $_smarty_tpl->getVariable('group')->value->parent_id;?>
&edit=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
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
                                
                                <button class="btn btn-xs btn-danger" id="AddProduct<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
"  data-toggle="tooltip" data-placement="top"  title=" افزودن محصول " >                                    
                                <i class=" fa fa-cart-plus bigger-120"></i>                                
                                </button>
                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/shop/?paging=1&search=NULL&f_parent=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
&f_status=all'" data-toggle="tooltip" data-placement="top"  title=" لیست محصولات " >
                                    <i class=" fa fa-list bigger-120"></i>
                                </button>
                                <script>
                                    $(document).on("click", "#AddProduct<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
", function(e) {
                                        bootbox.dialog ({
                                            title: " افزودن محصول به گروه   <?php echo $_smarty_tpl->getVariable('group')->value->pg_title;?>
 ",
                                            message: "<div class='row' ><div class='col-md-6' style='background:#CCCCCC' ><h3>اضافه کردن مستقیم محصول</h3><div class='input-group input-group-sm'><form target='_blank' method='post' action='/gadmin/shop/new' ><input type='text' name='name' placeholder='نام محصول' class='form-control' ><span class='input-group-btn' > <button type='submit' class='btn btn-primary btn-flat'> ایجاد محصول جدید </button> </span><input type='hidden' name='group_id' value='<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
' ><input type='hidden' name='barcode' value='<?php echo $_smarty_tpl->getVariable('group')->value->pg_excerpt;?>
' ></form> </div></div>"
                                            +"<div class='col-md-6' ><h3>اضافه کردن از سایت منبع</h3>"
                                            + "<div class='input-group input-group-sm'><form target='_blank' method='post' action='/gadmin/shop/new?import=true' ><input type='text' name='link' placeholder='URL WebSite ' class='form-control' >"
                                            +"<br><div style='padding:5px' >"
                                            +"<label class='col-md-12'><input type='radio' name='type' value='mangooutlet'>Mango Outlet</label>"
                                            +"<label class='col-md-6'><input type='radio' name='type' value='mango'>Mango</label>"
                                            +"<label class='col-md-6'><input type='radio' name='type' value='zara'>Zara</label> "
                                            +"<label class='col-md-6'><input type='radio' name='type' value='mroozi'>Mroozi</label> "
                                            +"</div><span class='input-group-btn' > <button type='submit' class='btn btn-primary btn-flat'> ایجاد محصول جدید </button> </span><input type='hidden' name='group_id' value='<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
' ><input type='hidden' name='barcode' value='<?php echo $_smarty_tpl->getVariable('group')->value->pg_excerpt;?>
' ></form> </div>"
                                            +"</div></div>"
                                            ,
                                            buttons: {

                                                main: {
                                                    label: "انصراف",
                                                    className: "btn-danger"
                                                }
                                            }
                                        })
                                    });
                                </script>
                                <br>
                                
                            </td>
                        </tr>

                    <?php }} ?>
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>