<?php /* Smarty version Smarty-3.0.8, created on 2016-09-17 23:43:46
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:82473499257dd95ea632320-79997841%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '607cf5d18182c40f922f8c76c6b0e7efa7de4d83' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/shop/index.tpl',
      1 => 1474139567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '82473499257dd95ea632320-79997841',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="container main-container headerOffset" >
	<?php $_template = new Smarty_Internal_Template("tpl/".($_smarty_tpl->getVariable('part')->value)."/".($_smarty_tpl->getVariable('action')->value)."/navigation.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>

    <div class="row">
			<?php  $_smarty_tpl->tpl_vars['sc'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('groups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['sc']->key => $_smarty_tpl->tpl_vars['sc']->value){
?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4  text-center ">
                    <div class="thumbnail equalheight"><a class="subCategoryThumb" 
                    href="/shop/category/<?php echo $_smarty_tpl->getVariable('sc')->value->id;?>
/<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('sc')->value->pg_content),$_smarty_tpl);?>
+<?php echo smarty_function_changetoplus(array('title'=>$_smarty_tpl->getVariable('sc')->value->pg_title),$_smarty_tpl);?>
">
                    <img src="/uploads/source/category/thumb/<?php echo $_smarty_tpl->getVariable('sc')->value->id;?>
.jpg" 
                    class="img-rounded " alt="<?php echo $_smarty_tpl->getVariable('sc')->value->pg_title;?>
"> </a> 
                            <a class="subCategoryTitle"><span> <?php echo $_smarty_tpl->getVariable('sc')->value->pg_content;?>
 </span></a>
                    </div>
                </div>
            <?php }} ?>
    </div>
    <!-- /.row  -->
</div>
<!-- /main container -->
