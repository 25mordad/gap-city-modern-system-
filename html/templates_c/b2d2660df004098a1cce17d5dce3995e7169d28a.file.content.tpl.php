<?php /* Smarty version Smarty-3.0.8, created on 2016-08-25 04:31:45
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/box/index/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110386783657be3569998a43-13442220%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b2d2660df004098a1cce17d5dce3995e7169d28a' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/box/index/content.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110386783657be3569998a43-13442220',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><div class="box box-primary">
    <div class="box-body no-padding">

        <div class="row" >
            <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('boxes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value){
?>
                <div class="col-md-6 " >
                    <!-- Warning box -->
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">
                                <a href="/gadmin/box/edit/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
" >
                                    <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('page')->value->box_title,43,"..",true);?>

                                </a>
                            </h3>
                            <div class="box-tools pull-left">
                                <?php if ($_smarty_tpl->getVariable('page')->value->box_status=="publish"){?>
                                    <button class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top"  title=" انتشاریافته " >
                                        <i class="ace-icon fa fa-check bigger-120"></i>
                                    </button>
                                <?php }?>
                                <?php if ($_smarty_tpl->getVariable('page')->value->box_status=="pending"){?>
                                    <button class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top"  title=" در دست بررسی " >
                                        <i class="ace-icon fa fa-close bigger-120"></i>
                                    </button>
                                <?php }?>

                                <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/box/edit/<?php echo $_smarty_tpl->getVariable('page')->value->id;?>
'" title=" ویرایش ">
                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body GCMSblock">
                            <p>
                                <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('page')->value->id,'type'=>"box",'thumb'=>"thumb/",'class'=>"indx",'source'=>"true"),$_smarty_tpl);?>
" class="img-thumbnail pull-left" width="115" >
                                <?php if ($_smarty_tpl->getVariable('page')->value->parent_id){?>
									<?php if ($_smarty_tpl->getVariable('page')->value->parent_id=="1"){?>
									<a href="/gadmin/page/page_index/1" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" صفحه والد " ><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('page')->value->parent_id,'chagetoplus'=>"false"),$_smarty_tpl);?>
 </span></a>									
									<?php }else{ ?>
                                    <a href="/gadmin/page/edit/<?php echo $_smarty_tpl->getVariable('page')->value->parent_id;?>
" >  <span class="text-red " data-toggle="tooltip" data-placement="left" title=" صفحه والد " ><?php echo smarty_function_showtitle(array('id'=>$_smarty_tpl->getVariable('page')->value->parent_id,'chagetoplus'=>"false"),$_smarty_tpl);?>
 </span></a>
                                    <?php }?>
									<br><i class="fa fa-level-up"></i>
                                    <small><?php echo $_smarty_tpl->getVariable('page')->value->box_title;?>
</small>
                                <?php }else{ ?>
                                    <br><i class="fa fa-level-up"></i>
                                    <small>
                                        نمایش در تمام صفحات
                                    </small>
                                <?php }?>

                                <div class="clearfix" ></div>
                            </p>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            <?php }} ?>
        </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->