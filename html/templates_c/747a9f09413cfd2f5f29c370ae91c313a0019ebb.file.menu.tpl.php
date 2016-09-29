<?php /* Smarty version Smarty-3.0.8, created on 2016-08-11 05:32:58
         compiled from "/var/www/gcms.dev/public_html/core/backend/tpl/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6239350757abcec2785d14-46114446%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '747a9f09413cfd2f5f29c370ae91c313a0019ebb' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/backend/tpl/menu.tpl',
      1 => 1447715368,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6239350757abcec2785d14-46114446',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<li <?php if ($_smarty_tpl->getVariable('part')->value=="admin"){?>class="active" <?php }?>>
    <a href="/gadmin">
        <i class="fa fa-dashboard"></i> <span>
            میزکار
        </span>
    </a>
</li>
<?php  $_smarty_tpl->tpl_vars['GCMSmenu'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('GCMSmenus')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['GCMSmenu']->key => $_smarty_tpl->tpl_vars['GCMSmenu']->value){
?>
<li class="<?php if (isset($_smarty_tpl->tpl_vars['GCMSmenu']->value['child'])){?>treeview<?php }?><?php if ($_smarty_tpl->getVariable('part')->value==($_smarty_tpl->tpl_vars['GCMSmenu']->value['part'])){?> active<?php }?> " >
    <a href="/gadmin/<?php echo $_smarty_tpl->tpl_vars['GCMSmenu']->value['part'];?>
">
        <i class="<?php echo $_smarty_tpl->tpl_vars['GCMSmenu']->value['icon'];?>
"></i><span><?php echo $_smarty_tpl->tpl_vars['GCMSmenu']->value['title'];?>
</span>
        <?php if (isset($_smarty_tpl->tpl_vars['GCMSmenu']->value['badge'])){?><small class="badge pull-left <?php echo $_smarty_tpl->tpl_vars['GCMSmenu']->value['badgeColor'];?>
"><?php echo $_smarty_tpl->tpl_vars['GCMSmenu']->value['badge'];?>
</small><?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['GCMSmenu']->value['child'])){?><i class="fa fa-angle-left pull-right"></i><?php }?>
    </a>
    <?php if (isset($_smarty_tpl->tpl_vars['GCMSmenu']->value['child'])){?>
        <ul class="treeview-menu">
            <?php  $_smarty_tpl->tpl_vars['GCMSmenuChild'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['GCMSmenu']->value['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['GCMSmenuChild']->key => $_smarty_tpl->tpl_vars['GCMSmenuChild']->value){
?>
                    <li class="<?php if ($_smarty_tpl->getVariable('part')->value==($_smarty_tpl->tpl_vars['GCMSmenu']->value['part'])&&$_smarty_tpl->getVariable('action')->value==($_smarty_tpl->tpl_vars['GCMSmenuChild']->value['action'])){?> active<?php }?> "><a href="/gadmin/<?php echo $_smarty_tpl->tpl_vars['GCMSmenuChild']->value['link'];?>
"><i class="fa fa-angle-double-right"></i> <?php echo $_smarty_tpl->tpl_vars['GCMSmenuChild']->value['title'];?>

                            <?php if (isset($_smarty_tpl->tpl_vars['GCMSmenuChild']->value['badge'])){?><small class="badge pull-left <?php echo $_smarty_tpl->tpl_vars['GCMSmenuChild']->value['badgeColor'];?>
"><?php echo $_smarty_tpl->tpl_vars['GCMSmenuChild']->value['badge'];?>
</small><?php }?>
                        </a></li>
            <?php }} ?>
        </ul>
    <?php }?>

</li>
<?php }} ?>