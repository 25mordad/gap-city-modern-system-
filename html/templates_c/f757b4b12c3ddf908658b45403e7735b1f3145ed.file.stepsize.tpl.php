<?php /* Smarty version Smarty-3.0.8, created on 2016-08-24 04:30:37
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/stepsize.tpl" */ ?>
<?php /*%%SmartyHeaderCode:101681676757bce3a573fe93-13754687%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f757b4b12c3ddf908658b45403e7735b1f3145ed' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/stepsize.tpl',
      1 => 1471996832,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101681676757bce3a573fe93-13754687',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="col-md-12" >
	<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
سایز
        </h3>
    </div>
    <div class="box-body">
    <a href="/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" class="btn btn-warning" >Next Step</a>
    <pre><?php echo print_r($_smarty_tpl->getVariable('MrooziSizes')->value);?>
</pre>
		<p>
		<?php $_smarty_tpl->tpl_vars['arraySize'] = new Smarty_variable(array('size'=>'اندازه','free'=>'فری‌سایز','number'=>'شماره','trousers-size'=>'سایز شلوار','blazer-size'=>'سایز کت','belt-size'=>'سایز کمربند','age-size'=>'سایز بر اساس سن','infants-size'=>'سایز نوزادی'), null, null);?>
		<script >
          function add_size(sizeType)
      	{
          	$.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=addSize", 
          			{ type: sizeType , id:<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
          			function(data,status){
	 					$("#answersSize").html(data);
					});
      	}
          function show_size()
        	{
            	$.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=showSize2", 
            			{ id: <?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
            			function(data,status){
  	 					$("#answersSize").html(data);
  					});
        	}
            show_size();
          </script>
	      	<select multiple="multiple" style="width: 100%">
	      	<?php  $_smarty_tpl->tpl_vars['size'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sizes')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['size']->key => $_smarty_tpl->tpl_vars['size']->value){
?>
	     		<option value="<?php echo $_smarty_tpl->getVariable('size')->value->id;?>
" onclick="add_size('<?php echo $_smarty_tpl->getVariable('size')->value->sizes;?>
');show_size();" ><?php echo $_smarty_tpl->getVariable('arraySize')->value[$_smarty_tpl->getVariable('size')->value->sizes];?>
</option>
	     	<?php }} ?>
			</select> 
			<a href="/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" target="_blank" >Edit</a>
	  	<div id="answersSize"></div> 
	  	
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
		<pre><?php echo print_r($_smarty_tpl->getVariable('MrooziColors')->value);?>
</pre>
		
		<script >
          function add_color(id)
      	{
          	$.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=addColor", 
          			{ id: id ,pid:<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
          			function(data,status){
	 					$("#answers").html(data);
					});
      	}
          function show_color()
      	{
          	$.post("<?php echo $_SERVER['REDIRECT_URL'];?>
<?php if ($_smarty_tpl->getVariable('action')->value=="index"){?><?php echo $_smarty_tpl->getVariable('action')->value;?>
<?php }?>/AjaxController?controller=showColor", 
          			{ id: <?php echo $_smarty_tpl->getVariable('product')->value->id;?>
},
          			function(data,status){
	 					$("#answers").html(data);
					});
      	}
          show_color();
          </script>
	     
	     
	      	<select multiple="multiple" style="width: 100%">
	      	<?php  $_smarty_tpl->tpl_vars['color'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('colors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['color']->key => $_smarty_tpl->tpl_vars['color']->value){
?>
	     		<option value="<?php echo $_smarty_tpl->getVariable('color')->value->id;?>
" onclick="add_color(<?php echo $_smarty_tpl->getVariable('color')->value->id;?>
);show_color();" ><?php echo $_smarty_tpl->getVariable('color')->value->pg_content;?>
</option>
	     	<?php }} ?>
			</select> 
	  	<div id="answers"></div>
		</p>
    </div>
</div>
<!--  ******  -->
	<p>
	<?php echo print_r($_smarty_tpl->getVariable('postedin')->value);?>

	<?php echo print_r($_smarty_tpl->getVariable('taggedas')->value);?>

	<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
            کلمات کلیدی
        </h3>
    </div>
    <div class="box-body">
        <p>
            <input type="text" id="demo-input-facebook-theme" name=""  />
            <script type="text/javascript">
                $(document).ready(function() {
                    $("input[type=button]").click(function () {
                        alert("Would submit: " + $(this).siblings("input[type=text]").val());
                    });
                    var result = null;
                    var scriptUrl = "/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/AjaxController?controller=get_keywords&id=" + <?php echo $_smarty_tpl->getVariable('product')->value->id;?>
;
                    $.ajax({
                        url: scriptUrl,
                        type: 'get',
                        dataType: 'html',
                        async: false,
                        success: function(data) {
                            result = eval(data);
                        }
                    });
                    $("#demo-input-facebook-theme").tokenInput(document.URL+ "/AjaxController?controller=get_suggestions", {
                        prePopulate: result,
                        onAdd: function (item) {
                            $.post( "/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/AjaxController?controller=add_keyword", { key_id: item.id, product_id: "<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" }, function(data){
                                item.rel_id = data;
                            });
                        },
                        onDelete: function (item) {
                            $.post( "/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/AjaxController?controller=del_keyword", { id: item.rel_id });
                        },
                        onNew: function (item) {
                            $.post("/gadmin/shop/edit/<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
/AjaxController?controller=new_keyword", { kw_title: item, product_id: "<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
"}, function(data){
                                $("#demo-input-facebook-theme").tokenInput("add", eval(data));
                            });
                        }
                    });
                });
            </script>
        <div class="clearfix" ></div>
        </p>
    </div>
</div>
<!--  ******  -->
	
	</p>
</div>