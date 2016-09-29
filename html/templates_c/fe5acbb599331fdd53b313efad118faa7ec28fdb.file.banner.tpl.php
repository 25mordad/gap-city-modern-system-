<?php /* Smarty version Smarty-3.0.8, created on 2016-09-21 22:06:17
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/banner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207635098057e2d321ea0971-90286797%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fe5acbb599331fdd53b313efad118faa7ec28fdb' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/banner.tpl',
      1 => 1474429483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207635098057e2d321ea0971-90286797',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="banner banner-boxes">
    <div class="slider-content"><span class="prevControl sliderControl"> <i class="fa fa-angle-left fa-3x "></i></span>
        <span class="nextControl sliderControl"> <i class="fa fa-angle-right fa-3x "></i></span>

        <div class="swiper-container swiper-container-h">
            <div class="swiper-wrapper">
                <div class="swiper-slide slide-2x">
                    <div class="box-slider-content">
                        <div class="box-text">
                            <h1><?php echo $_smarty_tpl->getVariable('general_boxes')->value[0]->box_title;?>
</h1>

                            <p><?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[0]->box_content);?>
</p>
                            <a class="btn btn-stroke-light" href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[0]->class_name;?>
"> خرید</a></div>
                        <div class="box-content-overly">
                            <!-- Delete this div if you dont want overly effect -->
                        </div>
                        <a href="#" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[0]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[0]->box_title;?>
"></a></div>
                </div>
                <div class="swiper-slide slide-2x">
                    <div class="slider-box-top">
                        <div class="box-slider-content">
                            <div class="box-text-table">
                                <div class="box-text-cell">
                                    <h1 class="bolder-style light"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[1]->class_name;?>
"><?php echo $_smarty_tpl->getVariable('general_boxes')->value[1]->box_title;?>
</a></h1>
                                    <span class="bolder-sub"> <a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[1]->class_name;?>
"> <?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[1]->box_content);?>
 </a> </span></div>
                            </div>
                            <div class="box-content-overly">
                                <!-- Delete this div if you dont want overly effect -->
                            </div>
                            <a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[1]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[1]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[1]->box_title;?>
"></a></div>
                    </div>
                    <div class="slider-box-bottom">
                        <div class="box-slider-content">
                            <div class="box-price-tag"><span class="price"><?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[2]->box_content);?>
</span></div>
                            <a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[2]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[2]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[2]->box_title;?>
"> </a>

                            <div class="box-content-overly"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[2]->class_name;?>
" class="box-blank-url">
                                <!-- keep this blank. This link will provide a hyperlink over the box-content-overly div -->
                            </a></div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide slide-2x">
                    <div class="box-slider-content">
                        <div class="box-text bottom-align">
                            <h1><?php echo $_smarty_tpl->getVariable('general_boxes')->value[3]->box_title;?>
</h1>
                            <a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[3]->class_name;?>
" class="btn btn-stroke-light">خرید</a></div>
                        <a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[3]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[3]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[3]->box_title;?>
"></a>

                        <div class="box-content-overly"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[3]->class_name;?>
" class="box-blank-url"> </a></div>
                    </div>
                </div>
                <div class="swiper-slide slide-4x">
                    <div class="box-4in a">
                        <div class="box-slider-content"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[4]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[4]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[4]->box_title;?>
"></a>

                            <div class="box-content-overly"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[4]->class_name;?>
" class="box-blank-url"> </a></div>
                        </div>
                    </div>
                    <div class="box-4in b">
                        <div class="box-slider-content"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[5]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[5]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[5]->box_title;?>
"></a>

                            <div class="box-content-overly"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[5]->class_name;?>
" class="box-blank-url"> </a></div>
                        </div>
                    </div>
                    <div class="box-4in c">
                        <div class="box-slider-content"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[6]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[6]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[6]->box_title;?>
"></a>

                            <div class="box-content-overly box-content-overly-white">
                                <div class="box-text-table">
                                    <div class="box-text-cell"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[6]->class_name;?>
" class="btn btn-stroke-dark"> نمایش</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-4in d">
                        <div class="box-slider-content"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[7]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[7]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[7]->box_title;?>
"></a>

                            <div class="box-content-overly box-content-overly-white">
                                <div class="box-text-table">
                                    <div class="box-text-cell"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[7]->class_name;?>
" class="btn btn-stroke-dark"> نمایش</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide slide-2x">
                    <div class="box-slider-content"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[8]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[8]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[8]->box_title;?>
"></a>

                        <div class="box-content-overly box-content-overly-white">
                            <div class="box-text-table">
                                <div class="box-text-cell ">
                                    <div class="box-text-cell-inner dark">
                                        <h1><?php echo $_smarty_tpl->getVariable('general_boxes')->value[8]->box_title;?>
</h1>

                                        <p><?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[8]->box_content);?>
</p>
                                        <a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[8]->class_name;?>
" class="btn btn-stroke-dark"> خرید</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide slide-2x">
                    <div class="slider-box-top">
                        <div class="box-slider-content">
                            <div class="box-content-overly box-content-overly-white">
                                <div class="box-text-table">
                                    <div class="box-text-cell"><span class="price dealprice"> <?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[9]->box_content);?>
 </span> <a
                                         href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[9]->class_name;?>
"   class="btn btn-stroke-dark"> نمایش</a></div>
                                </div>
                            </div>
                            <a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[9]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[9]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[9]->box_title;?>
"></a></div>
                    </div>
                    <div class="slider-box-bottom">
                        <div class="box-4in c">
                            <div class="box-slider-content"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[10]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[10]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[10]->box_title;?>
"></a>

                                <div class="box-content-overly box-content-overly-white">
                                    <div class="box-text-table">
                                        <div class="box-text-cell"><span class="price"> <?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[10]->box_content);?>
 </span> <a
                                           href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[10]->class_name;?>
"     class="btn btn-stroke-dark"> نمایش</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-4in d">
                            <div class="box-slider-content"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[11]->class_name;?>
" class="box-img"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[11]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[11]->box_title;?>
"></a>

                                <div class="box-content-overly box-content-overly-white">
                                    <div class="box-text-table">
                                        <div class="box-text-cell"><span class="price"> <?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[11]->box_content);?>
 </span> <a
                                           href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[11]->class_name;?>
"     class="btn btn-stroke-dark"> نمایش</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide slide-1x">
                    <div class="box-slider-content"><a href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[12]->class_name;?>
" class="box-img last-child-slide"> <img src="<?php echo smarty_function_get_last_image(array('id'=>$_smarty_tpl->getVariable('general_boxes')->value[12]->id,'type'=>"box",'source'=>"true"),$_smarty_tpl);?>
" alt="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[12]->box_title;?>
"></a>

                        <div class="box-content-overly box-content-overly-white">
                            <div class="box-text-table">
                                <div class="box-text-cell ">
                                    <div class="box-text-cell-inner dark">
                                        <h1><?php echo $_smarty_tpl->getVariable('general_boxes')->value[12]->box_title;?>
</h1>

                                        <p><?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[12]->box_content);?>
</p>
                                        <a  href="<?php echo $_smarty_tpl->getVariable('general_boxes')->value[12]->class_name;?>
"   class="btn btn-stroke-dark"> خرید</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-pagination swiper-pagination"></div>
        </div>

        <!--/.full-container-->
    </div>
</div>
<!--/.banner style1-->
