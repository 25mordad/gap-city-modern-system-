<div class="col-md-12" >
	<h1>انتخاب تصویر</h1>
	<a href="?step=title" class="btn btn-warning" >Next Step</a>
	<div class="row" style="font-family: tahoma" >
	<div id="answersImage" style="margin: 5px;padding: 5px;background: #ffccff;position:fixed; top:20%; left:0;width:40%; height: 200px;overflow: auto;"></div>
		{foreach $allImages as $image}
		
			<img width="100"  src="{str_replace("180x180","600x600",$image->src)}"><br>
			<span onclick="add_image('{str_replace("180x180","600x600",$image->src)}');show_image();" style="background:blue;cursor:pointer" >{str_replace("180x180","600x600",$image->src)}</span><br> 
			
		{/foreach}
		<script >
          function add_image(address)
      	{
        	  $.post("{$smarty.server.REDIRECT_URL}{if $action eq "index"}{$action}{/if}/AjaxController?controller=addImageToProduct", 
          			{ address: address , id:{$product->id}},
          			function(data,status){
	 					$("#answersImage").html(data);
					});
      	}
          function show_image(address)
        	{
          	  $.post("{$smarty.server.REDIRECT_URL}{if $action eq "index"}{$action}{/if}/AjaxController?controller=showImageOfProduct", 
            			{  id:{$product->id}},
            			function(data,status){
  	 					$("#answersImage").html(data);
  					});
        	}
          </script>
	</div>
</div>