<div class="row">
    <form method="post" action="/gadmin/module/new" target="_blank" id="newModuleForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group">
            <label>
                نام ماژول به لاتین
            </label>
            <input required type="text" name="module_name" placeholder="یک عنوان مناسب برای ماژول خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد ماژول جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newModuleForm').bootstrapValidator();
            });
        </script>
    </form>
</div>