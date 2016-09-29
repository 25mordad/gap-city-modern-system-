<div class="col-md-12" >
	<h1>انتخاب گروه محصول </h1>
	<p>
	
	{$group_name->pg_title} - {$group_name->pg_content}	<span > <a href="?step=images&del=true" >تغییر</a></span>
	</p>
	<h1>انتخاب تصویر</h1>
	<a href="?step=title" class="btn btn-warning" >Next Step</a>
	<div class="row" style="font-family: tahoma" >
	<div id="answersImage" style="margin: 5px;padding: 5px;background: #ffccff;position:fixed; top:20%; left:0;width:40%; height: 200px;overflow: auto;"></div>
		{foreach $imagesZara as $image}
		{$img = explode("?",$image)}
		{$img[0] = str_replace("/560/","/1024/",$img[0])}
			<img width="100"  src="{$img[0]}" onclick="add_image('http:{$img[0]}');show_image();"><br>
			<span onclick="add_image('http://{$img[0]}');show_image();" style="background:blue;cursor:pointer" >{$img[0]}</span><br> 
			 
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