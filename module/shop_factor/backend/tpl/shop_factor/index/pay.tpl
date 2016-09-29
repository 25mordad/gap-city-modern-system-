<div class="box-tools pull-left">
    <div data-toggle="btn-toggle" class="btn-group">
        <button data-toggle="on" class="btn btn-info btn-sm
                {if $smarty.get.status_pay eq "all"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&user={$smarty.get.user}&status_pay=all&status={$smarty.get.status}'"
                type="button">
            همه
        </button>
        <button data-toggle="off" class="btn btn-info btn-sm
                                 {if $smarty.get.status_pay eq "confirm"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&user={$smarty.get.user}&status_pay=confirm&status={$smarty.get.status}'"
                type="button">
            پرداخت شده
        </button>
        <button data-toggle="off" class="btn   btn-sm btn-info
                {if $smarty.get.status_pay eq "pending"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&user={$smarty.get.user}&status_pay=pending&status={$smarty.get.status}'"
                type="button">
            عدم پرداخت
        </button>
    </div>
</div>