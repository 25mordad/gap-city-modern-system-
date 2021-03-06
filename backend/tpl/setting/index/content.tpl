<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
تنظیمات سایت
                </h3>
            </div><!-- /.box-header -->
            <div class="box-body ">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="active"><a data-toggle="tab" href="#tabs-1" aria-expanded="true">
                                 عمومی
                        </a></li>
                        <li class=""><a data-toggle="tab" href="#tabs-2" aria-expanded="false">
                            موتورهای جستجو
                        </a></li>
                        <li class=""><a data-toggle="tab" href="#tabs-3" aria-expanded="false">
 آمار سایت
                        </a></li>
                        <li class=""><a data-toggle="tab" href="#tabs-4" aria-expanded="false">
 نظرات
                        </a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tabs-1" class="tab-pane active">
                            <p>
                            <form method="post" action="/gadmin/setting/update/" id="editSettingForm" >
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-4 ">
                                    <label>
ایمیل مدیر سایت
                                    </label>
                                    <input required type="email" name="general|email" id="general|email"  value="{$GCMS_SETTING['general']['email']}"  class="form-control">
                                </div>
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-2 col-sm-2">
                                    <label>
                                        &nbsp;
                                    </label>
                                    <button class="btn btn-success btn-block btn-flat " type="submit">
به روز رسانی تنظیمات
                                    </button>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#editSettingForm').bootstrapValidator();
                                    });
                                </script>
                                <div class="clearfix" ></div>
                                <input type="hidden" name="tabs" value="tabs-1" />
                                <input type="hidden" name="stng" value="general" />
                            </form>
                            </p>
                        </div><!-- /.tab-pane -->
                        <div id="tabs-2" class="tab-pane">
                            <p>
                            <form method="post" action="/gadmin/setting/update/" id="editSettingForm2" >
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-4 ">
                                    <label>
عنوان سایت
                                    </label>
                                    <input required type="text" name="seo|title" id="seo|title"  value="{$GCMS_SETTING['seo']['title']}"  class="form-control">
                                </div>
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-4 ">
                                    <label>
                                        کلمات کلیدی سایت
                                    </label>
                                    <input required type="text" name="seo|keyword" id="seo|keyword"  value="{$GCMS_SETTING['seo']['keyword']}"  class="form-control">
                                </div>
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-4 ">
                                    <label>
                                        شرح سایت
                                    </label>
                                    <input required type="text" name="seo|description" id="seo|description"  value="{$GCMS_SETTING['seo']['description']}"  class="form-control">
                                </div>
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-2 col-sm-2">
                                    <label>
                                        &nbsp;
                                    </label>
                                    <button class="btn btn-success btn-block btn-flat " type="submit">
                                        به روز رسانی تنظیمات
                                    </button>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#editSettingForm2').bootstrapValidator();

                                        // Javascript to enable link to tab
                                        var url = document.location.toString();
                                        if (url.match('#')) {
                                            $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
                                        }

// Change hash for page-reload
                                        $('.nav-tabs a').on('shown', function (e) {
                                            window.location.hash = e.target.hash;
                                        })
                                    });
                                </script>
                                <div class="clearfix" ></div>
                                <input type="hidden" name="tabs" value="tabs-2" />
                                <input type="hidden" name="stng" value="seo" />
                            </form>
                            </p>
                        </div><!-- /.tab-pane -->
                        <div id="tabs-3" class="tab-pane">
                            <p>
                            <form method="post" action="/gadmin/setting/update/" id="editSettingForm3" >
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-4 ">
                                    <label>
                                        کد آمار سایت
                                    </label>
                                    <input required type="text" name="statistic|ga_profile_id" id="statistic|ga_profile_id"  value="{$GCMS_SETTING['statistic']['ga_profile_id']}"  class="form-control">
                                </div>
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-2 col-sm-2">
                                    <label>
                                        &nbsp;
                                    </label>
                                    <button class="btn btn-success btn-block btn-flat " type="submit">
                                        به روز رسانی تنظیمات
                                    </button>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#editSettingForm3').bootstrapValidator();

                                    });
                                </script>
                                <div class="clearfix" ></div>
                                <input type="hidden" name="tabs" value="tabs-3" />
                                <input type="hidden" name="stng" value="statistic" />
                            </form>
                            </p>
                        </div><!-- /.tab-pane -->
                        <div id="tabs-4" class="tab-pane">
                            <p>
                            <form method="post" action="/gadmin/setting/update/" id="editSettingForm4" >
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-4 ">
                                    <label>
                                        ایمیل مدیریت نظرات
                                    </label>
                                    <input required type="email" name="comment|email" id="comment|email"  value="{$GCMS_SETTING['comment']['email']}"  class="form-control">
                                </div>
                                <div class="clearfix" ></div>
                                <div class="form-group col-md-2 col-sm-2">
                                    <label>
                                        &nbsp;
                                    </label>
                                    <button class="btn btn-success btn-block btn-flat " type="submit">
                                        به روز رسانی تنظیمات
                                    </button>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        $('#editSettingForm4').bootstrapValidator();
                                    });
                                </script>
                                <div class="clearfix" ></div>
                                <input type="hidden" name="tabs" value="tabs-4" />
                                <input type="hidden" name="stng" value="comment" />
                            </form>
                            </p>
                        </div><!-- /.tab-pane -->
                    </div><!-- /.tab-content -->
                </div>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>