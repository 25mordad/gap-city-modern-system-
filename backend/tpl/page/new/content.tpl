<div class="row">
    <form method="post" action="/gadmin/page/new" id="newPageForm" >
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            <label>
                صفحه مادر
            </label>
            <select class="form-control" name="parent_id" id="parent_id">
                <option value="0"> -- @@no_parent@@ --</option>
                {foreach $select_parent as $sp}
                    <option value="{$sp['value']}" >{$sp['name']}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label>
عنوان صفحه
            </label>
            <input required type="text" name="pg_title" placeholder="یک عنوان مناسب برای صفحه خود انتخاب کنید..." class="form-control">
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