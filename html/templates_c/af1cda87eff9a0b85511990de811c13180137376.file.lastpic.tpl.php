<?php /* Smarty version Smarty-3.0.8, created on 2016-08-31 03:28:13
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/gallery/lastpic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:61509990257c60f85a42d08-84367409%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af1cda87eff9a0b85511990de811c13180137376' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/gallery/lastpic.tpl',
      1 => 1447715452,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '61509990257c60f85a42d08-84367409',
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