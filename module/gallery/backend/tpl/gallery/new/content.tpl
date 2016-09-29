<div class="row">
    <form method="post" action="/gadmin/gallery/new" id="newGalleryForm" >
    <div class="col-md-12 col-xs-12">

        <div class="form-group">
            <label>
عنوان گالری عکس
            </label>
            <input required type="text" name="pg_title" placeholder="یک عنوان مناسب برای گالری عکس خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد گالری عکس جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newGalleryForm').bootstrapValidator();
            });
        </script>
    </form>
</div>