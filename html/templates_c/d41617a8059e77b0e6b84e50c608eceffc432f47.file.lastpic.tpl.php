<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 05:42:27
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/gallery/lastpic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:145586186157cb74fba11527-78042068%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd41617a8059e77b0e6b84e50c608eceffc432f47' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/gallery/lastpic.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '145586186157cb74fba11527-78042068',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div title="@@PhotoGallery@@" >
    <h3>@@PhotoGallery@@</h3>
    <a href="/gallery" class="thumbnail">
        <img src="<?php echo $_smarty_tpl->getVariable('rand_gallery')->value[0]->im_path;?>
<?php echo $_smarty_tpl->getVariable('rand_gallery')->value[0]->im_name;?>
" class="img-rounded ">
    </a>
</div>