<div class="box-tools pull-left">
    <div data-toggle="btn-toggle" class="btn-group">
        <button data-toggle="on" class="btn btn-info btn-sm
                {if $smarty.get.status eq "send"} active {/if} "
                onclick="window.location = '?paging=1&status=send'"
                type="button">
            پیام های در انتظار پاسخ
        </button>
        <button data-toggle="off" class="btn btn-info btn-sm
                                 {if $smarty.get.status eq "waiting"} active {/if} "
                onclick="window.location = '?paging=1&status=waiting'"
                type="button">
            پیام های پاسخ داده شده
        </button>
        <button data-toggle="off" class="btn   btn-sm btn-info
                {if $smarty.get.status eq "all"} active {/if} "
                onclick="window.location = '?paging=1&status=all'"
                type="button">
            همه پیام ها
        </button>
    </div>
</div>