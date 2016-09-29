<?php /* Smarty version Smarty-3.0.8, created on 2016-09-04 19:45:17
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:51709149457cc3a85b01793-86721424%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '33f6f3412ce2e57de3d1ddbd3fd55b16e9d7f740' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/footer.tpl',
      1 => 1473002116,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '51709149457cc3a85b01793-86721424',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<footer class="footer">
  <div class="container">
    
    
    <div class="row-fluid">
      <div class="span3">
        <h4 class="line3 center standart-h4title"><span><?php echo $_smarty_tpl->getVariable('general_boxes')->value[0]->box_title;?>
</span></h4>
        <ul class="footer-links">
          <?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[0]->box_content);?>

        </ul>
      </div>
      <div class="span3">
        <h4 class="line3 center standart-h4title"><span><?php echo $_smarty_tpl->getVariable('general_boxes')->value[1]->box_title;?>
</span></h4>
        <ul class="footer-links">
          <?php echo htmlspecialchars_decode($_smarty_tpl->getVariable('general_boxes')->value[1]->box_content);?>

        </ul>
      </div>
      <div class="span3">
        <h4 class="line3 center standart-h4title"><span>
        دفترکار
        </span></h4>
       <address>
									  <strong>فارس شایگان</strong><br>
									  <i class="fa-icon-map-marker"></i> 
									  شيراز - 
									  خيابان هدايت غربي حدفاصل 20 متري سينماسعدي(7 تير) و باغشاه (فلسطين)-نبش كوچه 8 ساختمان 125 طبقه دوم واحد3
									  <br>
									  <div style="direction: ltr">
									  <i class="fa-icon-phone-sign"></i> + 98 (71) 32360052
									  </div>
									  
									  <div class="foot-line"></div>
									  
									</address>
      </div>
      <div class="span3">
        <h4 class="line3 center standart-h4title"><span>در تماس باشیم</span></h4>
        
        <div class="widget_nav_menu"> 
				<ul class="socialIcons">
						<li class="facebook"><a href="#">facebook </a></li>
						<li class="linkedin"><a href="#">linkedin </a></li>
						<li class="twitter"><a href="#">twitter</a></li>
                   </ul>
				</div>
      </div>
    </div>
    <hr class="half1 copyhr">
    <div class="row-fluid copyright">
      <div class="span12 center">
      <a  href="http://fars-shygun.com/" >fars-shygun.com</a>
       All Rights Reserved &copy; <?php echo date('Y',strtotime('now'));?>
</div>
      <a  href="http://gatriya.com" target="_blank" title="گاتریا">
            Powered By Gatriya
        </a>
    </div>
  </div>
</footer>
