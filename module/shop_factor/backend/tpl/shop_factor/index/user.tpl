<div class="box-tools pull-left">
    <div >

        <form method="get" action="/gadmin/shop_factor/?"  >
            <div class="input-group input-group-sm">
                    <span class="input-group-btn" >
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-filter"></i></button>
                     </span>
                <select class="form-control" name="user" id="user">
                    <option value="all"> نمایش همه  </option>
                    {foreach $users as $user}
                        <option value="{$user->id}" {if $user->id eq $smarty.get.user} selected="selected" {/if} >{$user->username}</option>
                    {/foreach}
                </select>

                {if $smarty.get.user neq "all"}<span class="input-group-addon btn btn-danger"
                                                        data-toggle="tooltip" data-placement="right" title=" حذف "
                                                        onclick="window.location = '?paging=1&search={$smarty.get.search}&user=all&status_pay={$smarty.get.status_pay}&status={$smarty.get.status}'"><i class="fa  fa-close " style="color: white"></i></span>{/if}
            </div>
            <input type="hidden" name="paging" value="1" />
            <input type="hidden" name="status_pay" value="{$smarty.get.status_pay}" />
            <input type="hidden" name="status" value="{$smarty.get.status}" />
            <input type="hidden" name="search" value="{$smarty.get.search}" />
        </form>
    </div>
</div>