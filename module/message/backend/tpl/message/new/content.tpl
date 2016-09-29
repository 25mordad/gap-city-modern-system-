<div class="row">

    <form method="post" action="?send=true" id="newMessageForm" >
    <div class="col-md-12 col-xs-12">
        <div class="form-group">

            <label>
گیرنده

            </label>
            <div class="clearfix" ></div>

            <select class=" selectized "  style="width: 100%"  name="id_user" id="id_user"  required placeholder="گیرنده پیام" >
                    <option></option>
                {foreach $users as $row}
                    <option value="{$row->id}" >{$row->username} - {get_user_params id_user=$row->id name="14"}</option>
                {/foreach}
            </select>
        </div>

        <div class="form-group">
            <label>
عنوان پیام
            </label>
            <input required type="text" name="title" placeholder="یک عنوان مناسب برای پیام خود انتخاب کنید..." class="form-control">
        </div>

        <div class="form-group">
            <textarea class="form-control" required name="text" ></textarea>
        </div>

        <button class="btn btn-success btn-block btn-flat" type="submit">
ارسال پیام
        </button>
    </div>
        <script>
            $(document).ready(function() {
                $('#newMessageForm').bootstrapValidator();
            });
        </script>
    </form>
</div>
<link href="{$loct}/css/selectize.css" rel="stylesheet">
<script src="{$loct}/js/selectize.min.js"></script>
<script type="text/javascript">
    $(function() {

        $('#id_user').selectize();

    });
</script>