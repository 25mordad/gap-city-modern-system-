<?php /* Smarty version Smarty-3.0.8, created on 2016-09-25 21:51:11
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMangooutlet/stepprice.tpl" */ ?>
<?php /*%%SmartyHeaderCode:121929645857e81597ea7d14-00906224%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c03fa5fbfd0dbf24a1686a42c30e9d5eb52295b' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMangooutlet/stepprice.tpl',
      1 => 1473560893,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '121929645857e81597ea7d14-00906224',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="col-md-12" >
	<h1>انتخاب عنوان و متن</h1>
	<form action="?step=size" method="post">
	<button class="btn btn-warning" type="submit">Next Step</button>
	<div class="row" style="font-family: tahoma" >
		نرخ تبدیل یورو:‌ <?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
 - قیمت خرید  <?php echo $_smarty_tpl->getVariable('product')->value->buy_price;?>
 یورو -
		قیمت واقعی کالا  <?php echo $_smarty_tpl->getVariable('product')->value->real_price;?>
 یورو
		
		<div class="form-group">
		    <label for="price">قیمت فروش تومان: 
		    <?php echo $_smarty_tpl->getVariable('price')->value;?>
 =  (<?php echo $_smarty_tpl->getVariable('product')->value->real_price;?>
 × <?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
) + (<?php echo $_smarty_tpl->getVariable('product')->value->real_price;?>
 × <?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
 ×50%) 
		    </label>
		    <input type="number" class="form-control" name="price" id="price" value="<?php echo $_smarty_tpl->getVariable('price')->value;?>
" placeholder="price">
		    <script type="text/javascript">
		    document.getElementById("price").value  = Math.ceil(<?php echo $_smarty_tpl->getVariable('price')->value;?>
/10000) * 10000 - 1000  ;
		    </script>
		</div>
		
		<div class="form-group">
		    <label for="salse1_price">قیمت حراج 1  تومان:
		    (sales2 + max)/2
		    </label>
		    <input type="number" class="form-control" name="salse1_price" id="salse1_price"  placeholder="salse1_price">
		    <script type="text/javascript">
		    max = Math.ceil(<?php echo $_smarty_tpl->getVariable('price')->value;?>
/10000) * 10000 - 1000  ;
		    min = Math.ceil(<?php echo $_smarty_tpl->getVariable('min_price')->value;?>
/10000) * 10000 - 1000  ;
		    s2 = (max+min)/2 ;
		    document.getElementById("salse1_price").value  = Math.ceil(((max+s2)/2)/10000) * 10000 - 1000  ;
		    </script>
		</div>
		
		<div class="form-group">
		    <label for="sales2_price">قیمت حراج 2  تومان:
		    (Max + Min)/2
		    </label>
		    <input type="number" class="form-control" name="sales2_price" id="sales2_price"  placeholder="sales2_price">
		     <script type="text/javascript">
		    max = Math.ceil(<?php echo $_smarty_tpl->getVariable('price')->value;?>
/10000) * 10000 - 1000  ;
		    min = Math.ceil(<?php echo $_smarty_tpl->getVariable('min_price')->value;?>
/10000) * 10000 - 1000  ;
		    document.getElementById("sales2_price").value  = Math.ceil(((max+min)/2)/10000) * 10000 - 1000  ;
		    </script>
		</div>
		
		<div class="form-group">
		    <label for="min_price"> حداقل قیمت فروش تومان: 
		   <?php echo $_smarty_tpl->getVariable('min_price')->value;?>
 =  (<?php echo $_smarty_tpl->getVariable('product')->value->buy_price;?>
 × <?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
) + (<?php echo $_smarty_tpl->getVariable('product')->value->buy_price;?>
 × <?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
 ×20%) +  (<?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
×5) 
		    </label>
		    
		    <input type="number" class="form-control" name="min_price" id="min_price" value="" placeholder="min_price">
		    <script type="text/javascript">
		    document.getElementById("min_price").value  = Math.ceil(<?php echo $_smarty_tpl->getVariable('min_price')->value;?>
/10000) * 10000 - 1000  ;
		    </script>
		</div>
		
		
	</div>
	</form>
</div>