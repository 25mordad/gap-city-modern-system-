<?php /* Smarty version Smarty-3.0.8, created on 2016-09-19 04:21:58
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/page/show/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157342972557df289e7b47c3-82621025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bb21be05c99c6e61c6aeddca755682598ce44ba' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/page/show/content.tpl',
      1 => 1474242717,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '157342972557df289e7b47c3-82621025',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="row innerPage">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row userInfo">
                <div class="col-xs-12 col-sm-12">
                    <h1 class="title-big text-center section-title-style2" style="direction: ltr;">
            <span style="direction: rtl;">
              <?php echo $_smarty_tpl->getVariable('show_page')->value->pg_title;?>

            </span>
                    </h1>

                    <p class="lead text-justify" >
                        <?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('show_page')->value->pg_content);?>

                    </p>
                    <?php if (($_smarty_tpl->getVariable('show_page')->value->comment_status=="open")){?>
	<?php $_template = new Smarty_Internal_Template("tpl/page/comment.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
    <?php $_template = new Smarty_Internal_Template("tpl/page/allcomment.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
<?php }?>
<?php $_template = new Smarty_Internal_Template("tpl/page/allkeywords.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate(); $_template->rendered_content = null;?><?php unset($_template);?>
                </div>
            </div>
            <!--/row end-->
        </div>
    </div>