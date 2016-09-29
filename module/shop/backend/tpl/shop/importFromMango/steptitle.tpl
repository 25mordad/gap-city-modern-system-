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
		<script>
		$.getJSON('https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160910T231549Z.d3c0379676298079.04f16747b8f231b3dd6122ad85ef9074a8950f58&lang=es-fa&text={trim($headlines[0])}', function(data) {
			document.getElementById("fa_title").value = data.text;
		});
		
		$.getJSON('https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160910T231549Z.d3c0379676298079.04f16747b8f231b3dd6122ad85ef9074a8950f58&lang=es-fa&text={trim($description[0])}', function(data) {
			document.getElementById("fa_txt").value = data.text;
		});
		
		</script> 
		<div class="form-group">
		    <label for="fa_title">عنوان فارسی</label>
		    <input type="text" class="form-control" name="fa_title" id="fa_title" value="" placeholder="fa_title">
		</div>
		
		<div class="form-group">
		    <label for="en_title">عنوان انگلیسی</label>
		    <input type="text" class="form-control" name="en_title" style="direction: ltr;" id="en_title" value="{trim($headlines[0])}" placeholder="en_title">
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن فارسی</label>
		    <textarea class="form-control" name="fa_txt" id="fa_txt" rows="3"></textarea>
		</div>
		
		<div class="form-group">
		    <label for="en_txt">متن انگلیسی</label>
		    <textarea class="form-control" name="en_txt" style="direction: ltr;" rows="3">{trim($description[0])}</textarea>
		</div>	
	</div>
	</form>
</div>