<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 05:58:18
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/menu/index/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:89065672557cb78b249e8f7-89767428%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8b502d2b6e2ddfb3003cfea8585dfeb091be4b6' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/menu/index/content.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '89065672557cb78b249e8f7-89767428',
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
لیست منوها
                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm color-white" href="/gadmin/menu/new">
                        ایجاد منو جدید
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
ترتیب منو
                        </th>
                        <th>
عنوان منو
                        </th>
                        <th>
منوی مادر
                        </th>

                        <th>

                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  $_smarty_tpl->tpl_vars['menu'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menus')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['menu']->key => $_smarty_tpl->tpl_vars['menu']->value){
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->getVariable('menu')->value->order;?>
</td>
                        <td><?php echo $_smarty_tpl->getVariable('menu')->value->title;?>
</td>
                        <td><?php if ($_smarty_tpl->getVariable('menu')->value->parent){?><a href="menu/edit/<?php echo $_smarty_tpl->getVariable('menu')->value->parent;?>
"><?php echo $_smarty_tpl->getVariable('main_menu')->value[$_smarty_tpl->getVariable('menu')->value->parent];?>
</a><?php }else{ ?>ندارد<?php }?></td>
                        <td>
                            <button class="btn btn-xs bg-navy" data-toggle="tooltip" data-placement="top" onclick="window.open('<?php echo $_smarty_tpl->getVariable('menu')->value->link;?>
','_blank')" title=" لینک منو ">
                                <i class="ace-icon fa fa-external-link-square bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" onclick="location.href='/gadmin/menu/edit/<?php echo $_smarty_tpl->getVariable('menu')->value->id;?>
'" title=" ویرایش ">
                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                            </button>
                            <button class="btn btn-xs btn-danger" id="DelMenuBtt<?php echo $_smarty_tpl->getVariable('menu')->value->id;?>
" data-toggle="tooltip" data-placement="top"  title=" حذف ">
                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                            </button>
                            <script>
                                $(document).on("click", "#DelMenuBtt<?php echo $_smarty_tpl->getVariable('menu')->value->id;?>
", function(e) {
                                    bootbox.dialog ({
                                        message: " آیا از حذف این منو مطمئن هستید؟  ",
                                        buttons: {
                                            success: {
                                                label: "بله",
                                                className: "btn-danger",
                                                callback: function() {
                                                    window.location.href = "/gadmin/menu/del/<?php echo $_smarty_tpl->getVariable('menu')->value->id;?>
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
                        </td>
                    </tr>
                    <?php }} ?>
                    </tbody></table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>