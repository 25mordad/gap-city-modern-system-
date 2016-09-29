<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 19:03:23
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/groupshow/txt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:173276614957ced3b300ff08-62444567%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '743190476c551df58ad4f106fc40c0b931fe1b58' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/news/groupshow/txt.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '173276614957ced3b300ff08-62444567',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('show_page')->value->pg_content);?>


<div class="list-group">
        <?php  $_smarty_tpl->tpl_vars['prnt'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('all_parent')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['prnt']->key => $_smarty_tpl->tpl_vars['prnt']->value){
?>
            <a href="/news/show/<?php echo $_smarty_tpl->getVariable('prnt')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('prnt')->value->pg_title),$_smarty_tpl);?>
" class="list-group-item ">
                <h4 class="list-group-item-heading"><?php echo $_smarty_tpl->getVariable('prnt')->value->pg_title;?>
</h4>
                <p class="list-group-item-text">
                    <?php ob_start();?><?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('prnt')->value->id,'type'=>"news",'thumb'=>"thumb/",'source'=>"true"),$_smarty_tpl);?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1!="/uploads/index/defult/defult.jpg"){?>
                        <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('prnt')->value->id,'type'=>"news",'thumb'=>"thumb/",'source'=>"true"),$_smarty_tpl);?>
" class="pull-left img-rounded img-thumbnail"   >
                    <?php }?>
                    <?php echo $_smarty_tpl->getVariable('prnt')->value->pg_excerpt;?>

                <div class="clearfix" ></div>
                </p>
            </a>
        <?php }} ?>
</div>