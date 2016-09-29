<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:32:58
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/comment/boxComment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160419092257abcec2769028-49586127%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5565805e11353cf80f242702e31d81642d141d9f' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/comment/boxComment.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160419092257abcec2769028-49586127',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/gcms.dev/public_html/core/libs/smarty/plugins/modifier.truncate.php';
?><!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu hidden-xs hidden-sm">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope"></i>
        <span class="label label-success"><?php echo count($_smarty_tpl->getVariable('allPendingComments')->value);?>
</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">
            <?php if (count($_smarty_tpl->getVariable('allPendingComments')->value)==0){?>
                هیچ دیدگاه جدیدی وجود ندارد.
                <?php }else{ ?>
<?php echo count($_smarty_tpl->getVariable('allPendingComments')->value);?>

 دیدگاه جدید منتظر تایید شما است.
            <?php }?>
        </li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <li>
                    <?php  $_smarty_tpl->tpl_vars['allPendingComment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allPendingComments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['allPendingComment']->key => $_smarty_tpl->tpl_vars['allPendingComment']->value){
?>
                    <a href="/gadmin/comment/edit/<?php echo $_smarty_tpl->getVariable('allPendingComment')->value->id;?>
">
                        <div class="pull-left">
                            <img src="<?php echo $_smarty_tpl->getVariable('loct')->value;?>
/img/default-avatar.png" class="img-circle" />
                        </div>
                        <h4>
<?php echo $_smarty_tpl->getVariable('allPendingComment')->value->cm_author;?>

                            <small><i class="fa fa-clock-o"></i> <?php echo jdate(" l j F Y",strtotime($_smarty_tpl->getVariable('allPendingComment')->value->cm_date));?>
</small>
                        </h4>
                        <div class="clearfix" ></div>
                        <p>
                            <?php echo smarty_modifier_truncate($_smarty_tpl->getVariable('allPendingComment')->value->cm_content,130,"..",true);?>

                        </p>
                    </a>
                    <?php }} ?>
                </li>
            </ul>
        </li>
        <li class="footer"><a href="/gadmin/comment/">
                مشاهده همه‌ی دیدگاه‌ها
        </a></li>
    </ul>
</li>