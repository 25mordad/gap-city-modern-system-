<div class="row">
    <form method="post" action="/gadmin/user/chngpass/{$user->id}" id="newUserForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group ">
            <label>
نام کاربری
            </label>
            {$user->username}
        </div>

        <div class="form-group col-md-6" >
            <label>
                کلمه عبور
            </label>
            <input required type="password" name="password"  class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label>
                تکرار کلمه عبور
            </label>
            <input required type="password" name="confirm_password"  class="form-control">
        </div>


        <button class="btn btn-success btn-block btn-flat" type="submit">
تغییر کلمه عبور
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newUserForm').bootstrapValidator();
            });
        </script>
        <input type="hidden" name="submitForm" value="true">
    </form>
    <div class="clearfix" ></div>
    <p style="padding: 10px" >
        <span data-toggle="tooltip" style="font-size: 10px" data-placement="bottom" title="  تاریخ ایجاد عضو"><i class="fa fa-clock-o" ></i>
              تاریخ ایجاد عضو :
            {jdate(" l j F Y",strtotime({$user->date_created}))}</span>

    </p>
</div>