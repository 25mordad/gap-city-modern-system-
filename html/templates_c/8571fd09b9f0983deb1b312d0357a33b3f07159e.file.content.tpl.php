<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 08:05:47
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/index/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45995398357b92193420a30-45415482%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8571fd09b9f0983deb1b312d0357a33b3f07159e' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/index/content.tpl',
      1 => 1471750546,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45995398357b92193420a30-45415482',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
            لیست محصولات
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
            <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
                <div class="col-md-6 " >
                    <!-- Warning box -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">
                                <a href="/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" >
                                    <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('product')->value->fa_title,43,"..",true);?>

                                </a>
                            </h3>
                            <div class="box-tools pull-left">
                                <?php if ($_smarty_tpl->getVariable('product')->value->status=="publish"){?>
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top"  title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('product')->value->status=="pending"){?>
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top"  title=" در دست بررسی " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                <?php }?>

                                <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
'" title=" ویرایش ">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>


                            </div>
                        </div>
                        <div class="box-body GCMSblock">
                            <p>
                            	<?php if ($_smarty_tpl->getVariable('product')->value->default_photo!="0"){?>
                                <img src="<?php echo $_smarty_tpl->getVariable('product')->value->default_photo;?>
" class="img-thumbnail pull-left" width="115" >
                                <?php }?>
                                <i class="fa fa-level-up"></i> <span class="text-red " data-toggle="tooltip" data-placement="left" title=" گروه محصولی " ><?php echo smarty_function_get_page(array('id'=>$_smarty_tpl->getVariable('product')->value->group_id),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('getpage')->value->pg_content;?>
 </span>
                                <br>
                    <span data-toggle="tooltip" data-placement="left" title=" قیمت "><i class="fa fa-dollar" ></i>
                        <small><?php echo number_format($_smarty_tpl->getVariable('product')->value->price);?>
</small>
                    </span>
                                
                                <br>
                    <span data-toggle="tooltip" data-placement="left" title=" تعداد "><i class="fa fa-cubes" ></i>
                        <small><?php echo number_format($_smarty_tpl->getVariable('product')->value->quantity);?>
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