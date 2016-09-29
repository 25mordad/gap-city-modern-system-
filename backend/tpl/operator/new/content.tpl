<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
تعریف اپراتور جدید
                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm" href="/gadmin/operator/">
لیست اپراتورها
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                {if $smarty.session.level >= 8}
                    <form method="post" action="/gadmin/operator/new" id="newOperatorForm" >
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-4 col-sm-5">
                            <label>
                                نام
                            </label>
                            <input required type="text" name="name" id="name"   class="form-control">
                        </div>
                        <div class="form-group col-md-4 col-sm-5">
                            <label>
                                ایمیل
                            </label>
                            <input required type="email"  name="email" id="email"   class="form-control">
                        </div>

                        <div class="form-group col-md-4 col-sm-2">
                            <label>
                                وضعیت کاربر
                            </label>
                            <div class="clearfix" ></div>
                            <input id="switch_status" name="switch_status" type="checkbox" class="simple"  data-on-color="success" data-off-color="warning"
                                   checked
                                   name="switch_pg_status"
                                   data-on-text="فعال"
                                   data-off-text=" غیرفعال "
                                   data-label-width="0"
                                    >
                            <input type="hidden" name="status" value="true"  id="status">
                            <script>
                                $(document).ready(function() {

                                    $('input[name="switch_status"]').on('switchChange.bootstrapSwitch', function(event, state) {

                                        if ( $('#switch_status').bootstrapSwitch('state'))
                                            $('#status').val("true");
                                        else
                                            $('#status').val("false");
                                    });
                                });
                            </script>
                        </div>
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-4 col-sm-5">
                            <label>
                                نام کاربری
                            </label>
                            <input required type="text" name="username" id="username"   class="form-control">
                        </div>
                        <div class="form-group col-md-4 col-sm-5">
                            <label>
کلمه عبور
                            </label>
                            <input required type="password" name="password" id="password"   class="form-control">
                        </div>
                        <div class="form-group col-md-2 col-sm-2">
                            <label>
                                سطح دسترسی
                            </label>
                            <select class="form-control"  name="level" id="level"  >
                                <option value="8"  >
                                    مدیر اصلی
                                </option>
                                <option value="6"  >
                                    اپراتور
                                </option>
                            </select>
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
                        <script>
                            $(document).ready(function() {
                                $('#newOperatorForm').bootstrapValidator();
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