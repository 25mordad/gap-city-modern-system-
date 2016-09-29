<div class="col-md-12" >
	<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
سایز
        </h3>
    </div>
    <div class="box-body">
    <a href="/gadmin/shop/edit/{$product->id}" class="btn btn-warning" >Next Step</a>
    <pre>{print_r($MrooziSizes)}</pre>
		<p>
		{assign 
		var=arraySize 
		value=[
			'size'=>'اندازه',
			'sizex'=>'اندازه x',
			'free'=>'فری‌سایز',
			'number30odd'=>'شماره ۳۰ فرد',
			'number30even'=>'شماره ۳۰ زوج',
			'number40odd'=>'شماره ۴۰ فرد',
			'number40even'=>'شماره ۴۰ زوج',
			'shoessize3539'=>'سایز کفش ۳۵-۳۹',
			'shoessize4044'=>'سایز کفش ۴۰-۴۴',
			'shoessize4546'=>'سایز کفش ۴۵-۴۶',
			'trousers-size'=>'سایز شلوار',
			'blazer-size'=>'سایز کت',
			'belt-size'=>'سایز کمربند',
			'age-size'=>'سایز بر اساس سن',
			'infants-size'=>'سایز نوزادی'
			]}
		<script >
          function add_size(sizeType)
      	{
          	$.post("{$smarty.server.REDIRECT_URL}{if $action eq "index"}{$action}{/if}/AjaxController?controller=addSize", 
          			{ type: sizeType , id:{$product->id}},
          			function(data,status){
	 					$("#answersSize").html(data);
					});
      	}
          function show_size()
        	{
            	$.post("{$smarty.server.REDIRECT_URL}{if $action eq "index"}{$action}{/if}/AjaxController?controller=showSize2", 
            			{ id: {$product->id}},
            			function(data,status){
  	 					$("#answersSize").html(data);
  					});
        	}
            show_size();
          </script>
	      	<select multiple="multiple" style="width: 100%">
	      	{foreach $sizes as $size}
	     		<option value="{$size->id}" onclick="add_size('{$size->sizes}');show_size();" >{$arraySize[$size->sizes]}</option>
	     	{/foreach}
			</select> 
			<a href="/gadmin/shop/edit/{$product->id}" target="_blank" >Edit</a>
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
		<pre>{print_r($MrooziColors)}</pre>
		
		<script >
          function add_color(id)
      	{
          	$.post("{$smarty.server.REDIRECT_URL}{if $action eq "index"}{$action}{/if}/AjaxController?controller=addColor", 
          			{ id: id ,pid:{$product->id}},
          			function(data,status){
	 					$("#answers").html(data);
					});
      	}
          function show_color()
      	{
          	$.post("{$smarty.server.REDIRECT_URL}{if $action eq "index"}{$action}{/if}/AjaxController?controller=showColor", 
          			{ id: {$product->id}},
          			function(data,status){
	 					$("#answers").html(data);
					});
      	}
          show_color();
          </script>
	     
	     
	      	<select multiple="multiple" style="width: 100%">
	      	{foreach $colors as $color}
	     		<option value="{$color->id}" onclick="add_color({$color->id});show_color();" >{$color->pg_content}</option>
	     	{/foreach}
			</select> 
	  	<div id="answers"></div>
		</p>
    </div>
</div>
<!--  ******  -->
	<p>
	{print_r($postedin)}
	{print_r($taggedas)}
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
                    var scriptUrl = "/gadmin/shop/edit/{$product->id}/AjaxController?controller=get_keywords&id=" + {$product->id};
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
                            $.post( "/gadmin/shop/edit/{$product->id}/AjaxController?controller=add_keyword", { key_id: item.id, product_id: "{$product->id}" }, function(data){
                                item.rel_id = data;
                            });
                        },
                        onDelete: function (item) {
                            $.post( "/gadmin/shop/edit/{$product->id}/AjaxController?controller=del_keyword", { id: item.rel_id });
                        },
                        onNew: function (item) {
                            $.post("/gadmin/shop/edit/{$product->id}/AjaxController?controller=new_keyword", { kw_title: item, product_id: "{$product->id}"}, function(data){
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