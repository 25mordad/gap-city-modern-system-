<?php /* Smarty version Smarty-3.0.8, created on 2016-08-31 03:28:13
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/news/lastnews.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13107748557c60f85a54940-47815212%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9335a8e2e6f2b2b436eb5e93baa1d761733498dc' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/news/lastnews.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13107748557c60f85a54940-47815212',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div title="خبر" >
    <h3 >@@LastNews@@</h3>
    <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, null);?>
    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('last_news')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
?>
        <?php if ($_smarty_tpl->getVariable('i')->value<1){?>
    <div class="media">
        <a class="pull-left" href="/news/show/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->pg_title),$_smarty_tpl);?>
">
        <?php ob_start();?><?php echo smarty_function_showlastindeximage(array('id'=>$_smarty_tpl->getVariable('row')->value->id,'thumb'=>"thumb/",'source'=>"true"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1!="/uploads/index/defult/defult.jpg"){?>
            <img class="media-object " src="<?php echo smarty_function_showlastindeximage(array('id'=>$_smarty_tpl->getVariable('row')->value->id,'thumb'=>"thumb/",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('row')->value->pg_title;?>
" >
        <?php }?>
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $_smarty_tpl->getVariable('row')->value->pg_title;?>
</h4>
            <?php echo $_smarty_tpl->getVariable('row')->value->pg_excerpt;?>

            <br/>
            <a href="/news/show/<?php echo $_smarty_tpl->getVariable('row')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('row')->value->pg_title),$_smarty_tpl);?>
">
                ادامه خبر....
            </a>
        </div>
    </div>
        <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable($_smarty_tpl->getVariable('i')->value+1, null, null);?>
    <?php }?>
    <?php }} ?>
</div>

