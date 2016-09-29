<li><a href="/gadmin"><i class="fa fa-dashboard"></i> میزکار</a></li>
<li><a href="/gadmin/shop">
        لیست محصولات
    </a></li>

<li><a href="/gadmin/shop/?paging=1&search=NULL&f_parent={$product->group_id}&f_status=all">
        همه محصولات گروه
        {get_page id=$product->group_id}{$getpage->pg_title}
    </a></li>
<li class="active"> ساخت تصویر اینستاگرام 
{$product->name}
</li>