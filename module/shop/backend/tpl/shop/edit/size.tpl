<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
سایز
        </h3>
    </div>
    <div class="box-body">
		<p>
		<link href="/core/module/shop/backend/css/select2.min.css" rel="stylesheet" />
		<script src="/core/module/shop/backend/js/select2.min.js"></script>
	  	
		<script>
		    $(function(){
		      // turn the element to select2 select style
		      $('#sizeSelect').select2({
		    	  placeholder: 'انتخاب سایز'
		      });
		      
		    });
		    
		  </script>
				<select multiple="multiple" style="width: 100%" name="size[]" id="sizeSelect"> 
	      	{foreach $sizeList as $s}
	     		<option value="{$s->pg_title}"  {if in_array($s->pg_title, $sizes)} selected="selected" {/if} >{$s->pg_content}</option>
	     	{/foreach}
			</select> 
		</p>
    </div>
</div>
<!--  ******  -->
