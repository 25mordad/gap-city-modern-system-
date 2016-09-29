<div class="row">
    <form method="post" action="/gadmin/news/newgroup" id="newPageForm" >
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            <label>
                گروه خبری مادر
            </label>
            <select class="form-control" name="parent_id" id="parent_id">
                <option value="0">بدون گروه مادر</option>
                {foreach $select_group as $sp}
                    <option value="{$sp['value']}" >{$sp['name']}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label>
عنوان گروه خبری
            </label>
            <input required type="text" name="pg_title" placeholder="یک عنوان مناسب برای گروه خبری خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد صفحه جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newPageForm').bootstrapValidator();
            });
        </script>
    </form>
</div>