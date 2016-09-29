<?php /* Smarty version Smarty-3.0.8, created on 2016-09-19 04:23:13
         compiled from "/var/www/gcms.dev/public_html/web/mroozi/tpl/page/comment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170593364457df28e9c1c143-32559333%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '473be43bb93eb137de0e306f4ab1cabbb08dd25f' => 
    array (
      0 => '/var/www/gcms.dev/public_html/web/mroozi/tpl/page/comment.tpl',
      1 => 1474242792,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170593364457df28e9c1c143-32559333',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="?comment=true" method="post" name="comment" role="form" class="form-horizontal" id="comment">
    <legend>دیدگاه ها</legend>

    <div class="form-group">
        <label for="cm_author" class="col-md-2 control-label">@@Name@@</label>
        <div class="col-md-10">
            <input type="text" class="form-control" id="cm_author" placeholder="@@Name@@" name="cm_author" required />
        </div>
    </div>

    <div class="form-group">
        <label for="cm_email" class="col-md-2 control-label">@@Email@@</label>
        <div class="col-md-10">
            <input type="email" class="form-control" id="cm_email" placeholder="@@Email@@" name="cm_email" required />
        </div>
    </div>

    <div class="form-group">
        <label for="cm_url" class="col-md-2 control-label">@@Website@@</label>
        <div class="col-md-10">
            <input type="url" class="form-control" id="cm_url" placeholder="@@Website@@" name="cm_url"  />
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <textarea rows="3" name="cm_content" placeholder="@@Comment@@" class="col-md-12 form-control" required></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="capcha" class="col-md-2 control-label"><img src="<?php echo $_smarty_tpl->getVariable('temp_root')->value;?>
/images/captcha_code_file.php" id="captchaimg" required /></label>
        <div class="col-md-3">
            <input type="text" class="form-control col-md-12" id="capcha" placeholder="@@Captcha@@" name="capcha" required  />
        </div>
        <div class="col-md-7">
            <button type="submit" class="btn btn-primary col-md-12">@@SendComment@@</button>
        </div>
    </div>


</form>


<script>
    $(document).ready(function() {
        $('#comment').bootstrapValidator({
            container: 'tooltip',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {

            }
        });
    });


</script>
