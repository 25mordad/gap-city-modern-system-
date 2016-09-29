<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 05:42:27
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/adver.tpl" */ ?>
<?php /*%%SmartyHeaderCode:110777272557cb74fb98f0f1-03900956%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8958ac2df4bcb2a99a3a5d5da770354c63384c5c' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/adver.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '110777272557cb74fb98f0f1-03900956',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row "  >

    <?php echo smarty_function_get_all_boximg(array('id'=>$_smarty_tpl->getVariable('general_boxs')->value[0]->id),$_smarty_tpl);?>

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $_smarty_tpl->tpl_vars['i'] = new Smarty_variable(0, null, null);?>
            <?php  $_smarty_tpl->tpl_vars['adverimg'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('getallboximg')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['adverimg']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['adverimg']->iteration=0;
if ($_smarty_tpl->tpl_vars['adverimg']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['adverimg']->key => $_smarty_tpl->tpl_vars['adverimg']->value){
 $_smarty_tpl->tpl_vars['adverimg']->iteration++;
 $_smarty_tpl->tpl_vars['adverimg']->last = $_smarty_tpl->tpl_vars['adverimg']->iteration === $_smarty_tpl->tpl_vars['adverimg']->total;
?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $_smarty_tpl->getVariable('i')->value++;?>
" <?php if ($_smarty_tpl->tpl_vars['adverimg']->last){?> class="active" <?php }?>></li>
            <?php }} ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php  $_smarty_tpl->tpl_vars['adverimg'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('getallboximg')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['adverimg']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['adverimg']->iteration=0;
if ($_smarty_tpl->tpl_vars['adverimg']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['adverimg']->key => $_smarty_tpl->tpl_vars['adverimg']->value){
 $_smarty_tpl->tpl_vars['adverimg']->iteration++;
 $_smarty_tpl->tpl_vars['adverimg']->last = $_smarty_tpl->tpl_vars['adverimg']->iteration === $_smarty_tpl->tpl_vars['adverimg']->total;
?>
                <div class="item <?php if ($_smarty_tpl->tpl_vars['adverimg']->last){?> active <?php }?>">
                    <img src="<?php echo $_smarty_tpl->getVariable('adverimg')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('adverimg')->value->im_name;?>
" alt="<?php echo $_smarty_tpl->getVariable('adverimg')->value->im_name;?>
" class="img-responsive">
                </div>
            <?php }} ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>




</div>