<?php /* Smarty version Smarty-3.0.8, created on 2016-08-21 23:11:36
         compiled from "/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/price.tpl" */ ?>
<?php /*%%SmartyHeaderCode:162926949957b9f5e0673835-99817444%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a6231e103e7c015357dbe4102f65bdb1ed22978' => 
    array (
      0 => '/var/www/gcms.dev/public_html/core/module/shop/backend/tpl/shop/importFromMroozi/price.tpl',
      1 => 1471746463,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '162926949957b9f5e0673835-99817444',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!--  box -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
             تنظیم قیمت
        </h3>
    </div>
    <div class="box-body">
    <div class="row" style="background: #e6f2ff">
        <p class="col-md-3">
            <label for="buy_price" >
قیمت خرید - یورو
            </label>
            <input type="number" 
            value="<?php echo $_smarty_tpl->getVariable('product')->value->buy_price;?>
" onchange="findMin();salse1();salse2();"
            name="buy_price" id="buy_price" placeholder="Buy Price" 
            class="form-control" style="font-family: tahoma">
        </p>
        
        <p class="col-md-3">
            <label for="real_price" >
قیمت روی‌کالا - یورو
            </label>
            <input type="number" value="<?php echo $_smarty_tpl->getVariable('product')->value->real_price;?>
" onchange="pmainch();salse1();salse2();"
            name="real_price" id="real_price" placeholder="Product Price" 
            class="form-control" style="font-family: tahoma">
        </p>
        <p class="col-md-3">
        <br>
                    <input id="switch_srp" type="checkbox" class="simple"  
                    data-on-color="success" data-off-color="warning"
                           <?php if ($_smarty_tpl->getVariable('product')->value->show_real_price=="true"){?>checked <?php }?>
                           name="switch_srp"
                           data-on-text="نمایش قیمت یورو در سایت"
                           data-off-text="پنهان کردن قیمت"
                           data-label-width="0"
                            >
                    <input type="hidden" name="show_real_price" value="<?php echo $_smarty_tpl->getVariable('product')->value->show_real_price;?>
" id="show_real_price">
                    <script>
                        $(document).ready(function() {

                            $('input[name="switch_srp"]').on('switchChange.bootstrapSwitch', function(event, state) {

                                if ( $('#switch_srp').bootstrapSwitch('state'))
                                    $('#show_real_price').val("true");
                                else
                                    $('#show_real_price').val("false");
                            });
                        });
                    </script>
                </p>
                <p class="col-md-3">
            <label for="show_sales_price" >
نمایش قیمت حراج
            </label>
            <select name="show_sales_price" style="width: 100%">
            	<option value="none" <?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="none"){?> selected="selected" <?php }?>>هیچکدام</option>
            	<option value="sales1" <?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales1"){?> selected="selected" <?php }?>>حراج ۱</option>
            	<option value="sales2" <?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="sales2"){?> selected="selected" <?php }?>>حراج ۲</option>
            	<option value="min" <?php if ($_smarty_tpl->getVariable('product')->value->show_sales_price=="min"){?> selected="selected" <?php }?>>کمترین قیمت</option>
            </select>
        </p>
     </div>
    <div class="row" style="background: #ffffe6">
        <p class="col-md-3">
            <label for="price" >
قیمت اصلی - تومان
            </label>
            <input type="number" value="<?php echo $_smarty_tpl->getVariable('product')->value->price;?>
" name="price" id="price" placeholder="Price" class="form-control" style="font-family: tahoma">
            <label  id="sg_price" for="sg_price" onclick="pmainch(0)"
            style="font-family: tahoma;font-size: 12px;color: red;font-weight: normal;cursor: pointer;" >
            </label>
            <script type="text/javascript">
            function pmainch(p){
            	pmain = document.getElementById("real_price").value*<?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
+5000;
            	pmain = Math.ceil(pmain/10000) * 10000 - 1000  ;
                $("#sg_price").html("قیمت پیشنهادی" + pmain + "تومان");
                if (document.getElementById('price').value == "0" || p == 0)
                	document.getElementById('price').value = pmain
            }
            pmainch();
            </script>
            
        </p>
        
        <p class="col-md-3">
            <label for="salse1_price" >
قیمت حراج ۱ - تومان 
            </label>
            <input type="number" value="<?php echo $_smarty_tpl->getVariable('product')->value->salse1_price;?>
" name="salse1_price" id="salse1_price" placeholder="Salse1 Price" class="form-control" style="font-family: tahoma">
            <label  id="sg_salse1" for="sg_salse1" onclick="salse1(0)"
            style="font-family: tahoma;font-size: 12px;color: red;font-weight: normal;cursor: pointer;" >
            </label>
            <script type="text/javascript">
            function salse1(p){
            	pmin = document.getElementById("buy_price").value*<?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
*2;
                pmin = Math.ceil(pmin/10000) * 10000 - 1000  ;
                
                pmain = document.getElementById("real_price").value*<?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
+5000;
            	pmain = Math.ceil(pmain/10000) * 10000 - 1000  ;
            	
            	psalse2 = (pmin+pmain)/2;
            	psalse2 = Math.ceil(psalse2/10000) * 10000 - 1000  ;
            	
            	psalse1 = (psalse2+pmain)/2;
            	psalse1 = Math.ceil(psalse1/10000) * 10000 - 1000  ;
                $("#sg_salse1").html("قیمت پیشنهادی" + psalse1 + "تومان");
                if (document.getElementById('salse1_price').value == "0" || p == 0)
                	document.getElementById('salse1_price').value = psalse1
            }
            salse1();
            </script>
        </p>
        <p class="col-md-3">
            <label for="sales2_price" >
قیمت حراج ۲ - تومان
            </label>
            <input type="number" value="<?php echo $_smarty_tpl->getVariable('product')->value->sales2_price;?>
" name="sales2_price" id="sales2_price" placeholder="Sales2 Price" class="form-control" style="font-family: tahoma">
            <label  id="sg_salse2" for="sg_salse2" onclick="salse2(0)"
            style="font-family: tahoma;font-size: 12px;color: red;font-weight: normal;cursor: pointer;" >
            </label>
            <script type="text/javascript">
            function salse2(p){
            	
            	pmin = document.getElementById("buy_price").value*<?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
*2;
                pmin = Math.ceil(pmin/10000) * 10000 - 1000  ;
                
                pmain = document.getElementById("real_price").value*<?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
+5000;
            	pmain = Math.ceil(pmain/10000) * 10000 - 1000  ;
            	
            	psalse2 = (pmin+pmain)/2;
            	psalse2 = Math.ceil(psalse2/10000) * 10000 - 1000  ;
                $("#sg_salse2").html("قیمت پیشنهادی" + psalse2 + "تومان");
                if (document.getElementById('sales2_price').value == "0" || p == 0)
                	document.getElementById('sales2_price').value = psalse2
            }
            salse2();
            </script>
        </p>
        
        <p class="col-md-3">
            <label for="min_price" >
مینیمم قیمت فروش - تومان
            </label>
            <input type="number" value="<?php echo $_smarty_tpl->getVariable('product')->value->min_price;?>
" name="min_price" id="min_price" placeholder="Min Price" class="form-control" style="font-family: tahoma">
            <label  id="sg_min" for="sg_min" onclick="findMin(0)"
            style="font-family: tahoma;font-size: 12px;color: red;font-weight: normal;cursor: pointer;" >
            </label>
            <script type="text/javascript">
            function findMin(p){
            	pmin = document.getElementById("buy_price").value*<?php echo $_smarty_tpl->getVariable('GCMS_SETTING')->value['shop']['eurorate'];?>
*2;
                pmin = Math.ceil(pmin/10000) * 10000 - 1000  ;
                $("#sg_min").html("قیمت پیشنهادی" + pmin + "تومان");
                if (document.getElementById('min_price').value == "0" || p == 0)
                	document.getElementById('min_price').value = pmin
            }
            findMin();
            </script>
        </p>
        
        
     </div>
        <div class="clearfix" ></div>
    </div><!-- /.box-body -->
</div><!-- /.box -->

