<div class="box-tools pull-left">
    <div data-toggle="btn-toggle" class="btn-group">
        <button data-toggle="on" class="btn btn-info btn-sm
                {if $smarty.get.cm_status eq "publish"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&cm_type={$smarty.get.cm_type}&cm_status=publish'"
                type="button">
            دیدگاه‌های انتشاریافته
        </button>
        <button data-toggle="off" class="btn btn-info btn-sm
                                 {if $smarty.get.cm_status eq "pending"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&cm_type={$smarty.get.cm_type}&cm_status=pending'"
                type="button">
            دیدگاه‌های در دست بررسی
        </button>
        <button data-toggle="off" class="btn   btn-sm btn-info
                {if $smarty.get.cm_status eq "all"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&cm_type={$smarty.get.cm_type}&cm_status=all'"
                type="button">
            همه دیدگاه‌ها
        </button>
    </div>
</div>