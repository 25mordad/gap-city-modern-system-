<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">
تعریف منو جدید
                </h3>
                <div class="box-tools pull-left">
                    <a class="btn btn-info btn-sm" href="/gadmin/menu/">
لیست منوها
                    </a>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive padding">
                    <form method="post" action="/gadmin/menu/new" id="newMenuForm" >
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-4 ">
                            <label>
عنوان منو
                            </label>
                            <input required type="text" name="title" value="{$smarty.get.title}" id="title" placeholder="عنوان منو"   class="form-control">
                        </div>
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-4">
                            <label>
ترتیب منو
                            </label>
                            <input required type="number"  name="order" id="order" value="0"  class="form-control">
                            <span class="help-block fontSize10">
                                یک عدد صحیح است که ترتیب قرار گرفتن منو در سایت را تعیین می‌کندبا ترتیب منوهای دیگر مقایسه و مکان منو در سایت مشخص می‌شود
                            </span>

                        </div>
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-4">
                            <label>
                                لینک منو
                            </label>
                            <input required type="text"  name="link" id="link" value="{$smarty.get.link}"   class="form-control">
                            <span class="help-block fontSize10">
آدرس نسبی به صفحه مورد نظر<br>مثال: gallery/
                            </span>

                        </div>
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-4">
                            <label>
                                انتخاب منوی مادر
                            </label>
                            <select class="form-control"  name="parent" id="parent"  >
                                <option value="0" selected="selected">بدون منوی مادر</option>
                                {foreach $main_menu as $key => $val}
                                <option value="{$key}" >{$val}</option>
                                {/foreach}
                            </select>
                        </div>
                        <div class="clearfix" ></div>
                        <div class="form-group col-md-2 col-sm-2">
                            <label>
                                &nbsp;
                            </label>
                            <button class="btn btn-success btn-block btn-flat " type="submit">
ثبت
                            </button>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('#newMenuForm').bootstrapValidator();
                            });
                        </script>
                    </form>

            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>