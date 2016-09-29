<?php /* Smarty version Smarty-3.0.8, created on 2016-09-29 12:35:16
         compiled from "/var/www/gcms.dev/public_html/web/ppgtg/tpl/contact.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60311349657ecd94c4825e3-83395875%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2164117babb45ae82298443284989aee53c21fc0' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/ppgtg/tpl/contact.tpl',
      1 => 1474405140,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60311349657ecd94c4825e3-83395875',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Contact Section -->
<section id="contact">
    <div class="container wow fadeIn">
        <div class="row">
            <div class="col-md-5">
                <h2 class="headerline">Hayati Group Co Ltd</h2>
                <p> 
Tell : +66 22363200 <br>
Fax : +66 22363202 <br>
Mob: +66 929876545 <br>
                <h2><i class="fa fa-phone"></i> (66) 223-63200</h2>
                <h4><i class="fa fa-envelope fa-fw"></i> info[AT]hayatigroup[DOT]com<br>
                <b>Office</b> <br>
                    <i class="fa fa-map-marker fa-fw"></i> 
                 707, 7th Floor, AIA Tower, 19S Sathorn Rd, Yan Nawa, Sathon, Bangkok 10120, Thailand
                </h4>
                <h4>
                <b>Factory</b> <br>
                    <i class="fa fa-map-marker fa-fw"></i> 
					26/78 Moo 2 Tha Sao Sub district, Kratumbaen, Samutsakhon 74110, Thailand
                    </h4>
            </div>
            <div class="col-md-5 col-md-offset-2">
                <h2 class="headerline">Contact Us</h2>
                <form method="post" action="/page/show/5?comment=true" id="contactfrm" role="form">
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="name" class="sr-only control-label">Your Name</label>
                            <input type="text" class="form-control input-lg" placeholder="Your Name" id="cm_author" required="" name="cm_author"  data-validation-required-message="Please enter name">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="CompanyName" class="sr-only control-label">Company Name</label>
                            <input type="text" class="form-control input-lg" placeholder="Company Name" id="CompanyName"  data-validation-required-message="Please enter Company Name">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="email" class="sr-only control-label">Your Email</label>
                            <input type="email" class="form-control input-lg" placeholder="Your Email" name="cm_email" id="email" required="" data-validation-required-message="Please enter email">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                            <label for="message" class="sr-only control-label">Message</label>
                            <textarea rows="2" class="form-control input-lg" placeholder="Message" id="message" required="" name="cm_content" data-validation-required-message="Please enter a message." aria-invalid="false"></textarea>
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <div id="success"></div>
                    <button type="submit" class="btn btn-primary btn-lg" onsubmit="appBfSend()">Send</button>
                    <script>
                    function appBfSend()
					{
					    $CompanyName = $('#CompanyName').val();
					    $stringCmContent =
					            "Company Name: "+$CompanyName     +"<br>" +
					            $('#cm_content').val();
					
					    $('#cm_content').val($stringCmContent);
					}
					</script>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<div id="map" class="wow fadeIn"></div>
