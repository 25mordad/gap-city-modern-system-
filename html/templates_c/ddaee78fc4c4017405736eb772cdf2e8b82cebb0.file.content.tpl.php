<?php /* Smarty version Smarty-3.0.8, created on 2016-09-27 18:47:22
         compiled from "/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/index/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:84918389157ea8d8249d425-29673482%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddaee78fc4c4017405736eb772cdf2e8b82cebb0' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/user/backend/tpl/user/index/content.tpl',
      1 => 1447715360,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '84918389157ea8d8249d425-29673482',
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
                    لیست کاربران
                </h3>
                <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/search.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm color-white" href="/gadmin/user/new">
                        ایجاد کاربر جدید
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
                           نام کاربری
                        </th>
                        <th>
                            ایمیل
                        </th>

                        <th>
نوع کاربر
                        </th>
                        <th>
وضعیت
                        </th>
                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
                        <tr>
                            <td><span <?php if ($_smarty_tpl->getVariable('user')->value->params!=null){?> data-toggle="tooltip" data-placement="top" title="<?php echo $_smarty_tpl->getVariable('user')->value->params;?>
" <?php }?> style="font-family: tahoma"><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('user')->value->username,26,"..",true);?>
</span></td>
                            <td style="font-family: tahoma"><?php if ($_smarty_tpl->getVariable('user')->value->email){?><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('user')->value->email,26,"..",true);?>
<?php }else{ ?>-<?php }?></td>
                            <td><?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('GCMS_USER_LEVEL')->value[$_smarty_tpl->getVariable('user')->value->user_level],12,"..",true);?>
</td>
                            <td><?php if ($_smarty_tpl->getVariable('user')->value->status=="active"){?>فعال<?php }else{ ?>غیرفعال<?php }?></td>

                            <td>
                                <button class="btn btn-xs btn-info" onclick="location.href='/gadmin/user/edit/<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
'" data-toggle="tooltip" data-placement="top"  title=" ویرایش " >
                                    <?php if ($_smarty_tpl->getVariable('user')->value->status=="active"){?><i class="ace-icon fa fa-check bigger-120"></i><?php }else{ ?><i class="ace-icon fa fa-close bigger-120"></i><?php }?>
                                </button>
                                <button class="btn btn-xs btn-warning" onclick="location.href='/gadmin/user/chngpass/<?php echo $_smarty_tpl->getVariable('user')->value->id;?>
'" data-toggle="tooltip" data-placement="top"  title=" تغییر کلمه عبور " >
                                    <i class="ace-icon fa fa-asterisk bigger-120"></i>
                                </button>
                            </td>
                        </tr>
                    <?php }} ?>
                    </tbody></table>
            </div><!-- /.box-body -->
            <div class="box-footer clearfix">
                <?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/paging.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
            </div>
        </div><!-- /.box -->
    </div>
</div>