<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 20:07:46
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/map/index/txt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:194641460757cee2cabc5277-35216357%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '70d263e3636e3477be37140dfa58b911e015c264' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/map/index/txt.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '194641460757cee2cabc5277-35216357',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<a href="/page/show/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->pg_title),$_smarty_tpl);?>
">
    <span class="glyphicon glyphicon-chevron-left"></span>
    صفحه نخست
</a> <br />
<?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('site_map')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
?>
    <a href="/page/show/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->pg_title),$_smarty_tpl);?>
">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <?php echo $_smarty_tpl->getVariable('row')->value->pg_title;?>

    </a>
    <br />
    <?php echo smarty_function_find_childs(array('id'=>$_smarty_tpl->getVariable('row')->value->id),$_smarty_tpl);?>


    <?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('find_childs')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
?>
        <img src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/blank.png" width="30">
        <a href="/page/show/<?php echo $_smarty_tpl->getVariable('child')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('child')->value->pg_title),$_smarty_tpl);?>
">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <?php echo $_smarty_tpl->getVariable('child')->value->pg_title;?>

        </a><br />
    <?php }} ?>

<?php }} ?>