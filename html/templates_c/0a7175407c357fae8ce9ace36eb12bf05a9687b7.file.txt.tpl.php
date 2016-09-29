<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:56:53
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/gallery/show/txt.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94572601157ced22d44f778-95238465%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a7175407c357fae8ce9ace36eb12bf05a9687b7' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/gallery/show/txt.tpl',
      1 => 1473172012,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94572601157ced22d44f778-95238465',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<link   href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/bootstrap-lightbox.min.css" rel="stylesheet" >
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap-lightbox.min.js"></script>
<link   href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/css/prettyPhoto.css" rel="stylesheet" >
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.prettyPhoto.js"></script>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto({
            autoplay_slideshow: true,
            slideshow: 5000,
            show_title: true,
            allow_resize: true,
            default_width: 500,
            default_height: 344,
            theme: 'pp_default',
            overlay_gallery: true,
            keyboard_shortcuts: true
        });
    });
</script>

<div class="row">
    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allimages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
?>
    <div class="col-md-4">
        <a href="<?php echo $_smarty_tpl->getVariable('row')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('row')->value->im_name;?>
" rel="prettyPhoto[pp_gal]" title="<?php echo $_smarty_tpl->getVariable('show_gallery')->value->pg_title;?>
" class="thumbnail">
            <img src="<?php echo $_smarty_tpl->getVariable('row')->value->im_path;?>
<?php echo $_smarty_tpl->getVariable('row')->value->im_name;?>
"  alt="<?php echo $_smarty_tpl->getVariable('row')->value->im_name;?>
" class="img-rounded " />
        </a>
    </div>
    <?php }} ?>
</div>
<?php if (($_smarty_tpl->getVariable('show_gallery')->value->comment_status=="open")){?>
    <?php $_template = new Smarty_Internal_Template("tpl/page/comment.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php $_template = new Smarty_Internal_Template("tpl/page/allcomment.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }?>
<?php $_template = new Smarty_Internal_Template("tpl/page/allkeywords.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>


