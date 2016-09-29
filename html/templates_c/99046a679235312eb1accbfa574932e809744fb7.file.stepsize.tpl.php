<?php /* Smarty version Smarty-3.0.8, created on 2016-09-12 20:34:15
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromZara/stepsize.tpl" */ ?>
<?php /*%%SmartyHeaderCode:199889846857d6d1ffd250a2-64684343%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '99046a679235312eb1accbfa574932e809744fb7' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromZara/stepsize.tpl',
      1 => 1473696247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '199889846857d6d1ffd250a2-64684343',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="col-md-12" >
	<!-- ****** -->
	<form action="?step=size&upd=true" method="post">
	<button class="btn btn-warning" type="submit">Next Step</button>
	
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
سایز
        </h3>
    </div>
    <div class="box-body">
    	<p>
		<?php  $_smarty_tpl->tpl_vars['as'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('Allsizes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['as']->key => $_smarty_tpl->tpl_vars['as']->value){
?>
		<span class="badge"><?php echo $_smarty_tpl->tpl_vars['as']->value;?>
</span>
		<?php }} ?>
		
		<br>	<br>
		<link href="/core/module/shop/backend/css/select2.min.css" rel="stylesheet" />
		<script src="/core/module/shop/backend/js/select2.min.js"></script>
	  	
		<script>
		    $(function(){
		      // turn the element to select2 select style
		      $('#sizeSelect').select2({
		    	  placeholder: 'انتخاب سایز'
		      });
		      
		    });
		    
		  </script>
				<select multiple="multiple" style="width: 100%" name="size[]" id="sizeSelect"> 
	      	<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sizeList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value){
?>
	     		<option value="<?php echo $_smarty_tpl->getVariable('s')->value->pg_title;?>
"  <?php if (in_array($_smarty_tpl->getVariable('s')->value->pg_title,$_smarty_tpl->getVariable('sizes')->value)){?> selected="selected" <?php }?> ><?php echo $_smarty_tpl->getVariable('s')->value->pg_content;?>
</option>
	     	<?php }} ?>
			</select> 
			
            <div class="clearfix" ></div>
		</p>
    </div>
</div>
<!--  ******  -->

<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
رنگ
        </h3>
    </div>
    <div class="box-body">
		<p>
		<?php  $_smarty_tpl->tpl_vars['as'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('allColors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['as']->key => $_smarty_tpl->tpl_vars['as']->value){
?>
		<span class="badge"><?php echo $_smarty_tpl->tpl_vars['as']->value;?>
</span>
		<?php }} ?>
		
		<script>
		    $(function(){
		      // turn the element to select2 select style
		      $('#colorSelect').select2({
		    	  placeholder: 'انتخاب رنگ'
		      });
		      
		    });
		    
		  </script>
		  <br>	<br>
				<select multiple="multiple" style="width: 100%" name="color[]" id="colorSelect"> 
	      	<?php  $_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('colorList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['s']->key => $_smarty_tpl->tpl_vars['s']->value){
?>
	     		<option value="<?php echo $_smarty_tpl->getVariable('s')->value->pg_title;?>
"  <?php if (in_array($_smarty_tpl->getVariable('s')->value->pg_title,$_smarty_tpl->getVariable('colors')->value)){?> selected="selected" <?php }?> ><?php echo $_smarty_tpl->getVariable('s')->value->pg_content;?>
</option>
	     	<?php }} ?>
			</select> 
			
            <div class="clearfix" ></div>
		</p>
    </div>
    </form>
</div>
<!--  ******  -->
	