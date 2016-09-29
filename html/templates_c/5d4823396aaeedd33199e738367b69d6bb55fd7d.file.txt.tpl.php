<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:14:30
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/page/show/txt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15535894457d213fe68f447-66780625%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d4823396aaeedd33199e738367b69d6bb55fd7d' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/page/show/txt.tpl',
      1 => 1473385456,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15535894457d213fe68f447-66780625',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row" >
	<div class="col-md-8" >
	<?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('show_page')->value->pg_content);?>
	
	</div>
	<div class="col-md-4" >
	<?php echo smarty_function_get_all_images(array('type'=>"page",'id'=>$_smarty_tpl->getVariable('show_page')->value->id),$_smarty_tpl);?>

	

<div class="row">
    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('getallimages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
?>
    <div class="col-md-4">
        <a href="<?php echo $_smarty_tpl->getVariable('row')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('row')->value->im_name;?>
" rel="prettyPhoto[pp_gal]" title="<?php echo $_smarty_tpl->getVariable('show_page')->value->pg_title;?>
" class="thumbnail">
            <img src="<?php echo $_smarty_tpl->getVariable('row')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('row')->value->im_name;?>
"  alt="<?php echo $_smarty_tpl->getVariable('row')->value->im_name;?>
" class="img-rounded " />
        </a>
    </div>
    <?php }} ?>
</div>

	
	</div>
</div>

<?php if (count($_smarty_tpl->getVariable('all_parent')->value)!=0){?>
	<?php $_template = new Smarty_Internal_Template("tpl/page/child_content.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }?>
<?php if (($_smarty_tpl->getVariable('show_page')->value->comment_status=="open")){?>
	<?php $_template = new Smarty_Internal_Template("tpl/page/comment.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php $_template = new Smarty_Internal_Template("tpl/page/allcomment.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }?>
<?php $_template = new Smarty_Internal_Template("tpl/page/allkeywords.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
