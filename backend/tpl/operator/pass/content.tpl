<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
تغییر کلمه عبور اپراتور
                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm" href="/gadmin/operator/">
                        لیست اپراتورها
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                {if $smarty.session.level > {$operator->op_level} || $smarty.session.userid eq {$operator->id}}
                    <form method="post" action="/gadmin/operator/pass/{$operator->id}" id="passOperatorForm" >
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-4 col-sm-5">
                            <label>
کلمه عبور
                            </label>
                            <input required type="password" name="password" id="password"   class="form-control">
                        </div>
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-4 col-sm-5">
                            <label>
تکرار                                 کلمه عبور
                            </label>
                            <input required type="password" name="confirm_password" id="confirm_password"   class="form-control">
                        </div>


                        <div class="clearfix" ></div>


                        <div class="form-group col-md-2 col-sm-2">
                            <label>
                                &nbsp;
                            </label>
                            <button class="btn btn-success btn-block btn-flat " type="submit">
                                ویرایش
                            </button>
                        </div>

                        <input required type="hidden"  name="username"   value="{$operator->username}" >
                        <script>
                            $(document).ready(function() {
                                $('#passOperatorForm').bootstrapValidator();
                            });
                        </script>
                    </form>
                {else}
                    کاربر گرامی، شما به این بخش دسترسی ندارید.
                {/if}

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>