<div class="row">
    <form method="post" action="?send=true" id="newMessageForm" >
    <div class="col-md-12 col-xs-12">
        <div class="form-group">
            <label>
{get_user_params id_user=$message->id_user name="14"} -  {get_user_name id_user=$message->id_user }{$getuser->username}
            </label>
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

    <p >
    <div class="clearfix" style="margin-bottom: 10px" ></div>
    {foreach $messageTexts as $rowMss}
        <div class="callout callout-{if $rowMss->id_user eq "0" }danger{else}info{/if}">
            <p>{htmlspecialchars_decode($rowMss->text)}</p>
            <small>
                <cite >
                    {if $rowMss->id_user eq "0" }
                        ارسال شده توسط ادمین
                    {else}
                        {get_user_params  id_user=$rowMss->id_user name="14"}
                        {get_user_name id_user=$rowMss->id_user } {$getuser->username}
                    {/if}
                    <span class="pull-left label label-info">{jdate("H:i l j F Y ",strtotime( $rowMss->date ))}</span>
                </cite >
            </small>
        </div>
    {/foreach}
    <div class="clearfix" ></div>
    </p>

</div>