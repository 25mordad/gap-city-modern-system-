<?php /* Smarty version Smarty-3.0.8, created on 2016-08-23 22:34:13
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/stepbrand.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131638124257bc901d49e858-46456212%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8bca3504360e44e3556898f5690aebadc7af0366' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/stepbrand.tpl',
      1 => 1471906739,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131638124257bc901d49e858-46456212',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="col-md-12" >
	<h1>انتخاب عنوان و متن</h1>
	<form action="?step=brand" method="post">
	<button class="btn btn-warning" type="submit">Next Step</button>
	<div class="row" style="font-family: tahoma" >
	<!-- <div id="answersImage" style="margin: 5px;padding: 5px;background: #ffccff;position:fixed; top:20%; left:0;width:40%;height: 200px;overflow: auto;"></div> -->
		<pre><?php echo print_r($_smarty_tpl->getVariable('description')->value);?>
</pre>
		
		
		<div class="form-group">
		    <label for="fa_title">عنوان فارسی</label>
		    <input type="text" class="form-control" id="fa_title" value="<?php echo $_smarty_tpl->getVariable('headlines')->value[1];?>
" placeholder="fa_title">
		</div>
		
		<div class="form-group">
		    <label for="en_title">عنوان انگلیسی</label>
		    <input type="text" class="form-control" id="en_title" value="<?php echo $_smarty_tpl->getVariable('headlines')->value[1];?>
" placeholder="en_title">
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن فارسی</label>
		    <textarea class="form-control" name="en_txt" rows="3"><?php echo trim($_smarty_tpl->getVariable('description')->value[0]);?>
</textarea>
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن انگلیسی</label>
		    <textarea class="form-control" name="en_txt" rows="3"></textarea>
		</div>
		</form>
		
		
	</div>
</div>