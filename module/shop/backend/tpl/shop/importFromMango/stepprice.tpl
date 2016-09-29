<div class="col-md-12" >
	<h1>انتخاب عنوان و متن</h1>
	<form action="?step=size" method="post">
	<button class="btn btn-warning" type="submit">Next Step</button>
	<div class="row" style="font-family: tahoma" >
		نرخ تبدیل یورو:‌ {$GCMS_SETTING['shop']['eurorate']} - قیمت خرید  {$product->buy_price} یورو -
		قیمت واقعی کالا  {$product->real_price} یورو
		
		<div class="form-group">
		    <label for="price">قیمت فروش تومان: 
		    {$price} =  ({$product->real_price} × {$GCMS_SETTING['shop']['eurorate']}) + ({$product->real_price} × {$GCMS_SETTING['shop']['eurorate']} ×50%) +  ({$GCMS_SETTING['shop']['eurorate']}×5) 
		    </label>
		    <input type="number" class="form-control" name="price" id="price" value="{$price}" placeholder="price">
		    <script type="text/javascript">
		    document.getElementById("price").value  = Math.ceil({$price}/10000) * 10000 - 1000  ;
		    </script>
		</div>
		
		<div class="form-group">
		    <label for="salse1_price">قیمت حراج 1  تومان:
		    (sales2 + max)/2
		    </label>
		    <input type="number" class="form-control" name="salse1_price" id="salse1_price"  placeholder="salse1_price">
		    <script type="text/javascript">
		    max = Math.ceil({$price}/10000) * 10000 - 1000  ;
		    min = Math.ceil({$min_price}/10000) * 10000 - 1000  ;
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
		    max = Math.ceil({$price}/10000) * 10000 - 1000  ;
		    min = Math.ceil({$min_price}/10000) * 10000 - 1000  ;
		    document.getElementById("sales2_price").value  = Math.ceil(((max+min)/2)/10000) * 10000 - 1000  ;
		    </script>
		</div>
		
		<div class="form-group">
		    <label for="min_price"> حداقل قیمت فروش تومان: 
		   {$min_price} =  ({$product->buy_price} × {$GCMS_SETTING['shop']['eurorate']}) + ({$product->buy_price} × {$GCMS_SETTING['shop']['eurorate']} ×20%) +  ({$GCMS_SETTING['shop']['eurorate']}×5) 
		    </label>
		    
		    <input type="number" class="form-control" name="min_price" id="min_price" value="" placeholder="min_price">
		    <script type="text/javascript">
		    document.getElementById("min_price").value  = Math.ceil({$min_price}/10000) * 10000 - 1000  ;
		    </script>
		</div>
		
		
	</div>
	</form>
</div>