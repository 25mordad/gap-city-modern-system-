<div class="row">
    <form method="post" action="/gadmin/news/new" id="newPageForm" >
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            <label>
                گروه خبری
            </label>
            <select class="form-control" name="parent_id" id="parent_id">
                {foreach $select_group as $sp}
                    <option value="{$sp['value']}" {if $smarty.get.g eq  $sp['value']}selected="selected" {/if} >{$sp['name']}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label>
عنوان خبر
            </label>
            <input required type="text" name="pg_title" placeholder="یک عنوان مناسب برای خبر خود انتخاب کنید..." class="form-control">
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ایجاد خبر جدید
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newPageForm').bootstrapValidator();
            });
        </script>
    </form>
</div>