
<div class="row">
<br>
        <form method="post" action="?add=true"  >
            
            <div class="col-xs-2" style="padding-right: 20px">

                <div class="pull-right" style="padding-right: 20px">{get_user_name id_user=$packing->pg_title} 
                {get_user_params id_user=$packing->pg_title name="55"}
                    -
                                {$getuser->username} -  {$packing->pg_content}</div> 
            </div>
            
            
            
            <div class="col-xs-3" >

                           <div class="pull-right"  style="padding-right: 20px"> {date("Y-m-d",strtotime($packing->date_modified))} /  {jdate("Y-m-d",strtotime($packing->date_modified))}</div>
            </div>
            
            
            <div class="col-xs-2">
            
		<script>
		    $(function(){
		      // turn the element to select2 select style
		      $('#colorSelect').select2({
		    	  placeholder: 'انتخاب رنگ'
		      });
		      
		    });
		    
		  </script>
				<select  style="width: 100%" name="color" id="colorSelect"> 
	      	{foreach $colorList as $s}
	     		<option value="{$s->pg_content}"  >{$s->pg_content}</option>
	     	{/foreach}
			</select> 
            </div>
            
            <div class="col-xs-2">
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
				<select  style="width: 100%" name="size" id="sizeSelect"> 
	      	{foreach $sizeList as $s}
	     		<option value="{$s->pg_content}"  >{$s->pg_content}</option>
	     	{/foreach}
			</select> 

            </div>
            
            <div class="col-xs-2 input-group ">

                <input type="text" placeholder=" کد محصول "  required="required" title="  کد محصول "
                  data-toggle="tooltip" data-placement="top" name="barcode" id="barcode"
                       class="form-control">
               
                <span class="input-group-btn " >
                        <button type="submit" class="btn btn-primary btn-flat">
                            افزودن
                        </button>
                     </span>
            </div>

        </form>

</div>