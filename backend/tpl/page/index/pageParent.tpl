<div class="box-tools pull-left">
    <div >

        <form method="get" action="/gadmin/page/?"  >
            <div class="input-group input-group-sm">
                    <span class="input-group-btn" >
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-filter"></i></button>
                     </span>
                <select class="form-control" name="f_parent" id="f_parent">
                    <option value="all"> نمایش همه صفحات </option>
                    <option value="0" {if $smarty.get.f_parent eq "0"} selected="selected" {/if}>@@no_parent@@</option>
                    {foreach $select_parent as $sp}
                        <option value="{$sp['value']}" {if $sp['value'] eq $smarty.get.f_parent} selected="selected" {/if} >{$sp['name']}</option>
                    {/foreach}
                </select>

                {if $smarty.get.f_parent neq "all"}<span class="input-group-addon btn btn-danger"
                                                        data-toggle="tooltip" data-placement="right" title=" حذف فیلتر صفحه مادر "
                                                        onclick="window.location = '?paging=1&search={$smarty.get.search}&f_parent=all&f_status={$smarty.get.f_status}'"><i class="fa  fa-close " style="color: white"></i></span>{/if}
            </div>
            <input type="hidden" name="paging" value="1" />
            <input type="hidden" name="f_status" value="{$smarty.get.f_status}" />
            <input type="hidden" name="search" value="{$smarty.get.search}" />
        </form>
    </div>
</div>