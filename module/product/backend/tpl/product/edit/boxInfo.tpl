<!-- ****** -->
<div class="box box-solid box-primary">
    <div class="box-header">
        <h3 class="box-title">
اطلاعات محصول
        </h3>
    </div>
    <div class="box-body">
        <p class="col-md-12">
            <label for="price" >
قیمت
            </label>
            <input type="text" value="{$product->price}" name="price" id="price" placeholder="قیمت" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="model" >
                مدل
            </label>
            <input type="text" value="{$product->model}" name="model" id="model" placeholder="مدل" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="barcode" >
بارکد
            </label>
            <input type="text" value="{$product->barcode}" name="barcode" id="barcode" placeholder="بارکد" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="quantity" >
تعداد
            </label>
            <input type="number" value="{$product->quantity}" name="quantity" id="quantity" placeholder="تعداد" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="weight" >
وزن
            </label>
            <input type="text" value="{$product->weight}" name="weight" id="weight" placeholder="وزن" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="dimension" >
ابعاد
            </label>
            <input type="text" value="{$product->dimension}" name="dimension" id="dimension" placeholder="ابعاد" class="form-control">
        </p>
        <p class="col-md-6">
            <label for="p_order" >
ترتیب نمایش
            </label>
            <input type="number" value="{$product->p_order}" name="p_order" id="p_order" placeholder="ترتیب نمایش" class="form-control">
        </p>
        <p class="col-md-12">
            <label  >
حمل و نقل
            </label>
        <div class="clearfix" ></div>

        <input type="radio" value="yes" name="transport" id="transport1" {if $product->transport eq "yes" } checked {/if} >
        <label for="transport1">
            دارد
        </label>
        <span style="margin-right: 20px" ></span>
        <input type="radio" value="no" name="transport" id="transport2" {if $product->transport eq "no" } checked {/if} >
        <label for="transport2">
            ندارد
        </label>

            <script>
                $(document).ready(function() {

                    $('#transport1').bootstrapSwitch('destroy')
                    $('#transport2').bootstrapSwitch('destroy')
                });
            </script>
        </p>

        <div class="clearfix" ></div>
    </div>
</div>
<!--  ******  -->
