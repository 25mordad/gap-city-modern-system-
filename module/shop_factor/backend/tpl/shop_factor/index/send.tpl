<div class="box-tools pull-left">
    <div data-toggle="btn-toggle" class="btn-group">
        <button data-toggle="on" class="btn btn-info btn-sm
                {if $smarty.get.status eq "all"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&user={$smarty.get.user}&status_pay={$smarty.get.status_pay}&status=all'"
                type="button">
            همه
        </button>
        <button data-toggle="off" class="btn btn-info btn-sm
                                 {if $smarty.get.status eq "step1"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&user={$smarty.get.user}&status_pay={$smarty.get.status_pay}&status=step1'"
                type="button">
            ارسال نشده
        </button>
        <button data-toggle="off" class="btn   btn-sm btn-info
                {if $smarty.get.status eq "send"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&user={$smarty.get.user}&status_pay={$smarty.get.status_pay}&status=send'"
                type="button">
            ارسال شده
        </button>
    </div>
</div>