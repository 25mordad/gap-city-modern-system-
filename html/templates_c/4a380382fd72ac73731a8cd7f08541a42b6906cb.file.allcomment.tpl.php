<?php /* Smarty version Smarty-3.0.8, created on 2016-09-19 04:22:17
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/page/allcomment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:190136437657df28b1030e66-83816024%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a380382fd72ac73731a8cd7f08541a42b6906cb' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/page/allcomment.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190136437657df28b1030e66-83816024',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php  $_smarty_tpl->tpl_vars['all_comment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('all_comments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['all_comment']->key => $_smarty_tpl->tpl_vars['all_comment']->value){
?>
    <div class="well">
        <blockquote>
            <small><cite ><?php echo $_smarty_tpl->getVariable('all_comment')->value->cm_author;?>
</cite ></small>
            <p>
                <?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('all_comment')->value->cm_content);?>
</p>
        </blockquote>
        <small class="pull-left"><?php echo jdate(" l j F Y",strtotime($_smarty_tpl->getVariable('all_comment')->value->cm_date));?>
</small>
    </div>
<?php }} ?>

<?php if (!isset($_GET['commentpaging'])){?>
    <?php if (!isset($_smarty_tpl->tpl_vars['smarty']) || !is_array($_smarty_tpl->tpl_vars['smarty']->value)) $_smarty_tpl->createLocalArrayVariable('smarty', null, null);
$_smarty_tpl->tpl_vars['smarty']->value['get']['commentpaging'] = 1;?>
<?php }?>

<ul  class="pagination pagination-mini pagination-left">
        <?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['count']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['name'] = 'count';
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['start'] = (int)0;
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('commentpaging')->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['iteration'] = 1;
            $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['total'];
            $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['count']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['count']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['count']['total']);
?>
            <?php if ($_GET['commentpaging']==$_smarty_tpl->getVariable('smarty')->value['section']['count']['index']+1){?>
                <li class="disabled active"><a href="?commentpaging=<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['count']['index']+1;?>
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['count']['index']+1;?>
</a></li>
            <?php }else{ ?>
                <li><a href="?commentpaging=<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['count']['index']+1;?>
#comment"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['count']['index']+1;?>
</a></li>
            <?php }?>
        <?php endfor; endif; ?>
</ul >