<div class="row">
    <form method="post" action="/gadmin/user/edit/{$user->id}" id="newUserForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group ">
            <label>
نام کاربری
            </label>
            {$user->username}
        </div>
        {if isset($smarty.get.edit_params) and $smarty.get.edit_params eq "true"}
        <input type="hidden" name="edit_params" id="edit_params" value="true" />
        {foreach $user_params as $user_param}
            <div class="form-group col-md-3">
                <label for="meta_{$user_param['id']}">{$user_param['label']}</label>
                <input name="meta_{$user_param['id']}" id="meta_{$user_param['id']}"  type="text" class="form-control" value="{$user_param['value']}"/>
            </div>
        {/foreach}

        {else}
        <div class="form-group">
            <label>
                ایمیل معتبر
            </label>
            <input required type="email" name="email" value="{$user->email}" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label>
                @@UserStatus@@
            </label>
            <select class="form-control"  name="status" id="status" >
                <option value="active" {if $user->status eq "active"}selected="selected" {/if} >@@Active@@</option>
                <option value="pending" {if $user->status eq "pending"}selected="selected" {/if} >@@Deactive@@</option>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>
نوع عضویت
            </label>
            <select name="user_level" id="user_level" class="form-control">
                {foreach $GCMS_USER_LEVEL as $key=>$val }
                    <option value="{$key}" {if $user->user_level eq $key}selected="selected"{/if} >{$val}</option>
                {/foreach}
            </select>
        </div>
        {/if}
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
    <p style="padding: 10px" >
        <span data-toggle="tooltip" style="font-size: 10px" data-placement="bottom" title="  تاریخ ایجاد عضو"><i class="fa fa-clock-o" ></i>
              تاریخ ایجاد عضو :
            {jdate(" l j F Y",strtotime({$user->date_created}))}</span>
        {if isset($smarty.get.edit_params) and $smarty.get.edit_params eq "true"}
            <button class="btn bg-purple margin" onclick="location.href='/gadmin/user/edit/{$user->id}'" >
بازگشت به ویرایش عضو
            </button>
            {else}
        <button class="btn bg-purple margin" onclick="location.href='/gadmin/user/edit/{$user->id}/?edit_params=true'" >
            ویرایش پارامترهای عضو
        </button>
        {/if}
    </p>
</div>