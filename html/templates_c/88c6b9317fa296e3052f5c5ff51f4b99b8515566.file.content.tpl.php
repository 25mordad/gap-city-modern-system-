<?php /* Smarty version Smarty-3.0.8, created on 2016-09-28 22:16:01
         compiled from "/var/www/gcms.dev/public_html/core/module/packaging/backend/tpl/packaging/index/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:63769351457ec0fe93fe824-73145842%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '88c6b9317fa296e3052f5c5ff51f4b99b8515566' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/packaging/backend/tpl/packaging/index/content.tpl',
      1 => 1475088360,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '63769351457ec0fe93fe824-73145842',
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
نماینده فروش
                        </th>
                        <th>
مسوول ارسال
                        </th>
                        <th>
تاریخ ارسال
                        </th>
                        
                    </tr>
                    </thead>
                    <tbody>
                    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('packs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
?>
                        <tr>
                            <td>
                                
                                <?php echo smarty_function_get_user_name(array('id_user'=>$_smarty_tpl->getVariable('row')->value->pg_title),$_smarty_tpl);?>
 
                                <?php echo smarty_function_get_user_params(array('id_user'=>$_smarty_tpl->getVariable('row')->value->pg_title,'name'=>"55"),$_smarty_tpl);?>

                                -
                                <?php echo $_smarty_tpl->getVariable('getuser')->value->username;?>
 
                            </td>
                           <td>
                                <?php echo $_smarty_tpl->getVariable('row')->value->pg_content;?>

                            </td>
							<td>
                                <?php echo date("Y-m-d",strtotime($_smarty_tpl->getVariable('row')->value->date_modified));?>
 /  <?php echo jdate("Y-m-d",strtotime($_smarty_tpl->getVariable('row')->value->date_modified));?>

                            </td>

                            <td>

								
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/packaging/?edit=<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    <i class=" fa fa-pencil bigger-120"></i>
                                </button>
                                <button class="btn btn-xs btn-primary" onclick="location.href='/gadmin/packaging/products/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
'" data-toggle="tooltip" data-placement="top"  title=" اضافه کردن محصول به بسته " >
                                    <i class=" fa fa-plus bigger-120"></i>
                                </button>
                                <?php if ($_smarty_tpl->getVariable('row')->value->pg_status=="publish"){?>
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" onclick="location.href='?status=publish&id=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
'" title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('row')->value->pg_status=="pending"){?>
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" onclick="location.href='?status=pending&id=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
'" title=" در حال ارسال  " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                <?php }?>
                                
                             
                            </td>
                        </tr>

                    <?php }} ?>
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>