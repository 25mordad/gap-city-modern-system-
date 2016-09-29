<li {if $part eq "admin"}class="active" {/if}>
    <a href="/gadmin">
        <i class="fa fa-dashboard"></i> <span>
            میزکار
        </span>
    </a>
</li>
{foreach $GCMSmenus as $GCMSmenu}
<li class="{if isset($GCMSmenu['child'])}treeview{/if}{if $part eq "{$GCMSmenu['part']}"} active{/if} " >
    <a href="/gadmin/{$GCMSmenu['part']}">
        <i class="{$GCMSmenu['icon']}"></i><span>{$GCMSmenu['title']}</span>
        {if isset($GCMSmenu['badge'])}<small class="badge pull-left {$GCMSmenu['badgeColor']}">{$GCMSmenu['badge']}</small>{/if}
        {if isset($GCMSmenu['child'])}<i class="fa fa-angle-left pull-right"></i>{/if}
    </a>
    {if isset($GCMSmenu['child'])}
        <ul class="treeview-menu">
            {foreach $GCMSmenu['child'] as $GCMSmenuChild}
                    <li class="{if $part eq "{$GCMSmenu['part']}" and $action eq "{$GCMSmenuChild['action']}"} active{/if} "><a href="/gadmin/{$GCMSmenuChild['link']}"><i class="fa fa-angle-double-right"></i> {$GCMSmenuChild['title']}
                            {if isset($GCMSmenuChild['badge'])}<small class="badge pull-left {$GCMSmenuChild['badgeColor']}">{$GCMSmenuChild['badge']}</small>{/if}
                        </a></li>
            {/foreach}
        </ul>
    {/if}

</li>
{/foreach}