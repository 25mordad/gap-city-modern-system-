<?php /* Smarty version Smarty-3.0.8, created on 2016-08-28 01:48:08
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/paging.tpl" */ ?>
<?php /*%%SmartyHeaderCode:44196806757c20390499c43-58295065%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78719033cb3c927cd711894c5b2cc98c0cd7d631' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/paging.tpl',
      1 => 1472332645,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44196806757c20390499c43-58295065',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<ul class="pagination no-margin-top">
    <?php if ($_GET['paging']!=1){?><li><a href="<?php echo smarty_function_pagingurl(array('url'=>$_SERVER['REQUEST_URI'],'paging'=>$_GET['paging']-1),$_smarty_tpl);?>
">«</a></li><?php }?>
    <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['num']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['name'] = 'num';
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('paging')->value+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['iteration'] = 1;
            $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['total'];
            $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['num']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['num']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['num']['total']);
?>
    	<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['num']['index']!=$_GET['paging']){?>
    	<li><a href="<?php ob_start();?><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['num']['index'];?>
<?php $_tmp1=ob_get_clean();?><?php echo smarty_function_pagingurl(array('url'=>$_SERVER['REQUEST_URI'],'paging'=>$_tmp1),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['num']['index'];?>
</a></li>
    	<?php }else{ ?>
    	<li class="active"><a href="#"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['num']['index'];?>
</a></li>
    	<?php }?>
    <?php endfor; endif; ?>
    <?php if ($_GET['paging']!=$_smarty_tpl->getVariable('paging')->value){?><li><a href="<?php echo smarty_function_pagingurl(array('url'=>$_SERVER['REQUEST_URI'],'paging'=>$_GET['paging']-1),$_smarty_tpl);?>
">»</a></li><?php }?>
</ul>