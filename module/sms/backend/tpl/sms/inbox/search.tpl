<div class="box-tools pull-left">
    <div >

        <form method="get" action="/gadmin/sms/inbox/?"  >
            <div class="input-group input-group-sm">
                    <span class="input-group-btn" >
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                     </span>
                <input type="text" placeholder="عبارت جستجو..."  name="search" id="search" class="form-control" {if $smarty.get.search neq "NULL"}value="{$smarty.get.search}"{/if}>
                {if $smarty.get.search neq "NULL"}<span class="input-group-addon btn btn-danger"
                                                        data-toggle="tooltip" data-placement="right" title=" حذف عبارت جستجو "
                                                        onclick="window.location = '?paging=1&search=NULL'"><i class="fa  fa-close " style="color: white"></i></span>{/if}
            </div>
            <input type="hidden" name="paging" value="1" />
        </form>
    </div>
</div>