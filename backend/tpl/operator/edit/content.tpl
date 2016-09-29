<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
ویرایش اپراتور
                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm" href="/gadmin/operator/">
                        لیست اپراتورها
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                {if $smarty.session.level > {$operator->op_level} || $smarty.session.userid eq {$operator->id}}
                    <form method="post" action="/gadmin/operator/edit/{$operator->id}" id="editOperatorForm" >
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-4 col-sm-5">
                            <label>
                                نام
                            </label>
                            <input required type="text" name="name" id="name"  value="{$operator->name}" class="form-control">
                        </div>
                        <div class="form-group col-md-4 col-sm-5">
                            <label>
                                ایمیل
                            </label>
                            <input required type="email"  name="email" id="email"  value="{$operator->email}" class="form-control">
                        </div>

                        <div class="form-group col-md-4 col-sm-2">
                            <label>
                                وضعیت کاربر
                            </label>
                            <div class="clearfix" ></div>
                            <input id="switch_status" name="switch_status" type="checkbox" class="simple"  data-on-color="success" data-off-color="warning"
                                   {if $operator->status eq "true"}checked {/if}
                                   name="switch_pg_status"
                                   data-on-text="فعال"
                                   data-off-text=" غیرفعال "
                                   data-label-width="0"
                                    >
                            <input type="hidden" name="status" value="{$operator->status}" id="status">
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

                        {if $smarty.session.level >= 8}
                            <div class="form-group col-md-4 col-sm-5">
                                <label>
                                    سطح دسترسی
                                </label>
                                <select class="form-control"  name="level" id="level"  >
                                    {if $operator->op_level eq 10}
                                        <option value="10" selected >
                                            سوپر ادمین
                                        </option>
                                    {/if}
                                    <option value="8" {if $operator->op_level eq "8"} selected {/if} >
                                        مدیر اصلی
                                    </option>
                                    <option value="6" {if $operator->op_level eq "6"} selected {/if} >
                                        اپراتور
                                    </option>
                                </select>
                            </div>
                        {/if}
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
                                $('#editOperatorForm').bootstrapValidator();
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