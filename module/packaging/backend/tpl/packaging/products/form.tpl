
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
            <input type="text" placeholder=" کد محصول "  required="required" title="  کد محصول "
                  data-toggle="tooltip" data-placement="top" name="barcode" id="barcode"
                       class="form-control">
            </div>
            
            <div class="col-xs-2">
            <input type="text" placeholder=" سایز  " required="required"  title="  سایز  "
                  data-toggle="tooltip" data-placement="top" name="size" id="size"
                       class="form-control">
            </div>
            
            <div class="col-xs-2 input-group ">


                 
                
                 <input type="text" placeholder=" رنگ  " required="required" title="  رنگ  "
                  data-toggle="tooltip" data-placement="top" name="color" id="color"
                       class="form-control">
                
               
                <span class="input-group-btn " >
                        <button type="submit" class="btn btn-primary btn-flat">
                            افزودن
                        </button>
                     </span>
            </div>

        </form>

</div>