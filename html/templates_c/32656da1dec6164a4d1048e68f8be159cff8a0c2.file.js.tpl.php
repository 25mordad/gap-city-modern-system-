<?php /* Smarty version Smarty-3.0.8, created on 2016-09-09 06:15:06
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:182036757457d214222571c2-96064419%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32656da1dec6164a4d1048e68f8be159cff8a0c2' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/js.tpl',
      1 => 1473385503,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182036757457d214222571c2-96064419',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/jquery.easing.min.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/jquery.countdown.min.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/smoothscroll.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/form.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/jquery.placeholder.min.js"></script>

<!-- Google Map -->
<!-- Google Maps API Key - Use your own API key to enable the map feature. More information on the Google Maps API can be found at https://developers.google.com/maps/ -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsxs-JrfjnrIV-s6yaV4etVOQ_I4rWlqc"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/map.js"></script>

<!-- Header Background Slider -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/jquery.backstretch.min.js"></script>
<script type="text/javascript">
    $(".intro").backstretch([
        "<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/11.jpg"
        , "<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/10.jpg"
        , "<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/5.jpg"
        , "<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/9.jpg"
        , "<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/8.jpg"
        , "<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/8-2.jpg"
    ], { duration: 4000, fade: 1000, centeredX:true, centeredY:true});
</script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/lovehub.js"></script>


<link   href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/css/bootstrap-lightbox.min.css" rel="stylesheet" >
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/bootstrap-lightbox.min.js"></script>
<link   href="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/css/prettyPhoto.css" rel="stylesheet" >
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/js/jquery.prettyPhoto.js"></script>

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
