<?php /* Smarty version Smarty-3.0.8, created on 2016-09-06 18:46:20
         compiled from "/var/www/gcms.dev/public_html/web/fars-shygun/tpl/page/comment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:68353353657cecfb431bbb7-29467491%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2907a68857362039f146dd5c74b7c95f3807051d' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/fars-shygun/tpl/page/comment.tpl',
      1 => 1473171377,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '68353353657cecfb431bbb7-29467491',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
 <div class="clearfix" ></div>
  <!-- COMMENTS FORM -->
       <div class="well">
				
                      <form action="?comment=true" method="post" name="comment" role="form" class="form-horizontal" id="comment" >

                       <p class="span3">
                      <label for="comment-name"><strong>@@Name@@</strong> <span class="label">*</span></label>
                      <input class="span12" type="text" name="cm_author" placeholder="@@Name@@" value="" >
                      </p>

                      <p class="span3">
                      <label for="comment-name"><strong>@@Email@@</strong> <span class="label">*</span></label>
                      <input class="span12" type="text" name="cm_email" placeholder="Email" value=""  required="" >
                      </p>

                      <p class="span3">
                      <label for="comment-name"><strong>@@Website@@</strong></label>
                      <input class="span12" type="text" name="cm_url" placeholder="Website" value="" id="comment-name" >
                      </p>

                
                    <textarea class="span12" id="new_message" name="cm_content" placeholder="@@Comment@@" rows="5" required="required"></textarea>
                  <p class="span3">
                      <label for="capcha"><img src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/img/captcha_code_file.php" id="captchaimg" required /></label>
                      <input class="span12" type="text" name="capcha" placeholder="capcha" value="" id="capcha" required="" >
                      </p>
                      
                    <button class="btn btn-info btn-large" type="submit">@@SendComment@@</button>
                </form>
            </div>
			<!-- END COMMENTS FORM -->
      <hr class="soften">

<div class="clearfix" ></div>