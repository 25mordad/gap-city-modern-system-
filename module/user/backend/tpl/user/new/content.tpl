<div class="row">
    <form method="post" action="/gadmin/user/new" id="newUserForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group  col-md-6">
            <label>
نام کاربری
            </label>
            <input required type="text" name="username" placeholder="نام کاربری را وارد کنید" class="form-control">
        </div>

        <div class="form-group  col-md-6">
            <label>
                ایمیل معتبر
            </label>
            <input required type="email" name="email" placeholder="ایمیل خود را وارد کنید" class="form-control">
        </div>

        <div class="form-group  col-md-6">
            <label>
کلمه عبور
            </label>
            <input required type="password" name="password" placeholder="کلمه عبور" class="form-control">
        </div>

        <div class="form-group  col-md-6">
            <label>
تایید کلمه عبور
            </label>
            <input required type="password" name="confirm_password" placeholder="تکرار کلمه عبور" class="form-control">
        </div>


        <div class="form-group col-md-6">
            <label>
                @@UserStatus@@
            </label>
            <select class="form-control"  name="status" id="status" >
                <option value="active">@@Active@@</option>
                <option value="pending">@@Deactive@@</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>
نوع عضویت
            </label>
            <select name="user_level" id="user_level" class="form-control">
                {foreach $GCMS_USER_LEVEL as $key=>$val }
                    <option value="{$key}">{$val}</option>
                {/foreach}
            </select>
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد کاربر جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newUserForm').bootstrapValidator();
            });
        </script>
    </form>
</div>