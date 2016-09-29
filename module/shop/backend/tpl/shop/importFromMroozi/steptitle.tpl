<div class="col-md-12" >
	<h1>انتخاب عنوان و متن</h1>
	<form action="?step=size" method="post">
	<button class="btn btn-warning" type="submit">Next Step</button>
	<div class="row" style="font-family: tahoma" >
		
		
		<div class="form-group">
		     <label for="brand" >
  برند  ------- {$brand[0]}
            </label>
          
            <select class="form-control" name="brand" id="brand" >
            
                 {foreach $brands as $br}
                     <option value="{$br->id}" {if $product->brand eq $br->id} selected="selected" {/if} 	>{$br->pg_content}</option>
                 {/foreach}
             </select>
		</div>
		
		<div class="form-group">
		    <label for="price">قیمت  ----- {$price[0]}</label>
		    <input type="text" class="form-control" name="price" id="price"  placeholder="price">
		</div>
		
		<div class="form-group">
		    <label for="salse1_price">قیمت حراج  ----- {$price[1]}</label>
		    <input type="text" class="form-control" name="salse1_price" id="salse1_price"  placeholder="salse1_price">
		</div>
		
		<div class="form-group">
		    <label for="real_price">قیمت یورو  ----- {$priceeu[0]}</label>
		    <input type="text" class="form-control" name="real_price" value="{trim(str_replace("€","",$priceeu[0]))}" id="real_price"  placeholder="real_price">
		</div>
		
		<div class="form-group">
		    <label for="fa_title">عنوان فارسی</label>
		    <input type="text" class="form-control" name="fa_title" id="fa_title" value="{$headlines[1]}" placeholder="fa_title">
		</div>
		
		<div class="form-group">
		    <label for="en_title">عنوان انگلیسی</label>
		    <input type="text" class="form-control" name="" id="en_title" value="{$headlines[1]}" placeholder="en_title">
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن فارسی</label>
		    <textarea class="form-control" name="fa_txt" rows="3">{trim($description[0])}</textarea>
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن انگلیسی</label>
		    <textarea class="form-control" name="en_txt" rows="3"></textarea>
		</div>	
	</div>
	</form>
</div>