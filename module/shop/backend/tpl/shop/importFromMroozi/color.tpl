<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
رنگ
        </h3>
    </div>
    <div class="box-body">
		<p>
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
