<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 19:01:38
         compiled from "/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/index/pageParent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:129257928557ced34a7350a3-71293411%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b864d9c045140c3adbab2e2fbe582043863ea5f9' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/news/backend/tpl/news/index/pageParent.tpl',
      1 => 1447715352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129257928557ced34a7350a3-71293411',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="box-tools pull-left">
    <div >

        <form method="get" action="/gadmin/news/?"  >
            <div class="input-group input-group-sm">
                    <span class="input-group-btn" >
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-filter"></i></button>
                     </span>
                <select class="form-control" name="f_parent" id="f_parent">
                    <option value="all"> نمایش همه صفحات </option>
                    <?php  $_smarty_tpl->tpl_vars['sp'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('select_group')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sp']->key => $_smarty_tpl->tpl_vars['sp']->value){
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['sp']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['sp']->value['value']==$_GET['f_parent']){?> selected="selected" <?php }?> ><?php echo $_smarty_tpl->tpl_vars['sp']->value['name'];?>
</option>
                    <?php }} ?>
                </select>

                <?php if ($_GET['f_parent']!="all"){?><span class="input-group-addon btn btn-danger"
                                                        data-toggle="tooltip" data-placement="right" title=" حذف فیلتر صفحه مادر "
                                                        onclick="window.location = '?paging=1&search=<?php echo $_GET['search'];?>
&f_parent=all&f_status=<?php echo $_GET['f_status'];?>
'"><i class="fa  fa-close " style="color: white"></i></span><?php }?>
            </div>
            <input type="hidden" name="paging" value="1" />
            <input type="hidden" name="f_status" value="<?php echo $_GET['f_status'];?>
" />
            <input type="hidden" name="search" value="<?php echo $_GET['search'];?>
" />
        </form>
    </div>
</div>