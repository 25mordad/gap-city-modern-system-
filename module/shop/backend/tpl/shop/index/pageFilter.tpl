<div class="box-tools pull-left">
    <div data-toggle="btn-toggle" class="btn-group">
        <button data-toggle="on" class="btn btn-info btn-sm
                {if $smarty.get.f_status eq "publish"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&f_parent={$smarty.get.f_parent}&f_status=publish'"
                type="button">
            محصولات انتشاریافته
        </button>
        <button data-toggle="off" class="btn btn-info btn-sm
                                 {if $smarty.get.f_status eq "pending"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&f_parent={$smarty.get.f_parent}&f_status=pending'"
                type="button">
            محصولات در دست بررسی
        </button>
        <button data-toggle="off" class="btn   btn-sm btn-info
                {if $smarty.get.f_status eq "all"} active {/if} "
                onclick="window.location = '?paging=1&search={$smarty.get.search}&f_parent={$smarty.get.f_parent}&f_status=all'"
                type="button">
            همه محصولات
        </button>
    </div>
</div>