<div class="row">
    <form method="post" action="/gadmin/shop/setting" id="settingForm" >
    <div class="col-md-12 col-xs-12">


        <div class="form-group">
            <label>
                تاریخ ارسال بعدی محصولات
            </label>
            <input required type="text" name="nextdelivery" value="{$GCMS_SETTING['shop']['nextdelivery']}" placeholder="  تاریخ ارسال بعدی محصولات " class="form-control">
        </div>
        <div class="form-group">
            <label>
                مبلغ رفرنس یورو   
            </label>
            <input required type="text" name="eurorate" value="{$GCMS_SETTING['shop']['eurorate']}" placeholder="   مبلغ رفرنس یورو      " class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ثبت
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#settingForm').bootstrapValidator();
            });
        </script>
    </form>
</div>