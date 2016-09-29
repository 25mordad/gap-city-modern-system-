<div class="col-md-12" >
	<!-- ****** -->
	<form action="?step=size&upd=true" method="post">
	<button class="btn btn-warning" type="submit">Next Step</button>
	
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
سایز
        </h3>
    </div>
    <div class="box-body">
    	<p>
		{foreach $Allsizes as $as}
		<span class="badge">{$as}</span>
		{/foreach}
		
		<br>	<br>
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
			
            <div class="clearfix" ></div>
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
		{foreach $allColors as $as}
		<span class="badge">{$as}</span>
		{/foreach}
		
		<script>
		    $(function(){
		      // turn the element to select2 select style
		      $('#colorSelect').select2({
		    	  placeholder: 'انتخاب رنگ'
		      });
		      
		    });
		    
		  </script>
		  <br>	<br>
				<select multiple="multiple" style="width: 100%" name="color[]" id="colorSelect"> 
	      	{foreach $colorList as $s}
	     		<option value="{$s->pg_title}"  {if in_array($s->pg_title, $colors)} selected="selected" {/if} >{$s->pg_content}</option>
	     	{/foreach}
			</select> 
			
            <div class="clearfix" ></div>
		</p>
    </div>
    </form>
</div>
<!--  ******  -->
	