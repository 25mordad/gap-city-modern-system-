<div class="col-md-12" >
	<h1>انتخاب عنوان و متن</h1>
	<form action="?step=price&upd=true" method="post">
	<button class="btn btn-warning" type="submit">Next Step</button>
	<div class="row" style="font-family: tahoma" >
		
		
		<div class="form-group">
		    <label for="refrence"> کد رفرنس</label>
		    <input type="text" class="form-control" name="refrence" value="{$reference}" id="refrence"  placeholder="refrence">
		</div>
		
		<div class="form-group">
		    <label for="real_price">قیمت اصلی یورو</label>
		    <input type="text" class="form-control" name="real_price" value="{$realPrice}" id="real_price"  placeholder="real_price">
		</div>
		
		<div class="form-group">
		    <label for="buy_price">قیمت خرید یورو</label>
		    <input type="text" class="form-control" name="buy_price" value="{$buyPrice}" id="buy_price"  placeholder="buy_price">
		</div>
		
		<div class="form-group">
		    <label for="fa_title">عنوان فارسی</label>
		    <input type="text" class="form-control" name="fa_title" id="fa_title" value="{$fa_title}"" placeholder="fa_title">
		</div>
		
		<div class="form-group">
		    <label for="en_title">عنوان انگلیسی</label>
		    <input type="text" class="form-control" name="en_title" style="direction: ltr;" id="en_title" value="{$en_title}" placeholder="en_title">
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن فارسی</label>
		    <textarea class="form-control" name="fa_txt" id="fa_txt" rows="3">{$fa_txt}</textarea>
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن انگلیسی</label>
		    <textarea class="form-control" name="en_txt" style="direction: ltr;" rows="3">{$en_txt}</textarea>
		</div>	
	</div>
	</form>
</div>