<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
سایز
        </h3>
    </div>
    <div class="box-body">
		<p>
		{assign 
		var=arraySize 
		value=[
			'size'=>'اندازه',
			'free'=>'فری‌سایز',
			'number'=>'شماره',
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
            	$.post("{$smarty.server.REDIRECT_URL}{if $action eq "index"}{$action}{/if}/AjaxController?controller=showSize", 
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
	  	<div id="answersSize"></div> 
	  	
		</p>
    </div>
</div>
<!--  ******  -->
