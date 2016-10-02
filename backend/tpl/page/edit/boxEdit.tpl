<!-- ****** -->
<div class="box box-solid box-info">
    <div class="box-header">
        <h3 class="box-title">
            ویرایش صفحه
        </h3>
    </div>
    <div class="box-body">
        <p>
            <button class="btn btn-success btn-block btn-flat">
                ثبت
            </button>
        <div class="clearfix" ></div>
        <div class="row" >
            <div class="col-md-6" >
                <a href="/page/show/{$page->id}/title+ {changetoplus title =$page->pg_title}" class="text-aqua "  target="_blank"  ><i class="glyphicon glyphicon-new-window fontSize9" ></i>
                    <small class="fontSize9">لینک صفحه در سایت</small></a>
            </div>
            <div class="col-md-6" >
                <a href="/gadmin/menu/new?title={$page->pg_title|truncate:35:"":true}&link=/page/show/{$page->id}/{changetoplus title =$page->pg_title}" class="text-light "  ><i class="glyphicon glyphicon glyphicon-list " ></i>
                    <small class="fontSize9">ایجاد منو برای صفحه</small></a>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                <div class="form-group">
                    <label>
                        صفحه مادر
                    </label>
                    <select class="form-control" name="parent_id" id="parent_id">
                        <option value="0"> -- @@no_parent@@ --</option>
                        {foreach $select_parent as $sp}
                                <option value="{$sp['value']}" {if $sp['value'] eq $page->parent_id} selected="selected" {/if} >{$sp['name']}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
        </div>
        <div class="row" >
            <div class="col-md-10 col-md-offset-1" >
                <i class="fa fa-check-square" ></i>
                وضعیت صفحه
                <div class="clearfix" ></div>
                <p>
                    <input id="switch_pg_status" type="checkbox" class="simple"  data-on-color="success" data-off-color="warning"
                           {if $page->pg_status eq "publish"}checked {/if}
                           name="switch_pg_status"
                           data-on-text="درحال انتشار"
                           data-off-text="در حال بررسی"
                           data-label-width="0"
                            >
                    <input type="hidden" name="pg_status" value="{$page->pg_status}" id="pg_status">
                    <script>
                        $(document).ready(function() {

                            $('input[name="switch_pg_status"]').on('switchChange.bootstrapSwitch', function(event, state) {

                                if ( $('#switch_pg_status').bootstrapSwitch('state'))
                                    $('#pg_status').val("publish");
                                else
                                    $('#pg_status').val("pending");
                            });
                        });
                    </script>
                </p>
                <div class="clearfix" ></div>
                <i class="fa fa-comments " ></i>

                وضعیت دیدگاه های صفحه

                <div class="clearfix" ></div>
                <p>
                    <input id="switch_comment_status" type="checkbox" class="simple"  data-on-color="success" data-off-color="danger"
                           {if $page->comment_status eq "open"}checked {/if}
                           name="switch_comment_status"
                           data-on-text=" باز "
                           data-off-text=" بسته "
                           data-label-width="0"
                            >
                    <input type="hidden" name="comment_status" value="{$page->comment_status}" id="comment_status">
                    <script>
                        $(document).ready(function() {

                            $('input[name="switch_comment_status"]').on('switchChange.bootstrapSwitch', function(event, state) {

                                if ( $('#switch_comment_status').bootstrapSwitch('state'))
                                    $('#comment_status').val("open");
                                else
                                    $('#comment_status').val("close");
                            });
                        });
                    </script>
                </p>
                <div class="clearfix" ></div>
            </div>
        </div>

        </p>
    </div>
</div>
<!--  ******  -->