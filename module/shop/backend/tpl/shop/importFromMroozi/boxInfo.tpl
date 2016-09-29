<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
اطلاعات محصول
        </h3>
    </div>
    <div class="box-body">
        <p class="col-md-12">
            <label for="brand" >
 برند
            </label>
          
            <select class="form-control" name="brand" id="brand" >
            
                 {foreach $brands as $br}
                     <option value="{$br->id}" {if $product->brand eq $br->id} selected="selected" {/if} 	>{$br->pg_content}</option>
                 {/foreach}
             </select>
        </p>
        
        <p class="col-md-6">
            <label for="quantity" >
تعداد
            </label>
            <input type="number" value="{$product->quantity}" name="quantity" id="quantity" placeholder="تعداد" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="p_order" >
ترتیب نمایش
            </label>
            <input type="number" value="{$product->p_order}" name="p_order" id="p_order" placeholder="ترتیب نمایش" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="delivery_time" >
 تحویل (روز)
            </label>
            <input type="number" value="{$product->delivery_time}" name="delivery_time" id="delivery_time" placeholder="زمان تحویل کالا" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="refrence" >
کد رفرنس
            </label>
            <input type="text" value="{$product->refrence}" name="refrence" id="refrence" placeholder="رفرنس" class="form-control">
        </p>
        <p class="col-md-12">
            <label for="link" >
لینک به سایت رفرنس
            </label>
            <input type="text" value="{$product->link}" name="link" id="link" placeholder="URL" class="form-control" style="font-family: tahoma;font-size: 12px">
            <label for="link" >
				<a href="{$product->link}" target="_blank" style="font-size: 9px;font-weight: normal;"><i class="glyphicon glyphicon-new-window fontSize9" ></i> Open in new window</a>
            </label>
        </p>
        
        
        

        <div class="clearfix" ></div>
    </div>
</div>
<!--  ******  -->
