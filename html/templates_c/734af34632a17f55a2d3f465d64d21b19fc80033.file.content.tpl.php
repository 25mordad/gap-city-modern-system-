<?php /* Smarty version Smarty-3.0.8, created on 2016-08-15 21:52:12
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/brand/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:211165545357b1fa44ef88d0-07751644%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '734af34632a17f55a2d3f465d64d21b19fc80033' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/brand/content.tpl',
      1 => 1471274561,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '211165545357b1fa44ef88d0-07751644',
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

                                    <a href="/gadmin/shop/brand/" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" گروه والد " ><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('group')->value->parent_id,'chagetoplus'=>"false"),$_smarty_tpl);?>
 </span></a>
                                    <br><i class="fa fa-level-up"></i>
                                <?php }?>
                                <?php echo $_smarty_tpl->getVariable('group')->value->pg_title;?>

                            </td>
                           <td>
                                <?php echo $_smarty_tpl->getVariable('group')->value->pg_content;?>

                            </td>
							<td>
                                <?php echo $_smarty_tpl->getVariable('group')->value->pg_order;?>

                            </td>

                            <td>

								
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/shop/brand/?edit=<?php echo $_smarty_tpl->getVariable('group')->value->id;?>
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
                                
                             
                            </td>
                        </tr>

                    <?php }} ?>
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>