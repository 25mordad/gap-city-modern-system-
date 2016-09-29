    <ul class="pagination no-margin pull-right">
        {if $smarty.get.paging neq 1}<li><a href="{pagingurl url= $smarty.server.REQUEST_URI paging= $smarty.get.paging-1 }">&laquo;</a></li>{/if}
        {section name=num start=1 loop=$paging+1 }
            {if $smarty.section.num.index neq $smarty.get.paging}
                <li><a href="{pagingurl url= $smarty.server.REQUEST_URI paging= {$smarty.section.num.index} }">{$smarty.section.num.index}</a></li>
            {else}
                <li class="active"><a href="#" >{$smarty.section.num.index}</a></li>
            {/if}
        {/section}
        {if $smarty.get.paging neq $paging}<li><a href="{pagingurl url= $smarty.server.REQUEST_URI paging= $smarty.get.paging+1 }">&laquo;</a></li>{/if}
    </ul>