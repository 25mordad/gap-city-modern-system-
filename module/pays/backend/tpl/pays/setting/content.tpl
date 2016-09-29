<div class="row">
    <form method="post" action="/gadmin/pays/setting" id="settingForm" >
    <div class="col-md-12 col-xs-12">


        <div class="form-group">
            <label>
                کد دروازه پرداخت - زرین پال
            </label>
            <input required type="text" name="merchantID" value="{$GCMS_SETTING['pays']['merchantID']}" placeholder="کد رمز زرین پال" class="form-control">
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