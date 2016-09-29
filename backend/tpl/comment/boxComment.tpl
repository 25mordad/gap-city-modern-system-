<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu hidden-xs hidden-sm">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope"></i>
        <span class="label label-success">{count($allPendingComments)}</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">
            {if count($allPendingComments) eq 0}
                هیچ دیدگاه جدیدی وجود ندارد.
                {else}
{count($allPendingComments)}
 دیدگاه جدید منتظر تایید شما است.
            {/if}
        </li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <li>
                    {foreach $allPendingComments as $allPendingComment}
                    <a href="/gadmin/comment/edit/{$allPendingComment->id}">
                        <div class="pull-left">
                            <img src="{$loct}/img/default-avatar.png" class="img-circle" />
                        </div>
                        <h4>
{$allPendingComment->cm_author}
                            <small><i class="fa fa-clock-o"></i> {jdate(" l j F Y",strtotime($allPendingComment->cm_date))}</small>
                        </h4>
                        <div class="clearfix" ></div>
                        <p>
                            {$allPendingComment->cm_content|truncate:130:"..":true}
                        </p>
                    </a>
                    {/foreach}
                </li>
            </ul>
        </li>
        <li class="footer"><a href="/gadmin/comment/">
                مشاهده همه‌ی دیدگاه‌ها
        </a></li>
    </ul>
</li>