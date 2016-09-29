<div class="row">
    <form method="post" action="/gadmin/user/setting " id="newUserForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group ">
            {$user->username}
        </div>
                <label>
                    سطح دسترسی کاربری
                </label>

<div class="clearfix" ></div>
        {foreach $GCMS_USER_LEVEL as $key => $val}
        <div class="form-group  col-md-3 " >
            <label>
            </label>
            <input required type="text" name="{$key}" value="{$val}" class="form-control">
        </div>
        {/foreach}

                <label>
تعریف پارامترها
                </label>

        <div class="clearfix" ></div>
        {foreach $GCMS_USER_PARAM as $key => $val}
        <div class="form-group  col-md-3 " >
            <label>
            </label>
            <input required type="text" name="{$key}" value="{$val}" class="form-control">
        </div>
        {/foreach}

        <button class="btn btn-success btn-block btn-flat" type="submit">
ویرایش
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

</div>