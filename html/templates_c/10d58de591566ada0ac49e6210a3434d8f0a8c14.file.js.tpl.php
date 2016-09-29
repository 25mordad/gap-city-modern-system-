<?php /* Smarty version Smarty-3.0.8, created on 2016-09-29 02:08:35
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/js.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3174397857ec466b58a122-21985518%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10d58de591566ada0ac49e6210a3434d8f0a8c14' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/js.tpl',
      1 => 1475102311,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3174397857ec466b58a122-21985518',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<!-- Le javascript
================================================== -->

<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery/jquery-1.10.1.min.js"></script>

<script>
    // this script required for subscribe modal
    $(window).load(function () {
        // full load
        $('#modalAds').modal('show');
        $('#modalAds').removeClass('hide');
    });

</script>

<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/plugins/swiper-master/js/swiper.jquery.min.js"></script>
<script>


    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        nextButton: '.nextControl',
        prevButton: '.prevControl',
        keyboardControl: true,
        paginationClickable: true,
        slidesPerView: 'auto',
        autoResize: true,
        resizeReInit: true,
        spaceBetween: 0,
        freeMode: true
    });


</script>

<!-- include jqueryCycle plugin -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.cycle2.min.js"></script>

<!-- include easing plugin -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.easing.1.3.js"></script>

<!-- include  parallax plugin -->
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.parallax-1.1.js"></script>

<!-- optionally include helper plugins -->
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/helper-plugins/jquery.mousewheel.min.js"></script>

<!-- include mCustomScrollbar plugin //Custom Scrollbar  -->

<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.mCustomScrollbar.js"></script>

<!-- include icheck plugin // customized checkboxes and radio buttons   -->
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/plugins/icheck-1.x/icheck.min.js"></script>

<!-- include grid.js // for equal Div height  -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/grids.js"></script>

<!-- include carousel slider plugin  -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/owl.carousel.min.js"></script>

<!-- jQuery select2 // custom select   -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<!-- include touchspin.js // touch friendly input spinner component   -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap.touchspin.js"></script>

<!-- include custom script for only homepage  -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/home.js"></script>

<!-- include custom script for site  -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/script.js"></script>


<script src='<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/jquery.zoom.js'></script>
<script>
    $(document).ready(function () {
        //$('.swipebox').zoom();

        $('#zoomContent').zoom();
        $(".zoomThumb a").click(function () {
            var largeImage = $(this).find("img").attr('data-large');
            $(".zoomImage1").attr('src', largeImage);
            $(".zoomImg").attr('src', largeImage);
            $(".gall-item").attr('href', largeImage);

        });

        $('.productImageZoomx').magnificPopup({
            delegate: 'img', type: 'image', gallery: { enabled: true},

            callbacks: {
                elementParse: function () {
                    this.item.src = this.item.el.attr('src');
                }
            }

        });


        $('.gall-item').magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        $("#zoomContent").click(function () {
            //alert();
            $('.gall-item').trigger('click');
        });

        // CHANGE IMAGE MODAL THUMB

        $(".product-thumbList a").click(function () {
            var largeImage = $(this).find("img").attr('data-large');
            $(".mainImg").attr('src', largeImage);

        });

    });
</script>

<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/plugins/magnific/jquery.magnific-popup.min.js"></script>

<!-- jQuery select2 // custom select   -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<!-- include touchspin.js // touch friendly input spinner component   -->
<script src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/assets/js/bootstrap.touchspin.js"></script>	
