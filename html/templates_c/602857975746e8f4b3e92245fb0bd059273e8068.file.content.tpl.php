<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 01:43:50
         compiled from "/var/www/gcms.dev/public_html/core/module/module/backend/tpl/module/index/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:73628062857cde00eaf1165-33466634%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '602857975746e8f4b3e92245fb0bd059273e8068' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/module/backend/tpl/module/index/content.tpl',
      1 => 1447715354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '73628062857cde00eaf1165-33466634',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
لیست ماژول ها
                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm color-white" href="/gadmin/module/new">
                        ایجاد ماژول جدید
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
نام ماژول
                        </th>
                        <th>
وضعیت
                        </th>

                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('modules')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->getVariable('module')->value->module_name;?>
</td>
                        <td><?php echo $_smarty_tpl->getVariable('module')->value->status;?>
</td>

                        <td>
                            <?php if ($_smarty_tpl->getVariable('module')->value->status=="active"){?>
                                <button class="btn btn-xs btn-success" onclick="location.href='/gadmin/module/change_status/<?php echo $_smarty_tpl->getVariable('module')->value->id;?>
?status=<?php echo $_smarty_tpl->getVariable('module')->value->status;?>
'" data-toggle="tooltip" data-placement="top"  title=" فعال " >
                                    <i class="ace-icon fa fa-check bigger-120"></i>
                                </button>
                            <?php }else{ ?>
                                <button class="btn btn-xs btn-warning" onclick="location.href='/gadmin/module/change_status/<?php echo $_smarty_tpl->getVariable('module')->value->id;?>
?status=<?php echo $_smarty_tpl->getVariable('module')->value->status;?>
'" data-toggle="tooltip" data-placement="top"  title=" غیرفعال  " >
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