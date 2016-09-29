<div class="row">
    <form method="post" action="/gadmin/box/new" id="newPageForm" >
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            <label>
                صفحه مادر
            </label>
            <select class="form-control" name="parent_id" id="parent_id">
                <option value="0"> نمایش در تمام صفحات </option>
                {foreach $select_parent as $sp}
                    <option value="{$sp['value']}" {if $smarty.get.pid eq $sp['value'] }selected="selected" {/if} >{$sp['name']}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label>
عنوان بلوک
            </label>
            <input required type="text" name="box_title" placeholder="یک عنوان مناسب برای بلوک خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد بلوک جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newPageForm').bootstrapValidator();
            });
        </script>
    </form>
</div>